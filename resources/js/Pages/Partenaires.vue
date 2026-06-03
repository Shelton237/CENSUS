<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head } from '@inertiajs/vue3';

const financialPartners = [
    {
        name: 'Gouvernement du Cameroun',
        acronym: 'GVT',
        logo: null,
        role: 'Financement principal & tutelle institutionnelle',
        desc: 'Le Gouvernement camerounais assure le financement majoritaire du 4ème RGPH et RGAE via le budget de l\'État, sous la coordination du Ministère de l\'Économie, de la Planification et de l\'Aménagement du Territoire (MINEPAT).',
        website: 'https://www.minepat.gov.cm',
        color: '#204138',
        contribution: 'Financement principal',
    },
    {
        name: 'Banque Mondiale',
        acronym: 'WB',
        logo: '/assets/images/partenaire/worldbank.svg',
        role: 'Partenaire financier — Projet HISWACA',
        desc: 'La Banque Mondiale soutient le recensement à travers le projet HISWACA (Harmonized Integrated Statistical Work in Africa and Central Africa), apportant un financement clé pour les équipements numériques et la formation des agents.',
        website: 'https://www.banquemondiale.org/fr/country/cameroon',
        color: '#009FDA',
        contribution: '7 milliards FCFA',
    },
    {
        name: 'HISWACA',
        acronym: 'HIS',
        logo: '/assets/images/partenaire/hiswaca-e1770819554832.jpg',
        role: 'Programme de soutien statistique régional',
        desc: 'Le programme HISWACA (Harmonized Integrated Statistical Work in Africa and Central Africa) coordonne l\'appui technique et financier aux opérations statistiques des pays d\'Afrique Centrale, dont le Cameroun.',
        website: '#',
        color: '#1B6CA8',
        contribution: 'Coordination régionale',
    },
];

const technicalPartners = [
    {
        name: 'UNFPA',
        fullName: 'Fonds des Nations Unies pour la Population',
        logo: '/assets/images/partenaire/unfpa.png',
        role: 'Assistance technique démographique',
        desc: 'L\'UNFPA apporte une expertise démographique de pointe, notamment pour la conception des outils de collecte, la cartographie numérique des zones de dénombrement et le suivi en temps réel des opérations de terrain.',
        website: 'https://cameroon.unfpa.org/',
        color: '#009FDA',
    },
    {
        name: 'FAO',
        fullName: 'Organisation des Nations Unies pour l\'Alimentation et l\'Agriculture',
        logo: '/assets/images/partenaire/fao.png',
        role: 'Appui méthodologique volet agricole',
        desc: 'La FAO supervise et appuie le volet agricole du recensement (RGAE), en fournissant les méthodologies standardisées, les nomenclatures agricoles internationales et un soutien technique pour la collecte des données agropastorales.',
        website: 'https://www.fao.org/cameroon/fr/',
        color: '#4C9C2E',
    },
    {
        name: 'OMS',
        fullName: 'Organisation Mondiale de la Santé',
        acronym: 'OMS',
        logo: null,
        role: 'Logistique et matériel technique',
        desc: 'L\'OMS contribue à la logistique opérationnelle du recensement, notamment pour la mise à disposition de matériel technique et l\'appui aux opérations dans les zones à accès difficile.',
        website: 'https://www.who.int/fr/countries/cmr',
        color: '#007DC5',
    },
];

