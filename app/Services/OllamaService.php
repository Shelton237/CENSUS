<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\ChatbotSetting;

class OllamaService
{
    protected string $baseUrl = 'http://localhost:11434';

    public function chat(array $messages): string
    {
        $model = ChatbotSetting::get('model', 'llama3.1:latest');

        $response = Http::timeout(120)->post("{$this->baseUrl}/api/chat", [
            'model'    => $model,
            'messages' => $messages,
            'stream'   => false,
        ]);

        if (!$response->successful()) {
            throw new \RuntimeException('Ollama error: ' . $response->body());
        }

        return $response->json('message.content', '');
    }
}
