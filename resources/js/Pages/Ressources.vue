<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const legalDocs = [
    {
        ref: 'Loi N°91/023',
        title: 'Loi N°91/023 du 16 décembre 1991',
        desc: 'Relative aux recensements et enquêtes statistiques — fondement juridique de la statistique officielle au Cameroun et garantie du secret statistique.',
        status: 'sur_demande',
    },
    {
        ref: 'Décret N°2015/397',
        title: 'Décret Présidentiel N°2015/397 du 15 septembre 2015',
        desc: 'Institution du 4ème Recensement Général de la Population et de l\'Habitat (RGPH) — désigne le BUCREP comme maître d\'œuvre sous tutelle MINEPAT.',
        status: 'sur_demande',
    },
    {
        ref: 'Décret N°2015/292',
        title: 'Décret Présidentiel N°2015/292 du 29 juin 2015',
        desc: 'Institution du Recensement Général de l\'Agriculture et de l\'Élevage (RGAE) — statistiques structurelles sur les exploitations agropastorales.',
        status: 'sur_demande',
    },
    {
        ref: 'Arrêté N°039/CAB/PM',
        title: 'Arrêté N°039/CAB/PM du 06 mars 2026',
        desc: 'Fixation de la période de dénombrement principal mutualisé RGPH/RGAE du 24 avril au 29 mai 2026, signé par le Premier Ministre.',
        status: 'sur_demande',
    },
];

const manuals = [
    {
        title: 'Manuel de l\'agent recenseur (RGPH)',
        desc: 'Guide complet pour la collecte des données démographiques — questionnaire, procédures, cas particuliers.',
        status: 'sur_demande',
        icon: 'user',
    },
    {
        title: 'Manuel de l\'agent recenseur (RGAE)',
        desc: 'Guide pour la collecte des données agricoles — exploitation agropastorale, aquaculture, nomenclatures.',
        status: 'sur_demande',
        icon: 'user',
    },
    {
        title: 'Manuel du contrôleur',
        desc: 'Procédures de supervision, de contrôle qualité et de coordination des équipes de terrain.',
        status: 'sur_demande',
        icon: 'check',
    },
    {
        title: 'Guide de cartographie numérique',
        desc: 'Utilisation des outils SIG, délimitation des zones de dénombrement et saisie sur tablette.',
        status: 'a_venir',
        icon: 'map',
    },
    {
        title: 'Questionnaire ménage RGPH',
        desc: 'Formulaire officiel de collecte des données démographiques et d\'habitat par ménage.',
        status: 'sur_demande',
        icon: 'doc',
    },
    {
        title: 'Questionnaire exploitation RGAE',
        desc: 'Formulaire officiel de collecte des données agricoles, pastorales et aquacoles.',
        status: 'sur_demande',
        icon: 'doc',
    },
];

const usefulLinks = [
    {
        name: 'BUCREP',
        desc: 'Bureau Central des Recensements et des Études de Population — site officiel',
        url: 'https://bucrep.org',
        color: '#204138',
    },
    {
        name: 'INS Cameroun',
        desc: 'Institut National de la Statistique du Cameroun',
        url: 'https://www.statistics-cameroon.org',
        color: '#204138',
    },
    {
        name: 'UNFPA Cameroun',
        desc: 'Fonds des Nations Unies pour la Population — partenaire technique',
        url: 'https://cameroon.unfpa.org',
        color: '#1B6CA8',
    },
    {
        name: 'FAO Cameroun',
        desc: 'Organisation des Nations Unies pour l\'Alimentation et l\'Agriculture',
        url: 'https://www.fao.org/cameroon',
        color: '#1B6CA8',
    },
    {
        name: 'Banque Mondiale',
        desc: 'Partenaire financier du projet HISWACA (7 milliards FCFA)',
        url: 'https://www.worldbank.org/fr/country/cameroon',
        color: '#009FDA',
    },
    {
        name: 'MINEPAT',
        desc: 'Ministère de l\'Économie, de la Planification et de l\'Aménagement du Territoire',
        url: 'https://www.minepat.gov.cm',
        color: '#204138',
    },
];
</script>

