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
        <title>{{ __('Actualités') }}</title>
        <meta name="description" :content="__('Actualites description')">
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
            </div>
        </main>
    </MainLayout>
</template>
