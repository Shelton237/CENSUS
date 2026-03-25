<script setup>
import { ref } from 'vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import { Link, Head } from '@inertiajs/vue3';
</script>

<template>
    <Head>
        <title>{{ __('Activités') }}</title>
        <meta name="description" :content="__('Activites description')">
    </Head>

    <MainLayout>
        <!-- Hero -->
        <section class="relative pt-32 pb-20 overflow-hidden bg-[#204138]">
            <div class="absolute inset-0 z-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
            <div class="container relative z-10 text-center">
                <span class="inline-block py-1 px-3 rounded-full bg-[#EDAF11]/20 text-[#EDAF11] font-bold text-sm tracking-widest uppercase mb-4">{{ __('Calendrier') }}</span>
                <h1 class="text-4xl md:text-5xl font-black text-white mb-6 leading-tight">{{ __('Chronogramme des Activités') }}</h1>
                <p class="text-xl text-white/80 max-w-2xl mx-auto leading-relaxed">{{ __('Consultez les étapes clés du processus de recensement, de la conception à la publication.') }}</p>
            </div>
        </section>

        <!-- ===================== CHRONOGRAMME ===================== -->
        <section class="chron-page" style="padding: 60px 0; background: #FFF;">
            <div class="container">

                <div class="timeline-wrapper" style="margin-top: 50px;">
                    <div class="timeline-row">
                        <div class="tl-endpoint tl-start"><span>{{ __('Début du') }}<br>{{ __('processus') }}</span></div>
                        <div class="tl-phase completed"><div class="tl-box">{{ __('Conception') }}</div></div>
                        <div class="tl-phase completed"><div class="tl-box">{{ __('Cartographie') }}</div></div>
                        <div class="tl-phase active">
                            <div class="tl-now-marker">
                                <span>{{ __('Nous sommes ici') }}</span>
                                <svg width="20" height="28" viewBox="0 0 22 30" fill="none">
                                    <path d="M11 0C4.925 0 0 4.925 0 11C0 19.25 11 30 11 30C11 30 22 19.25 22 11C22 4.925 17.075 0 11 0Z" fill="#2E6B5E"/>
                                    <circle cx="11" cy="11" r="5" fill="#E8AA00"/>
                                </svg>
                            </div>
                            <div class="tl-box">{{ __('Dénombrement') }}</div>
                        </div>
                        <div class="tl-phase upcoming"><div class="tl-box">{{ __('Saisie des données') }}</div></div>
                        <div class="tl-phase upcoming"><div class="tl-box">{{ __('Publication') }}</div></div>
                        <div class="tl-endpoint tl-end"><span>{{ __('Fin du') }}<br>{{ __('processus') }}</span></div>
                    </div>
                    <div class="tl-axis-line" style="top: 104px;"></div>
                    <div class="tl-years-row" style="margin-top: 40px;">
                        <div></div>
                        <span class="tl-year">2024</span><span class="tl-year">2025</span><span class="tl-year">2026</span><span class="tl-year">2027</span>
                        <div></div>
                    </div>
                </div>

                <!-- Phase Details -->
                <div class="phases-detail-grid" style="margin-top: 100px; display: grid; gap: 40px;">
                    <div class="phase-panel" style="background: #F8FAF9; padding: 40px; border-radius: 20px; border: 1px solid #E9F0EE; display: grid; grid-template-columns: 1fr 300px; gap: 60px;">
                        <div class="phase-text">
                            <span class="article-tag tag-activite" style="margin-bottom: 20px;">{{ __('Phase Actuelle') }}</span>
                            <h2 style="font-size: 32px; font-weight: 900; color: #295E4D; margin-bottom: 20px;">{{ __('Le dénombrement principal') }}</h2>
                            <p style="color: #555; font-size: 16px; line-height: 1.8; margin-bottom: 20px;">{{ __('Dénombrement principal desc') }}</p>
                            <Link href="/article" class="btn-read" style="background: #295E4D; color: white;">{{ __('Voir les détails de la phase') }}</Link>
                        </div>
                        <div class="phase-stats" style="background:white; padding: 30px; border-radius: 12px; border: 1px solid #EEE; text-align: center;">
                            <span style="display: block; font-size: 14px; font-weight: 700; color: #888; margin-bottom: 10px; text-transform: uppercase;">{{ __('Progression estimée') }}</span>
                            <span style="display: block; font-size: 48px; font-weight: 900; color: #E8AA00;">64%</span>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </MainLayout>
</template>