const institutionalPartners = [
    {
        name: 'BUCREP',
        fullName: 'Bureau Central des Recensements et des Études de Population',
        acronym: 'BUCREP',
        logo: null,
        role: 'Maître d\'œuvre technique officiel',
        desc: 'Organisme public expert créé en 1999, le BUCREP est le bras opérationnel du gouvernement pour la réalisation du 4ème RGPH et RGAE. Il coordonne l\'ensemble des opérations, de la cartographie jusqu\'à la publication des résultats.',
        website: 'https://bucrep.org',
        color: '#204138',
    },
    {
        name: 'MINEPAT',
        fullName: 'Ministère de l\'Économie, de la Planification et de l\'Aménagement du Territoire',
        acronym: 'MINEPAT',
        logo: null,
        role: 'Tutelle technique du BUCREP',
        desc: 'Le MINEPAT assure la tutelle technique du BUCREP et supervise l\'orientation stratégique du recensement, en veillant à son intégration dans les politiques nationales de planification et de développement.',
        website: 'https://www.minepat.gov.cm',
        color: '#204138',
    },
    {
        name: 'INS',
        fullName: 'Institut National de la Statistique du Cameroun',
        acronym: 'INS',
        logo: null,
        role: 'Partenaire statistique national',
        desc: 'L\'INS collabore avec le BUCREP pour la validation méthodologique, la cohérence des nomenclatures statistiques nationales et la diffusion des résultats du recensement auprès des utilisateurs institutionnels.',
        website: 'https://www.statistics-cameroon.org',
        color: '#2E6B5E',
    },
];
</script>

