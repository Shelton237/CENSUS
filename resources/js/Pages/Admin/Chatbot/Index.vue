<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm, router } from '@inertiajs/vue3';
import PageHeader from '@/Components/PageHeader.vue';

const props = defineProps({ knowledge: Array });
const form = useForm({});

const deleteEntry = (id) => {
    if (confirm('Supprimer cette entrée ?')) {
        form.delete(route('admin.chatbot.destroy', id));
    }
};

const toggle = (id) => {
    router.patch(route('admin.chatbot.toggle', id), {}, { preserveScroll: true });
};
</script>

<template>
    <Head title="Chatbot IA — Base de connaissances" />

    <AuthenticatedLayout>
        <div class="py-10 bg-[#f8faf9] min-h-[calc(100vh-64px)]">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

                <div class="flex justify-between items-center mb-8">
                    <PageHeader
                        title="Chatbot IA"
                        subtitle="Gérez la base de connaissances injectée dans le chatbot."
                    />
                    <div class="flex gap-3">
                        <Link
                            :href="route('admin.chatbot.settings')"
                            class="border border-[#204138] text-[#204138] px-5 py-2.5 rounded-xl font-bold hover:bg-[#204138]/5 transition-all flex items-center gap-2 text-sm"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            Paramètres
                        </Link>
                        <Link
                            :href="route('admin.chatbot.create')"
                            class="bg-[#204138] text-white px-5 py-2.5 rounded-xl font-bold hover:bg-[#2b5549] transition-all flex items-center gap-2 text-sm"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            Nouvelle entrée
                        </Link>
                    </div>
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-3 gap-4 mb-6">
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 text-center">
                        <div class="text-3xl font-black text-[#204138]">{{ knowledge.length }}</div>
                        <div class="text-xs text-gray-500 mt-1 font-semibold uppercase tracking-wider">Total entrées</div>
                    </div>
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 text-center">
                        <div class="text-3xl font-black text-emerald-600">{{ knowledge.filter(k => k.is_active).length }}</div>
                        <div class="text-xs text-gray-500 mt-1 font-semibold uppercase tracking-wider">Actives</div>
                    </div>
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 text-center">
                        <div class="text-3xl font-black text-gray-400">{{ knowledge.filter(k => !k.is_active).length }}</div>
                        <div class="text-xs text-gray-500 mt-1 font-semibold uppercase tracking-wider">Inactives</div>
                    </div>
                </div>

                <!-- Table -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                    <table class="w-full text-left">
                        <thead class="bg-[#f9fbfb] border-b border-gray-100">
                            <tr>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Titre</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Catégorie</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Ordre</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Statut</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <tr v-if="knowledge.length === 0">
                                <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                                    <p class="font-semibold">Aucune entrée</p>
                                    <p class="text-sm mt-1">Ajoutez des connaissances pour enrichir votre chatbot.</p>
                                </td>
                            </tr>
                            <tr v-for="entry in knowledge" :key="entry.id" class="hover:bg-[#f9fbfb] transition-colors">
                                <td class="px-6 py-4">
                                    <div class="text-sm font-bold text-[#204138]">{{ entry.title }}</div>
                                    <div class="text-xs text-gray-400 mt-0.5 line-clamp-1">{{ entry.content.substring(0, 80) }}...</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span v-if="entry.category" class="px-2.5 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider border border-[#204138]/20 text-[#204138] bg-[#204138]/5">
                                        {{ entry.category }}
                                    </span>
                                    <span v-else class="text-gray-300 text-xs">—</span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 font-mono">{{ entry.sort_order }}</td>
                                <td class="px-6 py-4">
                                    <button @click="toggle(entry.id)" class="flex items-center gap-2 text-sm font-semibold transition-colors" :class="entry.is_active ? 'text-emerald-600' : 'text-gray-400'">
                                        <span class="w-8 h-4 rounded-full relative transition-colors" :class="entry.is_active ? 'bg-emerald-500' : 'bg-gray-200'">
                                            <span class="absolute top-0.5 w-3 h-3 bg-white rounded-full shadow transition-all" :class="entry.is_active ? 'left-4' : 'left-0.5'"></span>
                                        </span>
                                        {{ entry.is_active ? 'Active' : 'Inactive' }}
                                    </button>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        <Link
                                            :href="route('admin.chatbot.edit', entry.id)"
                                            class="px-3 py-1.5 text-xs font-bold text-[#204138] border border-[#204138]/20 rounded-lg hover:bg-[#204138]/5 transition-colors"
                                        >Éditer</Link>
                                        <button
                                            @click="deleteEntry(entry.id)"
                                            class="px-3 py-1.5 text-xs font-bold text-red-600 border border-red-100 rounded-lg hover:bg-red-50 transition-colors"
                                        >Supprimer</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
