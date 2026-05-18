<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import PageHeader from '@/Components/PageHeader.vue';
import RichTextEditor from '@/Components/RichTextEditor.vue';
import { ref } from 'vue';

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
    images: [],
    existing_images: props.article?.images || [],
    published_at: props.article?.published_at ? new Date(props.article.published_at).toISOString().slice(0, 10) : new Date().toISOString().slice(0, 10),
});

const featuredImagePreview = ref(props.article?.image ? `/storage/${props.article.image}` : null);
const newGalleryFilesCount = ref(0);

const handleFeaturedImageChange = (event) => {
    const file = event.target.files[0];
    form.image = file;
    if (file) {
        featuredImagePreview.value = URL.createObjectURL(file);
    }
};

const handleMultipleImagesUpload = (event) => {
    const files = Array.from(event.target.files);
    form.images = files;
    newGalleryFilesCount.value = files.length;
};

const removeExistingImage = (idx) => {
    form.existing_images.splice(idx, 1);
};

const submit = () => {
    if (props.article) {
        form.transform((data) => ({
            ...data,
            existing_images: JSON.stringify(data.existing_images),
            _method: 'put'
        })).post(route('admin.articles.update', props.article.id), {
            forceFormData: true,
        });
    } else {
        form.post(route('admin.articles.store'));
    }
};
</script>

