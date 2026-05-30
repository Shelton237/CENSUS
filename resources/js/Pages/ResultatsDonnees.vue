<script setup>
import { ref, computed } from 'vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';

const page = usePage();
const __ = (key) => {
    return page.props.translations?.[key] || key;
};

const currentLocale = computed(() => page.props.locale || 'fr');

const activeTab = ref('map'); // map, tables, publications, microdata

// --- Données Régionales (RGPH + RGAE) ---
const regionalData = {
    extreme_nord: {
        id: 'extreme_nord',
        name: { fr: 'Extrême-Nord', en: 'Far North' },
        capital: { fr: 'Maroua', en: 'Maroua' },
        population: '4 012 344',
        menages: '782 468',
        logements: '745 120',
        superficie: '34 263 km²',
        cheptel: '1 250 000 bovins, 2 800 000 ovins/caprins',
        exploitations: '412 500',
        culture: { fr: 'Sorgho, Mil, Coton, Oignon', en: 'Sorghum, Millet, Cotton, Onion' }
    },
    nord: {
        id: 'nord',
        name: { fr: 'Nord', en: 'North' },
        capital: { fr: 'Garoua', en: 'Garoua' },
        population: '2 581 110',
        menages: '448 912',
        logements: '412 400',
        superficie: '65 576 km²',
        cheptel: '850 000 bovins, 1 400 000 ovins/caprins',
        exploitations: '248 100',
        culture: { fr: 'Coton, Maïs, Arachides, Mil', en: 'Cotton, Maize, Groundnuts, Millet' }
    },
    adamaoua: {
        id: 'adamaoua',
        name: { fr: 'Adamaoua', en: 'Adamawa' },
        capital: { fr: 'Ngaoundéré', en: 'Ngaoundéré' },
        population: '1 315 200',
        menages: '238 410',
        logements: '224 800',
        superficie: '63 701 km²',
        cheptel: '1 600 000 bovins (Cœur de l\'élevage), 600 000 caprins',
        exploitations: '132 400',
        culture: { fr: 'Maïs, Manioc, Igname, Pomme de terre', en: 'Maize, Cassava, Yam, Potato' }
    },
    nord_ouest: {
        id: 'nord_ouest',
        name: { fr: 'Nord-Ouest', en: 'Northwest' },
        capital: { fr: 'Bamenda', en: 'Bamenda' },
        population: '2 150 450',
        menages: '476 120',
        logements: '452 300',
        superficie: '17 300 km²',
        cheptel: '250 000 bovins, 450 000 porcins, 1 200 000 volailles',
        exploitations: '286 900',
        culture: { fr: 'Café Arabica, Pomme de terre, Maïs, Haricots', en: 'Arabica Coffee, Potato, Maize, Beans' }
    },
    ouest: {
        id: 'ouest',
        name: { fr: 'Ouest', en: 'West' },
        capital: { fr: 'Bafoussam', en: 'Bafoussam' },
        population: '2 052 100',
        menages: '458 390',
        logements: '445 100',
        superficie: '13 892 km²',
        cheptel: '120 000 bovins, 650 000 porcins, 4 500 000 volailles',
        exploitations: '325 800',
        culture: { fr: 'Café, Maraîchage, Pomme de terre, Maïs', en: 'Coffee, Vegetables, Potato, Maize' }
    },
    sud_ouest: {
        id: 'sud_ouest',
        name: { fr: 'Sud-Ouest', en: 'Southwest' },
        capital: { fr: 'Buea', en: 'Buea' },
        population: '1 684 500',
        menages: '344 115',
        logements: '320 500',
        superficie: '25 410 km²',
        cheptel: '45 000 porcins, 800 000 volailles',
        exploitations: '185 200',
        culture: { fr: 'Cacao, Palmier à huile, Hévéa, Thé, Banane', en: 'Cocoa, Oil Palm, Rubber, Tea, Banana' }
    },
    littoral: {
        id: 'littoral',
        name: { fr: 'Littoral', en: 'Littoral' },
        capital: { fr: 'Douala', en: 'Douala' },
        population: '3 510 200',
        menages: '818 900',
        logements: '782 400',
        superficie: '20 248 km²',
        cheptel: '80 000 porcins, 3 800 000 volailles',
        exploitations: '94 500',
        culture: { fr: 'Palmier à huile, Hévéa, Banane, Cultures vivrières', en: 'Oil Palm, Rubber, Banana, Food Crops' }
    },
    centre: {
        id: 'centre',
        name: { fr: 'Centre', en: 'Centre' },
        capital: { fr: 'Yaoundé', en: 'Yaoundé' },
        population: '4 285 300',
        menages: '945 120',
        logements: '912 600',
        superficie: '68 953 km²',
        cheptel: '180 000 porcins, 5 200 000 volailles',
        exploitations: '382 100',
        culture: { fr: 'Cacao, Plantain, Manioc, Arachides', en: 'Cocoa, Plantain, Cassava, Groundnuts' }
    },
    est: {
        id: 'est',
        name: { fr: 'Est', en: 'East' },
        capital: { fr: 'Bertoua', en: 'Bertoua' },
        population: '1 180 900',
        menages: '212 400',
        logements: '198 200',
        superficie: '109 002 km²',
        cheptel: '180 000 bovins, 350 000 petits ruminants',
        exploitations: '128 400',
        culture: { fr: 'Cacao, Café Robust, Manioc, Tabac, Banane', en: 'Cocoa, Robusta Coffee, Cassava, Tobacco, Banana' }
    },
    sud: {
        id: 'sud',
        name: { fr: 'Sud', en: 'South' },
        capital: { fr: 'Ebolowa', en: 'Ebolowa' },
        population: '812 500',
        menages: '180 400',
        logements: '172 100',
        superficie: '47 191 km²',
        cheptel: '30 000 porcins, 750 000 volailles',
        exploitations: '96 800',
        culture: { fr: 'Cacao, Manioc, Arachides, Banane plantain', en: 'Cocoa, Cassava, Groundnuts, Plantain Banana' }
    }
};

const selectedRegionId = ref('centre');
const selectedRegion = computed(() => regionalData[selectedRegionId.value]);

const hoverRegionId = ref(null);

const geoLevel = ref('region'); // region, departement, commune

// --- Données Tableaux Statistiques ---
const searchQuery = ref('');
const filterMetric = ref('all'); // all, pop_gt_2m, sup_gt_50k, exp_gt_200k

