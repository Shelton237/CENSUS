<script setup>
import { ref, nextTick, onMounted } from 'vue';
import axios from 'axios';

const props = defineProps({
    botName:        { type: String, default: 'Assistant RGPH' },
    welcomeMessage: { type: String, default: "Bonjour ! Je suis l'assistant virtuel du RGPH. Comment puis-je vous aider ?" },
});

const isOpen     = ref(false);
const input      = ref('');
const loading    = ref(false);
const messagesEl = ref(null);

const messages = ref([
    { role: 'assistant', content: props.welcomeMessage },
]);

const toggle = () => { isOpen.value = !isOpen.value; };

const scrollToBottom = () => {
    nextTick(() => {
        if (messagesEl.value) messagesEl.value.scrollTop = messagesEl.value.scrollHeight;
    });
};

const send = async () => {
    const text = input.value.trim();
    if (!text || loading.value) return;

    input.value = '';
    messages.value.push({ role: 'user', content: text });
    loading.value = true;
    scrollToBottom();

    const history = messages.value
        .slice(-11, -1)
        .map(m => ({ role: m.role, content: m.content }));

    try {
        const { data } = await axios.post('/chat', { message: text, history });
        messages.value.push({ role: 'assistant', content: data.reply });
    } catch {
        messages.value.push({
            role: 'assistant',
            content: 'Désolé, le service est temporairement indisponible. Réessayez dans un instant.',
        });
    } finally {
        loading.value = false;
        scrollToBottom();
    }
};

const onKeydown = (e) => {
    if (e.key === 'Enter' && !e.shiftKey) { e.preventDefault(); send(); }
};

onMounted(scrollToBottom);
</script>

