<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

const page = usePage();
const __ = (key) => page.props.translations?.[key] || key;

const props = defineProps({
    videos: { type: Array, default: () => [] },
});

// FAQ : rumeurs & réponses
const faqs = [
    {
        q: 'Mes données seront-elles transmises au fisc ou aux impôts ?',
        a: 'Non. Les données collectées lors du recensement sont strictement confidentielles et ne sont jamais transmises aux services fiscaux, à la police ou à tout autre organisme gouvernemental. Elles servent exclusivement à produire des statistiques nationales anonymisées.',
    },
    {
        q: 'Est-ce que le recensement sert à identifier les opposants politiques ?',
        a: 'Absolument pas. Le recensement est une opération purement statistique, sans lien avec la politique. Son objectif est de dénombrer la population pour planifier les services publics (santé, éducation, eau potable). Il est protégé par le secret statistique garanti par la loi.',
    },
    {
        q: 'Les étrangers et résidents non-camerounais doivent-ils participer ?',
        a: 'Oui. Le recensement recense toutes les personnes résidant habituellement au Cameroun, quelle que soit leur nationalité. Cela inclut les étrangers en séjour régulier, les réfugiés reconnus et les personnes sans papiers. Leurs données restent confidentielles.',
    },
    {
        q: 'Puis-je refuser de répondre aux questions du recenseur ?',
        a: 'La participation au recensement est obligatoire selon la loi camerounaise sur les statistiques. Un refus ou la fourniture de fausses informations est passible de sanctions. Cependant, les agents ont pour mission de vous expliquer chaque question et de mettre à l\'aise les ménages.',
    },
    {
        q: 'Comment savoir si l\'agent recenseur est officiel ?',
        a: 'Tout agent recenseur officiel porte une tenue identifiable et une carte officielle de mission délivrée par le BUCREP, avec photo, nom et région d\'affectation. Il utilise une tablette Android avec l\'application officielle de collecte. En cas de doute, appelez le (+237) 6 93 87 31 45.',
    },
    {
        q: 'Le recensement va-t-il modifier mon accès à la terre ou à une aide sociale ?',
        a: 'Non. Le recensement ne modifie en rien vos droits sur la terre, vos allocations ou aides sociales. Il sert à planifier les investissements publics futurs (routes, hôpitaux, écoles) en fonction de la répartition réelle de la population.',
    },
    {
        q: 'Une femme seule doit-elle ouvrir sa porte à un agent recenseur ?',
        a: 'Les agents interviennent toujours pendant les heures de jour et peuvent être reçus en extérieur (cour, véranda). Si vous avez un doute, vous pouvez demander à un voisin de confiance d\'être présent. L\'agent doit toujours présenter sa carte officielle.',
    },
    {
        q: 'Les données du RGPH4 seront-elles rendues publiques ?',
        a: 'Oui, mais sous forme de statistiques agrégées et anonymisées. Aucune donnée individuelle ne sera publiée. Les résultats seront disponibles sur le site de l\'INS et du BUCREP pour servir aux chercheurs, institutions et décideurs publics.',
    },
];

const openFaq = ref(null);
const toggleFaq = (i) => { openFaq.value = openFaq.value === i ? null : i; };

