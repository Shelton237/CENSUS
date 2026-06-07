<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChatbotKnowledge;
use App\Models\ChatbotSetting;
use Inertia\Inertia;

class ChatbotController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Chatbot/Index', [
            'knowledge' => ChatbotKnowledge::orderBy('sort_order')->orderBy('created_at')->get(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Chatbot/Form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'      => 'required|string|max:255',
            'content'    => 'required|string',
            'category'   => 'nullable|string|max:100',
            'is_active'  => 'boolean',
            'sort_order' => 'integer',
        ]);

        ChatbotKnowledge::create($validated);

        return redirect()->route('admin.chatbot.index')->with('message', 'Entrée créée avec succès.');
    }

    public function edit(ChatbotKnowledge $chatbot)
    {
        return Inertia::render('Admin/Chatbot/Form', ['entry' => $chatbot]);
    }

    public function update(Request $request, ChatbotKnowledge $chatbot)
    {
        $validated = $request->validate([
            'title'      => 'required|string|max:255',
            'content'    => 'required|string',
            'category'   => 'nullable|string|max:100',
            'is_active'  => 'boolean',
            'sort_order' => 'integer',
        ]);

        $chatbot->update($validated);

        return redirect()->route('admin.chatbot.index')->with('message', 'Entrée mise à jour.');
    }

    public function destroy(ChatbotKnowledge $chatbot)
    {
        $chatbot->delete();
        return redirect()->route('admin.chatbot.index')->with('message', 'Entrée supprimée.');
    }

    public function toggle(ChatbotKnowledge $chatbot)
    {
        $chatbot->update(['is_active' => !$chatbot->is_active]);
        return back();
    }

    public function settings()
    {
        return Inertia::render('Admin/Chatbot/Settings', [
            'settings' => [
                'system_prompt'   => ChatbotSetting::get('system_prompt', ''),
                'bot_name'        => ChatbotSetting::get('bot_name', 'Assistant RGPH'),
                'welcome_message' => ChatbotSetting::get('welcome_message', 'Bonjour ! Je suis l\'assistant virtuel du RGPH. Comment puis-je vous aider ?'),
                'model'           => ChatbotSetting::get('model', 'llama3.1:latest'),
            ],
            'available_models' => ['llama3.1:latest', 'llama3.2:latest', 'llama3.2:1b'],
        ]);
    }

    public function updateSettings(Request $request)
    {
        $validated = $request->validate([
            'system_prompt'   => 'required|string',
            'bot_name'        => 'required|string|max:100',
            'welcome_message' => 'required|string|max:500',
            'model'           => 'required|string',
        ]);

        foreach ($validated as $key => $value) {
            ChatbotSetting::set($key, $value);
        }

        return back()->with('message', 'Paramètres sauvegardés.');
    }
}
