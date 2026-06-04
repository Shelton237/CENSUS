<script setup>
import { ref } from 'vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import { Link, Head } from '@inertiajs/vue3';

const props = defineProps({
    articles: Array
});

const activeFilter = ref('all');

const filteredArticles = () => {
    if (activeFilter.value === 'all') return props.articles;
    return props.articles.filter(a => a.category === activeFilter.value);
};
</script>

<template>
    <Head>
        <title>Actualités / Communiqués | RGPH4 Cameroun</title>
        <meta name="description" content="Découvrez les derniers communiqués, actualités et rapports officiels du recensement national au Cameroun.">
        <meta property="og:title" content="Actualités / Communiqués | RGPH4 Cameroun">
        <meta property="og:description" content="Communiqués officiels, activités et publications du 4ème Recensement Général de la Population et de l'Habitat du Cameroun.">
        <meta property="og:image" content="https://census.diginova.cm/assets/images/backgrounds/cameroon_people_map.png">
        <meta property="og:type" content="website">
        <meta property="og:locale" content="fr_FR">
        <meta property="og:site_name" content="Recensement Cameroun 2026">
        <meta property="og:url" content="https://census.diginova.cm/actualites">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@recensement90">
        <meta name="twitter:title" content="Actualités | RGPH4 Cameroun">
        <meta name="twitter:image" content="https://census.diginova.cm/assets/images/backgrounds/cameroon_people_map.png">
    </Head>

    <MainLayout>
        <!-- Hero -->
        <section class="relative pt-32 pb-20 overflow-hidden bg-[#204138]">
            <div class="absolute inset-0 z-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
            <div class="container relative z-10 text-center">
                <span class="inline-block py-1 px-3 rounded-full bg-[#EDAF11]/20 text-[#EDAF11] font-bold text-sm tracking-widest uppercase mb-4">{{ __('Presse & Médias') }}</span>
                <h1 class="text-4xl md:text-5xl font-black text-white mb-6 leading-tight">{{ __('Actualités') }}</h1>
                <p class="text-xl text-white/80 max-w-2xl mx-auto leading-relaxed">{{ __('Toute l\'actualité du Recensement Général de la Population et de l\'Habitat du Cameroun.') }}</p>
            </div>
        </section>

        <main class="actu-page" style="padding-top: 60px; padding-bottom: 80px;">
            <div class="container">
                <!-- FILTRES -->
                <nav class="filter-nav" style="margin-bottom: 50px;">
                    <button @click="activeFilter = 'all'" class="filter-btn" :class="{ active: activeFilter === 'all' }">{{ __('Tout') }}</button>
                    <button @click="activeFilter = 'communique'" class="filter-btn" :class="{ active: activeFilter === 'communique' }">{{ __('Communiqué') }}</button>
                    <button @click="activeFilter = 'activite'" class="filter-btn" :class="{ active: activeFilter === 'activite' }">{{ __('Activité') }}</button>
                    <button @click="activeFilter = 'publication'" class="filter-btn" :class="{ active: activeFilter === 'publication' }">{{ __('Publication') }}</button>
                </nav>

                <!-- GRILLE -->
                <div class="articles-grid">
                    <article v-for="(article, index) in filteredArticles()" :key="index" class="article-card">
                        <Link :href="route('actualites.show', article.slug)" class="article-card-link">
                            <div class="article-img relative overflow-hidden" :class="!article.image && article.media_type !== 'video' ? (article.imgClass || `article-img--${article.category === 'communique' ? 'green' : (article.category === 'activite' ? 'gold' : 'teal')}`) : ''">
                                <img v-if="article.image" :src="'/storage/' + article.image" :alt="article.title" class="w-full h-full object-cover absolute inset-0">
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
                                <div v-if="article.media_type === 'video'" class="absolute inset-0 bg-black/30 flex items-center justify-center group-hover:bg-black/40 transition-all">
                                    <span class="w-12 h-12 rounded-full bg-[#EDAF11] text-[#204138] flex items-center justify-center shadow-lg transform group-hover:scale-110 transition-all">
                                        <svg class="w-6 h-6 ml-0.5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                    </span>
                                </div>
                            </div>
                            <div class="article-card-body">
                                <div class="article-meta">
                                    <span class="article-tag" :class="`tag-${article.category}`">{{ __(article.tag) }}</span>
                                    <time class="article-date">{{ article.date }}</time>
                                </div>
                                <h3 class="article-card-title">{{ __(article.title) }}</h3>
                                <p class="article-card-excerpt">{{ __(article.excerpt) }}</p>
                                <span class="article-read-more">{{ __('Lire la suite') }}</span>
                            </div>
                        </Link>
                    </article>
                </div>

                <!-- PAGINATION -->
                <div class="pagination">
                    <button class="page-btn">{{ __('Précédent') }}</button>
                    <div class="page-numbers">
                        <button class="page-num active">1</button>
                        <button class="page-num">2</button>
                    </div>
                    <button class="page-btn">{{ __('Suivant') }}</button>
                </div>

                <!-- ===================== ESPACE PRESSE ===================== -->
                <section class="mt-24 pt-16 border-t border-[#204138]/10">

                    <!-- En-tête institutionnel -->
                    <div class="mb-10">
                        <span class="text-[11px] font-semibold uppercase tracking-[0.18em] text-[#EDAF11] block mb-2">Pour les journalistes & médias</span>
                        <h2 class="text-2xl md:text-3xl font-bold text-[#204138] leading-snug">Espace Presse</h2>
                        <p class="text-sm text-[#204138]/50 mt-2 max-w-xl">Retrouvez tous les outils et ressources destinés aux médias et journalistes couvrant le 4ème RGPH du Cameroun.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                        <!-- Dossier de presse -->
                        <div class="bg-[#F7F9F8] border-l-4 border-[#204138] p-6">
                            <div class="w-10 h-10 bg-[#204138] flex items-center justify-center mb-5 rounded-lg">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <h3 class="font-bold text-[#204138] text-base mb-2">Dossier de Presse</h3>
                            <p class="text-xs text-gray-500 mb-6 leading-relaxed">Présentation officielle du 4ème RGPH et RGAE, faits clés, chiffres de référence et informations à destination des médias.</p>
                            <div class="p-3 bg-white border border-[#204138]/10 rounded-lg mb-4">
                                <p class="text-[10px] font-bold uppercase tracking-[0.12em] text-[#204138]/50 mb-1">Disponible sur demande</p>
                                <a href="mailto:recensement90@gmail.com?subject=Demande%20dossier%20de%20presse%20RGPH4"
                                   class="text-xs font-semibold text-[#204138] hover:text-[#EDAF11] transition-colors no-underline break-all">
                                    recensement90@gmail.com
                                </a>
                            </div>
                        </div>

                        <!-- Contact presse -->
                        <div class="bg-[#204138] border-l-4 border-[#EDAF11] p-6">
                            <div class="w-10 h-10 bg-[#EDAF11] flex items-center justify-center mb-5 rounded-lg">
                                <svg class="w-5 h-5 text-[#204138]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <h3 class="font-bold text-white text-base mb-5">Contact Presse</h3>
                            <div class="space-y-4">
                                <a href="tel:+237693873145"
                                   class="flex items-center gap-3 no-underline group">
                                    <span class="w-7 h-7 bg-white/10 flex items-center justify-center rounded-lg flex-shrink-0 group-hover:bg-[#EDAF11] transition-colors duration-200">
                                        <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                    </span>
                                    <span class="text-sm font-semibold text-white/85 group-hover:text-white transition-colors">(+237) 6 93 87 31 45</span>
                                </a>
                                <a href="mailto:recensement90@gmail.com"
                                   class="flex items-center gap-3 no-underline group">
                                    <span class="w-7 h-7 bg-white/10 flex items-center justify-center rounded-lg flex-shrink-0 group-hover:bg-[#EDAF11] transition-colors duration-200">
                                        <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                    </span>
                                    <span class="text-sm font-semibold text-white/85 group-hover:text-white transition-colors">recensement90@gmail.com</span>
                                </a>
                                <a href="https://m.me/Cameroon-CENSUS-2026" target="_blank" rel="noopener noreferrer"
                                   class="flex items-center gap-3 no-underline group">
                                    <span class="w-7 h-7 bg-white/10 flex items-center justify-center rounded-lg flex-shrink-0 group-hover:bg-[#EDAF11] transition-colors duration-200">
                                        <svg class="w-3.5 h-3.5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.477 2 2 6.145 2 11.243c0 2.908 1.438 5.504 3.688 7.2V22l3.37-1.85c.9.249 1.853.383 2.942.383 5.523 0 10-4.145 10-9.243C22 6.145 17.523 2 12 2zm1.007 12.433l-2.548-2.717-4.973 2.717 5.472-5.808 2.61 2.717 4.91-2.717-5.471 5.808z"/></svg>
                                    </span>
                                    <span class="text-sm font-semibold text-white/85 group-hover:text-white transition-colors">Cameroon-CENSUS-2026</span>
                                </a>
                            </div>
                        </div>

                        <!-- Kit média -->
                        <div class="bg-[#F7F9F8] border-l-4 border-[#EDAF11] p-6">
                            <div class="w-10 h-10 bg-[#EDAF11]/15 flex items-center justify-center mb-5 rounded-lg">
                                <svg class="w-5 h-5 text-[#B8860B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <h3 class="font-bold text-[#204138] text-base mb-2">Kit Média</h3>
                            <p class="text-xs text-gray-500 mb-5 leading-relaxed">Logos officiels, éléments graphiques et photographies de terrain en haute résolution à usage éditorial.</p>
                            <div class="space-y-2">
                                <a href="/assets/images/badge.png" download
                                   class="flex items-center justify-between py-2.5 px-3 bg-white border border-[#204138]/8 hover:border-[#204138]/30 text-xs font-semibold text-[#204138] transition-colors duration-200 no-underline rounded-lg">
                                    <span>Logo RGPH4 officiel</span>
                                    <svg class="w-3.5 h-3.5 text-[#204138]/40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                </a>
                                <a href="/assets/images/logo-rgae.jpg" download
                                   class="flex items-center justify-between py-2.5 px-3 bg-white border border-[#204138]/8 hover:border-[#204138]/30 text-xs font-semibold text-[#204138] transition-colors duration-200 no-underline rounded-lg">
                                    <span>Logo RGAE officiel</span>
                                    <svg class="w-3.5 h-3.5 text-[#204138]/40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                </a>
                                <Link href="/phototheque"
                                   class="flex items-center justify-between py-2.5 px-3 bg-[#204138] hover:bg-[#2b5549] text-xs font-bold text-white transition-colors duration-200 no-underline rounded-lg">
                                    <span>Photothèque officielle</span>
                                    <svg class="w-3.5 h-3.5 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </Link>
                            </div>
                        </div>

                    </div>
                </section>

            </div>
        </main>
    </MainLayout>
</template>
