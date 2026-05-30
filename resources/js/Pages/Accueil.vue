<script setup>
import { ref, onMounted, onUnmounted, computed } from 'vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import { Link, Head, usePage } from '@inertiajs/vue3';
import PartenaireCarousel from '@/Components/PartenaireCarousel.vue';
import FaqSection from '@/Components/FaqSection.vue';
import CarteInteractive from '@/Components/CarteInteractive.vue';
import CallCenterBanner from '@/Components/CallCenterBanner.vue';

const props = defineProps({
    partners: Array,
    latestArticles: Array,
    stats: Object,
    socialPosts: Array
});

const page = usePage();
const __ = (key) => {
    return page.props.translations?.[key] || key;
};

const simulatedTweets = computed(() => {
    const xPosts = props.socialPosts ? props.socialPosts.filter(p => p.platform === 'x') : [];
    if (xPosts.length > 0) {
        return xPosts.map(p => ({
            user: p.user || 'Recensement Cameroun',
            handle: p.handle || '@recensement90',
            date: p.date || 'En ce moment',
            content: p.content,
            likes: p.likes || '0',
            comments: p.comments || '0',
            shares: p.shares || '0',
            link: p.link || 'https://x.com/recensement90',
            image: p.image ? (p.image.startsWith('/') ? p.image : '/storage/' + p.image) : null
        }));
    }
    return [
        {
            user: 'Recensement Cameroun',
            handle: '@recensement90',
            date: '18 Mai',
            content: 'Le numéro vert officiel 8585 est désormais actif pour répondre à toutes vos interrogations sur la collecte des données. Appelez-nous gratuitement ! 📞 #Cameroun #Statistiques #RGPH4',
            likes: '450',
            comments: '12',
            shares: '56',
            link: 'https://x.com/recensement90',
            image: null
        },
        {
            user: 'Recensement Cameroun',
            handle: '@recensement90',
            date: '15 Mai',
            content: 'La cartographie numérique est une étape fondamentale. Elle permet de découper le territoire national en zones de dénombrement. Nos agents arpentent les villes et villages avec dévouement ! 🗺️🇨🇲 #RGPH4',
            likes: '320',
            comments: '8',
            shares: '42',
            link: 'https://x.com/recensement90',
            image: null
        },
        {
            user: 'Recensement Cameroun',
            handle: '@recensement90',
            date: '12 Mai',
            content: 'Toutes les données recueillies lors du dénombrement sont strictement confidentielles conformément à la loi sur le secret statistique. Participer au recensement, c\'est planifier l\'avenir ! 🛡️📊 #BUCREP',
            likes: '512',
            comments: '19',
            shares: '88',
            link: 'https://x.com/recensement90',
            image: null
        }
    ];
});

// Slider state
const activeSlide = ref(0);
const slides = [
    { 
        image: '/assets/images/backgrounds/cameroon_people_map.png', 
        title: 'Le 4ème RGPH : Notre affaire à tous', 
        text: 'Une cartographie et un dénombrement modernes',
        cta: 'En savoir plus',
        link: '/apropos'
    },
    { 
        image: '/assets/images/backgrounds/cameroon_people_map.png', 
        title: 'Le 4ème RGPH et RGAE : Notre affaire à tous', 
        text: 'Une cartographie et un dénombrement modernes',
        cta: 'En savoir plus',
        link: '/apropos'
    },
    { 
        image: '/assets/images/slides/phase_prepa.jpg', 
        title: 'Bâtissons l\'avenir de notre nation', 
        text: 'Le 4ème Recensement Général de la Population et de l\'Habitat est une étape cruciale pour le développement du Cameroun.',
        cta: 'S\'impliquer',
        link: '/apropos'
    },
    { 
        image: '/assets/images/slides/phase_epc.jpg', 
        title: 'Chaque citoyen compte', 
        text: 'Votre participation permet une meilleure planification des infrastructures de santé, d\'éducation et de transport.',
        cta: 'En savoir plus',
        link: '/actualites'
    },
    { 
        image: '/assets/images/slides/phase_analyse.jpg', 
        title: 'Une technologie de pointe', 
        text: 'Nous utilisons des outils numériques de dernière génération pour garantir la fiabilité et la sécurité de vos données.',
        cta: 'Découvrir',
        link: '/activites'
    }
];

// Stats animées
const stats = ref([
    { label: 'Population Estimée', value: 0, target: 28644120, suffix: '' },
    { label: 'Ménages Recensés', value: 0, target: 5420115, suffix: '' },
    { label: 'Agents Mobiles', value: 0, target: 35000, suffix: '+' },
]);

const animateStats = () => {
    stats.value.forEach(stat => {
        let start = 0;
        const duration = 2000;
        const increment = stat.target / (duration / 16);
        const timer = setInterval(() => {
            start += increment;
            if (start >= stat.target) {
                stat.value = stat.target;
                clearInterval(timer);
            } else {
                stat.value = Math.floor(start);
            }
        }, 16);
    });
};

const nextSlide = () => {
    activeSlide.value = (activeSlide.value + 1) % slides.length;
};

const prevSlide = () => {
    activeSlide.value = (activeSlide.value - 1 + slides.length) % slides.length;
};

// Preuve sociale (Social Proof)
const showSocialProof = ref(false);
const currentProofIndex = ref(0);
const socialProofs = ref([
    { icon: 'users', text: 'personnes consultent ce portail en ce moment', value: 'online' },
    { icon: 'eye', text: 'agents se sont déjà inscrits sur le portail', value: 'total' },
    { icon: 'check', text: 'nouvelles candidatures reçues aujourd\'hui', value: 'today' }
]);

const cycleSocialProof = () => {
    setInterval(() => {
        showSocialProof.value = false;
        setTimeout(() => {
            currentProofIndex.value = (currentProofIndex.value + 1) % socialProofs.value.length;
            showSocialProof.value = true;
        }, 1000);
    }, 12000);
};

onMounted(() => {
    setInterval(nextSlide, 7000);
    setTimeout(animateStats, 500);
    setTimeout(animateVisitors, 1000);
    setTimeout(() => {
        showSocialProof.value = true;
        cycleSocialProof();
    }, 5000);

    // Load Twitter Widgets JS for live feed
    const script = document.createElement('script');
    script.setAttribute('src', 'https://platform.twitter.com/widgets.js');
    script.setAttribute('async', 'true');
    script.setAttribute('charset', 'utf-8');
    document.head.appendChild(script);
});

// Visiteurs dynamiques (Now based on Real stats)
const visitorStats = ref({
    total: 0,
    today: 0,
    online: 0
});