<template>
    <Head>
        <title>Partenaires — RGPH4 Cameroun</title>
        <meta name="description" content="Partenaires financiers, techniques et institutionnels du 4ème Recensement Général de la Population et de l'Habitat du Cameroun.">
    </Head>

    <MainLayout>
        <!-- Hero -->
        <section class="relative pt-32 pb-20 overflow-hidden bg-[#204138]">
            <div class="absolute inset-0 z-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
            <div class="container relative z-10 text-center">
                <span class="inline-block py-1 px-3 rounded-full bg-[#EDAF11]/20 text-[#EDAF11] font-bold text-sm tracking-widest uppercase mb-4">Transparence & Coopération</span>
                <h1 class="text-4xl md:text-5xl font-black text-white mb-6 leading-tight">Nos Partenaires</h1>
                <p class="text-xl text-white/80 max-w-2xl mx-auto leading-relaxed">Le 4ème RGPH et RGAE est le fruit d'une collaboration entre le Gouvernement camerounais et des organisations nationales et internationales de premier plan.</p>
            </div>
        </section>

        <main style="padding: 70px 0 100px; background: #FDFDFD;">
            <div class="container max-w-5xl mx-auto px-4">

                <!-- ══ 1. PARTENAIRES FINANCIERS ══ -->
                <section class="mb-20">
                    <div class="flex items-center gap-3 mb-8 pb-5 border-b border-[#204138]/10">
                        <div class="w-8 h-8 bg-[#EDAF11] flex items-center justify-center rounded-lg flex-shrink-0">
                            <svg class="w-4 h-4 text-[#204138]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <span class="text-[11px] font-semibold uppercase tracking-[0.18em] text-[#EDAF11] block">Soutien budgétaire</span>
                            <h2 class="text-xl font-bold text-[#204138]">Partenaires Financiers</h2>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div v-for="p in financialPartners" :key="p.name"
                             class="bg-white border border-[#204138]/8 rounded-2xl p-6 hover:border-[#204138]/20 hover:shadow-md transition-all duration-300">
                            <div class="flex items-start gap-5 flex-wrap md:flex-nowrap">
                                <!-- Logo -->
                                <div class="w-20 h-16 rounded-xl border border-gray-100 flex items-center justify-center flex-shrink-0 overflow-hidden bg-gray-50">
                                    <img v-if="p.logo" :src="p.logo" :alt="p.name" class="w-full h-full object-contain p-2">
                                    <span v-else class="text-sm font-black" :style="`color: ${p.color}`">{{ p.acronym }}</span>
                                </div>
                                <!-- Contenu -->
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-start justify-between gap-4 flex-wrap mb-2">
                                        <div>
                                            <h3 class="font-bold text-[#204138] text-base leading-snug">{{ p.name }}</h3>
                                            <p class="text-xs font-semibold text-[#EDAF11] mt-0.5">{{ p.role }}</p>
                                        </div>
                                        <span class="text-[10px] font-bold uppercase tracking-[0.12em] text-white px-3 py-1 rounded-full"
                                              :style="`background: ${p.color}`">
                                            {{ p.contribution }}
                                        </span>
                                    </div>
                                    <p class="text-sm text-gray-500 leading-relaxed mb-3">{{ p.desc }}</p>
                                    <a v-if="p.website !== '#'" :href="p.website" target="_blank" rel="noopener noreferrer"
                                       class="inline-flex items-center gap-1.5 text-xs font-semibold no-underline transition-colors duration-200"
                                       :style="`color: ${p.color}`">
                                        Visiter le site officiel
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- ══ 2. PARTENAIRES TECHNIQUES ══ -->
                <section class="mb-20">
                    <div class="flex items-center gap-3 mb-8 pb-5 border-b border-[#204138]/10">
                        <div class="w-8 h-8 bg-[#204138] flex items-center justify-center rounded-lg flex-shrink-0">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><circle cx="12" cy="12" r="3"/>
                            </svg>
                        </div>
                        <div>
                            <span class="text-[11px] font-semibold uppercase tracking-[0.18em] text-[#EDAF11] block">Expertise & méthodologie</span>
                            <h2 class="text-xl font-bold text-[#204138]">Partenaires Techniques</h2>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div v-for="p in technicalPartners" :key="p.name"
                             class="bg-white border border-[#204138]/8 rounded-2xl p-6 hover:border-[#204138]/20 hover:shadow-md transition-all duration-300 flex flex-col">
                            <!-- Logo -->
                            <div class="w-16 h-12 rounded-xl border border-gray-100 flex items-center justify-center mb-4 overflow-hidden bg-gray-50">
                                <img v-if="p.logo" :src="p.logo" :alt="p.name" class="w-full h-full object-contain p-1.5">
                                <span v-else class="text-sm font-black" :style="`color: ${p.color}`">{{ p.acronym }}</span>
                            </div>
                            <h3 class="font-bold text-[#204138] text-base mb-0.5">{{ p.name }}</h3>
                            <p class="text-[10px] font-semibold uppercase tracking-[0.1em] mb-3" :style="`color: ${p.color}`">{{ p.role }}</p>
                            <p class="text-xs text-gray-500 leading-relaxed flex-1 mb-4">{{ p.desc }}</p>
                            <a :href="p.website" target="_blank" rel="noopener noreferrer"
                               class="inline-flex items-center gap-1.5 text-xs font-semibold no-underline mt-auto transition-colors duration-200"
                               :style="`color: ${p.color}`">
                                {{ p.fullName }}
                                <svg class="w-3 h-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>
                    </div>
                </section>

                <!-- ══ 3. PARTENAIRES INSTITUTIONNELS ══ -->
                <section>
                    <div class="flex items-center gap-3 mb-8 pb-5 border-b border-[#204138]/10">
                        <div class="w-8 h-8 bg-[#204138] flex items-center justify-center rounded-lg flex-shrink-0">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <div>
                            <span class="text-[11px] font-semibold uppercase tracking-[0.18em] text-[#EDAF11] block">Cadre national</span>
                            <h2 class="text-xl font-bold text-[#204138]">Partenaires Institutionnels</h2>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <div v-for="p in institutionalPartners" :key="p.name"
                             class="flex items-start gap-5 p-5 bg-white border border-[#204138]/8 rounded-xl hover:border-[#204138]/20 hover:shadow-sm transition-all duration-300">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0"
                                 :style="`background: ${p.color}15`">
                                <span class="text-[11px] font-black" :style="`color: ${p.color}`">{{ p.acronym }}</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="font-bold text-[#204138] text-sm leading-snug">{{ p.name }}</h3>
                                <p class="text-[10px] font-semibold uppercase tracking-[0.1em] text-[#EDAF11] mb-2">{{ p.role }}</p>
                                <p class="text-xs text-gray-500 leading-relaxed">{{ p.desc }}</p>
                            </div>
                            <a :href="p.website" target="_blank" rel="noopener noreferrer"
                               class="flex-shrink-0 text-[10px] font-bold uppercase tracking-[0.1em] text-[#204138]/50 hover:text-[#204138] border border-[#204138]/15 hover:border-[#204138]/40 px-3 py-1.5 rounded-lg transition-colors duration-200 no-underline hidden md:block">
                                Site officiel
                            </a>
                        </div>
                    </div>
                </section>

            </div>
        </main>
    </MainLayout>
</template>
