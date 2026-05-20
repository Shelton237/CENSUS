<script setup>
import { ref, computed } from 'vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import { Link, Head, usePage } from '@inertiajs/vue3';

const { props } = usePage();
const currentLocale = computed(() => props.locale || 'fr');

const phases = ref([
    {
        id: 'conception',
        name: 'Conception',
        status: 'completed',
        year: '2024',
        title: {
            fr: 'Phase Préparatoire & Conception (2024)',
            en: 'Preparatory Phase & Design (2024)'
        },
        description: {
            fr: 'Cette phase initiale a posé les bases méthodologiques, technologiques et organisationnelles indispensables à la réussite du double recensement (RGPH et RGAE). Elle a permis d\'harmoniser les outils de collecte et de valider le cadre réglementaire nécessaire au déploiement national.',
            en: 'This initial phase laid the methodological, technological, and organizational foundations essential for the success of the double census (RGPH and RGAE). It enabled the harmonization of collection tools and validated the regulatory framework required for national deployment.'
        },
        stats: [
            { label: { fr: 'Questionnaires validés', en: 'Validated questionnaires' }, value: '100%' },
            { label: { fr: 'Textes officiels signés', en: 'Official decrees signed' }, value: '100%' },
            { label: { fr: 'Financement mobilisé', en: 'Funding mobilized' }, value: '100%' }
        ],
        milestones: {
            fr: [
                'Rédaction des manuels méthodologiques d\'instruction des agents recenseurs',
                'Élaboration et tests de l\'application de collecte numérique sur tablettes (CAPI)',
                'Mise en place officielle des comités de supervision nationaux et locaux',
                'Réalisation du test pilote de collecte (recensement pilote) en conditions réelles'
            ],
            en: [
                'Drafting of methodological instruction manuals for enumerators',
                'Development and testing of the digital collection software on tablets (CAPI)',
                'Official establishment of national and local supervision committees',
                'Execution of the pilot census under real field conditions'
            ]
        }
    },
    {
        id: 'cartographie',
        name: 'Cartographie',
        status: 'completed',
        year: '2025',
        title: {
            fr: 'Cartographie Censitaire Numérique (2025)',
            en: 'Digital Census Cartography (2025)'
        },
        description: {
            fr: 'La cartographie censitaire a consisté à découper l\'ensemble du territoire national en zones de dénombrement (ZD) géoréférencées. Cette étape cruciale de terrain garantit qu\'aucun ménage, village ni exploitation agricole ne sera oublié lors du comptage de la population.',
            en: 'The census cartography consisted of partitioning the entire national territory into georeferenced enumeration areas (ZD). This crucial fieldwork phase guarantees that no household, village, or agricultural holding will be overlooked during the general count.'
        },
        stats: [
            { label: { fr: 'Zones délimitées (ZD)', en: 'Delineated areas (ZD)' }, value: '25 000+' },
            { label: { fr: 'Couverture nationale SIG', en: 'GIS national coverage' }, value: '100%' },
            { label: { fr: 'Agents de terrain mobilisés', en: 'Field agents deployed' }, value: '1 500+' }
        ],
        milestones: {
            fr: [
                'Numérisation et traçage des limites des communes, villages et quartiers',
                'Géoréférencement de toutes les infrastructures socio-économiques (écoles, hôpitaux)',
                'Identification cartographique des zones à fort potentiel agricole et d\'élevage',
                'Intégration des données spatiales dans le Système d\'Information Géographique (SIG)'
            ],
            en: [
                'Digitization and boundary plotting of municipalities, villages, and neighborhoods',
                'Georeferencing of all basic social infrastructure (schools, health centers, water points)',
                'Cartographic identification of highly active agricultural and livestock farming zones',
                'Integration of spatial data into the central Geographic Information System (GIS)'
            ]
        }
    },
    {
        id: 'denombrement',
        name: 'Dénombrement',
        status: 'active',
        year: '2026',
        title: {
            fr: 'Dénombrement Principal (2026)',
            en: 'Main Enumeration (2026)'
        },
        description: {
            fr: 'Phase opérationnelle majeure où plus de 30 000 agents parcourent simultanément tout le Cameroun pour interroger les ménages et les producteurs agricoles. Les informations récoltées sur tablettes sécurisées alimentent en temps réel les bases de données d\'analyse.',
            en: 'Major operational phase where over 30,000 enumerators travel across Cameroon to interview households and agricultural producers. The information collected on secure tablets feeds the central analytical databases in real time.'
        },
        stats: [
            { label: { fr: 'Progression estimée', en: 'Estimated progress' }, value: '64%' },
            { label: { fr: 'Agents recenseurs actifs', en: 'Active enumerators' }, value: '32 000+' },
            { label: { fr: 'Ménages recensés', en: 'Households surveyed' }, value: '3.8 M+' }
        ],
        milestones: {
            fr: [
                'Recrutement, sélection et formation intensive des agents recenseurs et contrôleurs',
                'Déploiement logistique sécurisé des tablettes numériques dans les 10 régions',
                'Campagne de communication de masse et mobilisation sociale (radios, crieurs publics)',
                'Collecte en face-à-face des variables démographiques, agricoles et d\'élevage'
            ],
            en: [
                'Recruitment, selection, and intensive training of enumerators and supervisors',
                'Secure logistical deployment of digital tablets to all 10 administrative regions',
                'Mass communication and social mobilization campaign (radio, banners, town criers)',
                'Face-to-face collection of demographics, livestock, and agricultural variables'
            ]
        }
    },
    {
        id: 'saisie',
        name: 'Saisie des données',
        status: 'upcoming',
        year: '2027',
        title: {
            fr: 'Traitement & Apurement des Données (2027)',
            en: 'Data Processing & Cleaning (2027)'
        },
        description: {
            fr: 'Grâce à la collecte sur tablette, la saisie papier est éliminée. Cependant, cette phase consistera à effectuer des contrôles de cohérence stricts, à traiter les cas de non-réponses et à consolider les bases de données géantes pour s\'assurer de l\'exactitude des résultats.',
            en: 'Thanks to tablet-based digital collection, manual paper data entry is eliminated. However, this phase involves running strict logical consistency checks, handling non-responses, and consolidating the massive database to ensure the absolute accuracy of the results.'
        },
        stats: [
            { label: { fr: 'Protocoles de contrôle prêts', en: 'Control protocols ready' }, value: '100%' },
            { label: { fr: 'Système de stockage', en: 'Storage infrastructure' }, value: 'Redondant' }
        ],
        milestones: {
            fr: [
                'Exécution d\'algorithmes d\'apurement pour identifier et corriger les incohérences',
                'Calcul des coefficients de pondération et redressement statistique',
                'Analyses démographiques et agronomiques thématiques par des panels d\'experts',
                'Génération de la base de données finale anonymisée'
            ],
            en: [
                'Execution of data cleaning algorithms to detect and resolve consistency errors',
                'Calculation of statistical weights and sample adjustments',
                'Thematic demographic and agronomic analyses by expert panels',
                'Generation of the final, anonymized microdata database'
            ]
        }
    },
    {
        id: 'publication',
        name: 'Publication',
        status: 'upcoming',
        year: '2027',
        title: {
            fr: 'Publication & Diffusion des Résultats (2027)',
            en: 'Publication & Dissemination of Results (2027)'
        },
        description: {
            fr: 'L\'étape finale de diffusion consiste à restituer officiellement les données traitées sous forme de rapports, de portails Open Data interactifs et de cartes. Elle permet aux planificateurs, ministères et partenaires de développement d\'exploiter ces indicateurs vitaux.',
            en: 'The final dissemination step consists of officially delivering the processed statistics through reports, interactive Open Data portals, and thematic maps. It allows planners, ministries, and development partners to exploit these vital indicators.'
        },
        stats: [
            { label: { fr: 'Rapports thématiques prévus', en: 'Planned thematic reports' }, value: '12' },
            { label: { fr: 'Portail open-data interactif', en: 'Interactive open-data portal' }, value: 'Oui / Yes' }
        ],
        milestones: {
            fr: [
                'Présentation officielle des résultats préliminaires de population (chiffres clés)',
                'Rédaction et publication des volumes thématiques (éducation, emploi, agriculture)',
                'Mise en ligne d\'un atlas cartographique interactif grand public',
                'Ateliers nationaux et régionaux de vulgarisation pour les décideurs publics'
            ],
            en: [
                'Official presentation of preliminary population results (key aggregates)',
                'Drafting and publishing of thematic volumes (education, employment, agricultural production)',
                'Launch of a public-facing interactive cartographic atlas',
                'National and regional workshops to popularize data for policy makers'
            ]
        }
    }
]);

