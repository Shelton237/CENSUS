<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const props = defineProps({ dbPartners: { type: Array, default: () => [] } });

// Résolution logo : priorité DB, puis static, puis null
const resolveLogoFromDb = (name) => {
    const match = props.dbPartners.find(p => p.name.toLowerCase() === name.toLowerCase());
    if (!match || !match.logo) return null;
    // FAO : forcer SVG comme le carousel
    if (name === 'FAO') return '/assets/images/partenaire/fao.svg';
    let src = match.logo;
    if (!src.startsWith('http') && !src.startsWith('/assets') && !src.startsWith('/storage')) {
        src = `/storage/${src}`;
    }
    return src;
};

const activeFilter = ref('tous');

const partners = computed(() => [
    // ── Financiers ──────────────────────────────────────────────
    {
        id: 1, category: 'financier', name: 'Banque Mondiale', acronym: 'WB',
        logo: resolveLogoFromDb('Banque Mondiale') || '/assets/images/partenaire/worldbank.svg',
        role: 'Partenaire financier — Projet HISWACA', contribution: '7 milliards FCFA',
        desc: 'La Banque Mondiale soutient le recensement à travers le projet HISWACA, apportant un financement clé pour les équipements numériques, les tablettes CAPI et la formation des agents de terrain.',
        website: 'https://www.banquemondiale.org/fr/country/cameroon',
    },
    {
        id: 2, category: 'financier', name: 'HISWACA', acronym: 'HIS',
        logo: resolveLogoFromDb('HISWACA') || '/assets/images/partenaire/hiswaca-e1770819554832.jpg',
        role: 'Programme régional de statistiques', contribution: 'Coordination régionale',
        desc: 'Le programme HISWACA coordonne l\'appui technique et financier aux opérations statistiques des pays d\'Afrique Centrale, dont le Cameroun, dans le cadre d\'un effort de coopération régionale.',
        website: null,
    },
    {
        id: 3, category: 'financier', name: 'Gouvernement du Cameroun', acronym: 'GVT',
        logo: resolveLogoFromDb('Gouvernement du Cameroun'),
        role: 'Financement principal & tutelle', contribution: 'Budget de l\'État',
        desc: 'Le Gouvernement camerounais assure le financement majoritaire via le budget de l\'État et la coordination nationale à travers le MINEPAT, tutelle technique du BUCREP.',
        website: 'https://www.minepat.gov.cm',
    },
    // ── Techniques ──────────────────────────────────────────────
    {
        id: 4, category: 'technique', name: 'UNFPA', acronym: 'UNFPA',
        logo: resolveLogoFromDb('UNFPA') || '/assets/images/partenaire/unfpa.png',
        role: 'Assistance technique démographique', contribution: 'Expertise & outils SIG',
        desc: 'L\'UNFPA fournit une expertise démographique de pointe pour la conception des outils de collecte, la cartographie numérique et le suivi en temps réel des opérations de terrain.',
        website: 'https://cameroon.unfpa.org/',
    },
    {
        id: 5, category: 'technique', name: 'FAO', acronym: 'FAO',
        logo: resolveLogoFromDb('FAO') || '/assets/images/partenaire/fao.svg',
        role: 'Appui méthodologique agricole', contribution: 'Supervision RGAE',
        desc: 'La FAO supervise le volet agricole du recensement (RGAE), en fournissant les méthodologies standardisées, les nomenclatures agricoles internationales et un appui technique pour les données agropastorales.',
        website: 'https://www.fao.org/cameroon/fr/',
    },
    {
        id: 6, category: 'technique', name: 'OMS', acronym: 'OMS',
        logo: resolveLogoFromDb('OMS') || '/assets/images/partenaire/oms.gif',
        role: 'Logistique & matériel technique', contribution: 'Appui opérationnel',
        desc: 'L\'OMS contribue à la logistique opérationnelle du recensement, notamment pour la mise à disposition de matériel technique et l\'appui aux opérations dans les zones à accès difficile.',
        website: 'https://www.who.int/fr/countries/cmr',
    },
    // ── Institutionnels ─────────────────────────────────────────
    {
        id: 7, category: 'institutionnel', name: 'BUCREP', acronym: 'BUCREP',
        logo: resolveLogoFromDb('BUCREP'),
        role: 'Maître d\'œuvre technique officiel', contribution: 'Exécution nationale',
        desc: 'Organisme public créé en 1999, le BUCREP est le bras opérationnel du gouvernement. Il coordonne l\'ensemble des opérations, de la cartographie jusqu\'à la publication des résultats.',
        website: 'https://bucrep.org',
    },
    {
        id: 8, category: 'institutionnel', name: 'MINEPAT', acronym: 'MINEPAT',
        logo: resolveLogoFromDb('MINEPAT') || '/assets/images/partenaire/minepat.jpg',
        role: 'Tutelle technique du BUCREP', contribution: 'Pilotage stratégique',
        desc: 'Le MINEPAT supervise l\'orientation stratégique du recensement et veille à son intégration dans les politiques nationales de planification et de développement durable.',
        website: 'https://www.minepat.gov.cm',
    },
    {
        id: 9, category: 'institutionnel', name: 'INS', acronym: 'INS',
        logo: resolveLogoFromDb('INS') || '/assets/images/partenaire/ins.png',
        role: 'Partenaire statistique national', contribution: 'Validation méthodologique',
        desc: 'L\'Institut National de la Statistique collabore avec le BUCREP pour la validation méthodologique, la cohérence des nomenclatures et la diffusion des résultats auprès des utilisateurs.',
        website: 'https://www.statistics-cameroon.org',
    },
]);

