<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatbotKnowledge;
use App\Models\ChatbotSetting;
use App\Services\OllamaService;

class ChatController extends Controller
{
    public function __construct(protected OllamaService $ollama) {}

    public function chat(Request $request)
    {
        $request->validate([
            'message'          => 'required|string|max:2000',
            'history'          => 'nullable|array|max:20',
            'history.*.role'   => 'required|in:user,assistant',
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

        try {
            $reply = $this->ollama->chat($messages);
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Service temporairement indisponible.'], 503);
        }

        return response()->json(['reply' => $reply]);
    }
}
