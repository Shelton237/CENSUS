<script setup>
import { ref } from 'vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import { Link, Head } from '@inertiajs/vue3';

const activeFilter = ref('all');
const articles = [
    { category: 'communique', tag: 'Communiqué', date: '12 oct. 2024', title: 'Démarrage du dénombrement', excerpt: 'Le Gouverneur informe les populations que les équipes sont actives.', imgClass: 'article-img--green' },
    { category: 'activite', tag: 'Activité', date: '8 oct. 2024', title: 'Cartographie achevée', excerpt: "L'INS annonce l'achèvement de la phase de cartographie.", imgClass: 'article-img--gold' },
    { category: 'publication', tag: 'Publication', date: '5 oct. 2024', title: 'Rapport préliminaire', excerpt: "L'Institut National de la Statistique publie le rapport.", imgClass: 'article-img--teal' },
    { category: 'communique', tag: 'Communiqué', date: '01 oct. 2024', title: 'Note aux personnels', excerpt: 'Déploiement des équipes techniques sur le terrain.', imgClass: 'article-img--green' },
    { category: 'activite', tag: 'Activité', date: '25 sept. 2024', title: 'Formation des agents', excerpt: 'Séminaire de formation intensive pour les futurs agents.', imgClass: 'article-img--gold' },
    { category: 'publication', tag: 'Publication', date: '20 sept. 2024', title: 'Calendrier officiel', excerpt: 'Le chronogramme complet des activités pour 2024-2025.', imgClass: 'article-img--teal' }
];

const filteredArticles = () => {
    if (activeFilter.value === 'all') return articles;
    return articles.filter(a => a.category === activeFilter.value);
};
</script>

<template>
    <Head>
        <title>Actualités</title>
        <meta name="description" content="Découvrez les derniers communiqués, activités et rapports officiels du recensement national au Cameroun.">
    </Head>

    <MainLayout>
        <main class="actu-page" style="padding-top: 50px; padding-bottom: 80px;">
            <div class="container">
                <div class="section-header" style="text-align: left; margin-bottom: 40px;">
                    <h2 style="font-size: 38px; font-weight: 900;">Actualités</h2>
                    <p style="color: #666; font-size: 16px;">Toute l'actualité du Recensement au Cameroun</p>
                </div>

                <!-- FILTRES -->
                <nav class="filter-nav" style="margin-bottom: 50px;">
                    <button @click="activeFilter = 'all'" class="filter-btn" :class="{ active: activeFilter === 'all' }">Tout</button>
                    <button @click="activeFilter = 'communique'" class="filter-btn" :class="{ active: activeFilter === 'communique' }">Communiqué</button>
                    <button @click="activeFilter = 'activite'" class="filter-btn" :class="{ active: activeFilter === 'activite' }">Activité</button>
                    <button @click="activeFilter = 'publication'" class="filter-btn" :class="{ active: activeFilter === 'publication' }">Publication</button>
                </nav>

                <!-- GRILLE -->
                <div class="articles-grid">
                    <article v-for="(article, index) in filteredArticles()" :key="index" class="article-card">
                        <Link href="/article" class="article-card-link">
                            <div class="article-img" :class="article.imgClass"></div>
                            <div class="article-card-body">
                                <div class="article-meta">
                                    <span class="article-tag" :class="`tag-${article.category}`">{{ article.tag }}</span>
                                    <time class="article-date">{{ article.date }}</time>
                                </div>
                                <h3 class="article-card-title">{{ article.title }}</h3>
                                <p class="article-card-excerpt">{{ article.excerpt }}</p>
                                <span class="article-read-more">Lire la suite</span>
                            </div>
                        </Link>
                    </article>
                </div>

                <!-- PAGINATION -->
                <div class="pagination">
                    <button class="page-btn">Précédent</button>
                    <div class="page-numbers">
                        <button class="page-num active">1</button>
                        <button class="page-num">2</button>
                    </div>
                    <button class="page-btn">Suivant</button>
                </div>
            </div>
        </main>
    </MainLayout>
</template>
