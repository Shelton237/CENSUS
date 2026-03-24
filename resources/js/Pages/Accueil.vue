<script setup>
import { ref, onMounted } from 'vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import { Link, Head } from '@inertiajs/vue3';
import PartenaireCarousel from '@/Components/PartenaireCarousel.vue';
import CallCenterBanner from '@/Components/CallCenterBanner.vue';

const props = defineProps({
    partners: Array,
    latestArticles: Array
});

// Slider state
const activeSlide = ref(0);
const slides = [
    { 
        image: '/assets/images/slides/495229d6739ec5d681e8f133d30bce3835dd8d3d.jpg', 
        title: 'Phase de Préparation', 
        text: 'La phase préparatoire' 
    },
    { 
        image: '/assets/images/slides/phase_epc.jpg', 
        title: 'Recensement de Terrain', 
        text: 'La collecte des données' 
    },
    { 
        image: '/assets/images/slides/phase_analyse.jpg', 
        title: 'Traitement et Analyse', 
        text: 'Des experts s\'attellent' 
    },
    { 
        image: '/assets/images/slides/495229d6739ec5d681e8f133d30bce3835dd8d3d.jpg', 
        title: 'Diffusion des Résultats', 
        text: 'La publication officielle' 
    }
];

const nextSlide = () => {
    activeSlide.value = (activeSlide.value + 1) % slides.length;
};

const prevSlide = () => {
    activeSlide.value = (activeSlide.value - 1 + slides.length) % slides.length;
};

onMounted(() => {
    setInterval(nextSlide, 5000);
});
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
                <span>{{ __('Annonce défilement') }}</span>
            </div>
        </div>

        <!-- ===================== HERO SLIDER ===================== -->
        <section class="hero-slider" id="hero">
            <div class="slides-track">
                <div v-for="(slide, index) in slides" :key="index" 
                     class="slide" :class="{ active: activeSlide === index }">
                    <div class="slide-bg" :style="{ backgroundImage: `url(${slide.image})` }"></div>
                    <div class="slide-overlay"></div>
                    <div class="container slide-content">
                        <div class="hero-card">
                            <h1 v-html="__(slide.title)"></h1>
                            <p v-html="__(slide.text)"></p>
                            <Link href="/article" class="btn-read">{{ __('En savoir plus') }}</Link>
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

        <!-- Bandeau info sous le slider -->
        <div class="hero-infobar">
            <div class="container infobar-inner">
                <div class="info-item">
                    <span>{{ __('Mobilisation Info') }}</span>
                </div>
                <div class="info-item">
                    <span>{{ __('Technologie Info') }}</span>
                </div>
                <div class="info-item">
                    <span>{{ __('Planification Info') }}</span>
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

        <!-- ===================== A LA UNE ===================== -->
        <section class="alaune-section" id="a-la-une">
            <div class="container">
                <h2 class="alaune-title">{{ __('A la Une') }}</h2>

                <div class="alaune-hero">
                    <div class="alaune-hero-img-wrap">
                        <img src="/assets/images/accueil/495229d6739ec5d681e8f133d30bce3835dd8d3d.jpg" alt="À la une">
                        <div class="alaune-dots">
                            <span class="dot active"></span>
                            <span class="dot"></span>
                            <span class="dot"></span>
                        </div>
                    </div>
                    <div class="alaune-hero-card">
                        <span class="tag">{{ __('Événement') }}</span>
                        <h3>{{ __('Lancement officiel du RGPH') }}</h3>
                        <p>{{ __('Le Ministre de l\'Économie') }}</p>
                        <Link href="/article" class="alaune-link">{{ __('Lire le contenu') }}</Link>
                    </div>
                </div>

                <div class="alaune-cards-row">
                    <article v-for="(article, index) in latestArticles" :key="index" class="article-card" :data-category="article.category">
                        <Link :href="route('actualites.show', article.slug)" class="article-card-link">
                            <div class="article-img" :class="article.imgClass || `article-img--${article.category === 'communique' ? 'green' : (article.category === 'activite' ? 'gold' : 'teal')}`"></div>
                            <div class="article-card-body">
                                <div class="article-meta">
                                    <span class="article-tag" :class="`tag-${article.category}`">{{ __(article.tag) }}</span>
                                    <time class="article-date">{{ article.date }}</time>
                                </div>
                                <h3 class="article-card-title">{{ article.title }}</h3>
                                <p class="article-card-excerpt">{{ article.excerpt }}</p>
                                <span class="article-read-more">{{ __('Lire la suite') }}</span>
                            </div>
                        </Link>
                    </article>
                </div>

                <div class="alaune-footer">
                    <Link href="/actualites" class="btn-green-pill">{{ __('Voir plus de nouvelles') }}</Link>
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
