<script setup>
import { ref } from 'vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import { Link, Head } from '@inertiajs/vue3';
</script>

<template>
    <Head>
        <title>Activités</title>
        <meta name="description" content="Consultez le chronogramme officiel et suivez l'évolution en temps réel des différentes phases du 4ème RGPH au Cameroun.">
    </Head>

    <MainLayout>
        <!-- ===================== CHRONOGRAMME ===================== -->
        <section class="chron-page" style="padding: 100px 0; background: #FFF;">
            <div class="container">
                <div class="section-header" style="text-align: left; margin-bottom: 60px;">
                    <nav class="breadcrumb" style="margin-bottom: 20px;">
                        <Link href="/">Accueil</Link> &gt; 
                        <span>Activités</span>
                    </nav>
                    <h1 style="font-size: 42px; font-weight: 900; color: #295E4D; margin-bottom: 15px;">Chronogramme des Activités</h1>
                    <p style="color: #666; font-size: 18px; max-width: 800px;">Consultez les étapes clés du processus de recensement et le suivi en temps réel de chaque phase du projet.</p>
                </div>

                <div class="timeline-wrapper" style="margin-top: 50px;">
                    <div class="timeline-row">
                        <div class="tl-endpoint tl-start"><span>Début du<br>processus</span></div>
                        <div class="tl-phase completed"><div class="tl-box">Conception</div></div>
                        <div class="tl-phase completed"><div class="tl-box">Cartographie</div></div>
                        <div class="tl-phase active">
                            <div class="tl-now-marker">
                                <span>Nous sommes ici</span>
                                <svg width="20" height="28" viewBox="0 0 22 30" fill="none">
                                    <path d="M11 0C4.925 0 0 4.925 0 11C0 19.25 11 30 11 30C11 30 22 19.25 22 11C22 4.925 17.075 0 11 0Z" fill="#2E6B5E"/>
                                    <circle cx="11" cy="11" r="5" fill="#E8AA00"/>
                                </svg>
                            </div>
                            <div class="tl-box">Dénombrement</div>
                        </div>
                        <div class="tl-phase upcoming"><div class="tl-box">Saisie des données</div></div>
                        <div class="tl-phase upcoming"><div class="tl-box">Publication</div></div>
                        <div class="tl-endpoint tl-end"><span>Fin du<br>processus</span></div>
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
                            <span class="article-tag tag-activite" style="margin-bottom: 20px;">Phase Actuelle</span>
                            <h2 style="font-size: 32px; font-weight: 900; color: #295E4D; margin-bottom: 20px;">Le dénombrement principal</h2>
                            <p style="color: #555; font-size: 16px; line-height: 1.8; margin-bottom: 20px;">Cette phase consiste à collecter les données socio-démographiques auprès de chaque ménage sur toute l'étendue du territoire national.</p>
                            <Link href="/article" class="btn-read" style="background: #295E4D; color: white;">Voir les détails de la phase</Link>
                        </div>
                        <div class="phase-stats" style="background:white; padding: 30px; border-radius: 12px; border: 1px solid #EEE; text-align: center;">
                            <span style="display: block; font-size: 14px; font-weight: 700; color: #888; margin-bottom: 10px; text-transform: uppercase;">Progression estimée</span>
                            <span style="display: block; font-size: 48px; font-weight: 900; color: #E8AA00;">64%</span>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </MainLayout>
</template>