const animateVisitors = () => {
    // Total (Real Candidatures)
    let startTotal = 0;
    const targetTotal = props.stats?.total_candidatures || 0;
    const intervalTotal = setInterval(() => {
        if (targetTotal === 0) {
            visitorStats.value.total = 0;
            return clearInterval(intervalTotal);
        }
        startTotal += Math.max(1, Math.floor(targetTotal / 50));
        if (startTotal >= targetTotal) {
            visitorStats.value.total = targetTotal;
            clearInterval(intervalTotal);
        } else {
            visitorStats.value.total = startTotal;
        }
    }, 20);

    // Aujourd'hui (Real today)
    let startToday = 0;
    const targetToday = props.stats?.today_candidatures || 0;
    const intervalToday = setInterval(() => {
        if (targetToday === 0) {
            visitorStats.value.today = 0;
            return clearInterval(intervalToday);
        }
        startToday += 1;
        if (startToday >= targetToday) {
            visitorStats.value.today = targetToday;
            clearInterval(intervalToday);
        } else {
            visitorStats.value.today = startToday;
        }
    }, 50);

    // En ligne (Real Sessions)
    let startOnline = 0;
    const targetOnline = props.stats?.online_users || 1;
    const intervalOnline = setInterval(() => {
        if (targetOnline <= 1) {
            visitorStats.value.online = 1;
            return clearInterval(intervalOnline);
        }
        startOnline += 1;
        if (startOnline >= targetOnline) {
            visitorStats.value.online = targetOnline;
            clearInterval(intervalOnline);
        } else {
            visitorStats.value.online = startOnline;
        }
    }, 30);
};

// Social Posts Data (Dynamic with static fallbacks)
const defaultSocialPosts = [
    {
        platform: 'fb',
        platformName: 'Facebook',
        user: 'BUCREP Officiel',
        handle: '@bucrep.cameroun',
        date: '18 Mai',
        content: "Démarrage des opérations de cartographie numérique dans la région du Centre. Nos équipes sont sur le terrain pour bâtir le Cameroun de demain ! #Census2026 #BUCREP",
        image: '/assets/images/slides/phase_prepa.jpg',
        likes: '1.2k',
        comments: '85',
        shares: '120',
        link: 'https://www.facebook.com/profile.php?id=61562950229317'
    },
    {
        platform: 'x',
        platformName: 'X',
        user: 'Recensement Cameroun',
        handle: '@recensement90',
        date: '17 Mai',
        content: "Le numéro vert officiel 8585 est désormais actif pour répondre à toutes vos interrogations sur la collecte des données. Appelez-nous gratuitement ! 📞 #Cameroun #Statistiques",
        image: null,
        likes: '450',
        comments: '12',
        shares: '56',
        link: 'https://x.com/recensement90'
    },
    {
        platform: 'ig',
        platformName: 'Instagram',
        user: 'BUCREP Official',
        handle: '@bucrep_cm',
        date: '16 Mai',
        content: "Formation intensive de nos superviseurs régionaux. La technologie CAPI sur tablettes numériques garantit la sécurité et la confidentialité absolue de vos données. 💻🛡️ #BUCREP",
        image: '/assets/images/slides/phase_analyse.jpg',
        likes: '2.8k',
        comments: '42',
        shares: null,
        link: 'https://www.facebook.com/profile.php?id=61562950229317'
    },
    {
        platform: 'fb',
        platformName: 'Facebook',
        user: 'INS Cameroun',
        handle: '@ins_cameroun',
        date: '15 Mai',
        content: "Le recensement général est un acte civique d'utilité publique. Ensemble pour une planification fiable et efficace du Cameroun émergent ! 🇨🇲 #SecretStatistique #INS",
        image: null,
        likes: '890',
        comments: '34',
        shares: '45',
        link: 'https://www.facebook.com/profile.php?id=61562950229317'
    }
];

const socialPosts = computed(() => {
    const list = props.socialPosts && props.socialPosts.length > 0 ? props.socialPosts : defaultSocialPosts;
    return list.map(p => ({
        platform: p.platform,
        platformName: p.platform_name || p.platformName || (p.platform === 'fb' ? 'Facebook' : p.platform === 'x' ? 'X' : 'Instagram'),
        user: p.user,
        handle: p.handle,
        date: p.date,
        content: p.content,
        image: p.image,
        likes: p.likes,
        comments: p.comments,
        shares: p.shares,
        link: p.link || (p.platform === 'x' ? 'https://x.com/recensement90' : 'https://www.facebook.com/profile.php?id=61562950229317')
    }));
});

// Données régionales pour la carte interactive
const regionalStats = ref({
    'far-north': { name: 'Extrême-Nord', population: 4325490, agents: 4500, surface: '34 263 km²' },
    'north': { name: 'Nord', population: 2686835, agents: 2800, surface: '66 090 km²' },
    'adamawa': { name: 'Adamaoua', population: 1251670, agents: 1500, surface: '63 701 km²' },
    'east': { name: 'Est', population: 1111667, agents: 1300, surface: '109 002 km²' },
    'central': { name: 'Centre', population: 4627092, agents: 5100, surface: '68 953 km²' },
    'south': { name: 'Sud', population: 830113, agents: 1100, surface: '47 191 km²' },
    'littoral': { name: 'Littoral', population: 3824816, agents: 4800, surface: '20 248 km²' },
    'west': { name: 'Ouest', population: 1989803, agents: 2300, surface: '13 892 km²' },
    'northwest': { name: 'Nord-Ouest', population: 2107469, agents: 2100, surface: '17 300 km²' },
    'southwest': { name: 'Sud-Ouest', population: 1619623, agents: 1800, surface: '25 410 km²' }
});

const hoveredRegionData = ref(regionalStats.value['central']);

const handleRegionHover = (region) => {
    hoveredRegionData.value = regionalStats.value[region.id] || null;
};

const handleRegionLeave = () => {
    // We stay on the current one by default
};

const getSocialProofText = (proof) => {
    const value = visitorStats.value[proof.value];
    if (proof.value === 'total') {
        if (value <= 1) {
            return __('agent s\'est déjà inscrit sur le portail');
        } else {
            return __('agents se sont déjà inscrits sur le portail');
        }
    } else if (proof.value === 'today') {
        if (value <= 1) {
            return __('nouvelle candidature reçue aujourd\'hui');
        } else {
            return __('nouvelles candidatures reçues aujourd\'hui');
        }
    }
    return __(proof.text);
};

// Données de la galerie photo du terrain (Teaser / Preview de la page dédiée)
const activeLightboxIndex = ref(null);

const getCategoryLabel = (category) => {
    const map = {
        'collecte': 'Collecte',
        'sensibilisation': 'Sensibilisation',
        'formation': 'Formations',
        'supervision': 'Supervision',
        'evenement': 'Événements & Défilés'
    };
    const key = map[category] || category;
    return __(key);
};

const getRegionLabel = (region) => {
    const map = {
        'centre': 'Centre',
        'est': 'Est',
        'littoral': 'Littoral',
        'ouest': 'Ouest'
    };
    const key = map[region] || region;
    return __(key);
};

const galleryPhotos = [
    { id: 2, driveId: '1oqwbSYvhZ8bz7XUu1jrnTYI6fRlTOknv', category: 'collecte', region: 'centre', caption: 'Collecte numérique auprès des ménages', date: '13 Mai 2026' },
    { id: 19, type: 'video', src: '/assets/images/phototheque/Après le Défilé à Moloundou Dernière arrondissement frontalier avec le Congo/WhatsApp Video 2026-05-20 at 13.03.125.mp4', category: 'evenement', region: 'est', caption: 'Célébration patriotique après le défilé à Moloundou', date: '20 Mai 2026' },
    { id: 23, type: 'image', src: '/assets/images/phototheque/Baré bakem au défil/WhatsApp Image 2026-05-20 at 13.03.16.jpeg', category: 'evenement', region: 'littoral', caption: 'Équipe du RGPH au défilé officiel de Baré-Bakem', date: '20 Mai 2026' }
];

