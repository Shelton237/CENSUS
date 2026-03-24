<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import PageHeader from '@/Components/PageHeader.vue';
import AdminCard from '@/Components/AdminCard.vue';

const stats = [
    { title: 'Population Estimée', value: '28 644 120', trend: '+2.4%', icon: 'users' },
    { title: 'Ménages Recensés', value: '5 420 115', trend: '+12k', icon: 'chart' },
    { title: 'Cartographie', value: '98%', trend: 'Phase finale', icon: 'map' },
];
</script>

<template>
    <Head title="Tableau de Bord" />

    <AuthenticatedLayout>
        <div class="py-10 bg-[#f8faf9] min-h-[calc(100vh-64px)]">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                
                <!-- En-tête de page -->
                <PageHeader 
                    title="Console d'Administration" 
                    subtitle="Suivi en temps réel du 4ème Recensement Général de la Population (RGPH 2024)"
                />

                <!-- Grille de Statistique -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
                    <AdminCard 
                        v-for="stat in stats" 
                        :key="stat.title"
                        :title="stat.title"
                        :value="stat.value"
                        :trend="stat.trend"
                        :icon="stat.icon"
                    />
                </div>

                <!-- Section Details & Progrès -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    
                    <!-- Carte Progrès -->
                    <div class="bg-white rounded-2xl p-8 border border-gray-100 shadow-sm border-l-8 border-[#204138]">
                        <h3 class="text-xl font-bold text-[#204138] mb-6 flex items-center gap-2">
                            <span class="w-8 h-8 rounded-lg bg-[#204138]/10 flex items-center justify-center text-[#204138]">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                            </span>
                            Progression Globale du Recensement
                        </h3>
                        
                        <div class="space-y-6">
                            <div>
                                <div class="flex justify-between text-sm font-bold text-gray-500 mb-2 uppercase">
                                    <span>Phase de Cartographie</span>
                                    <span class="text-[#204138]">98%</span>
                                </div>
                                <div class="w-full bg-gray-100 h-3 rounded-full overflow-hidden border border-gray-200">
                                    <div class="bg-[#204138] h-full w-[98%] transition-all duration-1000"></div>
                                </div>
                            </div>

                            <div>
                                <div class="flex justify-between text-sm font-bold text-gray-500 mb-2 uppercase">
                                    <span>Recensement Pilote</span>
                                    <span class="text-[#EDAF11]">45%</span>
                                </div>
                                <div class="w-full bg-gray-100 h-3 rounded-full overflow-hidden border border-gray-200">
                                    <div class="bg-[#EDAF11] h-full w-[45%] transition-all duration-1000 delay-300"></div>
                                </div>
                            </div>

                            <div>
                                <div class="flex justify-between text-sm font-bold text-gray-500 mb-2 uppercase">
                                    <span>Dénombrement National</span>
                                    <span class="text-gray-300">Bientôt</span>
                                </div>
                                <div class="w-full bg-gray-100 h-3 rounded-full overflow-hidden border border-gray-200 shadow-inner">
                                    <div class="bg-gray-300 h-full w-[0%]"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Carte Activités Récentes -->
                    <div class="bg-white rounded-2xl p-8 border border-gray-100 shadow-sm">
                        <h3 class="text-xl font-bold text-[#204138] mb-6">Dernières Activités</h3>
                        <div class="space-y-4">
                            <div v-for="i in 3" :key="i" class="flex items-center gap-4 p-4 border-l-2 border-gray-100 hover:border-[#EDAF11] transition-all bg-[#f9fbfb]/50 rounded-r-xl">
                                <div class="w-10 h-10 rounded-full bg-white border border-[#204138]/10 flex items-center justify-center text-[#204138] shrink-0 shadow-sm">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-800">Mise à jour de la cartographie (Zone Centre)</p>
                                    <p class="text-xs text-gray-400">Il y a 2 heures par Admin RGPH</p>
                                </div>
                                <span class="text-[10px] font-bold px-2 py-1 rounded bg-[#204138]/5 text-[#204138] uppercase">Log</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

