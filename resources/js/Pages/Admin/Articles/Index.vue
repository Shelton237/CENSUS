<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import PageHeader from '@/Components/PageHeader.vue';

const props = defineProps({
    articles: Array
});

const form = useForm({});

const deleteArticle = (id) => {
    if (confirm('Êtes-vous sûr de vouloir supprimer cet article ?')) {
        form.delete(route('admin.articles.destroy', id));
    }
};
</script>

<template>
    <Head title="Gestion des Actualités" />

    <AuthenticatedLayout>
        <div class="py-10 bg-[#f8faf9] min-h-[calc(100vh-64px)]">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                
                <div class="flex justify-between items-center mb-8">
                    <PageHeader 
                        title="Gestion des Actualités" 
                        subtitle="Publiez et gérez les communiqués, activités et rapports officiels."
                    />
                    <Link 
                        :href="route('admin.articles.create')" 
                        class="bg-[#204138] text-white px-6 py-3 rounded-xl font-bold hover:bg-[#2b5549] transition-all flex items-center gap-2"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Nouvel Article
                    </Link>
                </div>

                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                    <table class="w-full text-left">
                        <thead class="bg-[#f9fbfb] border-b border-gray-100">
                            <tr>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Titre (FR)</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Catégorie</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <tr v-for="article in articles" :key="article.id" class="hover:bg-[#f9fbfb] transition-colors">
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ new Date(article.published_at).toLocaleDateString() }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-bold text-[#204138]">{{ article.title_fr }}</div>
                                    <div class="text-[10px] text-gray-400 font-mono">{{ article.slug }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="px-2 py-1 rounded text-[10px] font-bold uppercase" 
                                          :class="{
                                              'bg-green-100 text-green-700': article.category === 'communique',
                                              'bg-yellow-100 text-yellow-700': article.category === 'activite',
                                              'bg-blue-100 text-blue-700': article.category === 'publication'
                                          }">
                                        {{ article.category }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right flex justify-end gap-3">
                                    <Link :href="route('admin.articles.edit', article.id)" class="text-gray-400 hover:text-[#EDAF11] transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </Link>
                                    <button @click="deleteArticle(article.id)" class="text-gray-400 hover:text-red-500 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
