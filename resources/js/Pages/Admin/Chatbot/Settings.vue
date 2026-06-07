<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3';
import PageHeader from '@/Components/PageHeader.vue';

const props = defineProps({
    settings:         Object,
    available_models: Array,
});

const form = useForm({
    system_prompt:   props.settings.system_prompt || "Tu es l'assistant virtuel officiel du RGPH (Recensement Général de la Population et de l'Habitat) du Cameroun. Tu aides les visiteurs avec des réponses précises, professionnelles et concises.",
    bot_name:        props.settings.bot_name || 'Assistant RGPH',
    welcome_message: props.settings.welcome_message || "Bonjour ! Je suis l'assistant virtuel du RGPH. Comment puis-je vous aider ?",
    model:           props.settings.model || 'llama3.1:latest',
});

const submit = () => {
    form.patch(route('admin.chatbot.settings.update'));
};
</script>

<template>
    <Head title="Chatbot IA — Paramètres" />

    <AuthenticatedLayout>
        <div class="py-10 bg-[#f8faf9] min-h-[calc(100vh-64px)]">
            <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">

                <div class="flex items-center gap-4 mb-8">
                    <Link :href="route('admin.chatbot.index')" class="text-[#204138]/60 hover:text-[#204138] transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    </Link>
                    <PageHeader
                        title="Paramètres du Chatbot"
                        subtitle="Personnalisez la personnalité et le comportement de votre assistant IA."
                    />
                </div>

                <form @submit.prevent="submit" class="space-y-6">

                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-5">

                        <!-- Nom du bot -->
                        <div>
                            <label class="block text-sm font-bold text-[#204138] mb-1.5">Nom de l'assistant</label>
                            <input
                                v-model="form.bot_name"
                                type="text"
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm text-gray-900 bg-white focus:outline-none focus:ring-2 focus:ring-[#204138]/30 focus:border-[#204138]"
                            />
                        </div>

                        <!-- Message de bienvenue -->
                        <div>
                            <label class="block text-sm font-bold text-[#204138] mb-1.5">Message de bienvenue</label>
                            <textarea
                                v-model="form.welcome_message"
                                rows="2"
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm text-gray-900 bg-white focus:outline-none focus:ring-2 focus:ring-[#204138]/30 focus:border-[#204138] resize-none"
                            ></textarea>
                        </div>

                        <!-- Modèle IA -->
                        <div>
                            <label class="block text-sm font-bold text-[#204138] mb-1.5">Modèle IA (Ollama)</label>
                            <select
                                v-model="form.model"
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm text-gray-900 bg-white focus:outline-none focus:ring-2 focus:ring-[#204138]/30 focus:border-[#204138]"
                            >
                                <option v-for="m in available_models" :key="m" :value="m">{{ m }}</option>
                            </select>
                            <p class="mt-1 text-xs text-gray-400">llama3.1 est recommandé pour la qualité des réponses en français.</p>
                        </div>

                        <!-- Prompt système -->
                        <div>
                            <label class="block text-sm font-bold text-[#204138] mb-1.5">Prompt système</label>
                            <p class="text-xs text-gray-400 mb-2">Définit la personnalité et le comportement global du chatbot. Les connaissances de la base sont ajoutées automatiquement après.</p>
                            <textarea
                                v-model="form.system_prompt"
                                rows="6"
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm text-gray-900 bg-white focus:outline-none focus:ring-2 focus:ring-[#204138]/30 focus:border-[#204138] resize-y font-mono"
                            ></textarea>
                            <p v-if="form.errors.system_prompt" class="mt-1 text-xs text-red-500">{{ form.errors.system_prompt }}</p>
                        </div>

                    </div>

                    <!-- Aperçu -->
                    <div class="bg-[#204138]/5 border border-[#204138]/20 rounded-2xl p-5">
                        <p class="text-xs font-bold text-[#204138] uppercase tracking-wider mb-3">Aperçu de la bulle</p>
                        <div class="flex items-end gap-3">
                            <div class="w-10 h-10 rounded-full bg-[#204138] flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                            </div>
                            <div class="bg-white rounded-2xl rounded-bl-sm px-4 py-3 shadow-sm border border-gray-100 text-sm text-gray-700 max-w-xs">
                                {{ form.welcome_message || 'Message de bienvenue...' }}
                            </div>
                        </div>
                        <p class="mt-2 text-xs text-gray-500 pl-13">— <strong>{{ form.bot_name || 'Assistant' }}</strong>, modèle {{ form.model }}</p>
                    </div>

                    <!-- Actions -->
                    <div class="flex justify-end gap-3">
                        <Link
                            :href="route('admin.chatbot.index')"
                            class="px-6 py-2.5 text-sm font-bold text-gray-600 border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors"
                        >Annuler</Link>
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="px-6 py-2.5 text-sm font-bold text-white bg-[#204138] rounded-xl hover:bg-[#2b5549] transition-colors disabled:opacity-50"
                        >
                            {{ form.processing ? 'Sauvegarde...' : 'Sauvegarder' }}
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