<template>
    <div class="fixed bottom-6 right-6 z-50 flex flex-col items-end gap-3">

        <!-- Fenêtre de chat -->
        <Transition
            enter-active-class="transition-all duration-300 ease-out"
            enter-from-class="opacity-0 translate-y-4 scale-95"
            enter-to-class="opacity-100 translate-y-0 scale-100"
            leave-active-class="transition-all duration-200 ease-in"
            leave-from-class="opacity-100 translate-y-0 scale-100"
            leave-to-class="opacity-0 translate-y-4 scale-95"
        >
            <div
                v-if="isOpen"
                class="w-[340px] sm:w-[380px] bg-white rounded-2xl shadow-2xl border border-gray-100 flex flex-col overflow-hidden"
                style="height:480px; max-height:calc(100vh - 100px);"
            >
                <!-- Header -->
                <div class="bg-[#204138] px-4 py-3 flex items-center justify-between flex-shrink-0">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-white font-bold text-sm leading-tight">{{ botName }}</p>
                            <p class="text-white/60 text-[10px]">Propulsé par Llama · Ollama</p>
                        </div>
                    </div>
                    <button @click="toggle" class="text-white/70 hover:text-white transition-colors p-1 rounded-lg hover:bg-white/10">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <!-- Messages -->
                <div ref="messagesEl" class="flex-1 overflow-y-auto px-4 py-4 space-y-3 scroll-smooth">
                    <div
                        v-for="(msg, i) in messages"
                        :key="i"
                        class="flex"
                        :class="msg.role === 'user' ? 'justify-end' : 'justify-start'"
                    >
                        <div v-if="msg.role === 'assistant'" class="w-6 h-6 rounded-full bg-[#204138] flex items-center justify-center flex-shrink-0 mr-2 mt-0.5">
                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                            </svg>
                        </div>
                        <div
                            class="max-w-[75%] px-3 py-2 rounded-2xl text-sm leading-relaxed whitespace-pre-wrap"
                            :class="msg.role === 'user'
                                ? 'bg-[#204138] text-white rounded-br-sm'
                                : 'bg-gray-100 text-gray-800 rounded-bl-sm'"
                        >{{ msg.content }}</div>
                    </div>

                    <!-- Indicateur typing -->
                    <div v-if="loading" class="flex justify-start">
                        <div class="w-6 h-6 rounded-full bg-[#204138] flex items-center justify-center flex-shrink-0 mr-2 mt-0.5">
                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                            </svg>
                        </div>
                        <div class="bg-gray-100 rounded-2xl rounded-bl-sm px-4 py-3 flex items-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-gray-400 animate-bounce" style="animation-delay:0ms"></span>
                            <span class="w-1.5 h-1.5 rounded-full bg-gray-400 animate-bounce" style="animation-delay:150ms"></span>
                            <span class="w-1.5 h-1.5 rounded-full bg-gray-400 animate-bounce" style="animation-delay:300ms"></span>
                        </div>
                    </div>
                </div>

                <!-- Zone de saisie -->
                <div class="border-t border-gray-100 p-3 flex-shrink-0">
                    <div class="flex items-end gap-2">
                        <textarea
                            v-model="input"
                            @keydown="onKeydown"
                            rows="1"
                            placeholder="Écrivez votre message..."
                            :disabled="loading"
                            class="flex-1 resize-none px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#204138]/30 focus:border-[#204138] disabled:opacity-50 transition-all"
                            style="max-height:100px; overflow-y:auto;"
                        ></textarea>
                        <button
                            @click="send"
                            :disabled="loading || !input.trim()"
                            class="w-9 h-9 bg-[#204138] text-white rounded-xl flex items-center justify-center hover:bg-[#2b5549] transition-colors disabled:opacity-40 disabled:cursor-not-allowed flex-shrink-0"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                            </svg>
                        </button>
                    </div>
                    <p class="text-[10px] text-gray-300 mt-1.5 text-center">Entrée pour envoyer · Shift+Entrée pour nouvelle ligne</p>
                </div>
            </div>
        </Transition>

        <!-- Bouton bulle -->
        <div class="flex items-center gap-3">

            <!-- Label flottant (visible uniquement quand fermé) -->
            <Transition
                enter-active-class="transition-all duration-300 ease-out"
                enter-from-class="opacity-0 translate-x-4"
                enter-to-class="opacity-100 translate-x-0"
                leave-active-class="transition-all duration-200"
                leave-from-class="opacity-100 translate-x-0"
                leave-to-class="opacity-0 translate-x-4"
            >
                <div
                    v-if="!isOpen"
                    class="bg-white text-[#204138] text-sm font-bold px-4 py-2 rounded-full shadow-lg border border-gray-100 whitespace-nowrap cursor-pointer select-none"
                    @click="toggle"
                >
                    {{ botName }}
                </div>
            </Transition>

            <!-- Bouton rond avec effet ping -->
            <div class="relative">
                <!-- Anneau ping (disparaît une fois ouvert) -->
                <span
                    v-if="!isOpen"
                    class="absolute inset-0 rounded-full bg-[#DAA520] opacity-60 animate-ping"
                ></span>

                <button
                    @click="toggle"
                    class="relative w-16 h-16 rounded-full text-white flex items-center justify-center transition-all duration-200 hover:scale-110 active:scale-95 shadow-xl"
                    :style="{ background: 'linear-gradient(135deg, #295E4D 0%, #204138 100%)' }"
                    :title="isOpen ? 'Fermer' : botName"
                >
                    <!-- Point vert statut actif -->
                    <span class="absolute top-1 right-1 w-3 h-3 bg-emerald-400 border-2 border-white rounded-full"></span>

                    <Transition
                        enter-active-class="transition-all duration-200"
                        enter-from-class="opacity-0 rotate-90 scale-50"
                        enter-to-class="opacity-100 rotate-0 scale-100"
                        leave-active-class="transition-all duration-200"
                        leave-from-class="opacity-100 rotate-0 scale-100"
                        leave-to-class="opacity-0 -rotate-90 scale-50"
                        mode="out-in"
                    >
                        <svg v-if="isOpen" key="close" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        <svg v-else key="chat" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                    </Transition>
                </button>
            </div>
        </div>

    </div>
</template>
