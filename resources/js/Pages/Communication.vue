<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const page = usePage();
const __ = (key) => page.props.translations?.[key] || key;

const props = defineProps({
    videos: { type: Array, default: () => [] },
});

const categories = computed(() => [
    { id: 'all',             label: __('comm_cat_all') },
    { id: 'confidentialite', label: __('comm_cat_confidentialite') },
    { id: 'obligation',      label: __('comm_cat_obligation') },
    { id: 'securite',        label: __('comm_cat_securite') },
    { id: 'resultats',       label: __('comm_cat_resultats') },
]);

const faqs = computed(() => [
    { cat: 'confidentialite', q: __('comm_faq1_q'), a: __('comm_faq1_a') },
    { cat: 'confidentialite', q: __('comm_faq2_q'), a: __('comm_faq2_a') },
    { cat: 'confidentialite', q: __('comm_faq3_q'), a: __('comm_faq3_a') },
    { cat: 'obligation',      q: __('comm_faq4_q'), a: __('comm_faq4_a') },
    { cat: 'obligation',      q: __('comm_faq5_q'), a: __('comm_faq5_a') },
    { cat: 'obligation',      q: __('comm_faq6_q'), a: __('comm_faq6_a') },
    { cat: 'securite',        q: __('comm_faq7_q'), a: __('comm_faq7_a') },
    { cat: 'securite',        q: __('comm_faq8_q'), a: __('comm_faq8_a') },
    { cat: 'resultats',       q: __('comm_faq9_q'), a: __('comm_faq9_a') },
]);

const facts = computed(() => [
    { num: '26 M+',  label: __('comm_fact1_label'), sub: __('comm_fact1_sub') },
    { num: '10 ans', label: __('comm_fact2_label'), sub: __('comm_fact2_sub') },
    { num: '100 %',  label: __('comm_fact3_label'), sub: __('comm_fact3_sub') },
    { num: '360+',   label: __('comm_fact4_label'), sub: __('comm_fact4_sub') },
]);

