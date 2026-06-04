<script setup>
import { ref, computed } from 'vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import { Link, Head, usePage } from '@inertiajs/vue3';

const page = usePage();
const __ = (key) => {
    return page.props.translations?.[key] || key;
};

const currentLocale = computed(() => page.props.locale || 'fr');

const activeTab = ref('definition'); // definition, legal, methodology, calendar, organisation

// --- Données Cadre Légal ---
const legalDocuments = [
    {
        title: {
            fr: 'Loi N°91/023 du 16 décembre 1991',
            en: 'Law N°91/023 of December 16, 1991'
        },
        subtitle: {
            fr: 'Relative aux recensements et enquêtes statistiques',
            en: 'Relating to censuses and statistical surveys'
        },
        desc: {
            fr: 'Cette loi pose le fondement juridique de la statistique officielle au Cameroun. Elle stipule l\'obligation de répondre aux questionnaires officiels et garantit la confidentialité absolue des données individuelles recueillies (secret statistique).',
            en: 'This law establishes the legal foundation for official statistics in Cameroon. It mandates responding to official questionnaires and guarantees absolute confidentiality of individual data collected (statistical secrecy).'
        },
        ref: 'Loi N°91/023'
    },
    {
        title: {
            fr: 'Décret Présidentiel N°2015/397 du 15 septembre 2015',
            en: 'Presidential Decree N°2015/397 of September 15, 2015'
        },
        subtitle: {
            fr: 'Institution du 4e Recensement Général de la Population (RGPH)',
            en: 'Institution of the 4th General Population Census (GPHC)'
        },
        desc: {
            fr: 'Décret portant organisation du 4ème RGPH du Cameroun, définissant ses objectifs de planification et désignant le Bureau Central des Recensements (BUCREP) comme le maître d\'œuvre technique officiel sous la tutelle du MINEPAT.',
            en: 'Decree organizing the 4th GPHC of Cameroon, defining its planning objectives and designating the Central Bureau of Censuses (BUCREP) as the official technical executor under MINEPAT oversight.'
        },
        ref: 'Décret N°2015/397'
    },
    {
        title: {
            fr: 'Décret Présidentiel N°2015/292 du 29 juin 2015',
            en: 'Presidential Decree N°2015/292 of June 29, 2015'
        },
        subtitle: {
            fr: 'Institution du Recensement Général de l\'Agriculture (RGAE)',
            en: 'Institution of the General Agriculture Census (GALC)'
        },
        desc: {
            fr: 'Ce décret instaure le recensement national agricole et de l\'élevage afin de disposer de statistiques structurelles détaillées sur l\'ensemble des exploitations agropastorales et aquacoles du pays.',
            en: 'This decree establishes the national agricultural and livestock census to provide detailed structural statistics on all agropastoral and aquaculture holdings in the country.'
        },
        ref: 'Décret N°2015/292'
    },
    {
        title: {
            fr: 'Arrêté N°039/CAB/PM du 06 mars 2026',
            en: 'Short Order N°039/CAB/PM of March 6, 2026'
        },
        subtitle: {
            fr: 'Fixation de la période de dénombrement principal mutualisé',
            en: 'Setting of the mutualized main enumeration period'
        },
        desc: {
            fr: 'Arrêté signé par le Premier Ministre fixant la période de collecte des données sur le terrain du 24 avril au 29 mai 2026 pour l\'opération couplée démographique et agricole.',
            en: 'Order signed by the Prime Minister setting the field data collection period from April 24 to May 29, 2026 for the coupled demographic and agricultural operation.'
        },
        ref: 'Arrêté N°039/CAB/PM'
    }
];

// --- Données Méthodologie ---
const methodologySteps = [
    {
        title: { fr: 'L\'Unité de Collecte', en: 'The Collection Unit' },
        desc: {
            fr: 'Pour le RGPH, l\'unité de collecte principale est le **Ménage** (l\'ensemble des personnes vivant sous le même toit et partageant les repas). Pour le RGAE, il s\'agit de l\'**Exploitation Agropastorale et Aquacole** (l\'unité techno-économique de production agricole).',
            en: 'For the GPHC, the main collection unit is the **Household** (all persons living under the same roof and sharing meals). For the GALC, it is the **Agropastoral and Aquaculture Holding** (the techno-economic unit of agricultural production).'
        },
        icon: 'home'
    },
    {
        title: { fr: 'La Méthodologie CAPI', en: 'CAPI Methodology' },
        desc: {
            fr: 'La collecte se fait de manière 100% numérique par interview directe assistée par ordinateur/smartphone (**Computer-Assisted Personal Interviewing**). Cette méthode élimine les questionnaires papier, intègre des contrôles de cohérence automatiques lors de la saisie et transmet instantanément les données cryptées au serveur central.',
            en: 'Collection is 100% digital via computer/smartphone-assisted personal interviewing (**CAPI**). This method eliminates paper questionnaires, integrates automatic validation checks during entry, and instantly transmits encrypted data to the central server.'
        },
        icon: 'device-tablet'
    },
    {
        title: { fr: 'Questionnaires & Nomenclatures', en: 'Questionnaires & Classifications' },
        desc: {
            fr: 'Le questionnaire est structuré en plusieurs modules harmonisés : caractéristiques démographiques, niveau d\'éducation, fécondité, caractéristiques de l\'habitat, transferts de fonds et activités agropastorales. Il utilise les nomenclatures nationales et internationales standardisées pour assurer la comparabilité des données.',
            en: 'The questionnaire is structured into several harmonized modules: demographic characteristics, educational level, fertility, housing conditions, remittances, and agropastoral activities. It uses standardized national and international classifications to ensure data comparability.'
        },
        icon: 'clipboard-list'
    }
];