const activePhaseId = ref('denombrement');
const selectedPhase = computed(() => phases.value.find(p => p.id === activePhaseId.value));

const statusText = (status, locale) => {
    const texts = {
        completed: { fr: 'Phase Terminée', en: 'Phase Completed' },
        active: { fr: 'Phase Actuelle', en: 'Active Phase' },
        upcoming: { fr: 'Phase Planifiée', en: 'Planned Phase' }
    };
    return texts[status][locale] || texts[status]['fr'];
};

const statusBadgeClass = (status) => {
    switch (status) {
        case 'completed':
            return 'bg-[#2E9146]/10 text-[#2E9146] border border-[#2E9146]/20';
        case 'active':
            return 'bg-[#F1A502]/10 text-[#F1A502] border border-[#F1A502]/20';
        case 'upcoming':
            return 'bg-gray-100 text-gray-500 border border-gray-200';
        default:
            return 'bg-gray-100 text-gray-500';
    }
};
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
        <section class="chron-page" style="padding: 80px 0; background: #FFF;">
            <div class="container">

                <div class="timeline-wrapper" style="margin-top: 50px;">
                    <div class="timeline-row">
                        <!-- Début -->
                        <div class="tl-endpoint tl-start select-none">
                            <span>{{ __('Début du') }}<br>{{ __('processus') }}</span>
                        </div>

                        <!-- Phases bouclées -->
                        <div 
                            v-for="phase in phases" 
                            :key="phase.id"
                            class="tl-phase cursor-pointer select-none"
                            :class="[
                                phase.status,
                                { 'is-selected': activePhaseId === phase.id }
                            ]"
                            @click="activePhaseId = phase.id"
                        >
                            <!-- Badge "Nous sommes ici" -->
                            <div v-if="phase.status === 'active'" class="tl-now-marker">
                                <span>{{ __('Nous sommes ici') }}</span>
                                <svg width="20" height="28" viewBox="0 0 22 30" fill="none">
                                    <path d="M11 0C4.925 0 0 4.925 0 11C0 19.25 11 30 11 30C11 30 22 19.25 22 11C22 4.925 17.075 0 11 0Z" fill="#2E6B5E"/>
                                    <circle cx="11" cy="11" r="5" fill="#E8AA00"/>
                                </svg>
                            </div>

                            <div class="tl-box">
                                <div class="tl-title">{{ __(phase.name) }}</div>
                            </div>
                        </div>

                        <!-- Fin -->
                        <div class="tl-endpoint tl-end select-none">
                            <span>{{ __('Fin du') }}<br>{{ __('processus') }}</span>
                        </div>
                    </div>

                    <!-- Ligne d'axe -->
                    <div class="tl-axis-line" style="top: 104px;"></div>

                    <!-- Années -->
                    <div class="tl-years-row" style="margin-top: 40px;">
                        <div></div>
                        <span 
                            v-for="phase in phases" 
                            :key="phase.id" 
                            class="tl-year text-center cursor-pointer select-none transition-all duration-200"
                            :class="{ 'text-[#F1A502] font-black scale-110': activePhaseId === phase.id }"
                            @click="activePhaseId = phase.id"
                        >
                            {{ phase.year }}
                        </span>
                        <div></div>
                    </div>
                </div>

                <!-- Phase Details avec animation fluide -->
                <Transition name="fade" mode="out-in">
                    <div :key="activePhaseId" class="mt-20">
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 bg-[#F8FAF9] p-8 md:p-12 rounded-3xl border border-[#E9F0EE] shadow-sm transition-all duration-300">
                            <!-- Infos de phase -->
                            <div class="lg:col-span-2 space-y-6">
                                <div class="flex items-center gap-3 flex-wrap">
                                    <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider" :class="statusBadgeClass(selectedPhase.status)">
                                        {{ statusText(selectedPhase.status, currentLocale) }}
                                    </span>
                                    <span class="px-3 py-1 rounded-full bg-gray-200/60 text-gray-700 text-xs font-bold uppercase tracking-wider">
                                        {{ selectedPhase.year }}
                                    </span>
                                </div>
                                
                                <h2 class="text-3xl md:text-4xl font-black text-[#204138] leading-tight">
                                    {{ selectedPhase.title[currentLocale] }}
                                </h2>
                                
                                <p class="text-gray-600 text-lg leading-relaxed">
                                    {{ selectedPhase.description[currentLocale] }}
                                </p>

                                <!-- Livrables/Étapes clés -->
                                <div class="pt-6 border-t border-gray-200/60">
                                    <h3 class="text-sm font-black text-[#204138] uppercase tracking-wider mb-4">
                                        {{ currentLocale === 'en' ? 'Key Milestones & Deliverables' : 'Livrables & Étapes clés' }}
                                    </h3>
                                    <ul class="space-y-3">
                                        <li v-for="(milestone, idx) in selectedPhase.milestones[currentLocale]" :key="idx" class="flex items-start gap-3">
                                            <span class="mt-1 flex-shrink-0 w-5 h-5 rounded-full flex items-center justify-center" 
                                                  :class="selectedPhase.status === 'completed' ? 'bg-[#2E9146]/20 text-[#2E9146]' : (selectedPhase.status === 'active' ? 'bg-[#F1A502]/20 text-[#F1A502]' : 'bg-gray-200 text-gray-500')">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                                </svg>
                                            </span>
                                            <span class="text-gray-700 text-base">{{ milestone }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            
                            <!-- Stats & CTA -->
                            <div class="flex flex-col justify-between gap-6 bg-white p-6 md:p-8 rounded-2xl border border-gray-100 shadow-xs">
                                <div class="space-y-6">
                                    <span class="block text-xs font-bold text-gray-400 uppercase tracking-widest text-center">
                                        {{ currentLocale === 'en' ? 'Phase Metrics' : 'Indicateurs de phase' }}
                                    </span>
                                    
                                    <!-- Statistiques Widgets -->
                                    <div class="space-y-4">
                                        <div v-for="(stat, idx) in selectedPhase.stats" :key="idx" class="p-4 rounded-xl bg-gray-50 border border-gray-100/60 flex justify-between items-center">
                                            <span class="text-sm text-gray-600 font-medium mr-2">{{ stat.label[currentLocale] }}</span>
                                            <span class="text-lg font-black" :class="selectedPhase.status === 'completed' ? 'text-[#2E9146]' : (selectedPhase.status === 'active' ? 'text-[#F1A502]' : 'text-gray-500')">
                                                {{ stat.value }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Bouton CTA -->
                                <Link v-if="selectedPhase.status !== 'upcoming'" 
                                      href="/actualites" 
                                      class="w-full py-4 px-6 rounded-xl font-bold text-center text-white transition-all duration-300 transform hover:-translate-y-0.5 shadow-md flex items-center justify-center gap-2"
                                      :class="selectedPhase.status === 'completed' ? 'bg-[#2E9146] hover:bg-[#257538] shadow-[#2E9146]/20' : 'bg-[#204138] hover:bg-[#162e28] shadow-[#204138]/20'">
                                    <span>{{ currentLocale === 'en' ? 'View phase news' : 'Voir les actualités de la phase' }}</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </Link>
                                <div v-else class="py-4 px-6 rounded-xl bg-gray-100 text-gray-400 font-bold text-center border border-dashed border-gray-200 select-none">
                                    {{ currentLocale === 'en' ? 'Phase planned' : 'Phase planifiée' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </Transition>

            </div>
        </section>
    </MainLayout>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s ease, transform 0.3s ease;
}

.fade-enter-from {
  opacity: 0;
  transform: translateY(15px);
}

.fade-leave-to {
  opacity: 0;
  transform: translateY(-15px);
}
</style>
