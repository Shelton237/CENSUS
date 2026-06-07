<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use App\Models\ChatbotSetting;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
            ],
            'locale' => app()->getLocale(),
            'chatbot' => [
                'bot_name'        => ChatbotSetting::get('bot_name', 'Assistant RGPH'),
                'welcome_message' => ChatbotSetting::get('welcome_message', "Bonjour ! Je suis l'assistant virtuel du RGPH. Comment puis-je vous aider ?"),
            ],
            'translations' => array_merge(
                json_decode(file_get_contents(lang_path(app()->getLocale() . '.json')), true) ?? [],
                // Optionnel: charger aussi les fichiers php habituels si besoin
            ),
        ];
    }
}
