<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import PageHeader from '@/Components/PageHeader.vue';

const props = defineProps({
    partner: {
        type: Object,
        default: null
    }
});

const form = useForm({
    name: props.partner?.name || '',
    website: props.partner?.website || '',
    logo: null,
    order: props.partner?.order || 0,
});

const submit = () => {
    if (props.partner) {
        form.post(route('admin.partners.update', props.partner.id), {
            forceFormData: true,
            _method: 'put',
        });
    } else {
        form.post(route('admin.partners.store'));
    }
};
</script>

<template>
    <Head title="Nouveau Partenaire" />

    <AuthenticatedLayout>
        <div class="py-10 bg-[#f8faf9] min-h-[calc(100vh-64px)]">
            <div class="mx-auto max-w-2xl px-4 sm:px-6 lg:px-8">
                
                <div class="mb-8 flex items-center justify-between">
                    <PageHeader 
                        :title="partner ? 'Modifier le partenaire' : 'Nouveau Partenaire'" 
                        :subtitle="partner ? `Edition de : ${partner.name}` : 'Ajoutez un nouveau logo partenaire au carrousel.'"
                    />
                    <Link :href="route('admin.partners.index')" class="text-sm font-bold text-[#204138] hover:underline flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Retour
                    </Link>
                </div>

                <form @submit.prevent="submit" class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm space-y-6">
                    
                    <div class="space-y-4">
                        <label class="block text-xs font-black text-[#204138] uppercase tracking-widest">Nom du partenaire</label>
                        <input v-model="form.name" type="text" class="w-full bg-[#f9fbfb] border-gray-100 rounded-xl p-4 focus:ring-2 focus:ring-[#EDAF11] focus:border-transparent transition-all" required placeholder="Ex: UNFPA, Banque Mondiale...">
                        <div v-if="form.errors.name" class="text-red-500 text-xs">{{ form.errors.name }}</div>
                    </div>

                    <div class="space-y-4">
                        <label class="block text-xs font-black text-[#204138] uppercase tracking-widest">Lien Site Web (Optionnel)</label>
                        <input v-model="form.website" type="url" class="w-full bg-[#f9fbfb] border-gray-100 rounded-xl p-4 focus:ring-2 focus:ring-[#EDAF11] focus:border-transparent transition-all" placeholder="https://example.com">
                        <div v-if="form.errors.website" class="text-red-500 text-xs">{{ form.errors.website }}</div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-4">
                            <label class="block text-xs font-black text-[#204138] uppercase tracking-widest">Ordre d'affichage</label>
                            <input v-model="form.order" type="number" class="w-full bg-[#f9fbfb] border-gray-100 rounded-xl p-4 focus:ring-2 focus:ring-[#EDAF11] focus:border-transparent transition-all shadow-sm">
                        </div>
                    </div>

                    <div class="space-y-4">
                        <label class="block text-xs font-black text-[#204138] uppercase tracking-widest">Logo (PNG, SVG, JPG)</label>
                        <div class="flex items-center gap-6">
                            <div v-if="partner?.logo" class="w-24 h-24 rounded-xl overflow-hidden border border-gray-100 shrink-0 bg-[#f9fbfb] flex items-center justify-center p-2">
                                <img :src="`/storage/${partner.logo}`" class="max-w-full max-h-full object-contain">
                            </div>
                            <input type="file" @input="form.logo = $event.target.files[0]" class="w-full bg-[#f9fbfb] border-gray-100 rounded-xl p-4 focus:ring-2 focus:ring-[#EDAF11] focus:border-transparent transition-all shadow-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#204138] file:text-white hover:file:bg-[#2b5549]">
                        </div>
                        <div v-if="form.errors.logo" class="text-red-500 text-xs">{{ form.errors.logo }}</div>
                    </div>

                    <div class="flex justify-end pt-6">
                        <button :disabled="form.processing" type="submit" class="bg-[#204138] text-white px-10 py-4 rounded-2xl font-bold hover:bg-[#2b5549] hover:shadow-lg transition-all disabled:opacity-50">
                            {{ partner ? 'Enregistrer les modifications' : 'Ajouter le partenaire' }}
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
