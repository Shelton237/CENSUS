<script setup>
import { Link } from '@inertiajs/vue3';

const newsItems = [
    {
        id: 1,
        category: 'Communiqué',
        date: '12 oct. 2024',
        title: 'Communiqué officiel : démarrage du dénombrement',
        excerpt: 'Le Gouverneur de la région du Centre informe les populations que les équipes de recensement sont désormais actives.',
        imageClass: 'bg-green-600',
        tagClass: 'bg-green-100 text-green-700'
    },
    {
        id: 2,
        category: 'Activité',
        date: '08 oct. 2024',
        title: 'Cartographie achevée : 98% des zones délimitées',
        excerpt: "L'INS annonce l'achèvement de la phase de cartographie, avec 98% des zones de dénombrement délimitées.",
        imageClass: 'bg-yellow-500',
        tagClass: 'bg-yellow-100 text-yellow-700'
    },
    {
        id: 3,
        category: 'Publication',
        date: '05 oct. 2024',
        title: 'Rapport préliminaire de la phase de cartographie',
        excerpt: "L'Institut National de la Statistique publie le rapport préliminaire de la phase de cartographie.",
        imageClass: 'bg-teal-600',
        tagClass: 'bg-teal-100 text-teal-700'
    }
];
</script>

<template>
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            
            <!-- En-tête de section -->
            <div class="flex items-end justify-between mb-10">
                <div>
                    <h2 class="text-4xl font-black text-gray-900">À la Une</h2>
                    <div class="w-12 h-1 bg-yellow-400 mt-3 rounded-full"></div>
                </div>
                <Link href="/actualites" class="hidden md:flex items-center gap-2 text-green-700 font-bold hover:gap-3 transition-all">
                    Voir plus de nouvelles
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </Link>
            </div>

            <!-- News Hero (Grande mise en avant) -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-0 mb-12 rounded-3xl overflow-hidden shadow-2xl shadow-gray-200 border border-gray-100">
                <div class="lg:col-span-8 relative aspect-video lg:aspect-auto">
                    <img src="/assets/images/accueil/495229d6739ec5d681e8f133d30bce3835dd8d3d.jpg" alt="Actualité principale" class="absolute inset-0 w-full h-full object-cover">
                    <!-- Dots indicateurs superposés -->
                    <div class="absolute bottom-6 left-6 flex gap-2">
                        <span class="w-8 h-2 bg-yellow-400 rounded-full"></span>
                        <span class="w-2 h-2 bg-white/50 rounded-full"></span>
                        <span class="w-2 h-2 bg-white/50 rounded-full"></span>
                    </div>
                </div>
                <div class="lg:col-span-4 bg-white p-8 lg:p-12 flex flex-col justify-center">
                    <span class="inline-block px-3 py-1 bg-blue-100 text-blue-700 text-xs font-bold uppercase tracking-wider rounded-md mb-4 self-start">Info</span>
                    <h3 class="text-3xl font-black text-gray-900 mb-4 leading-tight">Lancement officiel du dénombrement national</h3>
                    <p class="text-gray-600 mb-8 line-clamp-3">Découvrez les détails de la cérémonie officielle tenue à Yaoundé marquant le début de la phase la plus critique du recensement.</p>
                    <Link href="/article" class="inline-flex items-center justify-center px-8 py-3 bg-gray-900 text-white font-bold rounded-xl hover:bg-gray-800 transition-colors self-start">
                        Lire l'article
                    </Link>
                </div>
            </div>

            <!-- Grille de cartes secondaires -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                <article v-for="item in newsItems" :key="item.id" class="group flex flex-col bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300">
                    <Link href="/article" class="block flex-1 flex flex-col">
                        <!-- Image placeholder colorée (en attendant de vraies images) -->
                        <div class="aspect-video relative overflow-hidden" :class="item.imageClass">
                            <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition-colors"></div>
                        </div>
                        
                        <div class="p-6 flex flex-col flex-1">
                            <div class="flex items-center justify-between mb-4">
                                <span class="px-3 py-1 text-[10px] font-bold uppercase tracking-widest rounded-md" :class="item.tagClass">
                                    {{ item.category }}
                                </span>
                                <time class="text-xs text-gray-400 font-medium">{{ item.date }}</time>
                            </div>
                            
                            <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-green-700 transition-colors line-clamp-2">
                                {{ item.title }}
                            </h3>
                            
                            <p class="text-sm text-gray-500 line-clamp-2 mb-6">
                                {{ item.excerpt }}
                            </p>
                            
                            <div class="mt-auto pt-4 border-t border-gray-50 flex items-center gap-2 text-gray-900 font-bold text-sm">
                                <span>Continuer la lecture</span>
                                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </div>
                        </div>
                    </Link>
                </article>
            </div>

            <!-- Bouton mobile unique -->
            <div class="md:hidden">
                <Link href="/actualites" class="flex items-center justify-center w-full py-4 bg-green-50 text-green-700 font-bold rounded-xl">
                    Voir plus de nouvelles
                </Link>
            </div>

        </div>
    </section>
</template>
