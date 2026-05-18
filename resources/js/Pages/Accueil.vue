<script setup>
import { ref, onMounted, computed } from 'vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import { Link, Head } from '@inertiajs/vue3';
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

// Slider state
const activeSlide = ref(0);
const slides = [
    { 
        image: '/assets/images/slides/495229d6739ec5d681e8f133d30bce3835dd8d3d.jpg', 
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
        image: '/assets/images/accueil/495229d6739ec5d681e8f133d30bce3835dd8d3d.jpg',
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
        image: '/assets/images/accueil/495229d6739ec5d681e8f133d30bce3835dd8d3d.jpg',
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
</script>

<template>
    <Head>
        <title>Accueil</title>
        <meta name="description" content="Suivez l'actualité, les activités et le chronogramme du recensement national au Cameroun. Soyez comptés !">
    </Head>

    <MainLayout>
        <!-- ===================== ANNONCE URGENTE ===================== -->
        <div class="announcement-bar" id="announcement-bar">
            <div class="scrolling-text">
                <span v-html="__('Annonce défilement')"></span>
            </div>
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
                                <Link :href="route('candidature')" class="bg-white/20 backdrop-blur-md text-white border border-white/30 px-8 py-4 rounded-full font-bold hover:bg-white/30 transition-all">
                                    {{ __('Devenir Agent Recenseur') }}
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

                <div class="timeline-wrapper">
                    <div class="timeline-row">
                        <div class="tl-endpoint tl-start">
                            <span>{{ __('Début du') }}<br>{{ __('processus') }}</span>
                        </div>
                        <div class="tl-phase completed">
                            <div class="tl-box">
                                <span class="tl-title">{{ __('Cartographie') }}</span>
                                <span class="tl-desc">{{ __('Cartographie desc') }}</span>
                            </div>
                        </div>
                        <div class="tl-phase active">
                            <div class="tl-now-marker">
                                <span>{{ __('Nous sommes ici') }}</span>
                                <svg width="22" height="30" viewBox="0 0 22 30" fill="none">
                                    <path d="M11 0C4.925 0 0 4.925 0 11C0 19.25 11 30 11 30C11 30 22 19.25 22 11C22 4.925 17.075 0 11 0Z" fill="#2E6B5E"/>
                                    <circle cx="11" cy="11" r="5" fill="#E8AA00"/>
                                </svg>
                            </div>
                            <div class="tl-box">
                                <span class="tl-title">{{ __('Recensement Pilote') }}</span>
                                <span class="tl-desc">{{ __('Recensement Pilote desc') }}</span>
                            </div>
                        </div>
                        <div class="tl-phase upcoming">
                            <div class="tl-box">
                                <span class="tl-title">{{ __('Dénombrement National') }}</span>
                                <span class="tl-desc">{{ __('Dénombrement National desc') }}</span>
                            </div>
                        </div>
                        <div class="tl-phase upcoming">
                            <div class="tl-box">
                                <span class="tl-title">{{ __('Analyse et Publication') }}</span>
                                <span class="tl-desc">{{ __('Analyse et Publication desc') }}</span>
                            </div>
                        </div>
                        <div class="tl-endpoint tl-end">
                            <span>{{ __('Fin du') }}<br>{{ __('processus') }}</span>
                        </div>
                    </div>

                    <div class="tl-axis-global">
                        <div class="tl-axis-line"></div>

                        <!-- Années -->
                        <div class="tl-years-row">
                            <div></div>
                            <span class="tl-year">2024</span>
                            <span class="tl-year">2025</span>
                            <span class="tl-year">2026</span>
                            <span class="tl-year">2027</span>
                            <div></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- ===================== CARTE INTERACTIVE ===================== -->
        <!-- <section class="carte-section py-24 relative overflow-hidden cartographie-section" id="carte-regions">
            <div class="container relative z-10 w-full max-w-7xl mx-auto px-4">
                <div class="flex flex-col lg:flex-row items-center gap-12">
                    <div class="lg:w-1/2 w-full text-center lg:text-left">
                        <h2 class="text-4xl md:text-5xl font-black text-[#204138] mb-6 leading-tight">
                            {{ __('Découvrez votre région') }}
                        </h2>
                        <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                            {{ __('Explorez les données statistiques et le déploiement des agents recenseurs dans les 10 régions du Cameroun via notre carte interactive. Survolez une région pour plus de détails.') }}
                        </p>
                        
                        <div class="region-info-panel">
                            <div v-if="hoveredRegionData" class="region-details">
                                <h3 class="text-3xl font-black text-[#EDAF11] mb-6">{{ __(hoveredRegionData.name) }}</h3>
                                <div class="grid grid-cols-2 gap-6">
                                    <div>
                                        <p class="text-sm text-gray-500 uppercase tracking-wider font-bold mb-1">{{ __('Population Estimée') }}</p>
                                        <p class="text-2xl font-bold text-[#204138]">{{ hoveredRegionData.population.toLocaleString() }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 uppercase tracking-wider font-bold mb-1">{{ __('Agents Pilotes') }}</p>
                                        <p class="text-2xl font-bold text-[#204138]">{{ hoveredRegionData.agents.toLocaleString() }}</p>
                                    </div>
                                    <div class="col-span-2 pt-4 border-t border-gray-100">
                                        <p class="text-sm text-gray-500 uppercase tracking-wider font-bold mb-1">{{ __('Superficie') }}</p>
                                        <p class="text-lg font-bold text-[#204138]">{{ hoveredRegionData.surface }}</p>
                                    </div>
                                </div>
                            </div>
                            <div v-else class="empty-state h-full flex flex-col items-center justify-center text-center opacity-50 py-10">
                                <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path></svg>
                                <p class="text-lg font-semibold text-gray-400">{{ __('Survolez une région sur la carte') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="lg:w-1/2 w-full lg:pl-16">
                        <CarteInteractive 
                            @region-hover="handleRegionHover"
                            @region-leave="handleRegionLeave"
                        />
                    </div>
                </div>
            </div>
            
            <div class="absolute top-0 right-0 -mr-32 -mt-32 w-96 h-96 rounded-full bg-[#EDAF11]/5 blur-3xl z-0 pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 -ml-32 -mb-32 w-[500px] h-[500px] rounded-full bg-[#204138]/5 blur-3xl z-0 pointer-events-none"></div>
        </section> -->

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
                            <img v-else :src="latestArticles[0].image ? `/storage/${latestArticles[0].image}` : '/assets/images/accueil/495229d6739ec5d681e8f133d30bce3835dd8d3d.jpg'" 
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
            <div v-if="showSocialProof" class="fixed bottom-8 left-8 z-[100] max-w-[320px]">
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
                            {{ ' ' + __(socialProofs[currentProofIndex].text) }}
                        </p>
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
                        <div class="widget-body flex-1 w-full overflow-y-auto rounded-2xl bg-[#f8faf9] border border-gray-100 flex flex-col items-center justify-center p-4">
                            <div class="w-full h-full flex flex-col justify-center">
                                <a 
                                    class="twitter-timeline w-full" 
                                    data-height="480" 
                                    data-theme="light"
                                    data-chrome="noheader nofooter noborders transparent"
                                    href="https://twitter.com/recensement90?ref_src=twsrc%5Etfw"
                                >
                                    <div class="text-center p-6 flex flex-col items-center justify-center h-full">
                                        <div class="animate-spin rounded-full h-10 w-10 border-t-2 border-b-2 border-[#204138] mb-4"></div>
                                        <p class="text-base font-bold text-[#204138] mb-2">{{ __('Chargement du fil X...') }}</p>
                                        <p class="text-xs text-gray-500 max-w-xs mx-auto leading-relaxed mb-6">
                                            {{ __('Si le fil ne s\'affiche pas, cela peut être dû à vos bloqueurs de contenu ou à la confidentialité de votre navigateur. Vous pouvez visiter notre profil officiel directement.') }}
                                        </p>
                                        <a href="https://x.com/recensement90" target="_blank" rel="noopener noreferrer" class="px-6 py-2.5 bg-[#204138] hover:bg-[#EDAF11] hover:text-[#204138] text-white font-bold text-sm rounded-full transition-all duration-300 shadow-md inline-block">
                                            {{ __('Visiter @recensement90') }}
                                        </a>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="follow-us-banner">
                    <span>{{ __('Suivez nous sur les réseaux sociaux') }}</span>
                    <div class="follow-icons">
                        <a href="https://www.facebook.com/profile.php?id=61562950229317" target="_blank" rel="noopener noreferrer" class="follow-icon fb"><svg width="22" height="22" viewBox="0 0 24 24" fill="white"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg></a>
                        <a href="https://x.com/recensement90" target="_blank" rel="noopener noreferrer" class="follow-icon x"><svg width="22" height="22" viewBox="0 0 24 24" fill="white"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg></a>
                        <a href="https://www.facebook.com/profile.php?id=61562950229317" target="_blank" rel="noopener noreferrer" class="follow-icon ig"><svg width="22" height="22" viewBox="0 0 24 24" fill="white"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path></svg></a>
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
