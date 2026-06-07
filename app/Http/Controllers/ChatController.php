<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatbotKnowledge;
use App\Models\ChatbotSetting;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller
{
    public function chat(Request $request)
    {
        $request->validate([
            'message'           => 'required|string|max:2000',
            'history'           => 'nullable|array|max:20',
            'history.*.role'    => 'required|in:user,assistant',
            'history.*.content' => 'required|string|max:2000',
        ]);

        $defaultPrompt = "Tu es l'assistant virtuel officiel du RGPH (Recensement Général de la Population et de l'Habitat) du Cameroun, disponible sur census.diginova.cm. Tu aides les visiteurs avec des réponses précises, professionnelles et concises. Si une question dépasse tes connaissances, oriente vers le contact officiel.";

        $systemPrompt = ChatbotSetting::get('system_prompt', $defaultPrompt);

        $knowledge = ChatbotKnowledge::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('created_at')
            ->get();

        if ($knowledge->isNotEmpty()) {
            $systemPrompt .= "\n\n--- BASE DE CONNAISSANCES ---\n";
            foreach ($knowledge as $entry) {
                $cat = $entry->category ? "[{$entry->category}] " : '';
                $systemPrompt .= "\n### {$cat}{$entry->title}\n{$entry->content}\n";
            }
        }

        $messages = [['role' => 'system', 'content' => $systemPrompt]];

        foreach ($request->input('history', []) as $msg) {
            $messages[] = ['role' => $msg['role'], 'content' => $msg['content']];
        }

        $messages[] = ['role' => 'user', 'content' => $request->message];

        $model = ChatbotSetting::get('model', 'llama3.1:latest');

        return response()->stream(function () use ($messages, $model) {
            try {
                $response = Http::withOptions(['stream' => true])
                    ->timeout(180)
                    ->post('http://localhost:11434/api/chat', [
                        'model'    => $model,
                        'messages' => $messages,
                        'stream'   => true,
                    ]);

                $body   = $response->getBody();
                $buffer = '';

                while (!$body->eof()) {
                    $buffer .= $body->read(512);

                    while (($pos = strpos($buffer, "\n")) !== false) {
                        $line   = substr($buffer, 0, $pos);
                        $buffer = substr($buffer, $pos + 1);

                        if ($line === '') continue;

                        $data = json_decode($line, true);
                        if (!$data) continue;

                        if (isset($data['message']['content']) && $data['message']['content'] !== '') {
                            echo 'data: ' . json_encode(['token' => $data['message']['content']]) . "\n\n";
                        }

                        if ($data['done'] ?? false) {
                            echo "data: [DONE]\n\n";
                        }
                    }

                    if (ob_get_level() > 0) ob_flush();
                    flush();
                }
            } catch (\Throwable) {
                echo 'data: ' . json_encode(['error' => 'Service temporairement indisponible.']) . "\n\n";
                echo "data: [DONE]\n\n";
                if (ob_get_level() > 0) ob_flush();
                flush();
            }
        }, 200, [
            'Content-Type'      => 'text/event-stream',
            'Cache-Control'     => 'no-cache',
            'X-Accel-Buffering' => 'no',
            'Connection'        => 'keep-alive',
        ]);
    }
}