const tableRows = computed(() => {
    let rows = Object.values(regionalData);

    // Filtrage recherche textuelle
    if (searchQuery.value.trim() !== '') {
        const q = searchQuery.value.toLowerCase();
        rows = rows.filter(r => 
            r.name.fr.toLowerCase().includes(q) || 
            r.name.en.toLowerCase().includes(q) ||
            r.capital.fr.toLowerCase().includes(q) ||
            r.capital.en.toLowerCase().includes(q)
        );
    }

    // Filtrage par critère métrique
    if (filterMetric.value === 'pop_gt_2m') {
        rows = rows.filter(r => parseFloat(r.population.replace(/\s/g, '')) > 2000000);
    } else if (filterMetric.value === 'sup_gt_50k') {
        rows = rows.filter(r => parseFloat(r.superficie.replace(/[^\d]/g, '')) > 50000);
    } else if (filterMetric.value === 'exp_gt_200k') {
        rows = rows.filter(r => parseFloat(r.exploitations.replace(/\s/g, '')) > 200000);
    }

    return rows;
});

// Téléchargements standards simulés
const downloadStats = (format, dataset) => {
    alert(`[Simulation] Téléchargement du jeu de données "${dataset}" au format ${format} démarré avec succès.`);
};

// --- Publications ---
const publicationSearch = ref('');
const activePubCategory = ref('all'); // all, atlas, rapports, monographies

const publications = [
    {
        title: { fr: 'Rapport Démographique Global Cameroun 2026', en: 'Cameroon Global Demographic Report 2026' },
        category: 'rapports',
        desc: { fr: 'Analyse globale préliminaire de la population du Cameroun : structure par âge, sexe et répartition par région.', en: 'Preliminary global analysis of Cameroon\'s population: age structure, sex ratio and distribution by region.' },
        date: 'Mai 2026',
        size: '4.8 MB',
        type: 'PDF'
    },
    {
        title: { fr: 'Atlas Cartographique des Infrastructures Nationales', en: 'Cartographic Atlas of National Infrastructure' },
        category: 'atlas',
        desc: { fr: 'Visualisation géographique complète des écoles, centres de santé et points d\'eau identifiés durant la cartographie.', en: 'Comprehensive geographic visualization of schools, health centers and water sources identified during cartography.' },
        date: 'Avril 2026',
        size: '18.2 MB',
        type: 'PDF'
    },
    {
        title: { fr: 'Monographie Agricole de la Région de l\'Adamaoua', en: 'Agricultural Monograph of the Adamawa Region' },
        category: 'monographies',
        desc: { fr: 'Étude structurelle fine de l\'élevage bovin, des superficies pastorales et du profil des éleveurs de la région.', en: 'Fine structural study of livestock farming, pastoral areas and breeders profile in the region.' },
        date: 'Février 2026',
        size: '6.1 MB',
        type: 'PDF'
    },
    {
        title: { fr: 'Rapport Spécifique RGAE : Profil des Exploitations Agricoles', en: 'GALC Specific Report: Profile of Agricultural Holdings' },
        category: 'rapports',
        desc: { fr: 'Données détaillées sur la taille moyenne des exploitations nationales, la parité de genre et l\'utilisation des engrais.', en: 'Detailed data on average size of national holdings, gender parity and fertilizer usage.' },
        date: 'Mars 2026',
        size: '3.4 MB',
        type: 'PDF'
    },
    {
        title: { fr: 'Atlas Sociodémographique de la Région du Centre', en: 'Sociodemographic Atlas of the Centre Region' },
        category: 'atlas',
        desc: { fr: 'Cartographie thématique de la densité de population, du taux d\'urbanisation et de l\'accès à l\'électricité.', en: 'Thematic mapping of population density, urbanization rate and access to electricity.' },
        date: 'Janvier 2026',
        size: '12.5 MB',
        type: 'PDF'
    },
    {
        title: { fr: 'Monographie Agricole et Pastorale de l\'Extrême-Nord', en: 'Agricultural and Pastoral Monograph of the Far North' },
        category: 'monographies',
        desc: { fr: 'Enjeux liés à la sécurité alimentaire, aux cultures sahéliennes (sorgho/oignon) et à la gestion de la transhumance.', en: 'Challenges related to food security, Sahelian crops (sorghum/onion) and transhumance management.' },
        date: 'Décembre 2025',
        size: '7.9 MB',
        type: 'PDF'
    }
];

const filteredPublications = computed(() => {
    let result = publications;

    if (activePubCategory.value !== 'all') {
        result = result.filter(p => p.category === activePubCategory.value);
    }

    if (publicationSearch.value.trim() !== '') {
        const q = publicationSearch.value.toLowerCase();
        result = result.filter(p => 
            p.title.fr.toLowerCase().includes(q) || 
            p.title.en.toLowerCase().includes(q) ||
            p.desc.fr.toLowerCase().includes(q) || 
            p.desc.en.toLowerCase().includes(q)
        );
    }

    return result;
});

// --- Formulaire de demande de Microdonnées ---
const microdataForm = ref({
    name: '',
    email: '',
    organization: '',
    purpose: '',
    dataset: 'rgph_2026_anonyme',
    terms: false
});

const isFormSubmitted = ref(false);
const formErrors = ref({});

const submitMicrodataRequest = () => {
    formErrors.value = {};
    
    if (!microdataForm.value.name) formErrors.value.name = __('Le nom est requis');
    if (!microdataForm.value.email) formErrors.value.email = __('L\'email est requis');
    else if (!/\S+@\S+\.\S+/.test(microdataForm.value.email)) formErrors.value.email = __('Format d\'email invalide');
    if (!microdataForm.value.organization) formErrors.value.organization = __('L\'organisation est requise');
    if (!microdataForm.value.purpose || microdataForm.value.purpose.length < 15) formErrors.value.purpose = __('Veuillez détailler votre projet de recherche (min. 15 caractères)');
    if (!microdataForm.value.terms) formErrors.value.terms = __('Vous devez accepter les conditions d\'utilisation');

    if (Object.keys(formErrors.value).length === 0) {
        // Envoi simulé réussi
        isFormSubmitted.value = true;
    }
};

const resetForm = () => {
    microdataForm.value = {
        name: '',
        email: '',
        organization: '',
        purpose: '',
        dataset: 'rgph_2026_anonyme',
        terms: false
    };
    isFormSubmitted.value = false;
};
</script>