// Messages clés
const messages = [
    { icon: 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', title: 'Données 100 % confidentielles', desc: 'Protégées par le secret statistique, vos informations ne quittent jamais le BUCREP.' },
    { icon: 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z', title: 'Pour de meilleurs services publics', desc: 'Chaque réponse aide à construire hôpitaux, routes et écoles là où la population en a besoin.' },
    { icon: 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z', title: 'Tout le monde compte', desc: 'Camerounais, étrangers, résidents ruraux et urbains — chaque habitant doit être compté.' },
    { icon: 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z', title: 'Une opération décennale', desc: 'Le RGPH se tient tous les 10 ans. Cette édition (RGPH4 & RGAE) est une occasion unique.' },
];
</script>

<template>
    <Head>
        <title>Communication & Sensibilisation | RGPH4 & RGAE Cameroun</title>
        <meta name="description" content="Réponses aux rumeurs, messages clés et spots de sensibilisation sur le 4ème Recensement Général de la Population et de l'Habitat du Cameroun.">
        <meta property="og:title" content="Communication & Sensibilisation RGPH4">
        <meta property="og:image" content="https://census.diginova.cm/assets/images/backgrounds/cameroon_people_map.png">
    </Head>

    <MainLayout>

        <!-- ══ HERO ══ -->
        <section class="bg-[#204138] pt-28 pb-14">
            <div class="container max-w-5xl mx-auto px-4">
                <p class="text-[#EDAF11] text-xs font-bold uppercase tracking-[0.18em] mb-3">Sensibilisation & Information</p>
                <h1 class="text-3xl md:text-4xl font-black text-white leading-tight mb-4 max-w-2xl">
                    Ce que vous devez savoir<br>sur le recensement
                </h1>
                <p class="text-white/70 text-sm max-w-xl leading-relaxed">
                    Réponses aux rumeurs, messages clés et matériaux de sensibilisation pour mieux comprendre le RGPH4 et le RGAE.
                </p>
            </div>
        </section>

        <div class="bg-gray-50 py-14">
            <div class="container max-w-5xl mx-auto px-4 space-y-16">

                <!-- ══ MESSAGES CLÉS ══ -->
                <section>
                    <div class="mb-8">
                        <p class="text-[#EDAF11] text-xs font-bold uppercase tracking-[0.18em] mb-1">Messages clés</p>
                        <h2 class="text-2xl font-black text-[#204138]">Pourquoi se faire recenser ?</h2>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div v-for="m in messages" :key="m.title"
                             class="bg-white border border-gray-200 rounded-lg p-5 border-l-4 border-l-[#EDAF11] flex gap-4">
                            <div class="w-9 h-9 bg-[#204138]/8 rounded-lg flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-5 h-5 text-[#204138]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" :d="m.icon"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-[#204138] text-sm mb-1">{{ m.title }}</h3>
                                <p class="text-xs text-gray-600 leading-relaxed">{{ m.desc }}</p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- ══ SPOTS VIDÉO ══ -->
                <section>
                    <div class="mb-8">
                        <p class="text-[#EDAF11] text-xs font-bold uppercase tracking-[0.18em] mb-1">Spots de sensibilisation</p>
                        <h2 class="text-2xl font-black text-[#204138]">Vidéos officielles</h2>
                    </div>

                    <div v-if="videos && videos.length > 0" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div v-for="video in videos" :key="video.id" class="bg-white border border-gray-200 rounded-lg overflow-hidden">
                            <div class="aspect-video">
                                <iframe :src="`https://www.youtube.com/embed/${video.youtube_id}`"
                                        class="w-full h-full" frameborder="0" allowfullscreen
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture">
                                </iframe>
                            </div>
                            <div class="p-4">
                                <h3 class="font-bold text-[#204138] text-sm">{{ video.title }}</h3>
                                <p v-if="video.description" class="text-xs text-gray-500 mt-1">{{ video.description }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Placeholder si aucune vidéo en base -->
                    <div v-else class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div v-for="i in 2" :key="i" class="bg-white border border-gray-200 rounded-lg overflow-hidden">
                            <div class="aspect-video bg-[#204138]/5 flex flex-col items-center justify-center gap-3">
                                <div class="w-14 h-14 bg-[#204138]/10 rounded-full flex items-center justify-center">
                                    <svg class="w-7 h-7 text-[#204138]/40" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z"/>
                                    </svg>
                                </div>
                                <p class="text-xs text-gray-400 font-medium">Spot vidéo — bientôt disponible</p>
                            </div>
                            <div class="p-4">
                                <div class="h-3 bg-gray-100 rounded w-3/4 mb-2"></div>
                                <div class="h-2 bg-gray-100 rounded w-1/2"></div>
                            </div>
                        </div>
                    </div>

                    <p class="text-xs text-gray-400 mt-4 text-center">
                        Retrouvez nos spots officiels sur
                        <a href="https://www.facebook.com/profile.php?id=61562950229317" target="_blank" rel="noopener"
                           class="text-[#204138] hover:underline font-medium">Facebook RGPH4</a>
                        et
                        <a href="https://x.com/recensement90" target="_blank" rel="noopener"
                           class="text-[#204138] hover:underline font-medium">X (Twitter)</a>.
                    </p>
                </section>

                <!-- ══ FAQ RUMEURS ══ -->
                <section>
                    <div class="mb-8">
                        <p class="text-[#EDAF11] text-xs font-bold uppercase tracking-[0.18em] mb-1">Idées reçues & réponses</p>
                        <h2 class="text-2xl font-black text-[#204138]">Foire aux questions</h2>
                        <p class="text-sm text-gray-500 mt-2">Réponses officielles aux questions et rumeurs les plus fréquentes.</p>
                    </div>

                    <div class="space-y-2">
                        <div v-for="(faq, i) in faqs" :key="i"
                             class="bg-white border border-gray-200 rounded-lg overflow-hidden">
                            <button type="button" @click="toggleFaq(i)"
                                    class="w-full px-6 py-4 text-left flex items-center justify-between gap-4 hover:bg-gray-50 transition-colors cursor-pointer">
                                <span class="text-sm font-semibold text-[#204138] leading-snug">{{ faq.q }}</span>
                                <svg class="w-4 h-4 text-[#EDAF11] shrink-0 transition-transform duration-200"
                                     :class="openFaq === i ? 'rotate-180' : ''"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div v-show="openFaq === i" class="px-6 pb-5 border-t border-gray-100">
                                <p class="text-sm text-gray-600 leading-relaxed pt-4 border-l-4 border-[#EDAF11] pl-4">
                                    {{ faq.a }}
                                </p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- ══ TÉLÉCHARGEMENTS ══ -->
                <section>
                    <div class="mb-8">
                        <p class="text-[#EDAF11] text-xs font-bold uppercase tracking-[0.18em] mb-1">Matériaux officiels</p>
                        <h2 class="text-2xl font-black text-[#204138]">Outils de sensibilisation</h2>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                        <a href="/ressources" class="bg-white border border-gray-200 rounded-lg p-5 flex items-start gap-4 hover:border-[#204138]/30 hover:shadow-sm transition-all group">
                            <div class="w-9 h-9 bg-[#EDAF11]/15 rounded-lg flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-[#204138]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-[#204138] text-sm mb-1 group-hover:underline">Documents officiels</h3>
                                <p class="text-xs text-gray-500">Textes réglementaires, manuels et questionnaires</p>
                            </div>
                        </a>
                        <a href="/phototheque" class="bg-white border border-gray-200 rounded-lg p-5 flex items-start gap-4 hover:border-[#204138]/30 hover:shadow-sm transition-all group">
                            <div class="w-9 h-9 bg-[#EDAF11]/15 rounded-lg flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-[#204138]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-[#204138] text-sm mb-1 group-hover:underline">Photothèque</h3>
                                <p class="text-xs text-gray-500">Photos et visuels officiels du recensement</p>
                            </div>
                        </a>
                        <a href="mailto:recensement90@gmail.com" class="bg-white border border-gray-200 rounded-lg p-5 flex items-start gap-4 hover:border-[#204138]/30 hover:shadow-sm transition-all group">
                            <div class="w-9 h-9 bg-[#EDAF11]/15 rounded-lg flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-[#204138]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-[#204138] text-sm mb-1 group-hover:underline">Kit presse & médias</h3>
                                <p class="text-xs text-gray-500">Logos, dossier de presse sur demande</p>
                            </div>
                        </a>
                    </div>
                </section>

                <!-- ══ CONTACT PRESSE ══ -->
                <section class="bg-[#204138] rounded-lg p-8 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                    <div>
                        <p class="text-[#EDAF11] text-xs font-bold uppercase tracking-[0.18em] mb-2">Médias & Journalistes</p>
                        <h2 class="text-xl font-black text-white mb-1">Vous êtes journaliste ?</h2>
                        <p class="text-white/70 text-sm">Contactez notre service de communication pour toute demande d'interview, de visuels ou d'accréditation.</p>
                    </div>
                    <div class="flex flex-col gap-2 shrink-0">
                        <a href="tel:+237693873145" class="flex items-center gap-2 bg-white/10 hover:bg-white/20 border border-white/20 rounded px-4 py-2.5 text-white text-sm transition-colors">
                            <svg class="w-4 h-4 text-[#EDAF11]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            (+237) 6 93 87 31 45
                        </a>
                        <a href="mailto:recensement90@gmail.com" class="flex items-center gap-2 bg-[#EDAF11] hover:bg-[#d9a00f] rounded px-4 py-2.5 text-[#204138] font-bold text-sm transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            recensement90@gmail.com
                        </a>
                    </div>
                </section>

            </div>
        </div>

    </MainLayout>
</template>
