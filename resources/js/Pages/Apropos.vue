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
        <!-- Hero -->
        <section class="relative pt-32 pb-20 overflow-hidden bg-[#204138]">
            <div class="absolute inset-0 z-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
            <div class="container relative z-10 text-center">
                <span class="inline-block py-1 px-3 rounded-full bg-[#EDAF11]/20 text-[#EDAF11] font-bold text-sm tracking-widest uppercase mb-4">{{ __('Qui sommes-nous ?') }}</span>
                <h1 class="text-4xl md:text-5xl font-black text-white mb-6 leading-tight">{{ __('À Propos du Recensement') }}</h1>
                <p class="text-xl text-white/80 max-w-2xl mx-auto leading-relaxed">{{ __('Comprendre les enjeux, les objectifs et le cadre institutionnel du 4ème RGPH du Cameroun.') }}</p>
            </div>
        </section>

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

                        <!-- Section 1 : Contexte Historique & Mutualisation -->
                        <article class="content-section">
                            <h2 class="section-title">{{ __('Contexte Historique et Mutualisation') }}</h2>
                            <div class="section-with-image">
                                <div class="section-text">
                                    <p>{{ __('Le quatrième Recensement Général de la Population et de l\'Habitat (4ème RGPH) et le Recensement Général de l\'Agriculture et de l\'Élevage (RGAE) constituent des opérations statistiques de grande envergure pour la planification du développement du pays.') }}</p>
                                    <p>{{ __('Le 4ème RGPH est institué par Décret Présidentiel n°2015/397 du 15 septembre 2015 tandis que le RGAE est institué par Décret Présidentiel n°2015/292 du 29 juin 2015.') }}</p>
                                    <p>{{ __('Les activités de mutualisation ont été instruites en 2019 par le Premier Ministre, Chef du Gouvernement, dans l\'optique d\'optimiser les coûts liés à l\'opérationnalisation desdites activités.') }}</p>
                                </div>
                                <div class="section-image">
                                    <img src="/assets/images/apropos/contexte.webp" alt="Signature Décret" loading="lazy">
                                </div>
                            </div>
                        </article>

                        <!-- Section 2 : Objectifs -->
                        <article class="content-section">
                            <h2 class="section-title">{{ __('Objectifs du Recensement') }}</h2>
                            <div class="section-with-image mb-8">
                                <div class="section-text">
                                    <div class="flex flex-col gap-6">
                                        <div class="p-6 bg-green-50/50 border-l-4 border-[#204138] rounded-r-xl">
                                            <h4 class="font-black text-[#204138] mb-2 uppercase text-xs tracking-wider">{{ __('Objectif 4ème RGPH') }}</h4>
                                            <p class="!mb-0 italic text-gray-700">{{ __('Le 4ème RGPH a pour objectif général de rendre disponibles les données nécessaires à la planification du développement et à la prise en compte du dividende démographique dans l\'élaboration des politiques permettant l\'évolution du Cameroun vers l\'émergence.') }}</p>
                                        </div>
                                        <div class="p-6 bg-yellow-50/50 border-l-4 border-[#EDAF11] rounded-r-xl">
                                            <h4 class="font-black text-[#EDAF11] mb-2 uppercase text-xs tracking-wider">{{ __('Objectif RGAE') }}</h4>
                                            <p class="!mb-0 italic text-gray-700">{{ __('Le RGAE a en revanche pour objectif général de rendre disponibles les informations statistiques structurelles suffisamment désagrégées sur toutes les exploitations agropastorales et aquacoles, et à élaborer les bases de sondage pour les modules complémentaire et thématique et les enquêtes du Système Permanent et Intégré des Statistiques Agropastorales (SPISA).') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="section-image">
                                    <img src="/assets/images/apropos/objectifs.webp" alt="Formation des Agents" loading="lazy">
                                </div>
                            </div>
                        </article>

                        <!-- Section 3 : Utilité -->
                        <article class="content-section">
                            <h2 class="section-title">{{ __('Utilité du Recensement') }}</h2>
                            <p>{{ __('Cet instrument précieux permet le cadrage, l\'élaboration, le suivi et l\'évaluation des politiques publiques aux niveaux national, régional et local. Il sert de base pour :') }}</p>
                            <ul class="content-list">
                                <li>{{ __('L\'élaboration des bases de sondage pour les enquêtes inter-censitaires.') }}</li>
                                <li>{{ __('La planification des infrastructures de base (écoles, hôpitaux, routes).') }}</li>
                                <li>{{ __('La répartition équitable des ressources publiques.') }}</li>
                                <li>{{ __('Le suivi des engagements internationaux (ODD, Agenda 2063).') }}</li>
                            </ul>
                        </article>

                        <!-- Section 4 : Cadre Institutionnel -->
                        <article class="content-section">
                            <h2 class="section-title">{{ __('Cadre Institutionnel') }}</h2>
                            <div class="flex flex-col gap-5 mb-6">
                                <div class="apropos-decree-card">
                                    <div class="apropos-decree-icon">
                                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14,2 14,8 20,8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10,9 9,9 8,9"/></svg>
                                    </div>
                                    <div class="apropos-decree-body">
                                        <span class="apropos-decree-label">{{ __('Décret Présidentiel Officiel') }}</span>
                                        <p class="apropos-decree-text">{{ __('Le 4ème RGPH a été institué par le Décret Présidentiel N° 2015/397 du 15 septembre 2015, plaçant l\'opération sous la responsabilité technique du Bureau Central des Recensements et des Etudes de Population (BUCREP).') }}</p>
                                    </div>
                                </div>
                                <div class="apropos-decree-card apropos-decree-card--yellow">
                                    <div class="apropos-decree-icon apropos-decree-icon--yellow">
                                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                                    </div>
                                    <div class="apropos-decree-body">
                                        <span class="apropos-decree-label apropos-decree-label--yellow">{{ __('Recommandation des Nations Unies') }}</span>
                                        <p class="apropos-decree-text">{{ __('L\'ONU recommande aux pays membres de réaliser leur recensement général de la population tous les dix ans afin de disposer d\'indicateurs démographiques et socioprofessionnels actualisés, essentiels pour le cadrage des politiques de développement.') }}</p>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <!-- Section 5 : Les 7 Grandes Phases -->
                        <article class="content-section">
                            <h2 class="section-title">{{ __('Les 7 Grandes Phases du RGPH') }}</h2>
                            <p class="mb-8 text-gray-600 leading-relaxed">{{ __('Une opération de cette envergure se déroule de manière rigoureuse en plusieurs phases successives, du cadrage initial jusqu\'à la publication finale.') }}</p>
                            <div class="apropos-phases">

                                <div class="apropos-phase-item">
                                    <div class="apropos-phase-number">01</div>
                                    <div class="apropos-phase-card">
                                        <div class="apropos-phase-icon-wrap">
                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2M9 5a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2M9 5a2 2 0 0 0 2-2h2a2 2 0 0 0 2 2"/></svg>
                                        </div>
                                        <div class="apropos-phase-content">
                                            <h4 class="apropos-phase-title">{{ __('01. Activités Préparatoires') }}</h4>
                                            <p class="apropos-phase-desc">{{ __('Conception des méthodologies, élaboration des questionnaires, outils de collecte, manuels d\'instruction et mobilisation des ressources financières, matérielles et humaines.') }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="apropos-phase-item">
                                    <div class="apropos-phase-number">02</div>
                                    <div class="apropos-phase-card">
                                        <div class="apropos-phase-icon-wrap">
                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9,22 9,12 15,12 15,22"/></svg>
                                        </div>
                                        <div class="apropos-phase-content">
                                            <h4 class="apropos-phase-title">{{ __('02. Cartographie Censitaire') }}</h4>
                                            <p class="apropos-phase-desc">{{ __('Mise à jour exhaustive du fichier des localités et découpage du territoire national en zones de travail appelées Zones de Dénombrement (ZD). Un agent sera déployé par ZD.') }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="apropos-phase-item">
                                    <div class="apropos-phase-number">03</div>
                                    <div class="apropos-phase-card">
                                        <div class="apropos-phase-icon-wrap">
                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                                        </div>
                                        <div class="apropos-phase-content">
                                            <h4 class="apropos-phase-title">{{ __('03. Recensement Pilote') }}</h4>
                                            <p class="apropos-phase-desc">{{ __('Test grandeur nature de l\'ensemble de l\'organisation et des méthodologies sur un échantillon d\'environ 260 zones de dénombrement représentatives (urbaines et rurales).') }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="apropos-phase-item">
                                    <div class="apropos-phase-number apropos-phase-number--active">04</div>
                                    <div class="apropos-phase-card apropos-phase-card--active">
                                        <div class="apropos-phase-icon-wrap apropos-phase-icon-wrap--active">
                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                                        </div>
                                        <div class="apropos-phase-content">
                                            <h4 class="apropos-phase-title">{{ __('04. Dénombrement Principal') }}</h4>
                                            <p class="apropos-phase-desc">{{ __('Le comptage effectif de la population et la collecte des données auprès de chaque ménage par des agents recenseurs munis de smartphones. Répondre est une obligation civique.') }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="apropos-phase-item">
                                    <div class="apropos-phase-number">05</div>
                                    <div class="apropos-phase-card">
                                        <div class="apropos-phase-icon-wrap">
                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                                        </div>
                                        <div class="apropos-phase-content">
                                            <h4 class="apropos-phase-title">{{ __('05. Enquête Post-Censitaire (EPC)') }}</h4>
                                            <p class="apropos-phase-desc">{{ __('Réalisée au plus tard trois mois après le dénombrement principal pour évaluer la couverture géographique et la qualité des variables clés (sexe et âge) sur 12 strates.') }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="apropos-phase-item">
                                    <div class="apropos-phase-number">06</div>
                                    <div class="apropos-phase-card">
                                        <div class="apropos-phase-icon-wrap">
                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
                                        </div>
                                        <div class="apropos-phase-content">
                                            <h4 class="apropos-phase-title">{{ __('06. Exploitation et Analyse') }}</h4>
                                            <p class="apropos-phase-desc">{{ __('Traitement transversal, apurement rigoureux et analyse statistique approfondie pour élaborer les tomes d\'analyse prioritaires et les monographies régionales.') }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="apropos-phase-item">
                                    <div class="apropos-phase-number">07</div>
                                    <div class="apropos-phase-card">
                                        <div class="apropos-phase-icon-wrap">
                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"/><polyline points="16,6 12,2 8,6"/><line x1="12" y1="2" x2="12" y2="15"/></svg>
                                        </div>
                                        <div class="apropos-phase-content">
                                            <h4 class="apropos-phase-title">{{ __('07. Publication et Diffusion') }}</h4>
                                            <p class="apropos-phase-desc">{{ __('Mise à disposition et vulgarisation des résultats officiels sur supports variés et accessibles, afin de faciliter leur compréhension et utilisation par les décideurs.') }}</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </article>

                        <!-- Section 6 : Modernisation Numérique CAPI -->
                        <article class="content-section">
                            <h2 class="section-title">{{ __('Modernisation Numérique & CAPI') }}</h2>
                            <p class="mb-6 text-gray-600 leading-relaxed">{{ __('Le Gouvernement a opté pour la méthode CAPI (Computer-Assisted Personal Interviewing) avec l\'utilisation de smartphones lors de la collecte pour plusieurs raisons stratégiques :') }}</p>
                            <div class="apropos-capi-grid">
                                <div class="apropos-capi-card">
                                    <div class="apropos-capi-icon">
                                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12,6 12,12 16,14"/></svg>
                                    </div>
                                    <h4 class="apropos-capi-title">{{ __('Gain de Temps et Célérité') }}</h4>
                                    <p class="apropos-capi-desc">{{ __('Raccourcissement significatif du délai de mise à disposition des résultats officiels.') }}</p>
                                </div>
                                <div class="apropos-capi-card">
                                    <div class="apropos-capi-icon apropos-capi-icon--yellow">
                                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22,4 12,14.01 9,11.01"/></svg>
                                    </div>
                                    <h4 class="apropos-capi-title">{{ __('Fiabilité Accrue') }}</h4>
                                    <p class="apropos-capi-desc">{{ __('Élimination complète des phases manuelles de vérification papier, de saisie de données et de recodage.') }}</p>
                                </div>
                                <div class="apropos-capi-card">
                                    <div class="apropos-capi-icon">
                                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                    </div>
                                    <h4 class="apropos-capi-title">{{ __('Confidentialité Absolue') }}</h4>
                                    <p class="apropos-capi-desc">{{ __('Les données transmises sont protégées par le secret statistique et cryptées de bout en bout.') }}</p>
                                </div>
                            </div>
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

/* ============================
   Decree Cards - Cadre Institutionnel
   ============================ */
.apropos-decree-card {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1.25rem 1.5rem;
    background: linear-gradient(135deg, rgba(32, 65, 56, 0.04) 0%, rgba(32, 65, 56, 0.08) 100%);
    border: 1px solid rgba(32, 65, 56, 0.15);
    border-left: 4px solid #204138;
    border-radius: 0.75rem;
    transition: box-shadow 0.2s ease, transform 0.2s ease;
}
.apropos-decree-card:hover {
    box-shadow: 0 4px 20px rgba(32, 65, 56, 0.12);
    transform: translateY(-2px);
}
.apropos-decree-card--yellow {
    background: linear-gradient(135deg, rgba(237, 175, 17, 0.04) 0%, rgba(237, 175, 17, 0.09) 100%);
    border-color: rgba(237, 175, 17, 0.25);
    border-left-color: #EDAF11;
}
.apropos-decree-card--yellow:hover {
    box-shadow: 0 4px 20px rgba(237, 175, 17, 0.15);
}
.apropos-decree-icon {
    flex-shrink: 0;
    width: 44px;
    height: 44px;
    border-radius: 0.6rem;
    background: rgba(32, 65, 56, 0.1);
    color: #204138;
    display: flex;
    align-items: center;
    justify-content: center;
}
.apropos-decree-icon--yellow {
    background: rgba(237, 175, 17, 0.12);
    color: #b88300;
}
.apropos-decree-label {
    display: block;
    font-weight: 800;
    font-size: 0.75rem;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    color: #204138;
    margin-bottom: 0.4rem;
}
.apropos-decree-label--yellow {
    color: #b88300;
}
.apropos-decree-text {
    margin: 0;
    font-size: 0.875rem;
    color: #4b5563;
    line-height: 1.65;
}

/* ============================
   7 Phases Timeline
   ============================ */
.apropos-phases {
    display: flex;
    flex-direction: column;
    gap: 0;
    position: relative;
}
.apropos-phases::before {
    content: '';
    position: absolute;
    left: 22px;
    top: 24px;
    bottom: 24px;
    width: 2px;
    background: linear-gradient(to bottom, #204138, rgba(32, 65, 56, 0.1));
    border-radius: 2px;
}
.apropos-phase-item {
    display: flex;
    align-items: flex-start;
    gap: 1.25rem;
    position: relative;
    padding-bottom: 1.5rem;
}
.apropos-phase-item:last-child {
    padding-bottom: 0;
}
.apropos-phase-number {
    flex-shrink: 0;
    width: 46px;
    height: 46px;
    border-radius: 50%;
    background: #204138;
    color: white;
    font-weight: 800;
    font-size: 0.8rem;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    z-index: 1;
    box-shadow: 0 0 0 4px rgba(32, 65, 56, 0.1);
    transition: transform 0.2s ease;
}
.apropos-phase-number--active {
    background: #EDAF11;
    box-shadow: 0 0 0 4px rgba(237, 175, 17, 0.2);
    animation: pulse-yellow 2s infinite;
}
@keyframes pulse-yellow {
    0%, 100% { box-shadow: 0 0 0 4px rgba(237, 175, 17, 0.2); }
    50% { box-shadow: 0 0 0 8px rgba(237, 175, 17, 0.08); }
}
.apropos-phase-card {
    flex: 1;
    display: flex;
    align-items: flex-start;
    gap: 0.875rem;
    padding: 1.1rem 1.25rem;
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 0.75rem;
    transition: box-shadow 0.2s ease, border-color 0.2s ease;
}
.apropos-phase-card:hover {
    box-shadow: 0 4px 16px rgba(0,0,0,0.07);
    border-color: #204138;
}
.apropos-phase-card--active {
    background: linear-gradient(135deg, rgba(237, 175, 17, 0.05) 0%, rgba(237, 175, 17, 0.1) 100%);
    border-color: rgba(237, 175, 17, 0.4);
}
.apropos-phase-icon-wrap {
    flex-shrink: 0;
    width: 38px;
    height: 38px;
    border-radius: 0.5rem;
    background: rgba(32, 65, 56, 0.07);
    color: #204138;
    display: flex;
    align-items: center;
    justify-content: center;
}
.apropos-phase-icon-wrap--active {
    background: rgba(237, 175, 17, 0.15);
    color: #b88300;
}
.apropos-phase-title {
    font-weight: 800;
    font-size: 0.9rem;
    color: #1a2e28;
    margin: 0 0 0.35rem 0;
}
.apropos-phase-desc {
    font-size: 0.82rem;
    color: #6b7280;
    line-height: 1.6;
    margin: 0;
}

/* ============================
   CAPI Cards Grid
   ============================ */
.apropos-capi-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1.25rem;
}
@media (max-width: 768px) {
    .apropos-capi-grid {
        grid-template-columns: 1fr;
    }
}
.apropos-capi-card {
    padding: 1.5rem 1.25rem;
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 1rem;
    text-align: center;
    transition: box-shadow 0.25s ease, transform 0.25s ease;
}
.apropos-capi-card:hover {
    box-shadow: 0 8px 28px rgba(32, 65, 56, 0.1);
    transform: translateY(-3px);
}
.apropos-capi-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: rgba(32, 65, 56, 0.08);
    color: #204138;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem auto;
}
.apropos-capi-icon--yellow {
    background: rgba(237, 175, 17, 0.12);
    color: #b88300;
}
.apropos-capi-title {
    font-weight: 800;
    font-size: 0.9rem;
    color: #1a2e28;
    margin: 0 0 0.5rem 0;
}
.apropos-capi-desc {
    font-size: 0.82rem;
    color: #6b7280;
    line-height: 1.6;
    margin: 0;
}

/* Mobile responsive adjustments */
@media (max-width: 640px) {
    .apropos-phases::before {
        left: 18px;
    }
    .apropos-phase-number {
        width: 38px;
        height: 38px;
        font-size: 0.72rem;
    }
    .apropos-phase-card {
        padding: 0.9rem 1rem;
    }
    .apropos-decree-card {
        flex-direction: column;
        gap: 0.75rem;
    }
}
</style>
