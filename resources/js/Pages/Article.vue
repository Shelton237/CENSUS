<script setup>
import { ref } from 'vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    article: Object,
    recentArticles: Array
});
</script>

<template>
    <MainLayout>
        <main class="article-detail-page">
            <!-- Hero dynamique -->
            <section class="relative pt-32 pb-20 overflow-hidden bg-[#204138]">
                <div class="absolute inset-0 z-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
                <div class="container relative z-10 text-center">
                    <nav class="flex justify-center items-center gap-2 text-white/50 text-sm mb-5">
                        <Link href="/" class="hover:text-white/80 transition-colors">{{ __('Accueil') }}</Link>
                        <span>/</span>
                        <Link href="/actualites" class="hover:text-white/80 transition-colors">{{ __('Actualités') }}</Link>
                        <span>/</span>
                        <span class="text-white/70">{{ __('Article') }}</span>
                    </nav>
                    <span class="inline-block py-1 px-3 rounded-full bg-[#EDAF11]/20 text-[#EDAF11] font-bold text-sm tracking-widest uppercase mb-4">{{ __(article.tag) }}</span>
                    <h1 class="text-3xl md:text-4xl font-black text-white mb-5 leading-tight max-w-3xl mx-auto">{{ article.title }}</h1>
                    <p class="text-white/60 text-sm flex items-center justify-center gap-4">
                        <span>{{ __('Publié le') }} {{ article.date }}</span>
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            {{ article.views || 0 }} {{ __('vues') }}
                        </span>
                    </p>
                </div>
            </section>

            <div class="container article-layout" style="margin-top: 40px; display: grid; grid-template-columns: 1fr 340px; gap: 60px;">
                <!-- Article Content Left -->
                <div class="article-left">
                    <div class="article-featured-img" style="width: 100%; height: 450px; background: #eee; border-radius: 12px; margin-bottom: 30px; overflow: hidden;">
                        <img :src="article.image || '/assets/images/accueil/495229d6739ec5d681e8f133d30bce3835dd8d3d.jpg'" :alt="article.title" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    
                    <div class="article-content-rich" style="line-height: 1.8; color: #333; font-size: 16px;" v-html="article.content">
                    </div>

                    <!-- Social Share -->
                    <div class="article-share" style="border-top: 1px solid #EEE; border-bottom: 1px solid #EEE; padding: 20px 0; margin-top: 50px; display: flex; align-items: center; gap: 15px;">
                        <span style="font-weight: bold; font-size: 14px;">{{ __('PARTAGER L\'ARTICLE :') }}</span>
                        <a href="#" class="share-btn-round" style="background:#3b5998; width:36px; height:36px; border-radius:50%; display:flex; align-items:center; justify-content:center;"><svg width="18" height="18" fill="white" viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg></a>
                        <a href="#" class="share-btn-round" style="background:#000; width:36px; height:36px; border-radius:50%; display:flex; align-items:center; justify-content:center;"><svg width="18" height="18" fill="white" viewBox="0 0 24 24"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg></a>
                    </div>
                </div>

                <!-- Documentation Sidebar Right -->
                <aside class="article-right">
                    <div class="doc-sidebar-card" style="background: #F8FAF9; padding: 25px; border-radius: 15px; border: 1px solid #E9F0EE; position: sticky; top: 120px;">
                        <h4 style="font-size: 18px; font-weight: 700; color: #295E4D; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                            {{ __('DOCUMENTS') }}
                        </h4>
                        <ul class="doc-list" style="list-style: none; display: flex; flex-direction: column; gap: 15px;">
                            <li><a href="#" class="doc-item-link" style="display: flex; justify-content: space-between; align-items: center; text-decoration: none; color: #444; font-size: 14px; padding-bottom: 10px; border-bottom: 1px solid #EEE;">
                                <span>{{ __('Note Circulaire No 2024-05') }}</span>
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#E8AA00" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                            </a></li>
                            <li><a href="#" class="doc-item-link" style="display: flex; justify-content: space-between; align-items: center; text-decoration: none; color: #444; font-size: 14px; padding-bottom: 10px; border-bottom: 1px solid #EEE;">
                                <span>{{ __('Décret de nomination') }}</span>
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#E8AA00" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                            </a></li>
                        </ul>
                    </div>
                </aside>
            </div>

            <!-- Autres Articles Slider -->
            <section class="other-articles-section" style="margin-top: 100px; padding: 60px 0; background: #FFF;">
                <div class="container">
                    <h2 class="other-articles-title" style="font-size: 28px; font-weight: 800; margin-bottom: 35px; color: #295E4D;">{{ __('Autres articles') }}</h2>
                    <div class="other-articles-grid" style="display: flex; gap: 24px; overflow-x: auto; scroll-snap-type: x mandatory; -ms-overflow-style: none; scrollbar-width: none; padding-bottom: 20px;">
                        <article v-for="(art, idx) in recentArticles" :key="idx" class="article-card" style="flex: 0 0 calc(31% - 16px); scroll-snap-align: start;">
                            <Link :href="route('actualites.show', art.slug)" class="article-card-link">
                                <div class="article-img" :class="art.imgClass || `article-img--${art.category === 'communique' ? 'green' : (art.category === 'activite' ? 'gold' : 'teal')}`"></div>
                                <div class="article-card-body">
                                    <div class="article-meta"><span class="article-tag" :class="`tag-${art.category}`">{{ __(art.tag) }}</span> <time class="article-date">{{ art.date }}</time></div>
                                    <h3 class="article-card-title">{{ art.title }}</h3>
                                    <span class="article-read-more">{{ __('Lire la suite') }}</span>
                                </div>
                            </Link>
                        </article>
                    </div>
                </div>
            </section>
        </main>
    </MainLayout>
</template>
