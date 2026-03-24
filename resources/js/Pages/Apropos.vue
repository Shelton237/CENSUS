<script setup>
import { ref } from 'vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import { Link, Head } from '@inertiajs/vue3';
</script>

<template>
    <Head>
        <title>{{ __('À propos') }}</title>
        <meta name="description" :content="__('Apropos description')">
    </Head>

    <MainLayout>
        <main class="inner-page" style="padding: 80px 0; background: #FFF;">
            <div class="container">
                <nav class="breadcrumb" style="margin-bottom: 20px;">
                    <Link href="/">{{ __('Accueil') }}</Link> &gt; 
                    <span>{{ __('A propos') }}</span>
                </nav>
                <div class="section-header" style="text-align: left; margin-bottom: 50px;">
                    <h1 style="font-size: 42px; font-weight: 900; color: #295E4D; margin-bottom: 15px;">{{ __('A propos du Recensement') }}</h1>
                    <p style="color: #666; font-size: 18px; max-width: 800px;">{{ __('Comprendre les enjeux') }}</p>
                </div>

                <div class="inner-content-grid" style="display: grid; grid-template-columns: 1fr 340px; gap: 60px;">
                    <div class="inner-left">
                        <section style="margin-bottom: 60px;">
                            <h2 style="font-size: 28px; font-weight: 800; color: #2E6B5E; margin-bottom: 20px; border-bottom: 2px solid #F0F0F0; padding-bottom: 10px;">{{ __('Pourquoi un recensement ?') }}</h2>
                            <p style="font-size: 16px; color: #444; line-height: 1.8; margin-bottom: 20px;">{{ __('Pourquoi desc') }}</p>
                        </section>

                        <section style="margin-bottom: 60px;">
                            <h2 style="font-size: 28px; font-weight: 800; color: #2E6B5E; margin-bottom: 20px; border-bottom: 2px solid #F0F0F0; padding-bottom: 10px;">{{ __('Nos principaux objectifs') }}</h2>
                            <ul style="list-style: none; display: grid; gap: 15px;">
                                <li style="display: flex; align-items: flex-start; gap: 12px; font-size: 16px; color: #444;">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#E8AA00" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    <span>{{ __('Objectif 1') }}</span>
                                </li>
                                <li style="display: flex; align-items: flex-start; gap: 12px; font-size: 16px; color: #444;">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#E8AA00" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    <span>{{ __('Objectif 2') }}</span>
                                </li>
                            </ul>
                        </section>
                    </div>

                    <aside class="inner-right">
                        <div style="background: #F8FAF9; padding: 25px; border-radius: 15px; border: 1px solid #E9F0EE;">
                            <h4 style="font-weight: 900; color: #295E4D; margin-bottom: 15px;">{{ __('COORDONNÉ PAR') }}</h4>
                            <p style="font-size: 14px; color: #666; margin-bottom: 20px;">{{ __('BUCREP desc') }}</p>
                        </div>
                    </aside>
                </div>
            </div>
        </main>
    </MainLayout>
</template>