const filters = computed(() => [
    { key: 'tous',          label: 'Tous les partenaires', count: partners.value.length },
    { key: 'financier',     label: 'Financiers',           count: partners.value.filter(p => p.category === 'financier').length },
    { key: 'technique',     label: 'Techniques',           count: partners.value.filter(p => p.category === 'technique').length },
    { key: 'institutionnel',label: 'Institutionnels',      count: partners.value.filter(p => p.category === 'institutionnel').length },
]);

const filtered = computed(() =>
    activeFilter.value === 'tous' ? partners.value : partners.value.filter(p => p.category === activeFilter.value)
);

const categoryColors = {
    financier:      { bg: 'bg-[#EDAF11]/15', text: 'text-[#92660A]', label: 'Financier' },
    technique:      { bg: 'bg-[#204138]/10', text: 'text-[#204138]', label: 'Technique' },
    institutionnel: { bg: 'bg-blue-50',       text: 'text-blue-700',  label: 'Institutionnel' },
};

const logoPartners = computed(() => partners.value.filter(p => p.logo));
</script>

<template>
    <Head>
        <title>Partenaires — RGPH4 Cameroun</title>
        <meta name="description" content="Partenaires financiers, techniques et institutionnels du 4ème Recensement Général de la Population et de l'Habitat du Cameroun.">
    </Head>

    <MainLayout>
        <!-- ═══════════════ HERO ═══════════════ -->
        <section class="relative pt-32 pb-24 overflow-hidden bg-[#204138]">
            <div class="absolute inset-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
            <!-- Déco dorée -->
            <div class="absolute bottom-0 left-0 right-0 h-1 bg-[#EDAF11]"></div>
            <div class="container relative z-10 text-center max-w-3xl mx-auto px-4">
                <span class="inline-block py-1.5 px-4 rounded-full bg-[#EDAF11]/20 text-[#EDAF11] font-bold text-xs tracking-widest uppercase mb-5">Transparence & Coopération</span>
                <h1 class="text-4xl md:text-5xl font-black text-white mb-5 leading-tight">Nos Partenaires</h1>
                <p class="text-lg text-white/75 leading-relaxed">Le 4ème RGPH et RGAE est le fruit d'une collaboration étroite entre le Gouvernement camerounais et des organisations nationales et internationales de premier plan.</p>
            </div>
        </section>

        <!-- ═══════════════ LOGO WALL ═══════════════ -->
        <section class="bg-white border-b border-gray-100 py-10">
            <div class="container max-w-5xl mx-auto px-4">
                <p class="text-center text-[10px] font-bold uppercase tracking-[0.18em] text-gray-400 mb-8">Ils nous font confiance</p>
                <div class="flex flex-wrap items-center justify-center gap-6 md:gap-10">
                    <div v-for="p in logoPartners" :key="p.id"
                         class="flex items-center justify-center w-28 h-14 grayscale hover:grayscale-0 opacity-60 hover:opacity-100 transition-all duration-300">
                        <img :src="p.logo" :alt="p.name" class="max-w-full max-h-full object-contain">
                    </div>
                    <!-- Logos texte pour les sans-logo -->
                    <div v-for="p in partners.filter(p => !p.logo).slice(0,3)" :key="'txt-'+p.id"
                         class="flex items-center justify-center w-28 h-14 opacity-40 hover:opacity-80 transition-opacity duration-300">
                        <span class="text-sm font-black text-[#204138] tracking-wider">{{ p.acronym }}</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- ═══════════════ FILTRES + CARTES ═══════════════ -->
        <main class="bg-[#F7F9F8] py-16">
            <div class="container max-w-5xl mx-auto px-4">

                <!-- Filtres -->
                <div class="flex flex-wrap gap-2 mb-10 justify-center">
                    <button v-for="f in filters" :key="f.key"
                            @click="activeFilter = f.key"
                            class="flex items-center gap-2 px-5 py-2.5 rounded-full text-xs font-bold uppercase tracking-wider transition-all duration-200 cursor-pointer border"
                            :class="activeFilter === f.key
                                ? 'bg-[#204138] text-white border-[#204138] shadow-md'
                                : 'bg-white text-gray-500 border-gray-200 hover:border-[#204138] hover:text-[#204138]'">
                        {{ f.label }}
                        <span class="text-[10px] font-black px-1.5 py-0.5 rounded-full"
                              :class="activeFilter === f.key ? 'bg-white/20 text-white' : 'bg-gray-100 text-gray-500'">
                            {{ f.count }}
                        </span>
                    </button>
                </div>

                <!-- Grille de cartes -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                    <article v-for="p in filtered" :key="p.id"
                             class="bg-white rounded-2xl overflow-hidden border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col cursor-default">

                        <!-- Logo plein largeur -->
                        <div class="w-full h-28 bg-gray-50 border-b border-gray-100 flex items-center justify-center px-8 py-4">
                            <img v-if="p.logo" :src="p.logo" :alt="p.name" class="w-full max-h-full object-contain" loading="lazy">
                            <span v-else class="text-xl font-black text-[#204138] tracking-widest">{{ p.acronym }}</span>
                        </div>

                        <div class="p-6 flex flex-col flex-1">
                            <!-- Badge catégorie -->
                            <div class="flex justify-end mb-4">
                                <span class="text-[9px] font-bold uppercase tracking-[0.12em] px-2.5 py-1 rounded-full"
                                      :class="[categoryColors[p.category].bg, categoryColors[p.category].text]">
                                    {{ categoryColors[p.category].label }}
                                </span>
                            </div>

                            <!-- Nom + Rôle -->
                            <h3 class="font-bold text-[#204138] text-base leading-snug mb-1">{{ p.name }}</h3>
                            <p class="text-xs font-semibold text-[#EDAF11] mb-3">{{ p.role }}</p>

                            <!-- Contribution pill -->
                            <div class="inline-flex items-center gap-1.5 mb-4 self-start">
                                <svg class="w-3 h-3 text-[#204138]/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span class="text-[10px] font-bold text-[#204138]/60 uppercase tracking-wider">{{ p.contribution }}</span>
                            </div>

                            <!-- Description -->
                            <p class="text-sm text-gray-500 leading-relaxed flex-1 mb-5">{{ p.desc }}</p>

                            <!-- Lien site -->
                            <a v-if="p.website" :href="p.website" target="_blank" rel="noopener noreferrer"
                               class="flex items-center justify-between pt-4 border-t border-gray-100 text-xs font-bold text-[#204138] hover:text-[#EDAF11] transition-colors duration-200 no-underline group cursor-pointer">
                                <span>Visiter le site officiel</span>
                                <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                            </a>
                            <div v-else class="pt-4 border-t border-gray-100">
                                <span class="text-[10px] text-gray-300 uppercase tracking-wider">Site non disponible</span>
                            </div>
                        </div>
                    </article>
                </div>

            </div>
        </main>
    </MainLayout>
</template>