const openLightbox = (photo) => {
    const index = galleryPhotos.findIndex(p => p.id === photo.id);
    if (index !== -1) {
        activeLightboxIndex.value = index;
    }
};

const closeLightbox = () => {
    activeLightboxIndex.value = null;
};

const nextLightboxPhoto = () => {
    if (activeLightboxIndex.value !== null) {
        activeLightboxIndex.value = (activeLightboxIndex.value + 1) % galleryPhotos.length;
    }
};

const prevLightboxPhoto = () => {
    if (activeLightboxIndex.value !== null) {
        activeLightboxIndex.value = (activeLightboxIndex.value - 1 + galleryPhotos.length) % galleryPhotos.length;
    }
};

const handleKeyDown = (e) => {
    if (activeLightboxIndex.value === null) return;
    if (e.key === 'Escape') closeLightbox();
    else if (e.key === 'ArrowRight') nextLightboxPhoto();
    else if (e.key === 'ArrowLeft') prevLightboxPhoto();
};

onMounted(() => {
    window.addEventListener('keydown', handleKeyDown);
});

onUnmounted(() => {
    window.removeEventListener('keydown', handleKeyDown);
});
</script>

<template>
    <Head>
        <title>Accueil</title>
        <meta name="description" content="Suivez l'actualité, les activités et le chronogramme du recensement national au Cameroun. Soyez comptés !">
    </Head>

    <MainLayout>
        <!-- ===================== BARRE D'ANNONCE + PROGRESSION ===================== -->
        <div class="announcement-bar" id="announcement-bar">
            <!-- Gauche : texte défilant -->
            <div class="announce-left">
                <div class="scrolling-text">
                    <span v-html="__('Annonce défilement')"></span>
                </div>
            </div>

            <!-- Droite : indicateur de progression compact -->
            <Link href="/activites" class="announce-progress" id="announce-progress-link">
                <!-- Étiquette phase -->
                <span class="announce-phase-label">
                    <span class="announce-phase-dot"></span>
                    {{ __('Phase 3/5') }} — {{ __('Dénombrement') }}
                </span>

                <!-- Barre + pourcentage -->
                <span class="announce-bar-wrap">
                    <span class="announce-bar-track">
                        <span class="announce-bar-fill" style="width: 60%;"></span>
                    </span>
                    <span class="announce-pct">60%</span>
                </span>
            </Link>
        </div>

        <!-- ===================== HERO SLIDER ===================== -->
        <section class="hero-slider" id="hero">
            <div class="slides-track">
                <div v-for="(slide, index) in slides" :key="index" 
                     class="slide" :class="{ active: activeSlide === index }">
                    <div class="slide-bg" :style="{ backgroundImage: `url(${slide.image})` }"></div>
                    <div class="slide-overlay"></div>
                    <div class="container slide-content relative z-20 h-full flex items-center">
                        <div class="hero-card max-w-2xl transform transition-all duration-1000" :class="activeSlide === index ? 'translate-x-0 opacity-100' : '-translate-x-12 opacity-0'">
                            <div class="uppercase tracking-widest text-[#EDAF11] font-bold text-xs md:text-sm mb-4">
                                {{ __('Le recensement est notre avenir, tous concernés, tous gagnants') }}
                            </div>
                            <h1 class="text-4xl md:text-6xl font-black text-white leading-tight mb-6 shadow-text" v-html="__(slide.title)"></h1>
                            <p class="text-lg md:text-xl text-white/90 mb-10 leading-relaxed max-w-xl" v-html="__(slide.text)"></p>
                            <div class="flex flex-wrap gap-4">
                                <Link :href="slide.link" class="bg-[#204138] text-white px-8 py-4 rounded-full font-bold hover:bg-[#2b5549] transition-all flex items-center gap-2 group shadow-xl">
                                    {{ __(slide.cta) }}
                                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Flèches latérales -->
            <button @click="prevSlide" class="slider-arrow arrow-prev" id="slider-prev" :aria-label="__('Précédent')">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
            </button>
            <button @click="nextSlide" class="slider-arrow arrow-next" id="slider-next" :aria-label="__('Suivant')">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </button>

            <!-- Indicateurs -->
            <div class="slider-dots">
                <span v-for="(_, i) in slides" :key="i"
                      class="dot" :class="{ active: activeSlide === i }" @click="activeSlide = i"></span>
            </div>
        </section>

        <!-- Bandeau stat dynamique -->
        <div class="hero-infobar !py-0">
            <div class="container infobar-inner !py-0 flex flex-wrap justify-between">
                <div v-for="stat in stats" :key="stat.label" class="flex flex-col items-center py-6 px-4 min-w-[200px] border-r border-white/10 last:border-0 grow">
                    <span class="text-[#EDAF11] text-2xl md:text-3xl font-black mb-1">
                        {{ stat.value.toLocaleString() }}{{ stat.suffix }}
                    </span>
                    <span class="text-white/70 text-xs font-bold uppercase tracking-widest text-center">{{ __(stat.label) }}</span>
                </div>
            </div>
        </div>

        <!-- ===================== CHRONOGRAMME ===================== -->
        <section class="chronogramme-section" id="chronogramme">
            <div class="container">
                <div class="section-header chron-header">
                    <h2>{{ __('Chronogramme des activités') }}</h2>
                    <p>{{ __('Consultez les étapes') }}</p>
                </div>

                <!-- Légende Professionnelle des Statuts -->
                <div class="flex flex-wrap items-center justify-center gap-6 mb-8 mt-2 select-none">
                    <div class="flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-gray-500 bg-white px-3 py-1.5 rounded-full border border-gray-100 shadow-sm">
                        <span class="w-3 h-3 rounded-full bg-[#2E9146] flex items-center justify-center">
                            <svg class="w-2 h-2 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        </span>
                        <span>{{ __('Terminée') }}</span>
                    </div>
                    <div class="flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-gray-500 bg-white px-3 py-1.5 rounded-full border border-gray-100 shadow-sm">
                        <span class="w-3 h-3 rounded-full bg-[#F1A502] relative flex">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#F1A502] opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-[#F1A502]"></span>
                        </span>
                        <span>{{ __('En cours') }}</span>
                    </div>
                    <div class="flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-gray-500 bg-white px-3 py-1.5 rounded-full border border-gray-100 shadow-sm">
                        <span class="w-3 h-3 rounded-full border-2 border-gray-300 bg-gray-100"></span>
                        <span>{{ __('À venir') }}</span>
                    </div>
                </div>

                <div class="timeline-wrapper p-6 bg-white border border-gray-100 rounded-3xl shadow-sm">
                    <div class="timeline-row">
                        <!-- Début -->
                        <div class="tl-endpoint tl-start select-none">
                            <span>{{ __('Début du') }}<br>{{ __('processus') }}</span>
                        </div>

                        <!-- Phase 1: Conception (completed) -->
                        <div class="tl-phase completed cursor-pointer group" @click="$inertia.visit('/activites')">
                            <!-- Box with Icon & Name -->
                            <div class="tl-box flex flex-col items-center justify-center gap-2 py-3 px-2">
                                <svg class="w-5 h-5 opacity-90 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <span class="tl-title">{{ __('Conception') }}</span>
                                <span class="tl-desc">{{ __('Phase Préparatoire') }}</span>
                            </div>
                        </div>

                        <!-- Phase 2: Cartographie (completed) -->
                        <div class="tl-phase completed cursor-pointer group" @click="$inertia.visit('/activites')">
                            <!-- Box with Icon & Name -->
                            <div class="tl-box flex flex-col items-center justify-center gap-2 py-3 px-2">
                                <svg class="w-5 h-5 opacity-90 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                                </svg>
                                <span class="tl-title">{{ __('Cartographie') }}</span>
                                <span class="tl-desc">{{ __('Découpage SIG') }}</span>
                            </div>
                        </div>

                        <!-- Phase 3: Dénombrement (active) -->
                        <div class="tl-phase active cursor-pointer group" @click="$inertia.visit('/activites')">
                            <!-- Badge "Nous sommes ici" -->
                            <div class="tl-now-marker">
                                <span>{{ __('Nous sommes ici') }}</span>
                                <svg width="20" height="28" viewBox="0 0 22 30" fill="none">
                                    <path d="M11 0C4.925 0 0 4.925 0 11C0 19.25 11 30 11 30C11 30 22 19.25 22 11C22 4.925 17.075 0 11 0Z" fill="#2E6B5E"/>
                                    <circle cx="11" cy="11" r="5" fill="#E8AA00"/>
                                </svg>
                            </div>
                            <!-- Box with Icon & Name -->
                            <div class="tl-box flex flex-col items-center justify-center gap-2 py-3 px-2">
                                <svg class="w-5 h-5 opacity-90 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                <span class="tl-title">{{ __('Dénombrement') }}</span>
                                <span class="tl-desc">{{ __('Collecte terrain') }}</span>
                            </div>
                        </div>

                        <!-- Phase 4: Saisie des données (upcoming) -->
                        <div class="tl-phase upcoming cursor-pointer group" @click="$inertia.visit('/activites')">
                            <!-- Box with Icon & Name -->
                            <div class="tl-box flex flex-col items-center justify-center gap-2 py-3 px-2">
                                <svg class="w-5 h-5 opacity-90 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"/>
                                </svg>
                                <span class="tl-title">{{ __('Saisie des données') }}</span>
                                <span class="tl-desc">{{ __('Apurement & Contrôle') }}</span>
                            </div>
                        </div>

                        <!-- Phase 5: Publication (upcoming) -->
                        <div class="tl-phase upcoming cursor-pointer group" @click="$inertia.visit('/activites')">
                            <!-- Box with Icon & Name -->
                            <div class="tl-box flex flex-col items-center justify-center gap-2 py-3 px-2">
                                <svg class="w-5 h-5 opacity-90 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                                <span class="tl-title">{{ __('Publication') }}</span>
                                <span class="tl-desc">{{ __('Diffusion des résultats') }}</span>
                            </div>
                        </div>

                        <!-- Fin -->
                        <div class="tl-endpoint tl-end select-none">
                            <span>{{ __('Fin du') }}<br>{{ __('processus') }}</span>
                        </div>
                    </div>

                    <div class="tl-axis-global">
                        <!-- Ligne d'axe -->
                        <div class="tl-axis-line" style="top: 104px;"></div>

                        <!-- Années -->
                        <div class="tl-years-row" style="margin-top: 40px;">
                            <div></div>
                            <span class="tl-year">2024</span>
                            <span class="tl-year">2025</span>
                            <span class="tl-year">2026</span>
                            <span class="tl-year">2027</span>
                            <span class="tl-year">2027</span>
                            <div></div>
                        </div>
                    </div>
                </div>

                <!-- Bouton d'action vers la page dédiée -->
                <div class="flex justify-center mt-10">
                    <Link href="/activites" class="group inline-flex items-center gap-3 px-8 py-4 bg-[#295E4D] hover:bg-[#1E4539] text-white font-bold rounded-full transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5 no-underline">
                        <span>{{ __('Suivre les détails et statistiques en direct') }}</span>
                        <svg class="w-5 h-5 text-white transition-transform duration-300 group-hover:translate-x-1.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 5l7 7-7 7M5 5l7 7-7 7"/>
                        </svg>
                    </Link>
                </div>
            </div>
        </section>


        <!-- ===================== CARTOGRAPHIE DEMOGRAPHIQUE ===================== -->
        <section class="carte-demographique-section" id="demographie">
            <div class="carto-inner">
                <!-- Colonne Image (Gauche — 55%) -->
                <div class="carto-visual-col">
                    <!-- Dot grid decorative -->
                    <div class="carto-dot-grid" aria-hidden="true"></div>
                    <!-- Gold accent bar -->
                    <div class="carto-accent-bar" aria-hidden="true"></div>
                    <!-- Image principale -->
                    <img
                        src="/assets/images/accueil/map_pop_white_bg.jpg"
                        alt="Cartographie de la population du Cameroun"
                        class="carto-map-img"
                    />
                </div>

                <!-- Colonne Contenu (Droite — 45%) -->
                <div class="carto-content-col">
                    <!-- Badge section -->
                    <span class="carto-badge">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0L6.343 16.657a8 8 0 1111.314 0z"/><circle cx="12" cy="11" r="3"/></svg>
                        {{ __('Cartographie Démographique') }}
                    </span>

                    <!-- Heading -->
                    <h2 class="carto-heading">
                        {{ __('Une photographie précise de notre nation') }}
                    </h2>

                    <!-- Separator -->
                    <div class="carto-separator"></div>

                    <!-- Description -->
                    <p class="carto-desc">
                        {{ __("Le 4ème RGPH assure une couverture exhaustive de l'ensemble des 10 régions du Cameroun, permettant de recueillir des données précieuses pour planifier les infrastructures de demain.") }}
                    </p>

                    <!-- KPI Grid -->
                    <div class="carto-kpi-grid">
                        <!-- KPI 1 -->
                        <div class="carto-kpi">
                            <div class="carto-kpi-number text-[#204138]">10</div>
                            <div class="carto-kpi-icon-wrap bg-[#2E6B5E]/10 text-[#2E6B5E]">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0L6.343 16.657a8 8 0 1111.314 0z"/><circle cx="12" cy="11" r="3"/></svg>
                            </div>
                            <div class="carto-kpi-label">{{ __('Régions Administratives') }}</div>
                        </div>
                        <!-- KPI 2 -->
                        <div class="carto-kpi">
                            <div class="carto-kpi-number text-[#2E6B5E]">58</div>
                            <div class="carto-kpi-icon-wrap bg-[#EDAF11]/15 text-[#EDAF11]">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            </div>
                            <div class="carto-kpi-label">{{ __('Départements') }}</div>
                        </div>
                        <!-- KPI 3 -->
                        <div class="carto-kpi">
                            <div class="carto-kpi-number text-[#204138]">360+</div>
                            <div class="carto-kpi-icon-wrap bg-[#2E6B5E]/10 text-[#2E6B5E]">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                            </div>
                            <div class="carto-kpi-label">{{ __('Arrondissements') }}</div>
                        </div>
                        <!-- KPI 4 -->
                        <div class="carto-kpi">
                            <div class="carto-kpi-number text-[#2E6B5E]">~30M</div>
                            <div class="carto-kpi-icon-wrap bg-[#EDAF11]/15 text-[#EDAF11]">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <div class="carto-kpi-label">{{ __('Habitants ciblés') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ===================== A LA UNE ===================== -->
        <section class="alaune-section" id="a-la-une" v-if="latestArticles && latestArticles.length > 0">
            <div class="container">
                <h2 class="alaune-title">{{ __('A la Une') }}</h2>

                <!-- Hero News (First one) -->
                <div class="alaune-hero" v-if="latestArticles[0]">
                    <Link :href="route('actualites.show', latestArticles[0].slug)" class="alaune-hero-card-container transition-all">
                        <div class="alaune-hero-img-wrap relative">
                            <video
                                v-if="latestArticles[0].media_type === 'video' && latestArticles[0].video && !latestArticles[0].image"
                                :src="'/storage/' + latestArticles[0].video"
                                muted
                                autoplay
                                loop
                                playsinline
                                @timeupdate="(e) => { if (e.target.currentTime >= 5) e.target.currentTime = 0; }"
                                class="w-full h-full object-cover absolute inset-0"
                                style="pointer-events: none;"
                            ></video>
                            <img v-else :src="latestArticles[0].image ? `/storage/${latestArticles[0].image}` : '/assets/images/slides/phase_prepa.jpg'" 
                                 :alt="latestArticles[0].title">
                            <!-- Video Play Badge Overlay for Hero -->
                            <div v-if="latestArticles[0].media_type === 'video'" class="absolute inset-0 bg-black/30 flex items-center justify-center transition-all">
                                <span class="w-16 h-16 rounded-full bg-[#EDAF11] text-[#204138] flex items-center justify-center shadow-lg transform scale-100 hover:scale-110 transition-all">
                                    <svg class="w-8 h-8 ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                </span>
                            </div>
                        </div>
                        <div class="alaune-hero-content">
                            <span class="tag" :class="`tag-${latestArticles[0].category}`">{{ __(latestArticles[0].tag) }}</span>
                            <h3>{{ latestArticles[0].title }}</h3>
                            <p>{{ latestArticles[0].excerpt }}</p>
                            <div class="alaune-hero-link">
                                {{ __('Lire le contenu') }}
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </div>
                        </div>
                    </Link>
                </div>

                <!-- Secondary News (Next 3) -->
                <div class="alaune-cards-row mt-12">
                    <article v-for="(article, index) in latestArticles.slice(1)" :key="index" class="article-card" :data-category="article.category">
                        <Link :href="route('actualites.show', article.slug)" class="article-card-link">
                            <div class="article-img relative overflow-hidden" :class="!article.image && article.media_type !== 'video' ? (article.imgClass || `article-img--${article.category === 'communique' ? 'green' : (article.category === 'activite' ? 'gold' : 'teal')}`) : ''">
                                <img v-if="article.image" :src="`/storage/${article.image}`" class="w-full h-full object-cover absolute inset-0">
                                <video
                                    v-else-if="article.media_type === 'video' && article.video"
                                    :src="'/storage/' + article.video"
                                    muted
                                    autoplay
                                    loop
                                    playsinline
                                    @timeupdate="(e) => { if (e.target.currentTime >= 5) e.target.currentTime = 0; }"
                                    class="w-full h-full object-cover absolute inset-0"
                                    style="pointer-events: none;"
                                ></video>
                                <!-- Video Play Badge Overlay -->
                                <div v-if="article.media_type === 'video'" class="absolute inset-0 bg-black/30 flex items-center justify-center transition-all">
                                    <span class="w-12 h-12 rounded-full bg-[#EDAF11] text-[#204138] flex items-center justify-center shadow-lg transform transition-all">
                                        <svg class="w-6 h-6 ml-0.5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                    </span>
                                </div>
                            </div>
                            <div class="article-card-body p-6">
                                <div class="article-meta mb-3">
                                    <span class="article-tag" :class="`tag-${article.category}`">{{ __(article.tag) }}</span>
                                    <time class="article-date text-xs text-gray-400 font-bold ml-auto">{{ article.date }}</time>
                                </div>
                                <h3 class="article-card-title text-xl font-bold text-[#204138] mb-3 line-clamp-2">{{ article.title }}</h3>
                                <p class="article-card-excerpt text-sm text-gray-500 line-clamp-2">{{ article.excerpt }}</p>
                                <span class="article-read-more mt-4 text-[#204138] font-bold text-xs uppercase tracking-widest flex items-center gap-2 group-hover:text-[#EDAF11]">
                                    {{ __('Lire la suite') }}
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </span>
                            </div>
                        </Link>
                    </article>
                </div>

                <div class="alaune-footer mt-16 text-center">
                    <Link href="/actualites" class="inline-flex items-center gap-3 bg-[#f0f4f3] text-[#204138] px-10 py-4 rounded-full font-bold hover:bg-[#204138] hover:text-white transition-all shadow-sm">
                        {{ __('Voir plus de nouvelles') }}
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </Link>
                </div>
            </div>
        </section>

        <!-- ===================== PREUVE SOCIALE (NOTIF) ===================== -->
        <Transition name="proof-fade">
            <div v-if="showSocialProof" class="hidden md:block fixed bottom-8 left-8 z-[100] max-w-[320px]">
                <div class="bg-white/95 backdrop-blur-2xl border border-white p-3 rounded-2xl shadow-2xl flex items-center gap-4 hover:scale-105 transition-transform duration-300">
                    <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center relative flex-shrink-0">
                        <svg v-if="socialProofs[currentProofIndex].icon === 'users'" class="w-6 h-6 text-[#204138]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        <svg v-else-if="socialProofs[currentProofIndex].icon === 'eye'" class="w-6 h-6 text-[#204138]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        <svg v-else class="w-6 h-6 text-[#204138]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <!-- Puce "En Direct" -->
                        <span class="absolute -top-1 -right-1 flex h-3 w-3">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                        </span>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-xs leading-snug font-bold text-[#204138]">
                            <span class="text-lg font-black text-[#EDAF11]">{{ visitorStats[socialProofs[currentProofIndex].value].toLocaleString() }}</span>
                            {{ ' ' + getSocialProofText(socialProofs[currentProofIndex]) }}
                        </p>
                    </div>
                </div>
            </div>
        </Transition>

        <!-- ===================== GALERIE DE TERRAIN ===================== -->
        <section class="field-gallery-section" id="galerie-terrain">
            <div class="container mx-auto px-4 md:px-6">
                <div class="text-center max-w-3xl mx-auto mb-12">
                    <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full text-xs font-bold bg-[#204138]/5 text-[#204138] uppercase tracking-wider mb-4 border border-[#204138]/10">
                        <svg class="w-3.5 h-3.5 text-[#EDAF11]" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                        </svg>
                        {{ __('Le Recensement en Images') }}
                    </span>
                    <h2 class="text-3xl md:text-5xl font-black text-[#204138] leading-tight mb-4">
                        {{ __('Découvrez nos équipes sur le terrain') }}
                    </h2>
                </div>

                <!-- Grille de Photos (Teaser) -->
                <div class="gallery-grid">
                    <div 
                        v-for="photo in galleryPhotos" 
                        :key="photo.id"
                        class="gallery-card group relative overflow-hidden rounded-[24px] cursor-pointer"
                        @click="openLightbox(photo)"
                    >
                        <div class="gallery-img-wrapper h-full relative aspect-square md:aspect-[4/3] overflow-hidden">
                            <!-- Type Vidéo local -->
                            <video 
                                v-if="photo.type === 'video'"
                                :src="photo.src" 
                                class="gallery-img w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                muted 
                                loop 
                                playsinline
                                @mouseenter="$event.target.play()"
                                @mouseleave="$event.target.pause(); $event.target.currentTime = 0;"
                            ></video>
                            <!-- Type Image local -->
                            <img 
                                v-else-if="photo.src"
                                :src="photo.src" 
                                :alt="__(photo.caption)"
                                class="gallery-img w-full h-full object-cover transition-transform duration-700 group-hover:scale-106"
                                loading="lazy"
                            />
                            <!-- Type Image Drive -->
                            <img 
                                v-else
                                :src="`https://drive.google.com/thumbnail?id=${photo.driveId}&sz=w800`" 
                                :alt="__(photo.caption)"
                                class="gallery-img w-full h-full object-cover transition-transform duration-700 group-hover:scale-106"
                                loading="lazy"
                            />

                            <!-- Overlay de lecture pour les vidéos -->
                            <div v-if="photo.type === 'video'" class="absolute inset-0 flex items-center justify-center pointer-events-none z-10 transition-transform duration-300 group-hover:scale-110">
                                <div class="bg-black/40 backdrop-blur-md text-white p-3.5 rounded-full shadow-lg border border-white/20">
                                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z"/>
                                    </svg>
                                </div>
                            </div>

                            <!-- Overlay de carte (Catégorie, Région, Caption) -->
                            <div class="gallery-card-overlay">
                                <div class="flex items-center justify-between w-full mb-1">
                                    <span class="gallery-card-category">{{ getCategoryLabel(photo.category) }}</span>
                                    <span v-if="photo.region" class="px-2 py-0.5 rounded text-[10px] font-bold bg-[#EDAF11] text-[#204138] uppercase tracking-wider">
                                        {{ getRegionLabel(photo.region) }}
                                    </span>
                                </div>
                                <h3 class="gallery-card-title">{{ __(photo.caption) }}</h3>
                                <span class="gallery-card-date">{{ __(photo.date) }}</span>
                            </div>

                            <!-- Icône Zoom/Expansion -->
                            <div class="gallery-card-icon">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CTA vers la page dédiée -->
                <div class="text-center mt-12">
                    <Link 
                        href="/phototheque" 
                        class="inline-flex items-center gap-3 bg-[#204138] text-white px-10 py-4 rounded-full font-bold hover:bg-[#EDAF11] hover:text-[#204138] transition-all shadow-md hover:-translate-y-0.5 duration-300 group"
                    >
                        {{ __('Visiter la photothèque complète') }}
                        <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </Link>
                </div>
            </div>
        </section>

        <!-- ===================== LIGHTBOX MODAL ===================== -->
        <Transition name="fade">
            <div v-if="activeLightboxIndex !== null" class="gallery-lightbox" @click.self="closeLightbox">
                <div class="lightbox-content-wrapper">
                    <!-- Bouton Fermer -->
                    <button class="lightbox-close-btn" @click="closeLightbox" aria-label="Close">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
 
                    <!-- Navigation Gauche -->
                    <button class="lightbox-arrow lightbox-arrow-left" @click="prevLightboxPhoto" aria-label="Previous">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>

                    <!-- Image / Vidéo Container -->
                    <div class="lightbox-img-container w-full aspect-video md:aspect-auto max-h-[75vh]">
                        <!-- Si c'est une vidéo locale -->
                        <video 
                            v-if="galleryPhotos[activeLightboxIndex].type === 'video'"
                            :src="galleryPhotos[activeLightboxIndex].src" 
                            class="lightbox-img w-full h-full max-h-[75vh] object-contain"
                            controls 
                            autoplay
                        ></video>
                        <!-- Si c'est une image locale -->
                        <img 
                            v-else-if="galleryPhotos[activeLightboxIndex].src"
                            :src="galleryPhotos[activeLightboxIndex].src" 
                            :alt="__(galleryPhotos[activeLightboxIndex].caption)"
                            class="lightbox-img w-full h-full max-h-[75vh] object-contain"
                        />
                        <!-- Si c'est une image Drive -->
                        <img 
                            v-else
                            :src="`https://drive.google.com/thumbnail?id=${galleryPhotos[activeLightboxIndex].driveId}&sz=w1000`" 
                            :alt="__(galleryPhotos[activeLightboxIndex].caption)"
                            class="lightbox-img"
                        />
                    </div>

                    <!-- Navigation Droite -->
                    <button class="lightbox-arrow lightbox-arrow-right" @click="nextLightboxPhoto" aria-label="Next">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>

                    <!-- Infos Image -->
                    <div class="lightbox-info">
                        <div class="flex items-center justify-center gap-3 mb-2 flex-wrap">
                            <span class="lightbox-category">{{ getCategoryLabel(galleryPhotos[activeLightboxIndex].category) }}</span>
                            <span v-if="galleryPhotos[activeLightboxIndex].region" class="px-2 py-0.5 rounded text-[10px] font-bold bg-[#EDAF11] text-[#204138] uppercase tracking-wider">
                                {{ getRegionLabel(galleryPhotos[activeLightboxIndex].region) }}
                            </span>
                        </div>
                        <h3 class="lightbox-title">{{ __(galleryPhotos[activeLightboxIndex].caption) }}</h3>
                        <span class="lightbox-date">{{ __(galleryPhotos[activeLightboxIndex].date) }}</span>
                    </div>
                </div>
            </div>
        </Transition>

        <!-- ===================== RESEAUX SOCIAUX ===================== -->
        <section class="social-section" id="reseaux-sociaux">
            <div class="container">
                <div class="social-header">
                    <span class="social-badge">{{ __('Communauté') }}</span>
                    <h2>{{ __('Suivez l\'actualité sur nos réseaux') }}</h2>
                    <p>{{ __('Rejoignez les milliers de citoyens qui nous suivent quotidiennement.') }}</p>
                </div>
                <!-- Live Social Media Widgets -->
                <div class="social-widgets-container grid grid-cols-1 md:grid-cols-2 gap-8 mt-12 justify-center items-center max-w-5xl mx-auto pb-8">
                    <!-- Facebook Page Widget -->
                    <div class="social-widget-card bg-white p-6 rounded-[32px] shadow-[0_20px_50px_rgba(0,0,0,0.05)] border border-gray-100 flex flex-col h-[620px] w-full transition-all duration-300 hover:shadow-[0_30px_70px_rgba(32,65,56,0.12)] hover:-translate-y-1">
                        <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
                            <span class="w-10 h-10 rounded-full bg-[#1877F2]/10 flex items-center justify-center text-[#1877F2]">
                                <svg viewBox="0 0 24 24" fill="currentColor" width="20" height="20"><path d="M12 2.04c-5.5 0-10 4.5-10 10s4.5 10 10 10 10-4.5 10-10-4.5-10-10-10zm3.18 10h-2.18v7h-3v-7h-1.5v-2.5h1.5v-1.5c0-2.12 1.25-3.25 3.12-3.25.9 0 1.68.07 1.9.1v2.18h-1.28c-1.02 0-1.22.48-1.22 1.2v1.27h2.5l-.34 2.5z"/></svg>
                            </span>
                            <h3 class="text-xl font-black text-[#204138]">{{ __('Notre Page Facebook') }}</h3>
                        </div>
                        <div class="widget-body flex-1 w-full overflow-hidden rounded-2xl bg-[#f8faf9] border border-gray-100">
                            <iframe 
                                src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fprofile.php%3Fid%3D61562950229317&tabs=timeline&width=450&height=500&small_header=true&adapt_container_width=true&hide_cover=false&show_facepile=false" 
                                width="100%" 
                                height="100%" 
                                style="border:none;overflow:hidden;" 
                                scrolling="no" 
                                frameborder="0" 
                                allowfullscreen="true" 
                                allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"
                                class="w-full h-full"
                            ></iframe>
                        </div>
                    </div>

                    <!-- Twitter (X) Timeline Widget -->
                    <div class="social-widget-card bg-white p-6 rounded-[32px] shadow-[0_20px_50px_rgba(0,0,0,0.05)] border border-gray-100 flex flex-col h-[620px] w-full transition-all duration-300 hover:shadow-[0_30px_70px_rgba(32,65,56,0.12)] hover:-translate-y-1">
                        <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
                            <span class="w-10 h-10 rounded-full bg-black/5 flex items-center justify-center text-black">
                                <svg viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231 5.45-6.231zm-1.161 17.52h1.833L7.084 4.126H5.117L17.083 19.77z"/></svg>
                            </span>
                            <h3 class="text-xl font-black text-[#204138]">{{ __('Notre Fil Twitter (X)') }}</h3>
                        </div>
                        <div class="widget-body flex-1 w-full overflow-y-auto rounded-2xl bg-[#f8faf9] border border-gray-100 flex flex-col p-4 space-y-4">
                            <div v-for="(tweet, idx) in simulatedTweets" :key="idx" class="p-5 bg-white border border-gray-100 rounded-[24px] hover:border-gray-200 transition-all duration-300 shadow-[0_4px_20px_rgba(0,0,0,0.02)] flex flex-col text-left">
                                <div class="flex items-center justify-between mb-3.5">
                                    <div class="flex items-center gap-3">
                                        <img src="/assets/images/logo-rgae.jpg" alt="X Avatar" class="w-10 h-10 rounded-full border border-gray-100 object-cover">
                                        <div>
                                            <h4 class="text-sm font-bold text-gray-900 flex items-center gap-1.5">
                                                {{ tweet.user }}
                                                <!-- Premium Verified Account Badge (Starburst Checkmark) -->
                                                <svg viewBox="0 0 24 24" fill="#1DA1F2" class="w-4 h-4 inline-block"><g><path d="M22.5 12.5c0-1.58-.875-2.95-2.148-3.6.154-.435.238-.905.238-1.4 0-2.21-1.71-3.99-3.818-3.99-.48 0-.938.1-1.35.278C14.775 2.525 13.5 1.5 12 1.5s-2.775 1.025-3.42 2.288c-.412-.178-.87-.278-1.35-.278-2.108 0-3.818 1.78-3.818 3.99 0 .495.084.965.238 1.4-1.273.65-2.148 2.02-2.148 3.6 0 1.58.875 2.95 2.148 3.6-.154.435-.238.905-.238 1.4 0 2.21 1.71 3.99 3.818 3.99.48 0 .938-.1 1.35-.278.645 1.263 1.92 2.288 3.42 2.288s2.775-1.025 3.42-2.288c.412.178.87.278 1.35.278 2.108 0 3.818-1.78 3.818-3.99 0-.495-.084-.965-.238-1.4 1.273-.65 2.148-2.02 2.148-3.6zm-12.72 3.29l-3.29-3.29 1.41-1.42 1.88 1.88 4.7-4.7 1.41 1.41-6.11 6.12z"></path></g></svg>
                                            </h4>
                                            <p class="text-xs text-gray-400 font-medium">{{ tweet.handle }} · {{ tweet.date }}</p>
                                        </div>
                                    </div>
                                    <svg viewBox="0 0 24 24" fill="black" width="16" height="16"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231 5.45-6.231zm-1.161 17.52h1.833L7.084 4.126H5.117L17.083 19.77z"/></svg>
                                </div>
                                <p class="text-sm text-gray-700 leading-relaxed font-normal mb-3.5 whitespace-pre-wrap">{{ tweet.content }}</p>
                                <div v-if="tweet.image" class="mb-3.5 rounded-xl overflow-hidden max-h-[160px] border border-gray-100">
                                    <img :src="tweet.image" class="w-full h-full object-cover">
                                </div>
                                <div class="flex items-center justify-between text-xs text-gray-400 border-t border-gray-50 pt-3 mt-auto">
                                    <div class="flex items-center gap-6">
                                        <span class="flex items-center gap-2 hover:text-[#1DA1F2] cursor-pointer transition-colors duration-200">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
                                            <span class="font-semibold text-gray-500">{{ tweet.comments }}</span>
                                        </span>
                                        <span class="flex items-center gap-2 hover:text-[#00BA7C] cursor-pointer transition-colors duration-200">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><polyline points="17 1 21 5 17 9"/><path d="M3 11V9a4 4 0 0 1 4-4h14"/><polyline points="7 23 3 19 7 15"/><path d="M21 13v2a4 4 0 0 1-4 4H3"/></svg>
                                            <span class="font-semibold text-gray-500">{{ tweet.shares }}</span>
                                        </span>
                                        <span class="flex items-center gap-2 hover:text-[#F91880] cursor-pointer transition-colors duration-200">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                                            <span class="font-semibold text-gray-500">{{ tweet.likes }}</span>
                                        </span>
                                    </div>
                                    <a :href="tweet.link" target="_blank" rel="noopener noreferrer" class="text-[#1DA1F2] font-black hover:underline flex items-center gap-1">
                                        {{ __('Voir sur X') }}
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-3 h-3"><line x1="7" y1="17" x2="17" y2="7"/><polyline points="7 7 17 7 17 17"/></svg>
                                    </a>
                                </div>
                            </div>
                            <!-- Bottom Action CTA -->
                            <div class="pt-2 text-center">
                                <a href="https://x.com/recensement90" target="_blank" rel="noopener noreferrer" class="px-6 py-2.5 bg-[#204138] hover:bg-[#EDAF11] hover:text-[#204138] text-white font-bold text-sm rounded-full transition-all duration-300 shadow-md inline-block">
                                    {{ __('Suivre @recensement90 sur X') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </section>

        <!-- ===================== SECURITY & TRUST SECTION ===================== -->
        <section class="security-trust-section py-24 px-4 md:px-8 relative overflow-hidden" style="background-image: url('/assets/images/pattern.jpg'); background-size: cover; background-position: center;">
            <!-- Background image overlay -->
            <div class="security-bg-overlay"></div>
            <div class="max-w-7xl mx-auto relative z-10">
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <span class="text-[#EDAF11] font-bold uppercase tracking-widest text-xs md:text-sm">{{ __('Souveraineté & Secret Statistique') }}</span>
                    <h2 class="text-3xl md:text-5xl font-black text-white mt-3 mb-6">{{ __('Vos données sont en sécurité') }}</h2>
                    <p class="text-white/75 leading-relaxed text-base">{{ __('Le BUCREP déploie des protocoles de sécurité de pointe pour garantir le secret et la confidentialité absolue de chaque déclaration citoyenne.') }}</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Card 1: Secret Statistique -->
                    <div class="security-card p-8 rounded-2xl flex flex-col items-center text-center">
                        <div class="w-16 h-16 rounded-2xl bg-white/10 border border-white/20 flex items-center justify-center text-[#EDAF11] mb-6">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-4">{{ __('Secret Statistique Garanti') }}</h3>
                        <p class="text-white/70 text-sm leading-relaxed">{{ __('Conformément à la loi sur le secret statistique, vos informations individuelles restent strictement confidentielles et protégées.') }}</p>
                    </div>

                    <!-- Card 2: CAPI Tablettes -->
                    <div class="security-card p-8 rounded-2xl flex flex-col items-center text-center">
                        <div class="w-16 h-16 rounded-2xl bg-white/10 border border-white/20 flex items-center justify-center text-[#EDAF11] mb-6">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"></rect><line x1="12" y1="18" x2="12.01" y2="18"></line></svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-4">{{ __('Collecte Numérique Sécurisée') }}</h3>
                        <p class="text-white/70 text-sm leading-relaxed">{{ __('La collecte s\'effectue sur des tablettes numériques sécurisées. Les données saisies sont immédiatement cryptées et transmises au serveur central du BUCREP.') }}</p>
                    </div>

                    <!-- Card 3: Utilité Publique -->
                    <div class="security-card p-8 rounded-2xl flex flex-col items-center text-center">
                        <div class="w-16 h-16 rounded-2xl bg-white/10 border border-white/20 flex items-center justify-center text-[#EDAF11] mb-6">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-4">{{ __('Usage Citoyen & Planification') }}</h3>
                        <p class="text-white/70 text-sm leading-relaxed">{{ __('Aucune donnée fiscale, bancaire ou nominative n\'est divulguée. Les informations servent uniquement à la planification du développement du Cameroun.') }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ===================== BESOIN D'INFORMATIONS ===================== -->
        <CallCenterBanner 
            title="Besoin d'informations ?"
            subtitle="Contactez nous via le numéro vert dédié"
            phone="8585"
            buttonLabel="Appeler le numéro Vert"
        />

        <!-- ===================== FAQ ===================== -->
        <FaqSection />

        <!-- ===================== PARTENAIRES ===================== -->
        <PartenaireCarousel :partners="partners" />
    </MainLayout>
</template>


<style scoped>
/* ===================== CARTO DEMOGRAPHIQUE — PREMIUM ===================== */
.carte-demographique-section {
    background: #ffffff;
    overflow: hidden;
    position: relative;
}

/* Full-bleed 2-col grid: 55% image / 45% content */
.carto-inner {
    display: grid;
    grid-template-columns: 55% 45%;
    min-height: 540px;
}

@media (max-width: 1023px) {
    .carto-inner {
        grid-template-columns: 1fr;
    }
}

/* === VISUAL COLUMN === */
.carto-visual-col {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f9fafb;
    overflow: hidden;
    min-height: 420px;
    padding: 3rem 2rem;
}

/* Dot grid background */
.carto-dot-grid {
    position: absolute;
    inset: 0;
    background-image: radial-gradient(circle, #2E6B5E1a 1px, transparent 1px);
    background-size: 24px 24px;
    opacity: 0.6;
    pointer-events: none;
}

/* Gold vertical accent bar on the right edge */
.carto-accent-bar {
    position: absolute;
    right: 0;
    top: 15%;
    height: 70%;
    width: 4px;
    background: linear-gradient(180deg, transparent, #EDAF11, transparent);
    border-radius: 4px;
    pointer-events: none;
}

/* The map image — NO shadow, no border-radius, fills col */
.carto-map-img {
    position: relative;
    z-index: 2;
    width: 100%;
    max-width: 560px;
    height: auto;
    object-fit: contain;
    display: block;
    transition: transform 0.7s cubic-bezier(0.16, 1, 0.3, 1);
    filter: drop-shadow(0 0 0 transparent);  /* explicitly no shadow */
}

.carto-map-img:hover {
    transform: scale(1.04);
}

/* === CONTENT COLUMN === */
.carto-content-col {
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 4rem 3.5rem 4rem 3rem;
    background: #ffffff;
}

@media (max-width: 1023px) {
    .carto-content-col {
        padding: 3rem 1.5rem;
        order: -1;
    }
    .carto-visual-col {
        min-height: 360px;
    }
}

/* Badge */
.carto-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 14px;
    background: rgba(46, 107, 94, 0.08);
    color: #2E6B5E;
    font-size: 0.7rem;
    font-weight: 800;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    border-radius: 999px;
    margin-bottom: 1.25rem;
    width: fit-content;
}

/* Heading */
.carto-heading {
    font-size: clamp(1.75rem, 2.5vw, 2.5rem);
    font-weight: 900;
    color: #204138;
    line-height: 1.2;
    margin-bottom: 1rem;
}

/* Gold separator */
.carto-separator {
    width: 48px;
    height: 4px;
    background: linear-gradient(90deg, #EDAF11, #f5c842);
    border-radius: 4px;
    margin-bottom: 1.25rem;
}

/* Description */
.carto-desc {
    font-size: 0.95rem;
    color: #6b7280;
    line-height: 1.7;
    margin-bottom: 2.5rem;
    max-width: 420px;
}

/* KPI Grid — 2×2 */
.carto-kpi-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1px;
    background: #e5e7eb;
    border: 1px solid #e5e7eb;
    border-radius: 20px;
    overflow: hidden;
}

/* KPI Cell */
.carto-kpi {
    background: #fff;
    padding: 1.5rem 1.25rem 1.25rem;
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    transition: background 0.3s ease;
    cursor: default;
}

.carto-kpi:hover {
    background: #f8fffe;
}

/* KPI Big Number */
.carto-kpi-number {
    font-size: 2.2rem;
    font-weight: 900;
    line-height: 1;
    letter-spacing: -0.02em;
}

/* KPI Icon badge */
.carto-kpi-icon-wrap {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 34px;
    height: 34px;
    border-radius: 10px;
    transition: transform 0.3s ease;
}

.carto-kpi:hover .carto-kpi-icon-wrap {
    transform: scale(1.15) rotate(6deg);
}

/* KPI Label */
.carto-kpi-label {
    font-size: 0.68rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: #9ca3af;
}

.cartographie-section {
    background-image: url('/assets/images/backgrounds/map-bg.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: scroll;
}

.region-info-panel {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(8px);
    border-radius: 24px;
    padding: 2.5rem;
}

/* Transitions Preuve Sociale */
.proof-fade-enter-active,
.proof-fade-leave-active {
    transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1);
}

.proof-fade-enter-from {
    opacity: 0;
    transform: translateX(-50px) scale(0.9);
}

.proof-fade-leave-to {
    opacity: 0;
    transform: translateX(-20px) scale(0.95);
}

.security-trust-section {
    background-color: #1a4132;
    position: relative;
}
.security-bg-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(26, 65, 50, 0.75) 0%, rgba(18, 45, 35, 0.70) 100%);
    z-index: 1;
}
.security-card {
    border-radius: 20px;
    background: rgba(255, 255, 255, 0.07);
    border: 1px solid rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.25);
    transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
}
.security-card:hover {
    transform: translateY(-8px);
    background: rgba(255, 255, 255, 0.12);
    border-color: rgba(237, 175, 17, 0.4);
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.35);
}
</style>