// --- Données Partenaires ---
const partnersList = [
    { name: 'Gouvernement du Cameroun', role: { fr: 'Financement principal & Tutelle institutionnelle (MINEPAT)', en: 'Main funding & Institutional oversight (MINEPAT)' }, logo: '/assets/images/logo-rgae.jpg' },
    { name: 'Banque Mondiale', role: { fr: 'Partenaire financier majeur via le projet HISWACA (7 milliards FCFA)', en: 'Major financial partner via the HISWACA project (7 billion FCFA)' }, logo: null },
    { name: 'UNFPA (Fonds des Nations Unies pour la Population)', role: { fr: 'Assistance technique démographique, outils de cartographie numérique et de suivi', en: 'Technical demographic assistance, digital mapping and monitoring tools' }, logo: null },
    { name: 'FAO (Organisation des Nations Unies pour l\'alimentation et l\'agriculture)', role: { fr: 'Appui méthodologique et supervision technique du volet agricole (RGAE)', en: 'Methodological support and technical supervision of the agricultural module (GALC)' }, logo: null },
    { name: 'OMS (Organisation Mondiale de la Santé)', role: { fr: 'Coopération pour la logistique et mise à disposition de matériel technique', en: 'Cooperation for logistics and provision of technical equipment' }, logo: null }
];
</script>


