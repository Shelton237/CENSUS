<script setup>
import { ref } from 'vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import { Link, Head } from '@inertiajs/vue3';
</script>

<template>
    <Head>
        <title>{{ __('À Propos') }}</title>
        <meta name="description" :content="__('En savoir plus sur le 4ème Recensement Général de la Population et de l\'Habitat et le Recensement Général de l\'Agriculture et de l\'Élevage - Cameroun 2024')">
    </Head>

    <MainLayout>
        <!-- ===================== MAIN CONTENT ===================== -->
        <main class="inner-page">
            <div class="container">

                <!-- Breadcrumb -->
                <nav class="breadcrumb" aria-label="Fil d'Ariane">
                    <Link :href="route('accueil')" class="bc-link">{{ __('Accueil') }}</Link>
                    <span class="bc-sep">/</span>
                    <span class="bc-current">{{ __('A propos') }}</span>
                </nav>

                <!-- Page Title -->
                <h1 class="page-title">
                    {{ __('A propos du Recensement Général') }}
                </h1>

                <!-- Main Layout : Content + Sidebar -->
                <div class="inner-layout">

                    <!-- Content Column -->
                    <div class="content-col">

                        <!-- Section 1 -->
                        <article class="content-section">
                            <h2 class="section-title">{{ __('Présentation du Recensement') }}</h2>
                            <div class="section-with-image">
                                <div class="section-text">
                                    <p>{{ __('Le Cameroun s\'apprête à réaliser le 4ème Recensement Général de la Population et de l\'Habitat (RGPH4), combiné pour la première fois avec le Recensement Général de l\'Agriculture et de l\'Élevage (RGAE). Cette opération d\'envergure nationale constitue un outil fondamental de planification du développement.') }}</p>
                                    <p>{{ __('Ce double recensement permettra de collecter des données démographiques, socio-économiques et agricoles essentielles pour orienter les politiques publiques, la distribution des ressources, et la planification de services essentiels tels que l\'éducation, la santé, l\'eau et l\'assainissement.') }}</p>
                                    <p>{{ __('Vingt ans après le dernier dénombrement, le Cameroun est sur le point d\'organiser un événement statistique majeur qui permettra de disposer de données actualisées sur la population et les ménages, l\'agriculture et l\'élevage, ainsi que le cadre de vie.') }}</p>
                                    <a href="#" class="doc-pill">
                                        {{ __('Rapport XXXXXX/XX') }}
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21.44 11.05l-9.19 9.19a6 6 0 01-8.49-8.49l9.19-9.19a4 4 0 015.66 5.66l-9.2 9.19a2 2 0 01-2.83-2.83l8.49-8.48"></path></svg>
                                    </a>
                                </div>
                                <div class="section-image">
                                    <img src="/assets/images/apropos-placeholder.jpg" alt="Recensement Général" onerror="this.style.display='none';this.parentElement.classList.add('img-placeholder')">
                                </div>
                            </div>
                        </article>

                        <!-- Section 2 -->
                        <article class="content-section">
                            <h2 class="section-title">{{ __('Objectifs du Recensement') }}</h2>
                            <p>{{ __('Le recensement général poursuit plusieurs objectifs stratégiques visant à doter le Cameroun d\'une base de données statistiques fiable et actualisée :') }}</p>
                            <ul class="content-list">
                                <li>{{ __('Dénombrer et localiser l\'ensemble de la population résidant sur le territoire national.') }}</li>
                                <li>{{ __('Collecter des informations socio-démographiques sur les ménages et les individus.') }}</li>
                                <li>{{ __('Répertorier les exploitations agricoles, les élevages et les activités connexes.') }}</li>
                                <li>{{ __('Fournir des données désagrégées pour la planification au niveau régional et local.') }}</li>
                                <li>{{ __('Alimenter les indicateurs de développement durable et de suivi des programmes nationaux.') }}</li>
                            </ul>
                            <p>{{ __('Ce recensement constitue la principale source de référence pour l\'actualisation des projections démographiques, la délimitation des circonscriptions administratives et la mise à jour des registres officiels.') }}</p>
                            <a href="#" class="doc-pill">
                                {{ __('Rapport XXXXXX/XX') }}
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21.44 11.05l-9.19 9.19a6 6 0 01-8.49-8.49l9.19-9.19a4 4 0 015.66 5.66l-9.2 9.19a2 2 0 01-2.83-2.83l8.49-8.48"></path></svg>
                            </a>
                        </article>

                        <!-- Section 3 -->
                        <article class="content-section">
                            <h2 class="section-title">{{ __('Cadre Juridique et Institutionnel') }}</h2>
                            <p>{{ __('La réalisation du RGPH4/RGAE repose sur un cadre juridique solide, composé de plusieurs textes législatifs et réglementaires qui définissent les responsabilités des différents acteurs et garantissent la confidentialité des données collectées.') }}</p>
                            <p>{{ __('Le recensement est placé sous la tutelle du Ministère de l\'Économie, de la Planification et de l\'Aménagement du Territoire, avec l\'appui technique de l\'Institut National de la Statistique (INS). Il est financé conjointement par l\'État camerounais et ses partenaires techniques et financiers, notamment l\'UNFPA, la Banque Mondiale, la FAO et le PNUD.') }}</p>
                            <p>{{ __('Conformément aux principes fondamentaux de la statistique officielle des Nations Unies, les données collectées sont strictement confidentielles et ne peuvent être utilisées qu\'à des fins statistiques. Aucune information individuelle ne peut être divulguée ou utilisée à des fins administratives, judiciaires ou fiscales.') }}</p>
                            <a href="#" class="doc-pill">
                                {{ __('Décret XXXXXXX/XXXX') }}
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21.44 11.05l-9.19 9.19a6 6 0 01-8.49-8.49l9.19-9.19a4 4 0 015.66 5.66l-9.2 9.19a2 2 0 01-2.83-2.83l8.49-8.48"></path></svg>
                            </a>
                        </article>

                    </div>

                    <!-- Sidebar Documentation -->
                    <aside class="sidebar-col">
                        <div class="sidebar-card">
                            <h3 class="sidebar-title">{{ __('Documentation') }}</h3>
                            <p class="sidebar-subtitle">{{ __('Les documentations de cette phase (décrets, publications)') }}</p>
                            <ul class="doc-list">
                                <li v-for="i in 6" :key="i">
                                    <a href="#" class="doc-item">
                                        <span>{{ __('Décret XXXXXXX/XXXX') }}</span>
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21.44 11.05l-9.19 9.19a6 6 0 01-8.49-8.49l9.19-9.19a4 4 0 015.66 5.66l-9.2 9.19a2 2 0 01-2.83-2.83l8.49-8.48"></path></svg>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </aside>

                </div>
            </div>
        </main>
    </MainLayout>
</template>

<style scoped>
@import "../../css/inner.css";
</style>
