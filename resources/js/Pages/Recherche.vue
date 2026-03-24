<script setup>
import { ref } from 'vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import { Link } from '@inertiajs/vue3';

const results = [
    { category: 'communique', tag: 'Communiqué', date: '12 oct. 2024', title: 'Démarrage du dénombrement', excerpt: 'Le Gouverneur informe les populations que les équipes sont actives.', imgClass: 'article-img--green' },
    { category: 'activite', tag: 'Activité', date: '8 oct. 2024', title: 'Cartographie achevée', excerpt: "L'INS annonce l'achèvement de la phase de cartographie.", imgClass: 'article-img--gold' },
    { category: 'publication', tag: 'Publication', date: '5 oct. 2024', title: 'Rapport préliminaire', excerpt: "L'Institut National de la Statistique publie le rapport.", imgClass: 'article-img--teal' }
];
</script>

<template>
    <MainLayout>
        <main class="actu-page" style="min-height: 70vh; padding: 80px 0;">
            <div class="container">
                <div class="section-header" style="text-align: left; margin-bottom: 30px;">
                    <h2 style="font-size: 38px; font-weight: 900; color: #295E4D; margin-bottom: 10px;">Résultats de recherche</h2>
                    <p style="color: #666; font-size: 16px;">Nous avons trouvé <strong>{{ results.length }}</strong> résultats correspondants à votre recherche.</p>
                </div>

                <div class="articles-grid" style="margin-top: 50px;">
                    <article v-for="(res, idx) in results" :key="idx" class="article-card">
                        <Link href="/article" class="article-card-link">
                            <div class="article-img" :class="res.imgClass"></div>
                            <div class="article-card-body">
                                <div class="article-meta">
                                    <span class="article-tag" :class="`tag-${res.category}`">{{ res.tag }}</span>
                                    <time class="article-date">{{ res.date }}</time>
                                </div>
                                <h3 class="article-card-title">{{ res.title }}</h3>
                                <p class="article-card-excerpt">{{ res.excerpt }}</p>
                                <span class="article-read-more">Lire la suite</span>
                            </div>
                        </Link>
                    </article>
                </div>

                <div v-if="results.length > 0" class="pagination" style="margin-top: 60px;">
                    <button class="page-btn">Précédent</button>
                    <div class="page-numbers">
                        <button class="page-num active">1</button>
                    </div>
                    <button class="page-btn">Suivant</button>
                </div>

                <div v-else style="text-align: center; padding: 50px; background: #f9f9f9; border-radius: 20px; border: 1px dashed #DDD;">
                    <p style="color: #888; font-size: 18px;">Aucun résultat trouvé pour votre recherche.</p>
                </div>

            </div>
        </main>
    </MainLayout>
</template>
