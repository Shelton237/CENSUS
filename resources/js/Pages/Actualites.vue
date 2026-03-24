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
        <main class="actu-page" style="padding-top: 50px; padding-bottom: 80px;">
            <div class="container">
                <div class="section-header" style="text-align: left; margin-bottom: 40px;">
                    <h2 style="font-size: 38px; font-weight: 900;">{{ __('Actualités') }}</h2>
                    <p style="color: #666; font-size: 16px;">{{ __('Toute l\'actualité du Recensement au Cameroun') }}</p>
                </div>

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
                            <div class="article-img" :class="article.imgClass || `article-img--${article.category === 'communique' ? 'green' : (article.category === 'activite' ? 'gold' : 'teal')}`"></div>
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
