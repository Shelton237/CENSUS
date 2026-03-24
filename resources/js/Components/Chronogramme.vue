<script setup>
import { ref } from 'vue';

const steps = ref([
    {
        id: 1,
        title: 'Phase Préparatoire',
        subtitle: 'Cartographie & Pilote',
        date: '2024',
        status: 'completed' // completed, active, upcoming
    },
    {
        id: 2,
        title: 'Dénombrement',
        subtitle: 'Collecte de données terrain',
        date: '2025',
        status: 'active'
    },
    {
        id: 3,
        title: 'Traitement',
        subtitle: 'Analyse & Tabulation',
        date: '2026',
        status: 'upcoming'
    },
    {
        id: 4,
        title: 'Publication',
        subtitle: 'Résultats définitifs',
        date: '2027',
        status: 'upcoming'
    }
]);
</script>

<template>
    <section class="py-16 bg-gray-50 overflow-hidden">
        <div class="container mx-auto px-6">
            <div class="text-left mb-12">
                <h2 class="text-4xl font-black text-gray-900 mb-2">Chronogramme</h2>
                <div class="flex items-center gap-3">
                    <div class="w-12 h-1 bg-yellow-400 rounded-full"></div>
                    <p class="text-gray-600 font-medium">Suivez l'évolution des étapes clés du recensement</p>
                </div>
            </div>

            <div class="relative pt-12">
                <!-- Ligne de fond (Track) -->
                <div class="absolute top-[164px] left-0 w-full h-1 bg-gray-200 rounded-full hidden md:block"></div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-8 relative">
                    <div v-for="(step, index) in steps" :key="step.id" class="flex flex-col items-center group">

                        <!-- Bulle de date / Titre haut -->
                        <div
                            class="mb-6 transition-all duration-300 transform group-hover:-translate-y-1"
                            :class="[
                                step.status === 'active' ? 'opacity-100 scale-110' : 'opacity-60 grayscale group-hover:grayscale-0'
                            ]"
                        >
                            <span
                                class="px-4 py-1 rounded-full text-xs font-bold uppercase tracking-wider mb-2 inline-block"
                                :class="[
                                    step.status === 'completed' ? 'bg-green-100 text-green-700' : 
                                    step.status === 'active' ? 'bg-yellow-400 text-yellow-900 shadow-lg shadow-yellow-200' : 
                                    'bg-gray-200 text-gray-600'
                                ]"
                            >
                                {{ step.date }}
                            </span>
                            <h3 class="text-lg font-extrabold text-gray-900 text-center">{{ step.title }}</h3>
                        </div>

                        <!-- Point central / Marqueur -->
                        <div class="relative z-10 flex items-center justify-center mb-6">
                            <!-- Halo d'incrustation pour la ligne -->
                            <div class="absolute w-20 h-1 bg-gray-50 z-[-1]"></div>

                            <div
                                class="w-10 h-10 rounded-full border-4 flex items-center justify-center transition-all duration-300"
                                :class="[
                                    step.status === 'completed' ? 'bg-white border-green-500 text-green-500' :
                                    step.status === 'active' ? 'bg-white border-yellow-400 scale-125 z-20 shadow-xl' :
                                    'bg-white border-gray-300 text-gray-300'
                                ]"
                            >
                                <svg v-if="step.status === 'completed'" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <div v-if="step.status === 'active'" class="w-3 h-3 bg-yellow-400 rounded-full animate-ping"></div>
                                <div v-if="step.status === 'active'" class="w-3 h-3 bg-yellow-400 rounded-full absolute"></div>
                                <div v-if="step.status === 'upcoming'" class="w-2 h-2 bg-gray-300 rounded-full"></div>
                            </div>

                            <!-- Marqueur "Nous sommes ici" -->
                            <div v-if="step.status === 'active'" class="absolute -top-10 whitespace-nowrap">
                                <span class="bg-gray-900 text-white text-[10px] font-bold px-3 py-1 rounded-md shadow-lg relative">
                                    Nous sommes ici
                                    <span class="absolute top-full left-1/2 -ml-1 border-4 border-transparent border-t-gray-900"></span>
                                </span>
                            </div>
                        </div>

                        <!-- Description basse -->
                        <div class="text-center px-4">
                            <p class="text-sm text-gray-500 leading-tight group-hover:text-gray-700 transition-colors">
                                {{ step.subtitle }}
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
/* Animation subtile pour le point actif */
@keyframes ping {
    75%, 100% {
        transform: scale(2.5);
        opacity: 0;
    }
}
</style>
