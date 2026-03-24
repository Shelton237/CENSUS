<script setup>
import { ref, onMounted } from 'vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import { Link, Head } from '@inertiajs/vue3';
import PartenairesCarousel from '@/Components/PartenairesCarousel.vue';
import CallCenterBanner from '@/Components/CallCenterBanner.vue';

// Slider state
const activeSlide = ref(0);
const slides = [
    { 
        image: '/assets/images/slides/phase_prepa.jpg', 
        title: 'Phase de Préparation', 
        text: "La phase préparatoire du 4<sup>ème</sup> RGPH et du RGAE mobilise toutes les ressources techniques et logistiques." 
    },
    { 
        image: '/assets/images/slides/phase_epc.jpg', 
        title: 'Recensement de Terrain', 
        text: "La collecte des données sur le terrain permet de cartographier précisément la population camerounaise." 
    },
    { 
        image: '/assets/images/slides/phase_analyse.jpg', 
        title: 'Traitement et Analyse', 
        text: "Des experts s'attellent à l'analyse rigoureuse des données collectées pour une planification optimale." 
    },
    { 
        image: '/assets/images/slides/phase_publication.jpg', 
        title: 'Diffusion des Résultats', 
        text: "La publication officielle des résultats finaux pour éclairer les politiques publiques de développement." 
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
                <span>⚠️ Le 4ème Recensement Général de la Population et de l'Habitat (RGPH) est en cours au Cameroun — Soyez comptés pour bâtir l'avenir de notre pays ! &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ⚠️ Participez massivement au dénombrement pour une planification précise du développement national.</span>
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
                            <h1 v-html="slide.title"></h1>
                            <p>{{ slide.text }}</p>
                            <a href="#" class="btn-read">Lire le contenu</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Flèches latérales -->
            <button @click="prevSlide" class="slider-arrow arrow-prev" id="slider-prev" aria-label="Précédent">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
            </button>
            <button @click="nextSlide" class="slider-arrow arrow-next" id="slider-next" aria-label="Suivant">
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
                    <span>Plus de 30 000 agents recenseurs mobilisés sur tout le territoire national</span>
                </div>
                <div class="info-item">
                    <span>Une technologie de collecte 100% numérique pour une fiabilité maximale</span>
                </div>
                <div class="info-item">
                    <span>Une planification stratégique basée sur des données démographiques fiables</span>
                </div>
            </div>
        </div>

        <!-- ===================== CHRONOGRAMME ===================== -->
        <section class="chronogramme-section" id="chronogramme">
            <div class="container">
                <div class="section-header chron-header">
                    <h2>Chronogramme</h2>
                    <p>Suivez le chronogramme des activités en temps réel</p>
                </div>

                <div class="timeline-wrapper">
                    <div class="timeline-row">
                        <div class="tl-endpoint tl-start">
                            <span>Début du<br>processus</span>
                        </div>
                        <div class="tl-phase completed">
                            <div class="tl-box">
                                <span class="tl-title">Cartographie</span>
                                <span class="tl-desc">Délimitation des zones de dénombrement (S1 2024).</span>
                            </div>
                        </div>
                        <div class="tl-phase active">
                            <div class="tl-now-marker">
                                <span>Nous sommes ici</span>
                                <svg width="22" height="30" viewBox="0 0 22 30" fill="none">
                                    <path d="M11 0C4.925 0 0 4.925 0 11C0 19.25 11 30 11 30C11 30 22 19.25 22 11C22 4.925 17.075 0 11 0Z" fill="#2E6B5E"/>
                                    <circle cx="11" cy="11" r="5" fill="#E8AA00"/>
                                </svg>
                            </div>
                            <div class="tl-box">
                                <span class="tl-title">Recensement Pilote</span>
                                <span class="tl-desc">Test grandeur nature sur zones échantillons (S2 2024).</span>
                            </div>
                        </div>
                        <div class="tl-phase upcoming">
                            <div class="tl-box">
                                <span class="tl-title">Dénombrement National</span>
                                <span class="tl-desc">Collecte nationale sur l'ensemble du territoire (2025).</span>
                            </div>
                        </div>
                        <div class="tl-phase upcoming">
                            <div class="tl-box">
                                <span class="tl-title">Analyse et Publication</span>
                                <span class="tl-desc">Traitement des données et diffusion des résultats finaux (2026).</span>
                            </div>
                        </div>
                        <div class="tl-endpoint tl-end">
                            <span>Fin du<br>processus</span>
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
                <h2 class="alaune-title">A la Une</h2>

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
                        <span class="tag">Événement</span>
                        <h3>Lancement officiel du RGPH</h3>
                        <p>Le Ministre de l'Économie a présidé la cérémonie de lancement du dénombrement pilote.</p>
                        <Link href="/article" class="alaune-link">Lire le contenu</Link>
                    </div>
                </div>

                <div class="alaune-cards-row">
                    <article class="article-card" data-category="communique">
                        <Link href="/article" class="article-card-link">
                            <div class="article-img article-img--green"></div>
                            <div class="article-card-body">
                                <div class="article-meta">
                                    <span class="article-tag tag-communique">Communiqué</span>
                                    <time class="article-date">12 oct. 2024</time>
                                </div>
                                <h3 class="article-card-title">Communiqué officiel : démarrage du dénombrement</h3>
                                <p class="article-card-excerpt">Le Gouverneur de la région du Centre informe les populations que les équipes de recensement sont désormais actives.</p>
                                <span class="article-read-more">Lire la suite</span>
                            </div>
                        </Link>
                    </article>

                    <article class="article-card" data-category="activite">
                        <Link href="/article" class="article-card-link">
                            <div class="article-img article-img--gold"></div>
                            <div class="article-card-body">
                                <div class="article-meta">
                                    <span class="article-tag tag-activite">Activité</span>
                                    <time class="article-date">8 oct. 2024</time>
                                </div>
                                <h3 class="article-card-title">Cartographie achevée : 98% des zones délimitées</h3>
                                <p class="article-card-excerpt">L'INS annonce l'achèvement de la phase de cartographie, avec 98% des zones de dénombrement délimitées.</p>
                                <span class="article-read-more">Lire la suite</span>
                            </div>
                        </Link>
                    </article>

                    <article class="article-card" data-category="publication">
                        <Link href="/article" class="article-card-link">
                            <div class="article-img article-img--teal"></div>
                            <div class="article-card-body">
                                <div class="article-meta">
                                    <span class="article-tag tag-publication">Publication</span>
                                    <time class="article-date">5 oct. 2024</time>
                                </div>
                                <h3 class="article-card-title">Rapport préliminaire de la phase de cartographie</h3>
                                <p class="article-card-excerpt">L'Institut National de la Statistique publie le rapport préliminaire de la phase de cartographie.</p>
                                <span class="article-read-more">Lire la suite</span>
                            </div>
                        </Link>
                    </article>
                </div>

                <div class="alaune-footer">
                    <Link href="/actualites" class="btn-green-pill">Voir plus de nouvelles</Link>
                </div>
            </div>
        </section>

        <!-- ===================== VISITEURS BANNER ===================== -->
        <section class="visitors-banner-section">
            <div class="visitors-banner-bg" style="background-image: url('/assets/images/accueil/495229d6739ec5d681e8f133d30bce3835dd8d3d.jpg')"></div>
            <div class="visitors-banner-overlay"></div>
            <div class="visitors-banner-content">
                <p class="visitors-banner-label">Visiteurs sur le site</p>
                <span class="visitors-banner-number">2 348 visiteurs</span>
                <p class="visitors-banner-sub">48 visiteurs aujourd'hui</p>
            </div>
        </section>

        <!-- ===================== RESEAUX SOCIAUX ===================== -->
        <section class="social-section" id="reseaux-sociaux">
            <div class="container">
                <div class="section-header" style="text-align:left; margin-bottom:28px;">
                    <h2>Réseaux sociaux</h2>
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
                        <p>Ensemble pour le développement ! Le recensement permet d'ajuster les services publics de santé et d'éducation... <a href="#" class="post-more">En voir plus</a></p>
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
                    <span>Suivez nous sur les réseaux sociaux</span>
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
        <PartenairesCarousel />
    </MainLayout>
</template>