<template>
    <Head>
        <title>Ressources | RGPH4 & RGAE Cameroun</title>
        <meta name="description" content="Textes réglementaires, manuels de terrain, questionnaires et liens utiles du 4ème RGPH et RGAE du Cameroun.">
        <meta property="og:title" content="Ressources | RGPH4 & RGAE Cameroun">
        <meta property="og:description" content="Lois, décrets, manuels d'agents, questionnaires officiels et liens institutionnels du recensement camerounais 2026.">
        <meta property="og:image" content="https://census.diginova.cm/assets/images/backgrounds/cameroon_people_map.png">
        <meta property="og:type" content="website">
        <meta property="og:locale" content="fr_FR">
        <meta property="og:locale:alternate" content="en_US">
        <meta property="og:site_name" content="Recensement Cameroun 2026">
        <meta property="og:url" content="https://census.diginova.cm/ressources">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@recensement90">
        <meta name="twitter:title" content="Ressources | RGPH4 & RGAE Cameroun">
        <meta name="twitter:image" content="https://census.diginova.cm/assets/images/backgrounds/cameroon_people_map.png">
    </Head>

    <MainLayout>
        <!-- Hero -->
        <section class="relative pt-32 pb-20 overflow-hidden bg-[#204138]">
            <div class="absolute inset-0 z-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
            <div class="container relative z-10 text-center">
                <span class="inline-block py-1 px-3 rounded-full bg-[#EDAF11]/20 text-[#EDAF11] font-bold text-sm tracking-widest uppercase mb-4">Documentation officielle</span>
                <h1 class="text-4xl md:text-5xl font-black text-white mb-6 leading-tight">Ressources</h1>
                <p class="text-xl text-white/80 max-w-2xl mx-auto leading-relaxed">Textes réglementaires, manuels de terrain, questionnaires et liens institutionnels du 4ème RGPH et RGAE du Cameroun.</p>
            </div>
        </section>

        <main style="padding: 60px 0 100px; background: #FDFDFD;">
            <div class="container max-w-5xl mx-auto px-4">

                <!-- ══ 1. TEXTES RÉGLEMENTAIRES ══ -->
                <section class="mb-16">
                    <div class="flex items-center gap-3 mb-8 pb-5 border-b border-[#204138]/10">
                        <div class="w-8 h-8 bg-[#204138] flex items-center justify-center rounded-lg flex-shrink-0">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/>
                            </svg>
                        </div>
                        <div>
                            <span class="text-[11px] font-semibold uppercase tracking-[0.18em] text-[#EDAF11] block">Cadre juridique</span>
                            <h2 class="text-xl font-bold text-[#204138] leading-snug">Textes Réglementaires</h2>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <div v-for="doc in legalDocs" :key="doc.ref"
                             class="flex items-start gap-4 p-5 bg-white border border-[#204138]/8 hover:border-[#204138]/20 transition-colors duration-200">
                            <div class="w-12 h-12 bg-[#F7F9F8] border border-[#204138]/10 flex items-center justify-center flex-shrink-0 rounded-lg">
                                <svg class="w-5 h-5 text-[#204138]/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between gap-4 flex-wrap">
                                    <div>
                                        <p class="text-[10px] font-bold uppercase tracking-[0.12em] text-[#EDAF11] mb-0.5">{{ doc.ref }}</p>
                                        <h3 class="text-sm font-bold text-[#204138] leading-snug mb-1">{{ doc.title }}</h3>
                                        <p class="text-xs text-gray-500 leading-relaxed">{{ doc.desc }}</p>
                                    </div>
                                    <a href="mailto:recensement90@gmail.com?subject=Demande%20document%20officiel%20RGPH4"
                                       class="flex-shrink-0 inline-flex items-center gap-1.5 text-[10px] font-bold uppercase tracking-[0.1em] text-[#204138]/60 hover:text-[#204138] border border-[#204138]/15 hover:border-[#204138]/40 px-3 py-1.5 transition-colors duration-200 no-underline rounded-lg">
                                        Sur demande
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- ══ 2. MANUELS & QUESTIONNAIRES ══ -->
                <section class="mb-16">
                    <div class="flex items-center gap-3 mb-8 pb-5 border-b border-[#204138]/10">
                        <div class="w-8 h-8 bg-[#EDAF11] flex items-center justify-center rounded-lg flex-shrink-0">
                            <svg class="w-4 h-4 text-[#204138]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <div>
                            <span class="text-[11px] font-semibold uppercase tracking-[0.18em] text-[#EDAF11] block">Outils de terrain</span>
                            <h2 class="text-xl font-bold text-[#204138] leading-snug">Manuels & Questionnaires</h2>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <div v-for="manual in manuals" :key="manual.title"
                             class="flex items-start gap-4 p-5 bg-white border border-[#204138]/8 hover:border-[#204138]/20 transition-colors duration-200">
                            <div class="w-10 h-10 bg-[#F7F9F8] border border-[#204138]/10 flex items-center justify-center flex-shrink-0 rounded-lg">
                                <svg class="w-4 h-4 text-[#204138]/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path v-if="manual.icon === 'user'" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    <path v-else-if="manual.icon === 'check'" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                                    <path v-else-if="manual.icon === 'map'" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                                    <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-sm font-bold text-[#204138] leading-snug mb-1">{{ manual.title }}</h3>
                                <p class="text-xs text-gray-500 leading-relaxed mb-3">{{ manual.desc }}</p>
                                <span v-if="manual.status === 'a_venir'"
                                      class="inline-flex items-center gap-1 text-[10px] font-bold uppercase tracking-[0.1em] text-gray-400 border border-gray-200 px-2.5 py-1 rounded-lg">
                                    À venir
                                </span>
                                <a v-else
                                   href="mailto:recensement90@gmail.com?subject=Demande%20manuel%20RGPH4"
                                   class="inline-flex items-center gap-1 text-[10px] font-bold uppercase tracking-[0.1em] text-[#204138]/60 hover:text-[#204138] border border-[#204138]/15 hover:border-[#204138]/40 px-2.5 py-1 transition-colors duration-200 no-underline rounded-lg">
                                    Sur demande
                                </a>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- ══ 3. LIENS UTILES ══ -->
                <section>
                    <div class="flex items-center gap-3 mb-8 pb-5 border-b border-[#204138]/10">
                        <div class="w-8 h-8 bg-[#204138] flex items-center justify-center rounded-lg flex-shrink-0">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                        </div>
                        <div>
                            <span class="text-[11px] font-semibold uppercase tracking-[0.18em] text-[#EDAF11] block">Institutions & partenaires</span>
                            <h2 class="text-xl font-bold text-[#204138] leading-snug">Liens Utiles</h2>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                        <a v-for="link in usefulLinks" :key="link.name"
                           :href="link.url" target="_blank" rel="noopener noreferrer"
                           class="group flex items-center gap-3 p-4 bg-white border border-[#204138]/8 hover:border-[#204138]/25 hover:bg-[#F7F9F8] transition-colors duration-200 no-underline">
                            <div class="w-9 h-9 flex-shrink-0 flex items-center justify-center rounded-lg"
                                 :style="`background: ${link.color}18`">
                                <svg class="w-4 h-4" :style="`color: ${link.color}`" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-bold text-[#204138] leading-snug group-hover:text-[#2b5549]">{{ link.name }}</p>
                                <p class="text-xs text-gray-400 leading-snug mt-0.5 truncate">{{ link.desc }}</p>
                            </div>
                            <svg class="w-3.5 h-3.5 text-gray-300 group-hover:text-[#EDAF11] flex-shrink-0 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                        </a>
                    </div>
                </section>

            </div>
        </main>
    </MainLayout>
</template>
