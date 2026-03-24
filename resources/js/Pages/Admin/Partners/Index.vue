<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import PageHeader from '@/Components/PageHeader.vue';

const props = defineProps({
    partners: Array
});

const form = useForm({});

const deletePartner = (id) => {
    if (confirm('Supprimer ce partenaire ?')) {
        form.delete(route('admin.partners.destroy', id));
    }
};
</script>

<template>
    <Head title="Gestion des Partenaires" />

    <AuthenticatedLayout>
        <div class="py-10 bg-[#f8faf9] min-h-[calc(100vh-64px)]">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                
                <div class="flex justify-between items-center mb-8">
                    <PageHeader 
                        title="Gestion des Partenaires" 
                        subtitle="Gérez les logos et les liens des partenaires affichés sur le site."
                    />
                    <Link 
                        :href="route('admin.partners.create')" 
                        class="bg-[#204138] text-white px-6 py-3 rounded-xl font-bold hover:bg-[#2b5549] transition-all flex items-center gap-2"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Nouveau Partenaire
                    </Link>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div v-for="partner in partners" :key="partner.id" class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-all group relative">
                        <div class="w-full h-32 flex items-center justify-center mb-4 bg-[#f9fbfb] rounded-xl overflow-hidden p-4">
                            <img :src="`/storage/${partner.logo}`" :alt="partner.name" class="max-h-full max-w-full object-contain">
                        </div>
                        <h3 class="text-center font-bold text-[#204138] mb-1">{{ partner.name }}</h3>
                        <p class="text-center text-[10px] text-gray-400 truncate">{{ partner.website || 'Pas de site' }}</p>
                        
                        <div class="absolute top-4 right-4 flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                            <Link :href="route('admin.partners.edit', partner.id)" class="bg-white p-2 rounded-lg shadow-sm text-gray-400 hover:text-[#EDAF11]">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </Link>
                            <button @click="deletePartner(partner.id)" class="bg-white p-2 rounded-lg shadow-sm text-gray-400 hover:text-red-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </div>
                        
                        <div class="absolute top-4 left-4">
                            <span class="bg-[#204138]/5 text-[#204138] text-[9px] font-black px-1.5 py-0.5 rounded">ORDRE: {{ partner.order }}</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