const messages = computed(() => [
    { num: '01', title: __('comm_msg1_title'), desc: __('comm_msg1_desc'), icon: 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z' },
    { num: '02', title: __('comm_msg2_title'), desc: __('comm_msg2_desc'), icon: 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4' },
    { num: '03', title: __('comm_msg3_title'), desc: __('comm_msg3_desc'), icon: 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z' },
    { num: '04', title: __('comm_msg4_title'), desc: __('comm_msg4_desc'), icon: 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z' },
]);

const activeTab = ref('all');
const openFaq  = ref(null);

const filteredFaqs = computed(() =>
    activeTab.value === 'all' ? faqs.value : faqs.value.filter(f => f.cat === activeTab.value)
);

const toggleFaq = (i) => { openFaq.value = openFaq.value === i ? null : i; };
const setTab = (id) => { activeTab.value = id; openFaq.value = null; };
</script>

<template>
    <Head>
        <title>Communication & Sensibilisation | RGPH4 & RGAE Cameroun</title>
        <meta name="description" content="Réponses aux rumeurs, messages clés et spots de sensibilisation sur le 4ème Recensement Général de la Population et de l'Habitat du Cameroun.">
        <meta property="og:title" content="Communication & Sensibilisation RGPH4">
        <meta property="og:image" content="https://census.diginova.cm/assets/images/backgrounds/cameroon_people_map.png">
    </Head>

    <MainLayout>

        <!-- ══ HERO ══ -->
        <section class="bg-[#204138] pt-28 pb-0 relative overflow-hidden">
            <div class="absolute inset-0 opacity-[0.04]" style="background-image: repeating-linear-gradient(0deg, #fff 0px, #fff 1px, transparent 1px, transparent 40px), repeating-linear-gradient(90deg, #fff 0px, #fff 1px, transparent 1px, transparent 40px);"></div>

            <div class="container max-w-6xl mx-auto px-4 relative z-10">
                <nav class="flex items-center gap-2 text-xs text-white/40 mb-8">
                    <a href="/accueil" class="hover:text-white/70 transition-colors">{{ __('Accueil') }}</a>
                    <span>/</span>
                    <span class="text-white/70">{{ __('comm_breadcrumb') }}</span>
                </nav>

                <div class="max-w-3xl pb-12">
                    <p class="text-[#EDAF11] text-xs font-bold uppercase tracking-[0.18em] mb-4">{{ __('comm_hero_overline') }}</p>
                    <h1 class="text-4xl md:text-5xl font-black text-white leading-[1.1] mb-5">{{ __('comm_hero_title') }}</h1>
                    <p class="text-white/65 text-base leading-relaxed max-w-xl">{{ __('comm_hero_subtitle') }}</p>
                </div>
            </div>

            <!-- Stat strip -->
            <div class="bg-white/5 border-t border-white/10">
                <div class="container max-w-6xl mx-auto px-4">
                    <div class="grid grid-cols-2 md:grid-cols-4 divide-x divide-white/10">
                        <div v-for="f in facts" :key="f.num" class="px-6 py-5">
                            <div class="text-2xl font-black text-white tabular-nums mb-0.5">{{ f.num }}</div>
                            <div class="text-xs font-semibold text-[#EDAF11]">{{ f.label }}</div>
                            <div class="text-[10px] text-white/40 mt-0.5">{{ f.sub }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="bg-white">

            <!-- ══ MESSAGES CLÉS ══ -->
            <section class="border-b border-gray-100">
                <div class="container max-w-6xl mx-auto px-4 py-16">
                    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-10">
                        <div>
                            <p class="text-[#EDAF11] text-xs font-bold uppercase tracking-[0.18em] mb-2">{{ __('comm_section_messages_overline') }}</p>
                            <h2 class="text-2xl md:text-3xl font-black text-[#204138]">{{ __('comm_section_messages_title') }}</h2>
                        </div>
                        <p class="text-sm text-gray-400 max-w-xs text-right hidden md:block">{{ __('comm_section_messages_sub') }}</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-px bg-gray-100">
                        <div v-for="m in messages" :key="m.num"
                             class="bg-white p-8 flex gap-6 group hover:bg-[#204138]/[0.02] transition-colors">
                            <div class="text-4xl font-black text-gray-100 group-hover:text-[#EDAF11]/30 transition-colors leading-none select-none shrink-0 tabular-nums">{{ m.num }}</div>
                            <div class="pt-1">
                                <div class="flex items-start gap-3 mb-3">
                                    <div class="w-8 h-8 bg-[#204138]/8 rounded-md flex items-center justify-center shrink-0">
                                        <svg class="w-4 h-4 text-[#204138]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="m.icon"/>
                                        </svg>
                                    </div>
                                    <h3 class="font-bold text-[#204138] text-sm leading-snug pt-1">{{ m.title }}</h3>
                                </div>
                                <p class="text-sm text-gray-500 leading-relaxed">{{ m.desc }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ══ SPOTS VIDÉO ══ -->
            <section class="border-b border-gray-100 bg-gray-50">
                <div class="container max-w-6xl mx-auto px-4 py-16">
                    <div class="mb-10">
                        <p class="text-[#EDAF11] text-xs font-bold uppercase tracking-[0.18em] mb-2">{{ __('comm_section_videos_overline') }}</p>
                        <h2 class="text-2xl md:text-3xl font-black text-[#204138]">{{ __('comm_section_videos_title') }}</h2>
                    </div>

                    <div v-if="videos && videos.length > 0" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div v-for="video in videos" :key="video.id" class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm">
                            <div class="aspect-video">
                                <iframe :src="`https://www.youtube.com/embed/${video.youtube_id}`"
                                        class="w-full h-full" frameborder="0" allowfullscreen
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"/>
                            </div>
                            <div class="px-5 py-4 border-t border-gray-100">
                                <h3 class="font-bold text-[#204138] text-sm">{{ video.title }}</h3>
                                <p v-if="video.description" class="text-xs text-gray-500 mt-1 leading-relaxed">{{ video.description }}</p>
                            </div>
                        </div>
                    </div>

                    <div v-else class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div v-for="i in 2" :key="i" class="bg-white border border-gray-200 rounded-lg overflow-hidden">
                            <div class="aspect-video bg-[#204138]/4 flex flex-col items-center justify-center gap-3 relative">
                                <span class="absolute top-3 right-3 bg-[#204138] text-white text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded">{{ __('comm_video_soon') }}</span>
                                <div class="w-14 h-14 bg-white/60 border border-[#204138]/10 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-[#204138]/30" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                </div>
                                <p class="text-xs text-[#204138]/40 font-medium">{{ __('comm_video_bucrep_label') }}</p>
                            </div>
                            <div class="px-5 py-4 border-t border-gray-100">
                                <div class="h-3 bg-gray-100 rounded w-2/3 mb-2"></div>
                                <div class="h-2 bg-gray-100 rounded w-2/5"></div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex items-center gap-4 text-xs text-gray-400">
                        <span>{{ __('comm_social_follow') }}</span>
                        <a href="https://www.facebook.com/profile.php?id=61562950229317" target="_blank" rel="noopener"
                           class="flex items-center gap-1.5 text-[#204138] hover:underline font-medium">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            Facebook RGPH4
                        </a>
                        <a href="https://x.com/recensement90" target="_blank" rel="noopener"
                           class="flex items-center gap-1.5 text-[#204138] hover:underline font-medium">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.741l7.73-8.835L1.254 2.25H8.08l4.253 5.622 5.91-5.622zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                            X (Twitter)
                        </a>
                    </div>
                </div>
            </section>

            <!-- ══ FAQ ══ -->
            <section class="border-b border-gray-100">
                <div class="container max-w-6xl mx-auto px-4 py-16">
                    <div class="mb-10">
                        <p class="text-[#EDAF11] text-xs font-bold uppercase tracking-[0.18em] mb-2">{{ __('comm_section_faq_overline') }}</p>
                        <h2 class="text-2xl md:text-3xl font-black text-[#204138] mb-1">{{ __('comm_section_faq_title') }}</h2>
                        <p class="text-sm text-gray-400">{{ __('comm_section_faq_sub') }}</p>
                    </div>

                    <!-- Tabs -->
                    <div class="flex flex-wrap gap-2 mb-8">
                        <button v-for="cat in categories" :key="cat.id"
                                @click="setTab(cat.id)"
                                :class="[
                                    'px-4 py-2 text-xs font-semibold rounded-md border transition-colors cursor-pointer',
                                    activeTab === cat.id
                                        ? 'bg-[#204138] text-white border-[#204138]'
                                        : 'bg-white text-gray-600 border-gray-200 hover:border-[#204138]/40 hover:text-[#204138]'
                                ]">
                            {{ cat.label }}
                        </button>
                    </div>

                    <!-- Accordion -->
                    <div class="divide-y divide-gray-100 border border-gray-200 rounded-lg overflow-hidden">
                        <div v-for="(faq, i) in filteredFaqs" :key="faq.q">
                            <button type="button" @click="toggleFaq(i)"
                                    class="w-full px-6 py-5 text-left flex items-start justify-between gap-5 hover:bg-gray-50 transition-colors cursor-pointer group">
                                <div class="flex items-start gap-4">
                                    <span class="text-[11px] font-black text-[#EDAF11] tabular-nums mt-0.5 shrink-0 w-5">{{ String(i + 1).padStart(2, '0') }}</span>
                                    <span class="text-sm font-semibold text-gray-800 leading-snug group-hover:text-[#204138] transition-colors">{{ faq.q }}</span>
                                </div>
                                <svg class="w-4 h-4 text-gray-400 shrink-0 transition-transform duration-200 mt-0.5"
                                     :class="openFaq === i ? 'rotate-180 text-[#204138]' : ''"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div v-show="openFaq === i" class="bg-[#204138]/[0.025]">
                                <div class="ml-6 pl-4 border-l-2 border-[#EDAF11] py-4 pr-6">
                                    <p class="text-sm text-gray-600 leading-relaxed">{{ faq.a }}</p>
                                </div>
                            </div>
                        </div>
                        <div v-if="filteredFaqs.length === 0" class="px-6 py-10 text-center text-sm text-gray-400">
                            {{ __('Aucune question dans cette catégorie.') }}
                        </div>
                    </div>
                </div>
            </section>

            <!-- ══ OUTILS ══ -->
            <section class="border-b border-gray-100 bg-gray-50">
                <div class="container max-w-6xl mx-auto px-4 py-16">
                    <div class="mb-10">
                        <p class="text-[#EDAF11] text-xs font-bold uppercase tracking-[0.18em] mb-2">{{ __('comm_section_tools_overline') }}</p>
                        <h2 class="text-2xl md:text-3xl font-black text-[#204138]">{{ __('comm_section_tools_title') }}</h2>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <a href="/ressources" class="bg-white border border-gray-200 rounded-lg p-6 flex flex-col gap-4 hover:shadow-md hover:border-[#204138]/20 transition-all group">
                            <div class="w-10 h-10 bg-[#204138]/8 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-[#204138]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-[#204138] text-sm mb-1 group-hover:underline">{{ __('comm_tool1_title') }}</h3>
                                <p class="text-xs text-gray-500 leading-relaxed">{{ __('comm_tool1_desc') }}</p>
                            </div>
                            <div class="flex items-center gap-1 text-xs text-[#204138] font-semibold mt-auto">
                                {{ __('comm_tool1_cta') }}
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </div>
                        </a>

                        <a href="/phototheque" class="bg-white border border-gray-200 rounded-lg p-6 flex flex-col gap-4 hover:shadow-md hover:border-[#204138]/20 transition-all group">
                            <div class="w-10 h-10 bg-[#204138]/8 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-[#204138]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-[#204138] text-sm mb-1 group-hover:underline">{{ __('comm_tool2_title') }}</h3>
                                <p class="text-xs text-gray-500 leading-relaxed">{{ __('comm_tool2_desc') }}</p>
                            </div>
                            <div class="flex items-center gap-1 text-xs text-[#204138] font-semibold mt-auto">
                                {{ __('comm_tool2_cta') }}
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </div>
                        </a>

                        <a href="mailto:recensement90@gmail.com" class="bg-[#204138] rounded-lg p-6 flex flex-col gap-4 hover:bg-[#2b5549] transition-colors group">
                            <div class="w-10 h-10 bg-white/15 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-white text-sm mb-1">{{ __('comm_tool3_title') }}</h3>
                                <p class="text-xs text-white/60 leading-relaxed">{{ __('comm_tool3_desc') }}</p>
                            </div>
                            <div class="flex items-center gap-1 text-xs text-[#EDAF11] font-semibold mt-auto">
                                {{ __('comm_tool3_cta') }}
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </div>
                        </a>
                    </div>
                </div>
            </section>

            <!-- ══ CONTACT PRESSE ══ -->
            <section>
                <div class="container max-w-6xl mx-auto px-4 py-16">
                    <div class="border border-gray-200 rounded-lg overflow-hidden">
                        <div class="grid grid-cols-1 md:grid-cols-2">
                            <div class="p-8 md:p-10 border-b md:border-b-0 md:border-r border-gray-200">
                                <p class="text-[#EDAF11] text-xs font-bold uppercase tracking-[0.18em] mb-3">{{ __('comm_press_overline') }}</p>
                                <h2 class="text-xl font-black text-[#204138] mb-3">{{ __('comm_press_title') }}</h2>
                                <p class="text-sm text-gray-500 leading-relaxed mb-6">{{ __('comm_press_sub') }}</p>
                                <ul class="space-y-3 text-sm">
                                    <li class="flex items-center gap-3 text-gray-600">
                                        <svg class="w-4 h-4 text-[#EDAF11] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        {{ __('comm_press_li1') }}
                                    </li>
                                    <li class="flex items-center gap-3 text-gray-600">
                                        <svg class="w-4 h-4 text-[#EDAF11] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        {{ __('comm_press_li2') }}
                                    </li>
                                    <li class="flex items-center gap-3 text-gray-600">
                                        <svg class="w-4 h-4 text-[#EDAF11] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        {{ __('comm_press_li3') }}
                                    </li>
                                </ul>
                            </div>
                            <div class="p-8 md:p-10 bg-gray-50 flex flex-col justify-center gap-4">
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">{{ __('comm_press_contact_label') }}</p>
                                <a href="tel:+237693873145" class="flex items-center gap-4 bg-white border border-gray-200 rounded-lg px-5 py-4 hover:border-[#204138]/30 hover:shadow-sm transition-all">
                                    <div class="w-9 h-9 bg-[#204138]/8 rounded-md flex items-center justify-center shrink-0">
                                        <svg class="w-4 h-4 text-[#204138]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                    </div>
                                    <div>
                                        <p class="text-[10px] text-gray-400 uppercase tracking-wider">{{ __('comm_press_phone_label') }}</p>
                                        <p class="text-sm font-bold text-[#204138]">(+237) 6 93 87 31 45</p>
                                    </div>
                                </a>
                                <a href="mailto:recensement90@gmail.com" class="flex items-center gap-4 bg-white border border-gray-200 rounded-lg px-5 py-4 hover:border-[#204138]/30 hover:shadow-sm transition-all">
                                    <div class="w-9 h-9 bg-[#204138]/8 rounded-md flex items-center justify-center shrink-0">
                                        <svg class="w-4 h-4 text-[#204138]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                    </div>
                                    <div>
                                        <p class="text-[10px] text-gray-400 uppercase tracking-wider">{{ __('comm_press_email_label') }}</p>
                                        <p class="text-sm font-bold text-[#204138]">recensement90@gmail.com</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>

    </MainLayout>
</template>
