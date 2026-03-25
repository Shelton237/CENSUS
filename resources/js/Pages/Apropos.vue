<script setup>
import { ref } from 'vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import { Link, Head } from '@inertiajs/vue3';
</script>

<template>
    <Head>
        <title>{{ __('À Propos') }}</title>
        <meta name="description" :content="__('En savoir plus sur le 4ème Recensement Général de la Population et de l\'Habitat et le Recensement Général de l\'Agriculture et de l\'Élevage - Cameroun 2024')">
    </Head>

    <MainLayout>
        <!-- Hero -->
        <section class="relative pt-32 pb-20 overflow-hidden bg-[#204138]">
            <div class="absolute inset-0 z-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
            <div class="container relative z-10 text-center">
                <span class="inline-block py-1 px-3 rounded-full bg-[#EDAF11]/20 text-[#EDAF11] font-bold text-sm tracking-widest uppercase mb-4">{{ __('Qui sommes-nous ?') }}</span>
                <h1 class="text-4xl md:text-5xl font-black text-white mb-6 leading-tight">{{ __('À Propos du Recensement') }}</h1>
                <p class="text-xl text-white/80 max-w-2xl mx-auto leading-relaxed">{{ __('Comprendre les enjeux, les objectifs et le cadre institutionnel du 4ème RGPH du Cameroun.') }}</p>
            </div>
        </section>

        <!-- ===================== MAIN CONTENT ===================== -->
        <main class="inner-page">
            <div class="container">

                <!-- Breadcrumb -->
                <nav class="breadcrumb" aria-label="Fil d'Ariane">
                    <Link :href="route('accueil')" class="bc-link">{{ __('Accueil') }}</Link>
                    <span class="bc-sep">/</span>
                    <span class="bc-current">{{ __('A propos') }}</span>
                </nav>

                <!-- Page Title -->
                <h1 class="page-title">
                    {{ __('A propos du Recensement Général') }}
                </h1>

                <!-- Main Layout : Content + Sidebar -->
                <div class="inner-layout">

                    <!-- Content Column -->
                    <div class="content-col">

                        <!-- Section 1 : Contexte Historique & Mutualisation -->
                        <article class="content-section">
                            <h2 class="section-title">{{ __('Contexte Historique et Mutualisation') }}</h2>
                            <div class="section-with-image">
                                <div class="section-text">
                                    <p>{{ __('Le quatrième Recensement Général de la Population et de l’Habitat (4ème RGPH) et le Recensement Général de l’Agriculture et de l’Élevage (RGAE) constituent des opérations statistiques de grande envergure pour la planification du développement du pays.') }}</p>
                                    <p>{{ __('Le 4ème RGPH est institué par Décret Présidentiel n°2015/397 du 15 septembre 2015 tandis que le RGAE est institué par Décret Présidentiel n°2015/292 du 29 juin 2015.') }}</p>
                                    <p>{{ __('Les activités de mutualisation ont été instruites en 2019 par le Premier Ministre, Chef du Gouvernement, dans l’optique d’optimiser les coûts liés à l’opérationnalisation desdites activités.') }}</p>
                                </div>
                                <div class="section-image">
                                    <img src="/assets/images/apropos-placeholder.jpg" alt="Contexte du Recensement" onerror="this.style.display='none';this.parentElement.classList.add('img-placeholder')">
                                </div>
                            </div>
                        </article>

                        <!-- Section 2 : Objectifs -->
                        <article class="content-section">
                            <h2 class="section-title">{{ __('Objectifs du Recensement') }}</h2>
                            <div class="flex flex-col gap-6">
                                <div class="p-6 bg-green-50/50 border-l-4 border-[#204138] rounded-r-xl">
                                    <h4 class="font-black text-[#204138] mb-2 uppercase text-xs tracking-wider">{{ __('Objectif 4ème RGPH') }}</h4>
                                    <p class="!mb-0 italic text-gray-700">{{ __('Le 4ème RGPH a pour objectif général de rendre disponibles les données nécessaires à la planification du développement et à la prise en compte du dividende démographique dans l’élaboration des politiques permettant l’évolution du Cameroun vers l’émergence.') }}</p>
                                </div>
                                <div class="p-6 bg-yellow-50/50 border-l-4 border-[#EDAF11] rounded-r-xl">
                                    <h4 class="font-black text-[#EDAF11] mb-2 uppercase text-xs tracking-wider">{{ __('Objectif RGAE') }}</h4>
                                    <p class="!mb-0 italic text-gray-700">{{ __('Le RGAE a en revanche pour objectif général de rendre disponibles les informations statistiques structurelles suffisamment désagrégées sur toutes les exploitations agropastorales et aquacoles, et à élaborer les bases de sondage pour les modules complémentaire et thématique et les enquêtes du Système Permanent et Intégré des Statistiques Agropastorales (SPISA).') }}</p>
                                </div>
                            </div>
                        </article>

                        <!-- Section 3 : Utilité -->
                        <article class="content-section">
                            <h2 class="section-title">{{ __('Utilité du Recensement') }}</h2>
                            <p>{{ __('Cet instrument précieux permet le cadrage, l\'élaboration, le suivi et l\'évaluation des politiques publiques aux niveaux national, régional et local. Il sert de base pour :') }}</p>
                            <ul class="content-list">
                                <li>{{ __('L\'élaboration des bases de sondage pour les enquêtes inter-censitaires.') }}</li>
                                <li>{{ __('La planification des infrastructures de base (écoles, hôpitaux, routes).') }}</li>
                                <li>{{ __('La répartition équitable des ressources publiques.') }}</li>
                                <li>{{ __('Le suivi des engagements internationaux (ODD, Agenda 2063).') }}</li>
                            </ul>
                        </article>

                        <!-- Section 4 : Méthodologie -->
                        <article class="content-section">
                            <h2 class="section-title">{{ __('Méthodologie de travail') }}</h2>
                            <p>{{ __('L\'opération adopte une approche numérique moderne (CAPI - Computer Assisted Personal Interviewing) utilisant des tablettes et smartphones pour garantir la qualité et la célérité de la collecte.') }}</p>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                <div class="p-4 bg-gray-50 rounded-xl border border-gray-100">
                                    <span class="font-bold text-[#204138] block mb-1">01. {{ __('Cartographie') }}</span>
                                    <p class="text-xs !mb-0">{{ __('Découpage du pays en zones de dénombrement (ZD).') }}</p>
                                </div>
                                <div class="p-4 bg-gray-50 rounded-xl border border-gray-100">
                                    <span class="font-bold text-[#204138] block mb-1">02. {{ __('Pilote') }}</span>
                                    <p class="text-xs !mb-0">{{ __('Test grandeur nature des outils et de l\'organisation.') }}</p>
                                </div>
                                <div class="p-4 bg-gray-50 rounded-xl border border-gray-100">
                                    <span class="font-bold text-[#204138] block mb-1">03. {{ __('Dénombrement') }}</span>
                                    <p class="text-xs !mb-0">{{ __('Collecte effective des données auprès des ménages.') }}</p>
                                </div>
                                <div class="p-4 bg-gray-50 rounded-xl border border-gray-100">
                                    <span class="font-bold text-[#204138] block mb-1">04. {{ __('Analyse') }}</span>
                                    <p class="text-xs !mb-0">{{ __('Traitement, apurement et publication des résultats.') }}</p>
                                </div>
                            </div>
                        </article>

                    </div>

                    <!-- Sidebar Documentation -->
                    <aside class="sidebar-col">
                        <div class="sidebar-card">
                            <h3 class="sidebar-title">{{ __('Documentation') }}</h3>
                            <p class="sidebar-subtitle">{{ __('Les documentations de cette phase (décrets, publications)') }}</p>
                            <ul class="doc-list">
                                <li v-for="i in 6" :key="i">
                                    <a href="#" class="doc-item">
                                        <span>{{ __('Décret XXXXXXX/XXXX') }}</span>
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21.44 11.05l-9.19 9.19a6 6 0 01-8.49-8.49l9.19-9.19a4 4 0 015.66 5.66l-9.2 9.19a2 2 0 01-2.83-2.83l8.49-8.48"></path></svg>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </aside>

                </div>
            </div>
        </main>
    </MainLayout>
</template>

<style scoped>
@import "../../css/inner.css";
</style>
