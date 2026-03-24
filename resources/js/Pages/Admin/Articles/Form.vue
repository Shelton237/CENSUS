<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import PageHeader from '@/Components/PageHeader.vue';

const props = defineProps({
    article: {
        type: Object,
        default: null
    }
});

const form = useForm({
    title_fr: props.article?.title_fr || '',
    title_en: props.article?.title_en || '',
    content_fr: props.article?.content_fr || '',
    content_en: props.article?.content_en || '',
    category: props.article?.category || 'activite',
    image: null,
    published_at: props.article?.published_at ? new Date(props.article.published_at).toISOString().slice(0, 10) : new Date().toISOString().slice(0, 10),
});

const submit = () => {
    if (props.article) {
        // Inertia.js doesn't support multipart/form-data with PUT requests out of the box in some versions,
        // often we use POST with _method = PUT
        form.post(route('admin.articles.update', props.article.id), {
            forceFormData: true,
            _method: 'put',
        });
    } else {
        form.post(route('admin.articles.store'));
    }
};
</script>

<template>
    <Head :title="article ? 'Modifier l\'article' : 'Nouvel Article'" />

    <AuthenticatedLayout>
        <div class="py-10 bg-[#f8faf9] min-h-[calc(100vh-64px)]">
            <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
                
                <div class="mb-8 flex items-center justify-between">
                    <PageHeader 
                        :title="article ? 'Modifier l\'article' : 'Nouvel Article'" 
                        :subtitle="article ? `Edition de : ${article.title_fr}` : 'Remplissez les informations ci-dessous pour publier un nouvel article.'"
                    />
                    <Link :href="route('admin.articles.index')" class="text-sm font-bold text-[#204138] hover:underline flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Retour à la liste
                    </Link>
                </div>

                <form @submit.prevent="submit" class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm space-y-8">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- FR -->
                        <div class="space-y-4">
                            <label class="block text-xs font-black text-[#204138] uppercase tracking-widest">Titre (Français)</label>
                            <input v-model="form.title_fr" type="text" class="w-full bg-[#f9fbfb] border-gray-100 rounded-xl p-4 focus:ring-2 focus:ring-[#EDAF11] focus:border-transparent transition-all" required placeholder="Titre en français">
                            <div v-if="form.errors.title_fr" class="text-red-500 text-xs">{{ form.errors.title_fr }}</div>
                        </div>

                        <!-- EN -->
                        <div class="space-y-4">
                            <label class="block text-xs font-black text-[#204138] uppercase tracking-widest">Titre (Anglais)</label>
                            <input v-model="form.title_en" type="text" class="w-full bg-[#f9fbfb] border-gray-100 rounded-xl p-4 focus:ring-2 focus:ring-[#EDAF11] focus:border-transparent transition-all" placeholder="Title in English">
                            <div v-if="form.errors.title_en" class="text-red-500 text-xs">{{ form.errors.title_en }}</div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Category -->
                        <div class="space-y-4">
                            <label class="block text-xs font-black text-[#204138] uppercase tracking-widest">Catégorie</label>
                            <select v-model="form.category" class="w-full bg-[#f9fbfb] border-gray-100 rounded-xl p-4 focus:ring-2 focus:ring-[#EDAF11] focus:border-transparent transition-all shadow-sm">
                                <option value="communique">Communiqué</option>
                                <option value="activite">Activité</option>
                                <option value="publication">Publication</option>
                            </select>
                        </div>

                        <!-- Date -->
                        <div class="space-y-4">
                            <label class="block text-xs font-black text-[#204138] uppercase tracking-widest">Date de publication</label>
                            <input v-model="form.published_at" type="date" class="w-full bg-[#f9fbfb] border-gray-100 rounded-xl p-4 focus:ring-2 focus:ring-[#EDAF11] focus:border-transparent transition-all shadow-sm">
                        </div>
                    </div>

                    <!-- Image Upload -->
                    <div class="space-y-4">
                        <label class="block text-xs font-black text-[#204138] uppercase tracking-widest">Image mise en avant</label>
                        <div class="flex items-center gap-6">
                            <div v-if="article?.image" class="w-32 h-32 rounded-2xl overflow-hidden border border-gray-100 shrink-0">
                                <img :src="`/storage/${article.image}`" class="w-full h-full object-cover">
                            </div>
                            <input type="file" @input="form.image = $event.target.files[0]" class="w-full bg-[#f9fbfb] border-gray-100 rounded-xl p-4 focus:ring-2 focus:ring-[#EDAF11] focus:border-transparent transition-all shadow-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#204138] file:text-white hover:file:bg-[#2b5549]">
                        </div>
                        <div v-if="form.errors.image" class="text-red-500 text-xs">{{ form.errors.image }}</div>
                    </div>

                    <div class="space-y-4">
                        <label class="block text-xs font-black text-[#204138] uppercase tracking-widest">Contenu (Français)</label>
                        <textarea v-model="form.content_fr" rows="8" class="w-full bg-[#f9fbfb] border-gray-100 rounded-2xl p-6 focus:ring-2 focus:ring-[#EDAF11] focus:border-transparent transition-all shadow-sm" required placeholder="Texte de l'article en français..."></textarea>
                        <div v-if="form.errors.content_fr" class="text-red-500 text-xs">{{ form.errors.content_fr }}</div>
                    </div>

                    <div class="space-y-4">
                        <label class="block text-xs font-black text-[#204138] uppercase tracking-widest">Contenu (Anglais)</label>
                        <textarea v-model="form.content_en" rows="8" class="w-full bg-[#f9fbfb] border-gray-100 rounded-2xl p-6 focus:ring-2 focus:ring-[#EDAF11] focus:border-transparent transition-all shadow-sm" placeholder="Text in English..."></textarea>
                        <div v-if="form.errors.content_en" class="text-red-500 text-xs">{{ form.errors.content_en }}</div>
                    </div>

                    <div class="flex justify-end pt-6">
                        <button :disabled="form.processing" type="submit" class="bg-[#204138] text-white px-10 py-4 rounded-2xl font-bold hover:bg-[#2b5549] hover:shadow-lg transition-all disabled:opacity-50">
                            {{ article ? 'Enregistrer les modifications' : 'Publier l\'article' }}
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
