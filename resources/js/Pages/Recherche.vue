<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    results: {
        type: Array,
        default: () => []
    },
    searchQuery: {
        type: String,
        default: ''
    }
});
</script>

<template>
    <MainLayout>
        <!-- Hero -->
        <section class="relative pt-32 pb-20 overflow-hidden bg-[#204138]">
            <div class="absolute inset-0 z-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
            <div class="container relative z-10 text-center">
                <span class="inline-block py-1 px-3 rounded-full bg-[#EDAF11]/20 text-[#EDAF11] font-bold text-sm tracking-widest uppercase mb-4">{{ __('Recherche') }}</span>
                <h1 class="text-4xl md:text-5xl font-black text-white mb-6 leading-tight">{{ __('Résultats de recherche') }}</h1>
                <p class="text-xl text-white/80 max-w-2xl mx-auto leading-relaxed">
                    <span v-if="searchQuery" class="block mb-2 text-white/60 font-semibold">{{ __('Recherche pour') }} : <strong class="text-[#EDAF11]">"{{ searchQuery }}"</strong></span>
                    <span v-if="results && results.length > 0"><strong class="text-[#EDAF11]">{{ results.length }}</strong> {{ results.length > 1 ? __('résultats trouvés') : __('résultat trouvé') }} {{ __('pour votre recherche') }}.</span>
                    <span v-else>{{ __('Aucun résultat ne correspond à votre recherche') }}.</span>
                </p>
            </div>
        </section>

        <main class="actu-page" style="min-height: 50vh; padding: 60px 0;">
            <div class="container">

                <div v-if="results && results.length > 0" class="articles-grid" style="margin-top: 50px;">
                    <article v-for="(res, idx) in results" :key="idx" class="article-card">
                        <Link :href="route('actualites.show', res.slug)" class="article-card-link">
                            <div class="article-img relative overflow-hidden" :class="!res.image && res.media_type !== 'video' ? (res.imgClass || `article-img--${res.category === 'communique' ? 'green' : (res.category === 'activite' ? 'gold' : 'teal')}`) : ''">
                                <img v-if="res.image" :src="'/storage/' + res.image" :alt="res.title" class="w-full h-full object-cover absolute inset-0">
                                <video
                                    v-else-if="res.media_type === 'video' && res.video"
                                    :src="'/storage/' + res.video"
                                    muted
                                    autoplay
                                    loop
                                    playsinline
                                    @timeupdate="(e) => { if (e.target.currentTime >= 5) e.target.currentTime = 0; }"
                                    class="w-full h-full object-cover absolute inset-0"
                                    style="pointer-events: none;"
                                ></video>
                                <!-- Video Play Badge Overlay -->
                                <div v-if="res.media_type === 'video'" class="absolute inset-0 bg-black/30 flex items-center justify-center transition-all">
                                    <span class="w-12 h-12 rounded-full bg-[#EDAF11] text-[#204138] flex items-center justify-center shadow-lg transform transition-all">
                                        <svg class="w-6 h-6 ml-0.5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                    </span>
                                </div>
                            </div>
                            <div class="article-card-body">
                                <div class="article-meta">
                                    <span class="article-tag" :class="`tag-${res.category}`">{{ __(res.tag) }}</span>
                                    <time class="article-date">{{ res.date }}</time>
                                </div>
                                <h3 class="article-card-title">{{ res.title }}</h3>
                                <p class="article-card-excerpt">{{ res.excerpt }}</p>
                                <span class="article-read-more">{{ __('Lire la suite') }}</span>
                            </div>
                        </Link>
                    </article>
                </div>

                <div v-else style="text-align: center; padding: 60px 20px; background: white; border-radius: 24px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05); border: 1px solid #ECECEC; max-w: 600px; margin: 50px auto;">
                    <div style="font-size: 48px; margin-bottom: 20px;">🔍</div>
                    <p style="color: #204138; font-weight: 800; font-size: 20px; margin-bottom: 10px;">{{ __('Aucun résultat trouvé') }}</p>
                    <p style="color: #666; font-size: 16px;">{{ __('Nous n\'avons trouvé aucun article correspondant à votre recherche') }} <span v-if="searchQuery">{{ __('pour') }} <strong style="color: #EDAF11;">"{{ searchQuery }}"</strong></span>.</p>
                </div>

            </div>
        </main>
    </MainLayout>
</template>