<template>
    <Head :title="article ? 'Modifier l\'article' : 'Nouvel Article'" />

    <AuthenticatedLayout>
        <div class="py-10 bg-[#f4f7f5] min-h-[calc(100vh-64px)]">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                
                <!-- Page Top Action Header -->
                <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <PageHeader 
                        :title="article ? 'Modifier l\'article' : 'Créer un Article'" 
                        :subtitle="article ? `Edition de : ${article.title_fr}` : 'Remplissez les formulaires de contenu et configurez la publication.'"
                    />
                    <div class="flex items-center gap-4">
                        <Link :href="route('admin.articles.index')" class="bg-white text-[#204138] border border-gray-200 px-5 py-3 rounded-2xl font-bold hover:bg-gray-50 hover:shadow-sm transition-all text-sm flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                            Retour à la liste
                        </Link>
                    </div>
                </div>

                <form @submit.prevent="submit" class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                    
                    <!-- Left Column: Primary Content Editor (Title & RichText) -->
                    <div class="lg:col-span-8 space-y-8">
                        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-gray-100 shadow-sm space-y-6">
                            
                            <h3 class="text-lg font-extrabold text-[#204138] border-b border-gray-100 pb-3 flex items-center gap-2">
                                <span class="bg-[#EDAF11]/10 text-[#EDAF11] py-1 px-2.5 rounded-lg text-xs font-black uppercase tracking-wider">FR</span>
                                Version Française
                            </h3>

                            <!-- FR Title -->
                            <div class="space-y-2">
                                <label class="block text-xs font-black text-[#204138] uppercase tracking-widest">Titre de l'article (Français)</label>
                                <input v-model="form.title_fr" type="text" class="w-full bg-[#f9fbfb] border border-gray-200 rounded-xl p-4 focus:ring-2 focus:ring-[#EDAF11] focus:border-transparent transition-all placeholder-gray-400 font-semibold text-gray-900" required placeholder="Saisir le titre français...">
                                <div v-if="form.errors.title_fr" class="text-red-500 text-xs mt-1">{{ form.errors.title_fr }}</div>
                            </div>

                            <!-- FR Rich Text Content -->
                            <div class="space-y-2">
                                <label class="block text-xs font-black text-[#204138] uppercase tracking-widest">Contenu principal (Français)</label>
                                <RichTextEditor v-model="form.content_fr" placeholder="Rédigez le texte français de l'article..." />
                                <div v-if="form.errors.content_fr" class="text-red-500 text-xs mt-1">{{ form.errors.content_fr }}</div>
                            </div>

                        </div>

                        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-gray-100 shadow-sm space-y-6">
                            
                            <h3 class="text-lg font-extrabold text-[#204138] border-b border-gray-100 pb-3 flex items-center gap-2">
                                <span class="bg-[#204138]/10 text-[#204138] py-1 px-2.5 rounded-lg text-xs font-black uppercase tracking-wider">EN</span>
                                Version Anglaise
                            </h3>

                            <!-- EN Title -->
                            <div class="space-y-2">
                                <label class="block text-xs font-black text-[#204138] uppercase tracking-widest">Titre de l'article (Anglais)</label>
                                <input v-model="form.title_en" type="text" class="w-full bg-[#f9fbfb] border border-gray-200 rounded-xl p-4 focus:ring-2 focus:ring-[#EDAF11] focus:border-transparent transition-all placeholder-gray-400 font-semibold text-gray-900" placeholder="Enter English title...">
                                <div v-if="form.errors.title_en" class="text-red-500 text-xs mt-1">{{ form.errors.title_en }}</div>
                            </div>

                            <!-- EN Rich Text Content -->
                            <div class="space-y-2">
                                <label class="block text-xs font-black text-[#204138] uppercase tracking-widest">Contenu principal (Anglais)</label>
                                <RichTextEditor v-model="form.content_en" placeholder="Write the English content of the article..." />
                                <div v-if="form.errors.content_en" class="text-red-500 text-xs mt-1">{{ form.errors.content_en }}</div>
                            </div>

                        </div>
                    </div>

                    <!-- Right Column: Sidebar Settings (Metadata, Image, Gallery, Submit) -->
                    <div class="lg:col-span-4 space-y-8">
                        
                        <!-- Actions Card -->
                        <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm space-y-4">
                            <h3 class="text-sm font-extrabold text-[#204138] uppercase tracking-wider border-b border-gray-100 pb-2">Actions</h3>
                            <button :disabled="form.processing" type="submit" class="w-full bg-[#204138] text-white py-4 rounded-2xl font-bold hover:bg-[#2b5549] hover:shadow-lg transition-all disabled:opacity-50 flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                                {{ article ? 'Enregistrer les modifications' : 'Publier l\'article' }}
                            </button>
                            <Link :href="route('admin.articles.index')" class="w-full bg-gray-50 border border-gray-200 text-gray-600 py-3 rounded-2xl font-bold hover:bg-gray-100 transition-all text-sm block text-center">
                                Annuler
                            </Link>
                        </div>

                        <!-- Settings Card -->
                        <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm space-y-6">
                            <h3 class="text-sm font-extrabold text-[#204138] uppercase tracking-wider border-b border-gray-100 pb-2">Paramètres de publication</h3>

                            <!-- Category -->
                            <div class="space-y-2">
                                <label class="block text-xs font-black text-[#204138] uppercase tracking-widest">Catégorie</label>
                                <select v-model="form.category" class="w-full bg-[#f9fbfb] border border-gray-200 rounded-xl p-3.5 focus:ring-2 focus:ring-[#EDAF11] focus:border-transparent transition-all shadow-sm text-sm font-bold text-gray-800">
                                    <option value="communique">⚠️ Communiqué</option>
                                    <option value="activite">📅 Activité</option>
                                    <option value="publication">📚 Publication</option>
                                </select>
                            </div>

                            <!-- Publication Date -->
                            <div class="space-y-2">
                                <label class="block text-xs font-black text-[#204138] uppercase tracking-widest">Date de publication</label>
                                <input v-model="form.published_at" type="date" class="w-full bg-[#f9fbfb] border border-gray-200 rounded-xl p-3.5 focus:ring-2 focus:ring-[#EDAF11] focus:border-transparent transition-all shadow-sm text-sm font-bold text-gray-800">
                            </div>
                        </div>

                        <!-- Main Image Card -->
                        <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm space-y-4">
                            <h3 class="text-sm font-extrabold text-[#204138] uppercase tracking-wider border-b border-gray-100 pb-2">Image Principale</h3>
                            
                            <!-- Thumbnail Preview -->
                            <div class="relative w-full aspect-video rounded-2xl overflow-hidden border border-gray-100 bg-[#f9fbfb] flex items-center justify-center shadow-inner group">
                                <img v-if="featuredImagePreview" :src="featuredImagePreview" class="w-full h-full object-cover">
                                <div v-else class="text-center p-4">
                                    <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                                        <circle cx="8.5" cy="8.5" r="1.5" />
                                        <polyline points="21 15 16 10 5 21" />
                                    </svg>
                                    <span class="mt-2 block text-xs font-bold text-gray-400">Aucun aperçu</span>
                                </div>
                            </div>

                            <!-- Upload Input -->
                            <div class="space-y-2">
                                <input type="file" @change="handleFeaturedImageChange" accept="image/*" class="w-full text-xs file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-black file:bg-[#204138] file:text-white hover:file:bg-[#2b5549] file:cursor-pointer cursor-pointer bg-[#f9fbfb] p-3 rounded-xl border border-gray-100 shadow-sm">
                                <p class="text-[10px] text-gray-400">Format recommandé : Paysage (ex: 1200x800 px).</p>
                                <div v-if="form.errors.image" class="text-red-500 text-xs">{{ form.errors.image }}</div>
                            </div>
                        </div>

                        <!-- Gallery Multi-Images Card -->
                        <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm space-y-4">
                            <h3 class="text-sm font-extrabold text-[#204138] uppercase tracking-wider border-b border-gray-100 pb-2">Images Supplémentaires</h3>
                            
                            <!-- Existing Gallery Images -->
                            <div v-if="form.existing_images && form.existing_images.length > 0" class="grid grid-cols-3 gap-3">
                                <div v-for="(img, idx) in form.existing_images" :key="idx" class="relative aspect-square rounded-xl overflow-hidden border border-gray-100 shadow-inner group">
                                    <img :src="`/storage/${img}`" class="w-full h-full object-cover">
                                    <button type="button" @click="removeExistingImage(idx)" class="absolute top-1 right-1 bg-red-500/90 hover:bg-red-600 text-white rounded-full p-1 shadow-md transition-all">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Upload Multi Inputs -->
                            <div class="space-y-2">
                                <input type="file" multiple @change="handleMultipleImagesUpload" accept="image/*" class="w-full text-xs file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-black file:bg-[#204138] file:text-white hover:file:bg-[#2b5549] file:cursor-pointer cursor-pointer bg-[#f9fbfb] p-3 rounded-xl border border-gray-100 shadow-sm">
                                <p v-if="newGalleryFilesCount > 0" class="text-xs font-bold text-emerald-600">
                                    ✨ {{ newGalleryFilesCount }} nouvelles images prêtes à être envoyées.
                                </p>
                                <p v-else class="text-[10px] text-gray-400">Sélectionnez plusieurs photos à intégrer dans le carrousel de l'article.</p>
                                <div v-if="form.errors.images" class="text-red-500 text-xs">{{ form.errors.images }}</div>
                            </div>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
/* Focus rings for selects and inputs */
select:focus, input[type="date"]:focus {
    border-color: #EDAF11 !important;
    box-shadow: 0 0 0 3px rgba(237, 175, 17, 0.15) !important;
}
</style>