<template>
    <Head>
        <title>À Propos | RGPH4 Cameroun</title>
        <meta name="description" content="En savoir plus sur le 4ème RGPH et le RGAE — mission du BUCREP, cadre légal, méthodologie et organisation institutionnelle.">
        <meta property="og:title" content="À Propos | RGPH4 Cameroun">
        <meta property="og:description" content="Mission, vision et organisation du BUCREP — maître d'œuvre du 4ème Recensement Général de la Population et de l'Habitat du Cameroun.">
        <meta property="og:image" content="https://census.diginova.cm/assets/images/backgrounds/cameroon_people_map.png">
        <meta property="og:type" content="website">
        <meta property="og:locale" content="fr_FR">
        <meta property="og:site_name" content="Recensement Cameroun 2026">
        <meta property="og:url" content="https://census.diginova.cm/apropos">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@recensement90">
        <meta name="twitter:title" content="À Propos | RGPH4 Cameroun">
        <meta name="twitter:image" content="https://census.diginova.cm/assets/images/backgrounds/cameroon_people_map.png">
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

                        <!-- Navigation des Onglets -->
                        <div class="flex overflow-x-auto md:flex-wrap gap-2 border-b border-gray-100 pb-4 mb-6 scrollbar-none -mx-4 px-4 md:mx-0 md:px-0">
                            <button @click="activeTab = 'definition'"
                                    class="px-5 py-3 rounded-xl text-xs font-black uppercase tracking-wider transition-all duration-300 border flex-shrink-0"
                                    :class="activeTab === 'definition' ? 'bg-[#204138] border-[#204138] text-white shadow-md' : 'bg-white border-gray-200 text-gray-500 hover:border-[#204138] hover:text-[#204138]'">
                                {{ __('Définition & Objectifs') }}
                            </button>
                            <button @click="activeTab = 'legal'"
                                    class="px-5 py-3 rounded-xl text-xs font-black uppercase tracking-wider transition-all duration-300 border flex-shrink-0"
                                    :class="activeTab === 'legal' ? 'bg-[#204138] border-[#204138] text-white shadow-md' : 'bg-white border-gray-200 text-gray-500 hover:border-[#204138] hover:text-[#204138]'">
                                {{ __('Cadre Légal') }}
                            </button>
                            <button @click="activeTab = 'methodology'"
                                    class="px-5 py-3 rounded-xl text-xs font-black uppercase tracking-wider transition-all duration-300 border flex-shrink-0"
                                    :class="activeTab === 'methodology' ? 'bg-[#204138] border-[#204138] text-white shadow-md' : 'bg-white border-gray-200 text-gray-500 hover:border-[#204138] hover:text-[#204138]'">
                                {{ __('Méthodologie') }}
                            </button>
                            <button @click="activeTab = 'calendar'"
                                    class="px-5 py-3 rounded-xl text-xs font-black uppercase tracking-wider transition-all duration-300 border flex-shrink-0"
                                    :class="activeTab === 'calendar' ? 'bg-[#204138] border-[#204138] text-white shadow-md' : 'bg-white border-gray-200 text-gray-500 hover:border-[#204138] hover:text-[#204138]'">
                                {{ __('Calendrier & Zones') }}
                            </button>
                            <button @click="activeTab = 'organisation'"
                                    class="px-5 py-3 rounded-xl text-xs font-black uppercase tracking-wider transition-all duration-300 border flex-shrink-0"
                                    :class="activeTab === 'organisation' ? 'bg-[#204138] border-[#204138] text-white shadow-md' : 'bg-white border-gray-200 text-gray-500 hover:border-[#204138] hover:text-[#204138]'">
                                {{ __('Organisation & Partenaires') }}
                            </button>
                        </div>

                        <!-- 1. ONGLET: DEFINITION & OBJECTIFS -->
                        <div v-if="activeTab === 'definition'" class="space-y-8 animate-fadeIn">
                            <!-- Contexte et définition -->
                            <article class="content-section">
                                <h2 class="section-title">{{ __('Contexte Historique et Mutualisation') }}</h2>
                                <div class="section-with-image">
                                    <div class="section-text">
                                        <p>{{ __('Le quatrième Recensement Général de la Population et de l\'Habitat (4ème RGPH) et le Recensement Général de l\'Agriculture et de l\'Élevage (RGAE) constituent des opérations statistiques de grande envergure pour la planification du développement du pays.') }}</p>
                                        <p>{{ __('Le 4ème RGPH est institué par Décret Présidentiel tandis que le RGAE l\'est également par Décret Présidentiel. Le Premier Ministre a instruit en 2019 la mutualisation des deux opérations afin d\'optimiser les coûts liés aux ressources financières, matérielles, technologiques et logistiques.') }}</p>
                                    </div>
                                    <div class="section-image">
                                        <img src="/assets/images/accueil/map_pop_white_bg.jpg" alt="Mutualisation" loading="lazy">
                                    </div>
                                </div>
                            </article>

                            <!-- Objectifs -->
                            <article class="content-section">
                                <h2 class="section-title">{{ __('Objectifs Généraux') }}</h2>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                                    <div class="p-6 bg-green-50/40 border-t-4 border-[#2E6B5E] rounded-b-2xl shadow-sm">
                                        <span class="inline-block px-2 py-0.5 rounded font-black text-[9px] uppercase tracking-wider bg-[#2E6B5E]/10 text-[#2E6B5E] mb-3">RGPH-4</span>
                                        <h4 class="font-bold text-[#204138] text-base mb-2">{{ __('Objectif Démographique') }}</h4>
                                        <p class="text-sm text-gray-600 leading-relaxed">{{ __('Rendre disponibles les données statistiques nécessaires à la planification du développement et à la prise en compte du dividende démographique dans l\'élaboration des politiques du pays.') }}</p>
                                    </div>
                                    <div class="p-6 bg-amber-50/40 border-t-4 border-[#EDAF11] rounded-b-2xl shadow-sm">
                                        <span class="inline-block px-2 py-0.5 rounded font-black text-[9px] uppercase tracking-wider bg-[#EDAF11]/10 text-[#a07402] mb-3">RGAE</span>
                                        <h4 class="font-bold text-[#a07402] text-base mb-2">{{ __('Objectif Agricole & Élevage') }}</h4>
                                        <p class="text-sm text-gray-600 leading-relaxed">{{ __('Fournir des données structurelles détaillées sur l\'ensemble des exploitations agropastorales et aquacoles du pays et élaborer des bases de sondage pour les modules thématiques complémentaires.') }}</p>
                                    </div>
                                </div>
                            </article>

                            <!-- Utilité -->
                            <article class="content-section">
                                <h2 class="section-title">{{ __('Utilité du Recensement') }}</h2>
                                <p>{{ __('Cet instrument précieux permet le cadrage, l\'élaboration, le suivi et l\'évaluation des politiques publiques aux niveaux national, régional et local. Il sert de base pour :') }}</p>
                                <ul class="content-list">
                                    <li>{{ __('L\'élaboration des bases de sondage pour les enquêtes inter-censitaires.') }}</li>
                                    <li>{{ __('La planification des infrastructures de base (écoles, hôpitaux, routes, électrification).') }}</li>
                                    <li>{{ __('La répartition équitable et rationnelle des ressources publiques.') }}</li>
                                    <li>{{ __('Le suivi des engagements internationaux (Objectifs de Développement Durable - ODD, Agenda 2063).') }}</li>
                                </ul>
                            </article>
                        </div>

                        <!-- 2. ONGLET: CADRE LEGAL -->
                        <div v-if="activeTab === 'legal'" class="space-y-6 animate-fadeIn">
                            <article class="content-section">
                                <h2 class="section-title">{{ __('Base Juridique du Recensement') }}</h2>
                                <p class="mb-6 text-gray-600 leading-relaxed">{{ __('Toutes les opérations de recensement au Cameroun s\'appuient sur un cadre juridique strict garantissant la souveraineté de l\'opération et la protection des données des citoyens.') }}</p>
                                
                                <div class="space-y-4">
                                    <div v-for="doc in legalDocuments" :key="doc.ref" 
                                         class="p-6 bg-white border border-gray-100 hover:border-[#2E6B5E]/30 rounded-2xl shadow-sm hover:shadow-md transition-all duration-300 flex items-start gap-4">
                                        <div class="w-12 h-12 rounded-xl bg-[#2E6B5E]/10 text-[#2E6B5E] flex items-center justify-center flex-shrink-0">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                            </svg>
                                        </div>
                                        <div class="space-y-1 flex-1">
                                            <div class="flex items-center justify-between gap-4 flex-wrap">
                                                <h4 class="font-bold text-[#204138] text-base leading-tight">{{ doc.title[currentLocale] }}</h4>
                                                <span class="text-[9px] px-2 py-0.5 rounded font-black bg-gray-100 text-gray-500 border border-gray-200">{{ doc.ref }}</span>
                                            </div>
                                            <p class="text-xs font-semibold text-[#EDAF11] uppercase tracking-wider">{{ doc.subtitle[currentLocale] }}</p>
                                            <p class="text-xs md:text-sm text-gray-500 leading-relaxed font-medium pt-1">{{ doc.desc[currentLocale] }}</p>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>

                        <!-- 3. ONGLET: METHODOLOGIE -->
                        <div v-if="activeTab === 'methodology'" class="space-y-8 animate-fadeIn">
                            <article class="content-section">
                                <h2 class="section-title">{{ __('Méthodologie de Collecte') }}</h2>
                                <p class="text-gray-600 leading-relaxed mb-6">{{ __('Le 4e RGPH et le RGAE adoptent des méthodologies statistiques éprouvées et conformes aux recommandations internationales des Nations Unies, de l\'UNFPA et de la FAO.') }}</p>
                                
                                <div class="grid grid-cols-1 gap-6">
                                    <div v-for="step in methodologySteps" :key="step.title.fr" 
                                         class="p-6 bg-white border border-gray-100 hover:border-[#2E6B5E]/30 rounded-3xl shadow-sm hover:shadow-md transition-all duration-300 flex flex-col md:flex-row gap-4">
                                        <div class="w-12 h-12 rounded-2xl bg-[#EDAF11]/15 text-[#a07402] flex items-center justify-center flex-shrink-0">
                                            <svg v-if="step.icon === 'home'" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                            </svg>
                                            <svg v-else-if="step.icon === 'device-tablet'" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                            </svg>
                                            <svg v-else class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2M9 5a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2M9 5a2 2 0 0 0 2-2h2a2 2 0 0 0 2 2"/>
                                            </svg>
                                        </div>
                                        <div class="space-y-1">
                                            <h4 class="font-bold text-[#204138] text-base">{{ step.title[currentLocale] }}</h4>
                                            <p class="text-xs md:text-sm text-gray-500 leading-relaxed font-medium" v-html="step.desc[currentLocale]"></p>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>

                        <!-- 4. ONGLET: CALENDRIER & ZONES -->
                        <div v-if="activeTab === 'calendar'" class="space-y-8 animate-fadeIn">
                            <!-- Les 7 Phases -->
                            <article class="content-section">
                                <h2 class="section-title">{{ __('Les 7 Grandes Phases du RGPH') }}</h2>
                                <p class="mb-8 text-gray-600 leading-relaxed">{{ __('Une opération de cette envergure se déroule de manière rigoureuse en plusieurs phases successives, du cadrage initial jusqu\'à la publication finale.') }}</p>
                                <div class="apropos-phases">

                                    <div class="apropos-phase-item">
                                        <div class="apropos-phase-number">01</div>
                                        <div class="apropos-phase-card">
                                            <div class="apropos-phase-icon-wrap">
                                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2M9 5a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2M9 5a2 2 0 0 0 2-2h2a2 2 0 0 0 2 2"/></svg>
                                            </div>
                                            <div class="apropos-phase-content">
                                                <h4 class="apropos-phase-title">{{ __('01. Activités Préparatoires') }}</h4>
                                                <p class="apropos-phase-desc">{{ __('Conception des méthodologies, élaboration des questionnaires, outils de collecte, manuels d\'instruction et mobilisation des ressources financières, matérielles et humaines.') }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="apropos-phase-item">
                                        <div class="apropos-phase-number">02</div>
                                        <div class="apropos-phase-card">
                                            <div class="apropos-phase-icon-wrap">
                                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9,22 9,12 15,12 15,22"/></svg>
                                            </div>
                                            <div class="apropos-phase-content">
                                                <h4 class="apropos-phase-title">{{ __('02. Cartographie Censitaire') }}</h4>
                                                <p class="apropos-phase-desc">{{ __('Mise à jour exhaustive du fichier des localités et découpage du territoire national en zones de travail appelées Zones de Dénombrement (ZD). Un agent sera déployé par ZD.') }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="apropos-phase-item">
                                        <div class="apropos-phase-number">03</div>
                                        <div class="apropos-phase-card">
                                            <div class="apropos-phase-icon-wrap">
                                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                                            </div>
                                            <div class="apropos-phase-content">
                                                <h4 class="apropos-phase-title">{{ __('03. Recensement Pilote') }}</h4>
                                                <p class="apropos-phase-desc">{{ __('Test grandeur nature de l\'ensemble de l\'organisation et des méthodologies sur un échantillon d\'environ 260 zones de dénombrement représentatives (urbaines et rurales).') }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="apropos-phase-item">
                                        <div class="apropos-phase-number apropos-phase-number--active">04</div>
                                        <div class="apropos-phase-card apropos-phase-card--active">
                                            <div class="apropos-phase-icon-wrap apropos-phase-icon-wrap--active">
                                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                                            </div>
                                            <div class="apropos-phase-content">
                                                <h4 class="apropos-phase-title">{{ __('04. Dénombrement Principal') }}</h4>
                                                <p class="apropos-phase-desc">{{ __('Le comptage effectif de la population et la collecte des données auprès de chaque ménage par des agents recenseurs munis de smartphones. Répondre est une obligation civique.') }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="apropos-phase-item">
                                        <div class="apropos-phase-number">05</div>
                                        <div class="apropos-phase-card">
                                            <div class="apropos-phase-icon-wrap">
                                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                                            </div>
                                            <div class="apropos-phase-content">
                                                <h4 class="apropos-phase-title">{{ __('05. Enquête Post-Censitaire (EPC)') }}</h4>
                                                <p class="apropos-phase-desc">{{ __('Réalisée au plus tard trois mois après le dénombrement principal pour évaluer la couverture géographique et la qualité des variables clés (sexe et âge) sur 12 strates.') }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="apropos-phase-item">
                                        <div class="apropos-phase-number">06</div>
                                        <div class="apropos-phase-card">
                                            <div class="apropos-phase-icon-wrap">
                                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
                                            </div>
                                            <div class="apropos-phase-content">
                                                <h4 class="apropos-phase-title">{{ __('06. Exploitation et Analyse') }}</h4>
                                                <p class="apropos-phase-desc">{{ __('Traitement transversal, apurement rigoureux et analyse statistique approfondie pour élaborer les tomes d\'analyse prioritaires et les monographies régionales.') }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="apropos-phase-item">
                                        <div class="apropos-phase-number">07</div>
                                        <div class="apropos-phase-card">
                                            <div class="apropos-phase-icon-wrap">
                                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"/><polyline points="16,6 12,2 8,6"/><line x1="12" y1="2" x2="12" y2="15"/></svg>
                                            </div>
                                            <div class="apropos-phase-content">
                                                <h4 class="apropos-phase-title">{{ __('07. Publication et Diffusion') }}</h4>
                                                <p class="apropos-phase-desc">{{ __('Mise à disposition et vulgarisation des résultats officiels sur supports variés et accessibles, afin de faciliter leur compréhension et utilisation par les décideurs.') }}</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </article>

                            <!-- Zones couvertes -->
                            <article class="content-section">
                                <h2 class="section-title">{{ __('Zones Couvertes') }}</h2>
                                <p class="text-gray-600 leading-relaxed mb-4">{{ __('Le recensement couvre l\'intégralité du territoire national du Cameroun sans aucune exclusion, réparti géographiquement comme suit :') }}</p>
                                <div class="p-6 bg-gray-50/50 border border-gray-100 rounded-3xl grid grid-cols-3 gap-4 text-center">
                                    <div class="p-2">
                                        <span class="block text-2xl font-black text-[#204138]">10</span>
                                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">{{ __('Régions') }}</span>
                                    </div>
                                    <div class="p-2 border-x border-gray-200">
                                        <span class="block text-2xl font-black text-[#204138]">58</span>
                                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">{{ __('Départements') }}</span>
                                    </div>
                                    <div class="p-2">
                                        <span class="block text-2xl font-black text-[#204138]">360</span>
                                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">{{ __('Arrondissements') }}</span>
                                    </div>
                                </div>
                            </article>
                        </div>

                        <!-- 5. ONGLET: ORGANISATION & PARTENAIRES -->
                        <div v-if="activeTab === 'organisation'" class="space-y-8 animate-fadeIn">

                            <!-- À propos du BUCREP -->
                            <article class="content-section">
                                <span class="text-[11px] font-semibold uppercase tracking-[0.18em] text-[#EDAF11] block mb-3">À propos du BUCREP</span>
                                <h2 class="section-title">Bureau Central des Recensements et des Études de Population</h2>

                                <!-- Mission -->
                                <div class="mb-6 p-5 bg-[#F7F9F8] border-l-4 border-[#204138]">
                                    <p class="text-[10px] font-bold uppercase tracking-[0.14em] text-[#204138]/50 mb-1.5">Notre Mission</p>
                                    <p class="text-sm font-semibold text-[#204138] leading-relaxed">Accompagner le gouvernement dans la planification du développement et le suivi des politiques publiques</p>
                                </div>

                                <p class="mb-4 text-gray-600 leading-relaxed">Créé en <strong class="text-[#204138]">1999</strong>, le BUCREP est placé sous la tutelle technique du Ministère de l'Économie, de la Planification et de l'Aménagement du Territoire (MINEPAT) et sous la tutelle financière du Ministère des Finances. Il a pour mission de réaliser les recensements et enquêtes démographiques au niveau national, d'élaborer des études sur la population afin de soutenir les politiques publiques, et de diffuser des données fiables à destination des décideurs, chercheurs et citoyens.</p>

                                <!-- Vision -->
                                <div class="p-5 bg-[#F7F9F8] border-l-4 border-[#EDAF11]">
                                    <p class="text-[10px] font-bold uppercase tracking-[0.14em] text-[#204138]/50 mb-1.5">Notre Vision</p>
                                    <p class="text-sm text-gray-600 leading-relaxed mb-3">Le BUCREP ambitionne de se positionner comme la <strong class="text-[#204138]">référence dans le domaine des études de population et de la démographie</strong>, en gagnant en notoriété, en améliorant son image et en développant ses prestations à l'échelle nationale et internationale.</p>
                                    <p class="text-sm text-gray-600 leading-relaxed">Le BUCREP vise à assurer la mise à disposition régulière des données sur la population, à garantir leur fiabilité par le développement continu de la compétence professionnelle, à favoriser leur accessibilité via les technologies de l'information et enfin à produire des revenus pour son autonomisation progressive.</p>
                                </div>
                            </article>

                            <!-- Principaux organes -->
                            <article class="content-section">
                                <h2 class="section-title">Principaux Organes</h2>
                                <p class="text-gray-500 text-sm mb-6 leading-relaxed">Pour remplir ses missions, le BUCREP est administré par deux organes de gestion et un organe consultatif placé auprès du Directeur Général.</p>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                                    <!-- Conseil d'Administration -->
                                    <div class="p-5 bg-white border border-[#204138]/10 border-l-4 border-l-[#204138] rounded-xl">
                                        <div class="w-10 h-10 bg-[#204138] flex items-center justify-center mb-4 rounded-xl">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        </div>
                                        <h4 class="font-bold text-[#204138] mb-2 text-sm">Conseil d'Administration</h4>
                                        <p class="text-xs text-gray-500 leading-relaxed">Définit et oriente la politique générale et évalue la gestion dans les limites fixées par l'objet social. Composé de <strong class="text-[#204138]">12 membres</strong>.</p>
                                    </div>

                                    <!-- Direction Générale -->
                                    <div class="p-5 bg-[#204138] border-l-4 border-[#EDAF11] rounded-xl">
                                        <div class="w-10 h-10 bg-[#EDAF11] flex items-center justify-center mb-4 rounded-xl">
                                            <svg class="w-5 h-5 text-[#204138]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                        </div>
                                        <h4 class="font-bold text-white mb-2 text-sm">Direction Générale</h4>
                                        <p class="text-xs text-white/70 leading-relaxed">Assure la gestion et l'application de la politique générale sous le contrôle du CA. Placée sous l'autorité d'un <strong class="text-white">Directeur Général assisté d'un DGA</strong>.</p>
                                    </div>

                                    <!-- Conseil Scientifique -->
                                    <div class="p-5 bg-white border border-[#EDAF11]/25 border-l-4 border-l-[#EDAF11] rounded-xl">
                                        <div class="w-10 h-10 bg-[#EDAF11]/15 flex items-center justify-center mb-4 rounded-xl">
                                            <svg class="w-5 h-5 text-[#B8860B]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                        </div>
                                        <h4 class="font-bold text-[#204138] mb-2 text-sm">Conseil Scientifique</h4>
                                        <p class="text-xs text-gray-500 leading-relaxed">Assure le respect de la démarche scientifique dans la préparation et l'exécution de toutes les activités. Organe <strong class="text-[#204138]">consultatif</strong> placé auprès du DG.</p>
                                    </div>
                                </div>

                                <!-- Organigramme -->
                                <div class="mb-6">
                                    <p class="text-[10px] font-bold uppercase tracking-[0.14em] text-[#204138]/50 mb-3">Organigramme institutionnel</p>
                                    <div class="border border-[#204138]/10 overflow-hidden">
                                        <img
                                            src="https://bucrep.org/wp-content/uploads/2025/07/Avant-Projet_Organigramme_BUCREP-5-juillet-francais-25-1-1024x724.png"
                                            alt="Organigramme du BUCREP"
                                            class="w-full h-auto block"
                                            loading="lazy"
                                        >
                                    </div>
                                    <p class="text-[10px] text-gray-400 mt-2 text-right">Source : bucrep.org — Avant-projet organigramme, juillet 2025</p>
                                </div>

                                <!-- Coordination terrain -->
                                <div class="p-5 bg-[#F7F9F8] border-l-4 border-[#204138]/30">
                                    <p class="text-[10px] font-bold uppercase tracking-[0.14em] text-[#204138]/50 mb-1.5">Coordination de terrain</p>
                                    <p class="text-sm text-gray-600 leading-relaxed">L'opération est coordonnée par des <strong class="text-[#204138]">Directions Régionales</strong>, des Comités Départementaux et des Comités d'Arrondissement présidés par les autorités administratives (Gouverneurs, Préfets, Sous-préfets) pour en garantir le bon déroulement, la logistique et la sécurité.</p>
                                </div>
                            </article>

                            <!-- Partenaires -->
                            <article class="content-section">
                                <h2 class="section-title">{{ __('Partenaires Techniques et Financiers') }}</h2>
                                <p class="text-gray-600 leading-relaxed mb-6">{{ __('Le 4e RGPH et le RGAE bénéficient de l\'appui d\'institutions internationales majeures pour le financement et la supervision technique :') }}</p>
                                
                                <div class="space-y-4">
                                    <div v-for="partner in partnersList" :key="partner.name" 
                                         class="p-6 bg-white border border-gray-100 rounded-2xl shadow-sm flex items-center gap-4 hover:border-[#2E6B5E]/20 transition-all duration-300">
                                        <div class="w-12 h-12 rounded-xl bg-gray-50 flex items-center justify-center flex-shrink-0 overflow-hidden border border-gray-100">
                                            <img v-if="partner.logo" :src="partner.logo" :alt="partner.name" class="w-full h-full object-cover">
                                            <span v-else class="text-xs font-black text-gray-400 uppercase">PART</span>
                                        </div>
                                        <div class="space-y-0.5">
                                            <h4 class="font-bold text-[#204138] text-base leading-tight">{{ partner.name }}</h4>
                                            <p class="text-xs md:text-sm text-gray-500 leading-relaxed font-medium">{{ partner.role[currentLocale] }}</p>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>

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

                        <!-- National Coverage Visual Card -->
                        <div class="sidebar-card sidebar-map-card mt-6">
                            <div class="sidebar-map-img-wrap">
                                <img src="/assets/images/backgrounds/cameroon_people_map.png" alt="Cameroon National Map" class="sidebar-map-img" loading="lazy">
                                <div class="sidebar-map-overlay"></div>
                                <span class="sidebar-map-badge">{{ __('Couverture Nationale') }}</span>
                            </div>
                            <div class="sidebar-map-body">
                                <h4 class="sidebar-map-title">{{ __('Chaque citoyen compte') }}</h4>
                                <p class="sidebar-map-desc">{{ __('Des savanes du Grand Nord aux forêts équatoriales du Sud, le 4ème RGPH unit et cartographie toutes les populations du Cameroun.') }}</p>
                            </div>
                        </div>
                    </aside>

                </div>
            </div>
        </main>
    </MainLayout>
</template>

<style scoped>
@import "../../css/inner.css";

/* ============================
   Decree Cards - Cadre Institutionnel
   ============================ */
.apropos-decree-card {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1.25rem 1.5rem;
    background: linear-gradient(135deg, rgba(32, 65, 56, 0.04) 0%, rgba(32, 65, 56, 0.08) 100%);
    border: 1px solid rgba(32, 65, 56, 0.15);
    border-left: 4px solid #204138;
    border-radius: 0.75rem;
    transition: box-shadow 0.2s ease, transform 0.2s ease;
}
.apropos-decree-card:hover {
    box-shadow: 0 4px 20px rgba(32, 65, 56, 0.12);
    transform: translateY(-2px);
}
.apropos-decree-card--yellow {
    background: linear-gradient(135deg, rgba(237, 175, 17, 0.04) 0%, rgba(237, 175, 17, 0.09) 100%);
    border-color: rgba(237, 175, 17, 0.25);
    border-left-color: #EDAF11;
}
.apropos-decree-card--yellow:hover {
    box-shadow: 0 4px 20px rgba(237, 175, 17, 0.15);
}
.apropos-decree-icon {
    flex-shrink: 0;
    width: 44px;
    height: 44px;
    border-radius: 0.6rem;
    background: rgba(32, 65, 56, 0.1);
    color: #204138;
    display: flex;
    align-items: center;
    justify-content: center;
}
.apropos-decree-icon--yellow {
    background: rgba(237, 175, 17, 0.12);
    color: #b88300;
}
.apropos-decree-label {
    display: block;
    font-weight: 800;
    font-size: 0.75rem;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    color: #204138;
    margin-bottom: 0.4rem;
}
.apropos-decree-label--yellow {
    color: #b88300;
}
.apropos-decree-text {
    margin: 0;
    font-size: 0.875rem;
    color: #4b5563;
    line-height: 1.65;
}

/* ============================
   7 Phases Timeline
   ============================ */
.apropos-phases {
    display: flex;
    flex-direction: column;
    gap: 0;
    position: relative;
}
.apropos-phases::before {
    content: '';
    position: absolute;
    left: 22px;
    top: 24px;
    bottom: 24px;
    width: 2px;
    background: linear-gradient(to bottom, #204138, rgba(32, 65, 56, 0.1));
    border-radius: 2px;
}
.apropos-phase-item {
    display: flex;
    align-items: flex-start;
    gap: 1.25rem;
    position: relative;
    padding-bottom: 1.5rem;
}
.apropos-phase-item:last-child {
    padding-bottom: 0;
}
.apropos-phase-number {
    flex-shrink: 0;
    width: 46px;
    height: 46px;
    border-radius: 50%;
    background: #204138;
    color: white;
    font-weight: 800;
    font-size: 0.8rem;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    z-index: 1;
    box-shadow: 0 0 0 4px rgba(32, 65, 56, 0.1);
    transition: transform 0.2s ease;
}
.apropos-phase-number--active {
    background: #EDAF11;
    box-shadow: 0 0 0 4px rgba(237, 175, 17, 0.2);
    animation: pulse-yellow 2s infinite;
}
@keyframes pulse-yellow {
    0%, 100% { box-shadow: 0 0 0 4px rgba(237, 175, 17, 0.2); }
    50% { box-shadow: 0 0 0 8px rgba(237, 175, 17, 0.08); }
}
.apropos-phase-card {
    flex: 1;
    display: flex;
    align-items: flex-start;
    gap: 0.875rem;
    padding: 1.1rem 1.25rem;
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 0.75rem;
    transition: box-shadow 0.2s ease, border-color 0.2s ease;
}
.apropos-phase-card:hover {
    box-shadow: 0 4px 16px rgba(0,0,0,0.07);
    border-color: #204138;
}
.apropos-phase-card--active {
    background: linear-gradient(135deg, rgba(237, 175, 17, 0.05) 0%, rgba(237, 175, 17, 0.1) 100%);
    border-color: rgba(237, 175, 17, 0.4);
}
.apropos-phase-icon-wrap {
    flex-shrink: 0;
    width: 38px;
    height: 38px;
    border-radius: 0.5rem;
    background: rgba(32, 65, 56, 0.07);
    color: #204138;
    display: flex;
    align-items: center;
    justify-content: center;
}
.apropos-phase-icon-wrap--active {
    background: rgba(237, 175, 17, 0.15);
    color: #b88300;
}
.apropos-phase-title {
    font-weight: 800;
    font-size: 0.9rem;
    color: #1a2e28;
    margin: 0 0 0.35rem 0;
}
.apropos-phase-desc {
    font-size: 0.82rem;
    color: #6b7280;
    line-height: 1.6;
    margin: 0;
}

/* ============================
   CAPI Cards Grid
   ============================ */
.apropos-capi-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1.25rem;
}
@media (max-width: 768px) {
    .apropos-capi-grid {
        grid-template-columns: 1fr;
    }
}
.apropos-capi-card {
    padding: 1.5rem 1.25rem;
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 1rem;
    text-align: center;
    transition: box-shadow 0.25s ease, transform 0.25s ease;
}
.apropos-capi-card:hover {
    box-shadow: 0 8px 28px rgba(32, 65, 56, 0.1);
    transform: translateY(-3px);
}
.apropos-capi-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: rgba(32, 65, 56, 0.08);
    color: #204138;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem auto;
}
.apropos-capi-icon--yellow {
    background: rgba(237, 175, 17, 0.12);
    color: #b88300;
}
.apropos-capi-title {
    font-weight: 800;
    font-size: 0.9rem;
    color: #1a2e28;
    margin: 0 0 0.5rem 0;
}
.apropos-capi-desc {
    font-size: 0.82rem;
    color: #6b7280;
    line-height: 1.6;
    margin: 0;
}

/* Sidebar National Map Card */
.sidebar-map-card {
    padding: 0 !important;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    border-radius: 1rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
    border: 1px solid rgba(0, 0, 0, 0.05);
}
.sidebar-map-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 30px rgba(32, 65, 56, 0.12);
}
.sidebar-map-img-wrap {
    position: relative;
    width: 100%;
    height: 180px;
    background-color: #f3f4f6;
    overflow: hidden;
}
.sidebar-map-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}
.sidebar-map-card:hover .sidebar-map-img {
    transform: scale(1.05);
}
.sidebar-map-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to bottom, transparent 30%, rgba(32, 65, 56, 0.9) 100%);
}
.sidebar-map-badge {
    position: absolute;
    top: 1rem;
    left: 1rem;
    background-color: #EDAF11;
    color: #ffffff;
    font-size: 0.65rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    padding: 0.25rem 0.6rem;
    border-radius: 9999px;
    z-index: 10;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
}
.sidebar-map-body {
    padding: 1.25rem;
    background: #ffffff;
}
.sidebar-map-title {
    font-weight: 800;
    font-size: 1rem;
    color: #204138;
    margin: 0 0 0.5rem 0;
    text-align: left;
}
.sidebar-map-desc {
    font-size: 0.8rem;
    color: #4b5563;
    line-height: 1.5;
    margin: 0;
    text-align: left;
}

/* Mobile responsive adjustments */
@media (max-width: 640px) {
    .apropos-phases::before {
        left: 18px;
    }
    .apropos-phase-number {
        width: 38px;
        height: 38px;
        font-size: 0.72rem;
    }
    .apropos-phase-card {
        padding: 0.9rem 1rem;
    }
    .apropos-decree-card {
        flex-direction: column;
        gap: 0.75rem;
    }
}

/* Animations and tab visual helpers */
.animate-fadeIn {
    animation: fadeIn 0.4s ease-out forwards;
}

.scrollbar-none::-webkit-scrollbar {
    display: none;
}
.scrollbar-none {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
</style>