<template>
    <Head>
        <title>{{ __('Résultats & Données') }}</title>
        <meta name="description" :content="__('Accédez aux publications, tableaux statistiques et à la cartographie interactive du double recensement du Cameroun')">
    </Head>

    <MainLayout>
        <!-- Hero section -->
        <section class="relative pt-32 pb-20 overflow-hidden bg-[#204138]">
            <div class="absolute inset-0 z-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
            <div class="container relative z-10 text-center">
                <span class="inline-block py-1 px-3 rounded-full bg-[#EDAF11]/20 text-[#EDAF11] font-bold text-sm tracking-widest uppercase mb-4">{{ __('Statistiques Officielles') }}</span>
                <h1 class="text-4xl md:text-5xl font-black text-white mb-6 leading-tight">{{ __('Résultats & Données du Recensement') }}</h1>
                <p class="text-xl text-white/80 max-w-2xl mx-auto leading-relaxed">{{ __('Explorez les bases de données démographiques, agricoles et cartographiques à destination des citoyens et chercheurs.') }}</p>
            </div>
        </section>

        <!-- Main section -->
        <main class="inner-page">
            <div class="container">
                <!-- Breadcrumb -->
                <nav class="breadcrumb" aria-label="Fil d'Ariane">
                    <Link :href="route('accueil')" class="bc-link">{{ __('Accueil') }}</Link>
                    <span class="bc-sep">/</span>
                    <span class="bc-current">{{ __('Données & Résultats') }}</span>
                </nav>

                <!-- Page title -->
                <h1 class="page-title">{{ __('Résultats & Données de Collecte') }}</h1>

                <!-- Tabs Container -->
                <div class="inner-layout">
                    <!-- Left main column -->
                    <div class="content-col">
                        
                        <!-- Horizontal Scrollable Tabs bar -->
                        <div class="flex overflow-x-auto md:flex-wrap gap-2 border-b border-gray-100 pb-4 mb-2 scrollbar-none -mx-4 px-4 md:mx-0 md:px-0">
                            <button @click="activeTab = 'map'"
                                    class="px-5 py-3 rounded-xl text-xs font-black uppercase tracking-wider transition-all duration-300 border flex-shrink-0 flex items-center gap-2"
                                    :class="activeTab === 'map' ? 'bg-[#204138] border-[#204138] text-white shadow-md' : 'bg-white border-gray-200 text-gray-500 hover:border-[#204138] hover:text-[#204138]'">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" /></svg>
                                {{ __('Cartographie Interactive') }}
                            </button>
                            <button @click="activeTab = 'tables'"
                                    class="px-5 py-3 rounded-xl text-xs font-black uppercase tracking-wider transition-all duration-300 border flex-shrink-0 flex items-center gap-2"
                                    :class="activeTab === 'tables' ? 'bg-[#204138] border-[#204138] text-white shadow-md' : 'bg-white border-gray-200 text-gray-500 hover:border-[#204138] hover:text-[#204138]'">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>
                                {{ __('Résultats & Tableaux') }}
                            </button>
                            <button @click="activeTab = 'publications'"
                                    class="px-5 py-3 rounded-xl text-xs font-black uppercase tracking-wider transition-all duration-300 border flex-shrink-0 flex items-center gap-2"
                                    :class="activeTab === 'publications' ? 'bg-[#204138] border-[#204138] text-white shadow-md' : 'bg-white border-gray-200 text-gray-500 hover:border-[#204138] hover:text-[#204138]'">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                                {{ __('Publications & Atlas') }}
                            </button>
                            <button @click="activeTab = 'microdata'"
                                    class="px-5 py-3 rounded-xl text-xs font-black uppercase tracking-wider transition-all duration-300 border flex-shrink-0 flex items-center gap-2"
                                    :class="activeTab === 'microdata' ? 'bg-[#204138] border-[#204138] text-white shadow-md' : 'bg-white border-gray-200 text-gray-500 hover:border-[#204138] hover:text-[#204138]'">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z" /></svg>
                                {{ __('Microdonnées & Base') }}
                            </button>
                        </div>

                        <!-- ===================== TAB 1: CARTOGRAPHIE INTERACTIVE ===================== -->
                        <div v-if="activeTab === 'map'" class="space-y-8 animate-fadeIn">
                            <div class="p-6 bg-white border border-gray-100 rounded-3xl shadow-sm">
                                <h3 class="text-xl font-black text-[#204138] mb-2">{{ __('Carte Interactive des 10 Régions') }}</h3>
                                <p class="text-sm text-gray-500 mb-6 leading-relaxed">
                                    {{ __('Survolez ou cliquez sur une région sur la carte ci-dessous pour afficher en temps réel les données de population (RGPH) et agropastorales (RGAE) associées.') }}
                                </p>

                                <div class="flex items-center gap-4 flex-wrap mb-6 border-b border-gray-50 pb-4">
                                    <span class="text-xs font-black text-gray-400 uppercase tracking-widest">{{ __('Niveau Géographique :') }}</span>
                                    <button @click="geoLevel = 'region'" 
                                            class="px-3 py-1.5 rounded-lg text-xs font-bold transition-all border"
                                            :class="geoLevel === 'region' ? 'bg-[#EDAF11] border-[#EDAF11] text-white' : 'bg-gray-50 border-gray-200 text-gray-500 hover:bg-gray-100'">
                                        {{ __('Régions (10)') }}
                                    </button>
                                    <button @click="geoLevel = 'departement'" 
                                            class="px-3 py-1.5 rounded-lg text-xs font-bold transition-all border opacity-60 cursor-not-allowed" disabled>
                                        {{ __('Départements (58) - Bientôt') }}
                                    </button>
                                    <button @click="geoLevel = 'commune'" 
                                            class="px-3 py-1.5 rounded-lg text-xs font-bold transition-all border opacity-60 cursor-not-allowed" disabled>
                                        {{ __('Communes (360) - Bientôt') }}
                                    </button>
                                </div>

                                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                                    
                                    <!-- Map SVG Container (Lefthand 7 cols on Desktop) -->
                                    <div class="lg:col-span-7 bg-[#204138]/5 border border-[#204138]/10 rounded-2xl p-4 flex items-center justify-center relative overflow-hidden">
                                        <svg viewBox="0 0 400 480" class="w-full max-w-[420px] h-auto drop-shadow-md select-none transition-all duration-300">
                                            
                                            <!-- Extrême-Nord -->
                                            <path d="M 220,10 L 250,50 L 230,100 L 190,70 L 195,30 Z" 
                                                  class="map-region-path"
                                                  :class="{ 'active': selectedRegionId === 'extreme_nord', 'hovered': hoverRegionId === 'extreme_nord' }"
                                                  @mouseover="hoverRegionId = 'extreme_nord'"
                                                  @mouseleave="hoverRegionId = null"
                                                  @click="selectedRegionId = 'extreme_nord'" />

                                            <!-- Nord -->
                                            <path d="M 190,70 L 230,100 L 250,150 L 170,140 L 160,110 Z" 
                                                  class="map-region-path"
                                                  :class="{ 'active': selectedRegionId === 'nord', 'hovered': hoverRegionId === 'nord' }"
                                                  @mouseover="hoverRegionId = 'nord'"
                                                  @mouseleave="hoverRegionId = null"
                                                  @click="selectedRegionId = 'nord'" />

                                            <!-- Adamaoua -->
                                            <path d="M 170,140 L 250,150 L 280,180 L 250,220 L 140,200 L 150,160 Z" 
                                                  class="map-region-path"
                                                  :class="{ 'active': selectedRegionId === 'adamaoua', 'hovered': hoverRegionId === 'adamaoua' }"
                                                  @mouseover="hoverRegionId = 'adamaoua'"
                                                  @mouseleave="hoverRegionId = null"
                                                  @click="selectedRegionId = 'adamaoua'" />

                                            <!-- Nord-Ouest -->
                                            <path d="M 140,200 L 160,200 L 150,230 L 120,230 L 110,210 Z" 
                                                  class="map-region-path"
                                                  :class="{ 'active': selectedRegionId === 'nord_ouest', 'hovered': hoverRegionId === 'nord_ouest' }"
                                                  @mouseover="hoverRegionId = 'nord_ouest'"
                                                  @mouseleave="hoverRegionId = null"
                                                  @click="selectedRegionId = 'nord_ouest'" />

                                            <!-- Ouest -->
                                            <path d="M 150,230 L 175,230 L 170,260 L 135,260 L 130,245 Z" 
                                                  class="map-region-path"
                                                  :class="{ 'active': selectedRegionId === 'ouest', 'hovered': hoverRegionId === 'ouest' }"
                                                  @mouseover="hoverRegionId = 'ouest'"
                                                  @mouseleave="hoverRegionId = null"
                                                  @click="selectedRegionId = 'ouest'" />

                                            <!-- Sud-Ouest -->
                                            <path d="M 110,210 L 130,245 L 120,280 L 90,260 L 95,225 Z" 
                                                  class="map-region-path"
                                                  :class="{ 'active': selectedRegionId === 'sud_ouest', 'hovered': hoverRegionId === 'sud_ouest' }"
                                                  @mouseover="hoverRegionId = 'sud_ouest'"
                                                  @mouseleave="hoverRegionId = null"
                                                  @click="selectedRegionId = 'sud_ouest'" />

                                            <!-- Littoral -->
                                            <path d="M 120,280 L 170,260 L 165,300 L 125,320 Z" 
                                                  class="map-region-path"
                                                  :class="{ 'active': selectedRegionId === 'littoral', 'hovered': hoverRegionId === 'littoral' }"
                                                  @mouseover="hoverRegionId = 'littoral'"
                                                  @mouseleave="hoverRegionId = null"
                                                  @click="selectedRegionId = 'littoral'" />

                                            <!-- Centre -->
                                            <path d="M 170,260 L 220,240 L 250,285 L 220,335 L 165,300 Z" 
                                                  class="map-region-path"
                                                  :class="{ 'active': selectedRegionId === 'centre', 'hovered': hoverRegionId === 'centre' }"
                                                  @mouseover="hoverRegionId = 'centre'"
                                                  @mouseleave="hoverRegionId = null"
                                                  @click="selectedRegionId = 'centre'" />

                                            <!-- Est -->
                                            <path d="M 250,220 L 320,240 L 330,340 L 260,350 L 250,285 Z" 
                                                  class="map-region-path"
                                                  :class="{ 'active': selectedRegionId === 'est', 'hovered': hoverRegionId === 'est' }"
                                                  @mouseover="hoverRegionId = 'est'"
                                                  @mouseleave="hoverRegionId = null"
                                                  @click="selectedRegionId = 'est'" />

                                            <!-- Sud -->
                                            <path d="M 165,300 L 220,335 L 260,350 L 250,420 L 160,400 Z" 
                                                  class="map-region-path"
                                                  :class="{ 'active': selectedRegionId === 'sud', 'hovered': hoverRegionId === 'sud' }"
                                                  @mouseover="hoverRegionId = 'sud'"
                                                  @mouseleave="hoverRegionId = null"
                                                  @click="selectedRegionId = 'sud'" />

                                            <!-- Text labels on map -->
                                            <text x="215" y="55" class="map-label pointer-events-none">EXT-N</text>
                                            <text x="200" y="115" class="map-label pointer-events-none">NORD</text>
                                            <text x="200" y="180" class="map-label pointer-events-none">ADAM</text>
                                            <text x="135" y="215" class="map-label pointer-events-none">N-O</text>
                                            <text x="150" y="248" class="map-label pointer-events-none">OU</text>
                                            <text x="110" y="248" class="map-label pointer-events-none">S-O</text>
                                            <text x="145" y="293" class="map-label pointer-events-none">LIT</text>
                                            <text x="205" y="295" class="map-label pointer-events-none">CEN</text>
                                            <text x="285" y="290" class="map-label pointer-events-none">EST</text>
                                            <text x="205" y="375" class="map-label pointer-events-none">SUD</text>

                                        </svg>
                                    </div>

                                    <!-- Selected Region Panel Info (Righthand 5 cols on Desktop) -->
                                    <div class="lg:col-span-5 space-y-4">
                                        <div class="p-6 rounded-2xl bg-gradient-to-br from-[#204138]/5 to-white border border-gray-100 shadow-sm relative overflow-hidden">
                                            <div class="absolute top-0 right-0 w-24 h-24 bg-[#EDAF11]/5 rounded-full blur-xl"></div>
                                            
                                            <div class="flex items-center justify-between gap-3 mb-4">
                                                <div>
                                                    <span class="text-[9px] font-black uppercase tracking-widest text-[#EDAF11] bg-[#EDAF11]/10 px-2 py-0.5 rounded">{{ __('Données Régionales') }}</span>
                                                    <h4 class="text-2xl font-black text-[#204138] mt-1">{{ selectedRegion.name[currentLocale] }}</h4>
                                                </div>
                                                <div class="w-10 h-10 rounded-full bg-[#204138]/10 text-[#204138] flex items-center justify-center font-bold text-sm shrink-0 border border-[#204138]/20">
                                                    {{ selectedRegionId.slice(0, 2).toUpperCase() }}
                                                </div>
                                            </div>

                                            <div class="divide-y divide-gray-50 text-xs font-semibold">
                                                <div class="py-2.5 flex items-center justify-between">
                                                    <span class="text-gray-400">{{ __('Chef-lieu / Capitale') }}</span>
                                                    <span class="text-[#204138] text-right font-black">{{ selectedRegion.capital[currentLocale] }}</span>
                                                </div>
                                                <div class="py-2.5 flex items-center justify-between">
                                                    <span class="text-gray-400">{{ __('Population (RGPH)') }}</span>
                                                    <span class="text-[#204138] text-right font-black">{{ selectedRegion.population }} {{ __('hab.') }}</span>
                                                </div>
                                                <div class="py-2.5 flex items-center justify-between">
                                                    <span class="text-gray-400">{{ __('Nombre de Ménages') }}</span>
                                                    <span class="text-[#204138] text-right font-black">{{ selectedRegion.menages }}</span>
                                                </div>
                                                <div class="py-2.5 flex items-center justify-between">
                                                    <span class="text-gray-400">{{ __('Logements recensés') }}</span>
                                                    <span class="text-[#204138] text-right font-black">{{ selectedRegion.logements }}</span>
                                                </div>
                                                <div class="py-2.5 flex items-center justify-between">
                                                    <span class="text-gray-400">{{ __('Superficie totale') }}</span>
                                                    <span class="text-[#204138] text-right font-black">{{ selectedRegion.superficie }}</span>
                                                </div>
                                                <div class="py-2.5 flex flex-col gap-1 items-start justify-center">
                                                    <span class="text-gray-400">{{ __('Nombre d\'exploitations RGAE') }}</span>
                                                    <span class="text-[#204138] font-black text-sm">{{ selectedRegion.exploitations }}</span>
                                                </div>
                                                <div class="py-2.5 flex flex-col gap-1 items-start justify-center">
                                                    <span class="text-gray-400">{{ __('Principales Cultures') }}</span>
                                                    <span class="text-[#204138] font-bold">{{ selectedRegion.culture[currentLocale] }}</span>
                                                </div>
                                                <div class="py-2.5 flex flex-col gap-1 items-start justify-center">
                                                    <span class="text-gray-400">{{ __('Cheptel & Elevage estimé') }}</span>
                                                    <span class="text-gray-500 font-medium text-xs leading-normal">{{ selectedRegion.cheptel }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Quick Selection list -->
                                        <div class="p-4 rounded-xl border border-gray-100 bg-white">
                                            <label class="block text-xs font-black uppercase text-gray-400 mb-2">{{ __('Sélection rapide par liste :') }}</label>
                                            <select v-model="selectedRegionId" class="w-full p-2.5 rounded-lg border border-gray-200 text-xs font-bold text-[#204138] focus:border-[#204138] focus:ring-1 focus:ring-[#204138] outline-none">
                                                <option v-for="r in Object.values(regionalData)" :key="r.id" :value="r.id">
                                                    {{ r.name[currentLocale] }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ===================== TAB 2: RESULTATS & TABLEAUX ===================== -->
                        <div v-if="activeTab === 'tables'" class="space-y-8 animate-fadeIn">
                            <!-- Global National Key Figures Summary -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="p-6 bg-white border border-gray-100 rounded-3xl shadow-sm flex items-start gap-4">
                                    <div class="w-12 h-12 rounded-xl bg-green-50 text-[#204138] flex items-center justify-center shrink-0">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                                    </div>
                                    <div>
                                        <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">{{ __('Population Globale') }}</span>
                                        <h4 class="text-xl font-black text-[#204138] mt-1">27 635 804</h4>
                                        <p class="text-[10px] text-green-600 font-bold mt-1">✓ {{ __('Estimation Finale 2026') }}</p>
                                    </div>
                                </div>
                                <div class="p-6 bg-white border border-gray-100 rounded-3xl shadow-sm flex items-start gap-4">
                                    <div class="w-12 h-12 rounded-xl bg-amber-50 text-[#a07402] flex items-center justify-center shrink-0">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                                    </div>
                                    <div>
                                        <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">{{ __('Total Ménages') }}</span>
                                        <h4 class="text-xl font-black text-[#a07402] mt-1">5 683 915</h4>
                                        <p class="text-[10px] text-[#a07402] font-semibold mt-1">~ 4.86 {{ __('personnes / ménage') }}</p>
                                    </div>
                                </div>
                                <div class="p-6 bg-white border border-gray-100 rounded-3xl shadow-sm flex items-start gap-4">
                                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                                    </div>
                                    <div>
                                        <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">{{ __('Exploitations RGAE') }}</span>
                                        <h4 class="text-xl font-black text-blue-600 mt-1">2 245 400</h4>
                                        <p class="text-[10px] text-blue-600 font-semibold mt-1">~ 82.3% {{ __('milieu rural') }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Interactive Regional Table -->
                            <div class="p-6 bg-white border border-gray-100 rounded-3xl shadow-sm">
                                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
                                    <div>
                                        <h3 class="text-lg font-black text-[#204138]">{{ __('Tableau Statistique Régional Harmonisé') }}</h3>
                                        <p class="text-xs text-gray-400 mt-1">{{ __('Filtrez et triez la base démographique et agricole harmonisée des 10 régions.') }}</p>
                                    </div>
                                    
                                    <div class="flex flex-wrap gap-2 items-center">
                                        <!-- Search input -->
                                        <div class="relative shrink-0">
                                            <input type="text" v-model="searchQuery" :placeholder="__('Rechercher région...')" class="p-2 pl-8 border border-gray-200 rounded-xl text-xs outline-none focus:border-[#204138] focus:ring-1 focus:ring-[#204138] w-44 font-semibold">
                                            <svg class="w-3.5 h-3.5 text-gray-400 absolute left-2.5 top-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                                        </div>

                                        <!-- Dropdown criteria -->
                                        <select v-model="filterMetric" class="p-2 border border-gray-200 rounded-xl text-xs outline-none text-gray-500 font-bold focus:border-[#204138] focus:ring-1 focus:ring-[#204138]">
                                            <option value="all">{{ __('Tous critères') }}</option>
                                            <option value="pop_gt_2m">{{ __('Population > 2M') }}</option>
                                            <option value="sup_gt_50k">{{ __('Superficie > 50k km²') }}</option>
                                            <option value="exp_gt_200k">{{ __('Exploitations > 200k') }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="overflow-x-auto border border-gray-50 rounded-2xl">
                                    <table class="w-full text-left text-xs font-semibold border-collapse">
                                        <thead>
                                            <tr class="bg-gray-50/50 border-b border-gray-100 text-gray-400 uppercase tracking-widest text-[9px]">
                                                <th class="p-4">{{ __('Région') }}</th>
                                                <th class="p-4">{{ __('Chef-lieu') }}</th>
                                                <th class="p-4 text-right">{{ __('Population') }}</th>
                                                <th class="p-4 text-right">{{ __('Ménages') }}</th>
                                                <th class="p-4 text-right">{{ __('Superficie') }}</th>
                                                <th class="p-4 text-right">{{ __('Exploitations') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-100 text-[#204138]">
                                            <tr v-for="row in tableRows" :key="row.id" class="hover:bg-[#204138]/5 transition-colors">
                                                <td class="p-4 font-black">{{ row.name[currentLocale] }}</td>
                                                <td class="p-4 text-gray-500">{{ row.capital[currentLocale] }}</td>
                                                <td class="p-4 text-right font-bold">{{ row.population }}</td>
                                                <td class="p-4 text-right text-gray-600">{{ row.menages }}</td>
                                                <td class="p-4 text-right text-gray-600">{{ row.superficie }}</td>
                                                <td class="p-4 text-right text-[#a07402] font-bold">{{ row.exploitations }}</td>
                                            </tr>
                                            <tr v-if="tableRows.length === 0">
                                                <td colspan="6" class="p-8 text-center text-gray-400 font-medium bg-gray-50/30">
                                                    {{ __('Aucune région ne correspond à vos filtres.') }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Downloads block -->
                            <div class="p-6 bg-gradient-to-br from-[#204138] to-[#122822] rounded-3xl text-white relative overflow-hidden">
                                <div class="absolute right-0 bottom-0 opacity-10 transform translate-x-12 translate-y-12">
                                    <svg class="w-72 h-72" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 17h-2v-6h2v6zm0-8h-2V9h2v2z" /></svg>
                                </div>

                                <div class="relative z-10 space-y-4 max-w-lg">
                                    <h4 class="text-lg font-black">{{ __('Téléchargements Statistiques Annuels') }}</h4>
                                    <p class="text-xs text-white/80 leading-relaxed">
                                        {{ __('Exportez les tableaux statistiques complets nationaux et régionaux validés par les comités de supervision pour vos rapports économiques.') }}
                                    </p>
                                    <div class="flex flex-wrap gap-2 pt-2">
                                        <button @click="downloadStats('xlsx', 'Données Générales')" class="px-4 py-2 bg-[#EDAF11] text-[#204138] rounded-xl text-xs font-black hover:bg-white hover:text-[#204138] transition-all flex items-center gap-2 border-none">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                            Excel (XLSX)
                                        </button>
                                        <button @click="downloadStats('csv', 'Données Générales')" class="px-4 py-2 bg-white/10 hover:bg-white/20 border border-white/20 rounded-xl text-xs font-bold transition-all flex items-center gap-2">
                                            CSV (Text)
                                        </button>
                                        <button @click="downloadStats('pdf', 'Données Générales')" class="px-4 py-2 bg-white/10 hover:bg-white/20 border border-white/20 rounded-xl text-xs font-bold transition-all flex items-center gap-2">
                                            Rapport PDF
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ===================== TAB 3: PUBLICATIONS & ATLAS ===================== -->
                        <div v-if="activeTab === 'publications'" class="space-y-6 animate-fadeIn">
                            <!-- Filters & Search block -->
                            <div class="p-6 bg-white border border-gray-100 rounded-3xl shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
                                <div class="flex flex-wrap gap-1.5">
                                    <button @click="activePubCategory = 'all'" 
                                            class="px-4 py-2 rounded-xl text-xs font-bold transition-all border"
                                            :class="activePubCategory === 'all' ? 'bg-[#204138] border-[#204138] text-white shadow-sm' : 'bg-gray-50 border-gray-100 text-gray-500 hover:bg-gray-100'">
                                        {{ __('Tous') }}
                                    </button>
                                    <button @click="activePubCategory = 'atlas'" 
                                            class="px-4 py-2 rounded-xl text-xs font-bold transition-all border"
                                            :class="activePubCategory === 'atlas' ? 'bg-[#204138] border-[#204138] text-white shadow-sm' : 'bg-gray-50 border-gray-100 text-gray-500 hover:bg-gray-100'">
                                        {{ __('Atlas') }}
                                    </button>
                                    <button @click="activePubCategory = 'rapports'" 
                                            class="px-4 py-2 rounded-xl text-xs font-bold transition-all border"
                                            :class="activePubCategory === 'rapports' ? 'bg-[#204138] border-[#204138] text-white shadow-sm' : 'bg-gray-50 border-gray-100 text-gray-500 hover:bg-gray-100'">
                                        {{ __('Rapports') }}
                                    </button>
                                    <button @click="activePubCategory = 'monographies'" 
                                            class="px-4 py-2 rounded-xl text-xs font-bold transition-all border"
                                            :class="activePubCategory === 'monographies' ? 'bg-[#204138] border-[#204138] text-white shadow-sm' : 'bg-gray-50 border-gray-100 text-gray-500 hover:bg-gray-100'">
                                        {{ __('Monographies') }}
                                    </button>
                                </div>

                                <div class="relative w-full md:w-60">
                                    <input type="text" v-model="publicationSearch" :placeholder="__('Filtrer les rapports...')" class="w-full p-2.5 pl-9 border border-gray-200 rounded-xl text-xs font-semibold outline-none focus:border-[#204138]">
                                    <svg class="w-4 h-4 text-gray-400 absolute left-3 top-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                                </div>
                            </div>

                            <!-- Publications Grid -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div v-for="(pub, idx) in filteredPublications" :key="idx" 
                                     class="p-6 bg-white border border-gray-100 hover:border-[#204138]/20 rounded-3xl shadow-sm hover:shadow-md transition-all duration-300 flex flex-col justify-between group">
                                    <div class="space-y-3">
                                        <div class="flex items-center justify-between">
                                            <span class="text-[9px] font-black uppercase tracking-widest text-[#a07402] bg-[#EDAF11]/10 px-2.5 py-1 rounded">
                                                {{ pub.category }}
                                            </span>
                                            <span class="text-[10px] text-gray-400 font-bold">{{ pub.date }}</span>
                                        </div>
                                        <h4 class="font-black text-[#204138] text-sm md:text-base leading-snug group-hover:text-[#EDAF11] transition-colors">
                                            {{ pub.title[currentLocale] }}
                                        </h4>
                                        <p class="text-xs text-gray-500 leading-relaxed font-medium">
                                            {{ pub.desc[currentLocale] }}
                                        </p>
                                    </div>
                                    <div class="flex items-center justify-between pt-4 mt-4 border-t border-gray-50 text-xs font-black">
                                        <span class="text-gray-400">{{ pub.type }} ({{ pub.size }})</span>
                                        <button @click="downloadStats('pdf', pub.title.fr)" class="text-[#204138] hover:text-[#EDAF11] transition-colors flex items-center gap-1 bg-transparent border-none outline-none font-bold">
                                            {{ __('Télécharger') }}
                                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                                        </button>
                                    </div>
                                </div>

                                <div v-if="filteredPublications.length === 0" class="md:col-span-2 p-12 text-center text-gray-400 bg-white border border-gray-100 rounded-3xl shadow-sm">
                                    <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    <p class="font-bold">{{ __('Aucune publication trouvée.') }}</p>
                                    <p class="text-xs text-gray-400 mt-1">{{ __('Modifiez vos critères de recherche ou de catégorie.') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- ===================== TAB 4: MICRODONNEES & FORMULAIRE ===================== -->
                        <div v-if="activeTab === 'microdata'" class="space-y-8 animate-fadeIn">
                            <!-- Terms and info -->
                            <div class="p-6 bg-white border border-gray-100 rounded-3xl shadow-sm space-y-4">
                                <h3 class="text-lg font-black text-[#204138]">{{ __('Charte d\'Accès aux Microdonnées Anonymisées') }}</h3>
                                <p class="text-sm text-gray-500 leading-relaxed">
                                    {{ __('Le BUCREP et le MINEPAT partagent les fichiers de microdonnées individuelles anonymisées (sans nom, sans adresse exacte) à des fins de recherche universitaire, scientifique, de planification et d\'élaboration de projets à impact sociétal.') }}
                                </p>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs font-semibold pt-2">
                                    <div class="p-4 bg-green-50/50 rounded-2xl border-l-4 border-[#204138]">
                                        <h5 class="font-black text-[#204138] mb-1">🔐 {{ __('Confidentialité Totale') }}</h5>
                                        <p class="text-gray-500 leading-relaxed">{{ __('Conformément à la loi statistique de 1991, il est strictement interdit de tenter de reconstituer l\'identité d\'individus ou de ménages.') }}</p>
                                    </div>
                                    <div class="p-4 bg-amber-50/50 rounded-2xl border-l-4 border-[#EDAF11]">
                                        <h5 class="font-black text-[#a07402] mb-1">📊 {{ __('Usage Académique & Public') }}</h5>
                                        <p class="text-gray-500 leading-relaxed">{{ __('Les microdonnées ne doivent pas faire l\'objet d\'une commercialisation ni être partagées hors du cadre validé par le BUCREP.') }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Microdata request form block -->
                            <div class="p-8 bg-white border border-gray-100 rounded-3xl shadow-sm">
                                <h3 class="text-xl font-black text-[#204138] mb-6 border-b border-gray-50 pb-4 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-[#EDAF11]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                    {{ __('Demande d\'Accès Scientifique aux Bases de Données') }}
                                </h3>

                                <!-- Success state -->
                                <div v-if="isFormSubmitted" class="p-6 bg-green-50 border border-green-200 rounded-2xl text-center space-y-4 animate-fadeIn">
                                    <div class="w-16 h-16 bg-[#204138] text-white rounded-full flex items-center justify-center mx-auto shadow-md">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7" /></svg>
                                    </div>
                                    <h4 class="text-lg font-black text-[#204138]">{{ __('Demande Enregistrée avec Succès !') }}</h4>
                                    <p class="text-xs text-gray-500 max-w-md mx-auto leading-relaxed">
                                        {{ __('Votre demande a été transmise aux administrateurs techniques du BUCREP. Après vérification de votre affiliation académique ou professionnelle, vos codes d\'accès uniques vous seront envoyés à l\'adresse :') }}
                                        <strong class="text-[#204138] block mt-1">{{ microdataForm.email }}</strong>
                                    </p>
                                    <button @click="resetForm" class="mt-4 px-5 py-2.5 bg-[#204138] text-white font-bold rounded-xl text-xs hover:bg-[#EDAF11] transition-colors border-none cursor-pointer">
                                        {{ __('Faire une nouvelle demande') }}
                                    </button>
                                </div>

                                <!-- Form inputs -->
                                <form v-else @submit.prevent="submitMicrodataRequest" class="space-y-5 text-xs font-semibold">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div class="space-y-1">
                                            <label class="block text-gray-500 font-bold">{{ __('Nom complet') }} *</label>
                                            <input type="text" v-model="microdataForm.name" class="w-full p-3 border border-gray-200 focus:border-[#204138] rounded-xl outline-none" :class="{ 'border-red-400': formErrors.name }">
                                            <span v-if="formErrors.name" class="text-red-500 text-[10px]">{{ formErrors.name }}</span>
                                        </div>

                                        <div class="space-y-1">
                                            <label class="block text-gray-500 font-bold">{{ __('Adresse e-mail (Professionnelle / Académique)') }} *</label>
                                            <input type="email" v-model="microdataForm.email" class="w-full p-3 border border-gray-200 focus:border-[#204138] rounded-xl outline-none" :class="{ 'border-red-400': formErrors.email }">
                                            <span v-if="formErrors.email" class="text-red-500 text-[10px]">{{ formErrors.email }}</span>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div class="space-y-1">
                                            <label class="block text-gray-500 font-bold">{{ __('Organisation / Institution d\'affiliation') }} *</label>
                                            <input type="text" v-model="microdataForm.organization" class="w-full p-3 border border-gray-200 focus:border-[#204138] rounded-xl outline-none" :class="{ 'border-red-400': formErrors.organization }">
                                            <span v-if="formErrors.organization" class="text-red-500 text-[10px]">{{ formErrors.organization }}</span>
                                        </div>

                                        <div class="space-y-1">
                                            <label class="block text-gray-500 font-bold">{{ __('Base de données sollicitée') }}</label>
                                            <select v-model="microdataForm.dataset" class="w-full p-3 border border-gray-200 focus:border-[#204138] rounded-xl outline-none text-[#204138] font-bold">
                                                <option value="rgph_2026_anonyme">{{ __('Base Démographique RGPH-4 Anonymisée') }}</option>
                                                <option value="rgae_2026_anonyme">{{ __('Base Agricole RGAE Anonymisée') }}</option>
                                                <option value="combined_2026_sample">{{ __('Échantillon Couplé Démographie-Agropastoral (10%)') }}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="space-y-1">
                                        <label class="block text-gray-500 font-bold">{{ __('Objectif et méthodologie abrégée du projet de recherche') }} *</label>
                                        <textarea v-model="microdataForm.purpose" rows="4" class="w-full p-3 border border-gray-200 focus:border-[#204138] rounded-xl outline-none resize-y" :placeholder="__('Décrivez précisément l\'utilisation que vous ferez de ces données dans vos travaux (min. 15 caractères)...')" :class="{ 'border-red-400': formErrors.purpose }"></textarea>
                                        <span v-if="formErrors.purpose" class="text-red-500 text-[10px]">{{ formErrors.purpose }}</span>
                                    </div>

                                    <div class="space-y-1 pt-2">
                                        <label class="flex items-start gap-2 text-[11px] text-gray-500 font-bold cursor-pointer select-none">
                                            <input type="checkbox" v-model="microdataForm.terms" class="mt-0.5 shrink-0 rounded border-gray-300 text-[#204138] focus:ring-[#204138]">
                                            <span>
                                                {{ __('J\'atteste par la présente avoir pris connaissance des règles de confidentialité de la Loi statistique N°91/023, et m\'engage à ne pas divulguer ni exploiter commercialement les microdonnées individuelles fournies.') }} *
                                            </span>
                                        </label>
                                        <span v-if="formErrors.terms" class="text-red-500 text-[10px] block mt-1">{{ formErrors.terms }}</span>
                                    </div>

                                    <div class="pt-4 border-t border-gray-50 flex justify-end">
                                        <button type="submit" class="px-6 py-3 bg-[#204138] text-white font-black rounded-xl hover:bg-[#EDAF11] transition-all cursor-pointer border-none shadow-md">
                                            {{ __('Soumettre la demande d\'accès') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>

                    <!-- Right sidebar (Documentations / National Map) -->
                    <aside class="sidebar-col">
                        <div class="sidebar-card">
                            <h3 class="sidebar-title">{{ __('Documentation Données') }}</h3>
                            <p class="sidebar-subtitle">{{ __('Guides méthodologiques et questionnaires types en téléchargement public.') }}</p>
                            <ul class="doc-list">
                                <li>
                                    <a href="#" @click.prevent="downloadStats('pdf', 'Manuel Démographique')" class="doc-item">
                                        <span>{{ __('Manuel de l\'Agent Recenseur RGPH') }}</span>
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21.44 11.05l-9.19 9.19a6 6 0 01-8.49-8.49l9.19-9.19a4 4 0 015.66 5.66l-9.2 9.19a2 2 0 01-2.83-2.83l8.49-8.48"></path></svg>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" @click.prevent="downloadStats('pdf', 'Manuel RGAE')" class="doc-item">
                                        <span>{{ __('Nomenclatures & Méthodes RGAE') }}</span>
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21.44 11.05l-9.19 9.19a6 6 0 01-8.49-8.49l9.19-9.19a4 4 0 015.66 5.66l-9.2 9.19a2 2 0 01-2.83-2.83l8.49-8.48"></path></svg>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" @click.prevent="downloadStats('pdf', 'Questionnaire Démographique')" class="doc-item">
                                        <span>{{ __('Questionnaire Ménage RGPH (Spécimen)') }}</span>
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21.44 11.05l-9.19 9.19a6 6 0 01-8.49-8.49l9.19-9.19a4 4 0 015.66 5.66l-9.2 9.19a2 2 0 01-2.83-2.83l8.49-8.48"></path></svg>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" @click.prevent="downloadStats('pdf', 'Questionnaire Exploitation')" class="doc-item">
                                        <span>{{ __('Questionnaire Exploitation Agricole (RGAE)') }}</span>
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
                                <h4 class="sidebar-map-title">{{ __('10 Régions Unies') }}</h4>
                                <p class="sidebar-map-desc">{{ __('Le recensement harmonise les bases statistiques agropastorales et démographiques sur l\'ensemble du territoire.') }}</p>
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

/* --- Stylisation interactive de la carte SVG --- */
.map-region-path {
    fill: rgba(32, 65, 56, 0.15);
    stroke: #204138;
    stroke-width: 2;
    stroke-linejoin: round;
    cursor: pointer;
    transition: all 0.3s ease;
}

.map-region-path:hover,
.map-region-path.hovered {
    fill: rgba(237, 175, 17, 0.35);
    stroke: #EDAF11;
    filter: drop-shadow(0px 4px 6px rgba(237, 175, 17, 0.3));
}

.map-region-path.active {
    fill: #204138;
    stroke: #EDAF11;
    stroke-width: 3;
    filter: drop-shadow(0px 4px 10px rgba(32, 65, 56, 0.4));
}

/* Libellés de la carte */
.map-label {
    fill: #162c26;
    font-size: 10px;
    font-weight: 900;
    letter-spacing: 0.02em;
    text-anchor: middle;
    font-family: 'Inter', sans-serif;
    opacity: 0.85;
}

.map-region-path.active + .map-label {
    fill: #ffffff;
    opacity: 1;
}

/* Animations transitions d'onglets */
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
</style>
