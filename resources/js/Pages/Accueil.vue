<script setup>
import { ref, onMounted } from 'vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import { Link, Head } from '@inertiajs/vue3';
import PartenaireCarousel from '@/Components/PartenaireCarousel.vue';
import CallCenterBanner from '@/Components/CallCenterBanner.vue';
import CarteInteractive from '@/Components/CarteInteractive.vue';

const props = defineProps({
    partners: Array,
    latestArticles: Array
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

onMounted(() => {
    setInterval(nextSlide, 7000);
    setTimeout(animateStats, 500);
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

const hoveredRegionData = ref(null);

const handleRegionHover = (region) => {
    hoveredRegionData.value = regionalStats.value[region.id] || null;
};

const handleRegionLeave = () => {
    hoveredRegionData.value = null;
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
        <section class="carte-section py-24 relative overflow-hidden cartographie-section" id="carte-regions">
            <div class="container relative z-10 w-full max-w-7xl mx-auto px-4">
                <div class="flex flex-col lg:flex-row items-center gap-12">
                    <div class="lg:w-1/2 w-full text-center lg:text-left">
                        <h2 class="text-4xl md:text-5xl font-black text-[#204138] mb-6 leading-tight">
                            {{ __('Découvrez votre région') }}
                        </h2>
                        <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                            {{ __('Explorez les données statistiques et le déploiement des agents recenseurs dans les 10 régions du Cameroun via notre carte interactive. Survolez une région pour plus de détails.') }}
                        </p>
                        
                        <!-- Panneau de statistiques d'informations -->
                        <div class="region-info-panel min-h-[220px] bg-white rounded-3xl p-8 shadow-xl border border-gray-100 transition-all duration-300 relative overflow-hidden">
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
        </section>

        <!-- ===================== A LA UNE ===================== -->
        <section class="alaune-section" id="a-la-une" v-if="latestArticles && latestArticles.length > 0">
            <div class="container">
                <h2 class="alaune-title">{{ __('A la Une') }}</h2>

                <!-- Hero News (First one) -->
                <div class="alaune-hero group cursor-pointer" v-if="latestArticles[0]">
                    <Link :href="route('actualites.show', latestArticles[0].slug)" class="flex flex-col lg:flex-row w-full overflow-hidden rounded-3xl bg-white shadow-xl hover:shadow-2xl transition-all border border-gray-100">
                        <div class="alaune-hero-img-wrap lg:w-3/5 overflow-hidden">
                            <img :src="latestArticles[0].image ? `/storage/${latestArticles[0].image}` : '/assets/images/accueil/495229d6739ec5d681e8f133d30bce3835dd8d3d.jpg'" 
                                 :alt="latestArticles[0].title"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        </div>
                        <div class="alaune-hero-card lg:w-2/5 p-10 flex flex-col justify-center">
                            <span class="tag mb-4 shadow-sm" :class="`tag-${latestArticles[0].category}`">{{ __(latestArticles[0].tag) }}</span>
                            <h3 class="text-3xl font-black text-[#204138] mb-4 leading-tight group-hover:text-[#EDAF11] transition-colors">{{ latestArticles[0].title }}</h3>
                            <p class="text-gray-500 mb-8 leading-relaxed">{{ latestArticles[0].excerpt }}</p>
                            <div class="alaune-link !mt-auto flex items-center gap-2 font-bold text-[#204138]">
                                {{ __('Lire le contenu') }}
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </div>
                        </div>
                    </Link>
                </div>

                <!-- Secondary News (Next 3) -->
                <div class="alaune-cards-row mt-12">
                    <article v-for="(article, index) in latestArticles.slice(1)" :key="index" class="article-card" :data-category="article.category">
                        <Link :href="route('actualites.show', article.slug)" class="article-card-link">
                            <div class="article-img overflow-hidden" :class="article.imgClass || `article-img--${article.category === 'communique' ? 'green' : (article.category === 'activite' ? 'gold' : 'teal')}`">
                                <img v-if="article.image" :src="`/storage/${article.image}`" class="w-full h-full object-cover">
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

        <!-- ===================== VISITEURS BANNER ===================== -->
        <section class="visitors-banner-section">
            <div class="visitors-banner-bg" style="background-image: url('/assets/images/accueil/495229d6739ec5d681e8f133d30bce3835dd8d3d.jpg')"></div>
            <div class="visitors-banner-overlay"></div>
            <div class="visitors-banner-content">
                <p class="visitors-banner-label">{{ __('Visiteurs sur le site') }}</p>
                <span class="visitors-banner-number">{{ __('2 348 visiteurs') }}</span>
                <p class="visitors-banner-sub">{{ __('48 visiteurs aujourd\'hui') }}</p>
            </div>
        </section>

        <!-- ===================== RESEAUX SOCIAUX ===================== -->
        <section class="social-section" id="reseaux-sociaux">
            <div class="container">
                <div class="section-header" style="text-align:left; margin-bottom:28px;">
                    <h2>{{ __('Réseaux sociaux') }}</h2>
                </div>
                <div class="social-feed-grid">
                    <!-- Les posts sociaux sont reproduits à l'identique -->
                    <div class="social-post" v-for="i in 5" :key="i">
                        <div class="post-header">
                            <img src="/assets/images/logo-rgae.jpg" alt="Organisme" class="post-avatar">
                            <div class="post-meta">
                                <strong>Census Kamerun</strong>
                                <span class="post-handle">@CensusCam · March 24</span>
                            </div>
                        </div>
                        <p>{{ __('Social post content') }} <a href="#" class="post-more">{{ __('En voir plus') }}</a></p>
                        <div class="post-img-wrap">
                            <img src="/assets/images/accueil/495229d6739ec5d681e8f133d30bce3835dd8d3d.jpg" alt="Post image">
                        </div>
                        <div class="post-footer">
                            <div class="post-stats"><span>24 ❤</span><span>↩ 12</span><span>♺ 5</span></div>
                            <span class="post-tag">Facebook</span>
                        </div>
                    </div>
                </div>

                <div class="follow-us-banner">
                    <span>{{ __('Suivez nous sur les réseaux sociaux') }}</span>
                    <div class="follow-icons">
                        <a href="#" class="follow-icon fb"><svg width="22" height="22" viewBox="0 0 24 24" fill="white"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg></a>
                        <a href="#" class="follow-icon x"><svg width="22" height="22" viewBox="0 0 24 24" fill="white"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg></a>
                        <a href="#" class="follow-icon ig"><svg width="22" height="22" viewBox="0 0 24 24" fill="white"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path></svg></a>
                    </div>
                </div>
            </div>
        </section>

        <!-- ===================== CALL CENTER ===================== -->
        <CallCenterBanner />

        <!-- ===================== PARTENAIRES ===================== -->
        <PartenaireCarousel :partners="partners" />
    </MainLayout>
</template>
+
+<style scoped>
+.cartographie-section {
+    background-image: linear-gradient(rgba(255, 255, 255, 0.88), rgba(255, 255, 255, 0.88)), 
+                      url('https://census-cameroon.com/assets/images/slider/revolution/bg13.jpg');
+    background-size: cover;
+    background-position: center;
+    background-repeat: no-repeat;
+    background-attachment: scroll; /* safer than fixed for now */
+}
+</style>
