<script setup>
import { ref } from 'vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import { Link, Head } from '@inertiajs/vue3';

// Form and verification state
const searchMatricule = ref('');
const verificationResult = ref(null);
const isVerifying = ref(false);

// Pre-defined valid mock agent databases
const mockAgents = {
    'AGT-2026-8585': {
        name: 'KAMDEM Pierre Marie',
        role: 'Agent Recenseur Principal',
        region: 'Centre (Mfoundi)',
        status: 'active',
        since: 'Avril 2026'
    },
    'AGT-2026-1042': {
        name: 'OUSMANOU DJAFAROU',
        role: 'Agent Recenseur',
        region: 'Extrême-Nord (Diamaré)',
        status: 'active',
        since: 'Mai 2026'
    },
    'AGT-2026-3091': {
        name: 'EFOUBA Marie-Thérèse',
        role: 'Superviseur de zone',
        region: 'Littoral (Wouri)',
        status: 'active',
        since: 'Mars 2026'
    },
    'AGT-2026-7492': {
        name: 'NGUETSOP Jean-Pierre',
        role: 'Agent Recenseur',
        region: 'Ouest (Mifi)',
        status: 'active',
        since: 'Mai 2026'
    }
};

const handleVerify = () => {
    if (!searchMatricule.value.trim()) return;
    
    isVerifying.value = true;
    verificationResult.value = null;
    
    setTimeout(() => {
        const query = searchMatricule.value.trim().toUpperCase();
        if (mockAgents[query]) {
            verificationResult.value = {
                found: true,
                ...mockAgents[query]
            };
        } else {
            verificationResult.value = {
                found: false,
                matricule: query
            };
        }
        isVerifying.value = false;
    }, 800);
};

// Active hotspot for uniform visual checklist
const activeHotspot = ref(null);
const hotspots = [
    {
        id: 'badge',
        x: 48,
        y: 35,
        title: 'Le Badge Professionnel',
        desc: 'Un badge plastifié avec cordon vert, portant la photo de l\'agent, son nom, son numéro matricule unique et le cachet officiel du BUCREP.'
    },
    {
        id: 'gilet',
        x: 35,
        y: 48,
        title: 'Le Gilet Haute Visibilité',
        desc: 'Gilet officiel vert ou jaune fluorescent avec bandes réfléchissantes, floqué du logo du Recensement Général et du BUCREP au dos.'
    },
    {
        id: 'tablette',
        x: 55,
        y: 72,
        title: 'La Tablette Tactile (CAPI)',
        desc: 'Les agents n\'utilisent aucun questionnaire papier. La saisie des données est entièrement numérique via une tablette sécurisée.'
    },
    {
        id: 'lettre',
        x: 75,
        y: 50,
        title: 'La Lettre de Mission',
        desc: 'Document officiel signé par le Directeur Général du BUCREP, attestant de l\'accréditation de l\'agent à collecter les données dans votre quartier.'
    }
];
</script>

<template>
    <Head>
        <title>Identification des Agents | RGPH4 & RGAE Cameroun</title>
        <meta name="description" content="Vérifiez l'identité des agents recenseurs officiels du 4ème RGPH et RGAE afin d'éviter les fraudes.">
        <meta property="og:title" content="Identification des Agents | RGPH4 & RGAE Cameroun">
        <meta property="og:description" content="Comment reconnaître et vérifier un agent recenseur officiel du 4ème Recensement Général de la Population et de l'Habitat du Cameroun.">
        <meta property="og:image" content="https://census.diginova.cm/assets/images/backgrounds/cameroon_people_map.png">
        <meta property="og:type" content="website">
        <meta property="og:locale" content="fr_FR">
        <meta property="og:site_name" content="Recensement Cameroun 2026">
        <meta property="og:url" content="https://census.diginova.cm/identification-agents">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@recensement90">
        <meta name="twitter:title" content="Identification des Agents | RGPH4 & RGAE Cameroun">
        <meta name="twitter:image" content="https://census.diginova.cm/assets/images/backgrounds/cameroon_people_map.png">
    </Head>

    <MainLayout>
        <!-- Hero Section -->
        <section class="relative pt-32 pb-20 overflow-hidden bg-[#204138]">
            <div class="absolute inset-0 z-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
            <div class="container relative z-10 text-center">
                <span class="inline-block py-1 px-3 rounded-full bg-[#EDAF11]/20 text-[#EDAF11] font-bold text-sm tracking-widest uppercase mb-4">
                    {{ __('Sécurité & Citoyenneté') }}
                </span>
                <h1 class="text-4xl md:text-5xl font-black text-white mb-6 leading-tight">
                    {{ __('Identification des Agents') }}
                </h1>
                <p class="text-xl text-white/80 max-w-2xl mx-auto leading-relaxed">
                    {{ __('Apprenez à reconnaître officiellement nos équipes sur le terrain pour garantir la sécurité et la sérénité des opérations.') }}
                </p>
            </div>
        </section>

        <!-- Main Content -->
        <main class="inner-page">
            <div class="container">
                <!-- Breadcrumbs -->
                <nav class="breadcrumb" aria-label="Fil d'Ariane">
                    <Link :href="route('accueil')" class="bc-link">{{ __('Accueil') }}</Link>
                    <span class="bc-sep">/</span>
                    <span class="bc-current">{{ __('Identification des Agents') }}</span>
                </nav>

                <div class="inner-layout">
                    <!-- Column 1: Main Identification Details -->
                    <div class="content-col">
                        
                        <!-- Introduction Banner -->
                        <div class="intro-banner mb-10 p-6 bg-green-50/50 rounded-2xl border border-green-100 flex items-start gap-4">
                            <div class="w-12 h-12 rounded-full bg-[#204138]/10 text-[#204138] flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-[#204138] mb-1.5">{{ __('Une collecte sécurisée et réglementée') }}</h3>
                                <p class="text-sm text-gray-700 leading-relaxed !mb-0">
                                    {{ __('Le 4ème RGPH et le RGAE se déroulent sur l\'ensemble du territoire camerounais. Pour assurer votre sécurité et la fiabilité de la collecte, voici comment reconnaître officiellement nos agents recenseurs.') }}
                                </p>
                            </div>
                        </div>

                        <!-- Visual Uniform Mockup Section -->
                        <section class="mb-14">
                            <h2 class="text-2xl font-black text-gray-900 mb-6">{{ __('L\'Équipement Officiel de l\'Agent') }}</h2>
                            
                            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                                <!-- Interactive image display -->
                                <div class="lg:col-span-6 relative rounded-2xl overflow-hidden border border-gray-200 shadow-lg bg-gray-50">
                                    <img src="/assets/images/agent_uniform.png" alt="Tenue Officielle Agent Recenseur" class="w-full object-cover aspect-[4/5] object-top">
                                    
                                    <!-- Hotspot Pins overlaying the image -->
                                    <div v-for="spot in hotspots" :key="spot.id" 
                                         class="absolute w-8 h-8 rounded-full bg-[#EDAF11] text-white flex items-center justify-center font-bold text-xs shadow-lg cursor-pointer transform -translate-x-1/2 -translate-y-1/2 transition-transform hover:scale-110 active:scale-95 z-20"
                                         :style="{ left: spot.x + '%', top: spot.y + '%' }"
                                         @click="activeHotspot = spot.id"
                                    >
                                        <span>!</span>
                                    </div>
                                </div>

                                <!-- Explanation of equipment and active hotspots -->
                                <div class="lg:col-span-6 flex flex-col gap-5">
                                    <p class="text-sm text-gray-600 italic">
                                        {{ __('Cliquez sur les points d\'information de l\'image pour explorer les détails de l\'équipement officiel.') }}
                                    </p>

                                    <!-- Hotspots card switcher -->
                                    <div v-for="spot in hotspots" :key="spot.id"
                                         class="p-4 rounded-xl border transition-all cursor-pointer"
                                         :class="activeHotspot === spot.id ? 'bg-green-50/50 border-[#204138] shadow-sm' : 'bg-white border-gray-100 hover:border-gray-200'"
                                         @click="activeHotspot = spot.id"
                                    >
                                        <div class="flex items-center gap-3 mb-2">
                                            <div class="w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold"
                                                 :class="activeHotspot === spot.id ? 'bg-[#204138] text-white' : 'bg-gray-100 text-gray-500'"
                                            >
                                                ✓
                                            </div>
                                            <h4 class="font-extrabold text-sm" :class="activeHotspot === spot.id ? 'text-[#204138]' : 'text-gray-900'">
                                                {{ __(spot.title) }}
                                            </h4>
                                        </div>
                                        <p class="text-xs text-gray-600 leading-relaxed !mb-0">
                                            {{ __(spot.desc) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- The 4 key elements breakdown with nice cards -->
                        <section class="mb-14">
                            <h2 class="text-2xl font-black text-gray-900 mb-6">{{ __('Les 4 Éléments d\'Identification Officiels') }}</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                
                                <!-- Card 1: Badge -->
                                <div class="p-6 bg-white border border-gray-100 rounded-2xl shadow-sm hover:shadow-md transition-shadow">
                                    <div class="w-10 h-10 rounded-xl bg-green-50 text-[#204138] flex items-center justify-center mb-4">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-base font-bold text-gray-900 mb-2">{{ __('1. Le Badge Nominatif') }}</h3>
                                    <p class="text-xs text-gray-600 leading-relaxed !mb-0">
                                        {{ __('Porté obligatoirement autour du cou, il présente la photo d\'identité, le nom de l\'agent, son rôle spécifique et son code matricule unique. Scannable via un QR Code officiel.') }}
                                    </p>
                                </div>

                                <!-- Card 2: Gilet -->
                                <div class="p-6 bg-white border border-gray-100 rounded-2xl shadow-sm hover:shadow-md transition-shadow">
                                    <div class="w-10 h-10 rounded-xl bg-green-50 text-[#204138] flex items-center justify-center mb-4">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-base font-bold text-gray-900 mb-2">{{ __('2. Le Gilet Officiel') }}</h3>
                                    <p class="text-xs text-gray-600 leading-relaxed !mb-0">
                                        {{ __('Un gilet fluorescent haute visibilité de couleur verte ou jaune floqué aux couleurs nationales du Cameroun, avec des insignes du BUCREP et du recensement inscrits en français et en anglais.') }}
                                    </p>
                                </div>

                                <!-- Card 3: Tablette -->
                                <div class="p-6 bg-white border border-gray-100 rounded-2xl shadow-sm hover:shadow-md transition-shadow">
                                    <div class="w-10 h-10 rounded-xl bg-green-50 text-[#204138] flex items-center justify-center mb-4">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-base font-bold text-gray-900 mb-2">{{ __('3. La Tablette de Collecte') }}</h3>
                                    <p class="text-xs text-gray-600 leading-relaxed !mb-0">
                                        {{ __('Outil de travail numérique principal de l\'agent (CAPI). Il ne dispose pas de formulaires papier. Cette numérisation accrue limite la fraude et garantit la confidentialité statistique.') }}
                                    </p>
                                </div>

                                <!-- Card 4: Accreditation -->
                                <div class="p-6 bg-white border border-gray-100 rounded-2xl shadow-sm hover:shadow-md transition-shadow">
                                    <div class="w-10 h-10 rounded-xl bg-green-50 text-[#204138] flex items-center justify-center mb-4">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-base font-bold text-gray-900 mb-2">{{ __('4. L\'Accréditation BUCREP') }}</h3>
                                    <p class="text-xs text-gray-600 leading-relaxed !mb-0">
                                        {{ __('Une lettre d\'accréditation officielle signée par la hiérarchie compétente (BUCREP) contenant les coordonnées des superviseurs locaux que vous pouvez exiger pour vérification.') }}
                                    </p>
                                </div>

                            </div>
                        </section>

                    </div>

                    <!-- Column 2: Verification Widget & Safety Guidelines -->
                    <div class="sidebar-col">
                        
                        <!-- Real-time Verification Widget -->
                        <div class="p-6 bg-white border border-gray-100 rounded-2xl shadow-xl mb-8 relative overflow-hidden">
                            <!-- Background accent -->
                            <div class="absolute top-0 left-0 right-0 h-1.5 bg-[#204138]"></div>
                            
                            <h3 class="text-lg font-black text-gray-900 mb-2">
                                {{ __('Vérifier l\'identité d\'un agent') }}
                            </h3>
                            <p class="text-xs text-gray-500 leading-relaxed mb-6">
                                {{ __('Entrez le numéro matricule présent sur le badge de l\'agent pour vérifier son accréditation officielle.') }}
                            </p>

                            <!-- Form -->
                            <form @submit.prevent="handleVerify" class="flex flex-col gap-4">
                                <div class="relative">
                                    <input type="text" 
                                           v-model="searchMatricule" 
                                           :placeholder="__('Exemple: AGT-2026-8585')" 
                                           class="w-full px-4 py-3 border border-gray-200 rounded-xl outline-none focus:border-[#204138] text-xs font-semibold uppercase transition-all"
                                           :disabled="isVerifying"
                                           required
                                    >
                                </div>
                                <button type="submit" 
                                        class="w-full py-3 bg-[#204138] hover:bg-[#2e5d50] text-white text-xs font-bold rounded-xl transition-all flex items-center justify-center gap-2 border-0 cursor-pointer disabled:opacity-60"
                                        :disabled="isVerifying"
                                >
                                    <svg v-if="isVerifying" class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    <span v-else>{{ __('Vérifier') }}</span>
                                </button>
                            </form>

                            <!-- Verification Result Displays -->
                            <div v-if="verificationResult" class="mt-6 p-4 rounded-xl transition-all"
                                 :class="verificationResult.found ? 'bg-green-50 border border-green-100 text-green-800' : 'bg-red-50 border border-red-100 text-red-800'"
                             >
                                <!-- SUCCESS: Agent active -->
                                <div v-if="verificationResult.found" class="flex flex-col gap-2">
                                    <div class="flex items-center gap-2">
                                        <span class="w-2.5 h-2.5 rounded-full bg-green-500 animate-pulse shrink-0"></span>
                                        <span class="text-xs font-black uppercase tracking-wider">{{ __('Agent Vérifié') }}</span>
                                    </div>
                                    <div class="text-xs flex flex-col gap-1 mt-1 text-gray-700">
                                        <div><strong>{{ __('Nom') }}:</strong> {{ verificationResult.name }}</div>
                                        <div><strong>{{ __('Rôle') }}:</strong> {{ verificationResult.role }}</div>
                                        <div><strong>{{ __('Région d\'affectation') }}:</strong> {{ verificationResult.region }}</div>
                                        <div><strong>{{ __('Statut') }}:</strong> <span class="text-green-600 font-extrabold uppercase text-[10px]">{{ __('Actif') }}</span></div>
                                    </div>
                                </div>
                                
                                <!-- ERROR: Agent not found -->
                                <div v-else class="flex flex-col gap-2">
                                    <div class="flex items-center gap-2 text-red-600">
                                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                        </svg>
                                        <span class="text-xs font-black uppercase tracking-wider">{{ __('Alerte Sécurité') }}</span>
                                    </div>
                                    <p class="text-xs text-gray-700 leading-normal !mb-0 mt-1">
                                        {{ __('Le matricule') }} <strong>{{ verificationResult.matricule }}</strong> {{ __('n\'est pas répertorié dans notre base de données. Demandez à l\'agent sa carte d\'identité nationale et composez le 8585 en cas de doute.') }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Safety Instructions Sidebar Card -->
                        <div class="p-6 bg-gray-50 border border-gray-100 rounded-2xl shadow-sm relative">
                            <h3 class="text-sm font-extrabold text-gray-900 uppercase tracking-wider mb-6 flex items-center gap-2 text-[#204138]">
                                <svg class="w-5 h-5 text-[#EDAF11]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                </svg>
                                {{ __('Consignes de Sécurité') }}
                            </h3>

                            <div class="flex flex-col gap-6">
                                <!-- Instruction 1 -->
                                <div class="flex gap-3">
                                    <div class="w-6 h-6 rounded-full bg-red-100 text-red-600 flex items-center justify-center font-bold text-xs shrink-0">✕</div>
                                    <div>
                                        <h4 class="text-xs font-extrabold text-gray-900 mb-1">{{ __('Aucune transaction financière') }}</h4>
                                        <p class="text-[11px] text-gray-600 leading-relaxed !mb-0">
                                            {{ __('Le recensement est entièrement gratuit. Un agent ne vous demandera jamais d\'argent.') }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Instruction 2 -->
                                <div class="flex gap-3">
                                    <div class="w-6 h-6 rounded-full bg-red-100 text-red-600 flex items-center justify-center font-bold text-xs shrink-0">✕</div>
                                    <div>
                                        <h4 class="text-xs font-extrabold text-gray-900 mb-1">{{ __('Données bancaires confidentielles') }}</h4>
                                        <p class="text-[11px] text-gray-600 leading-relaxed !mb-0">
                                            {{ __('Aucun mot de passe, code PIN ou information bancaire ne vous sera demandé.') }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Instruction 3 -->
                                <div class="flex gap-3">
                                    <div class="w-6 h-6 rounded-full bg-green-100 text-green-600 flex items-center justify-center font-bold text-xs shrink-0">✓</div>
                                    <div>
                                        <h4 class="text-xs font-extrabold text-gray-900 mb-1">{{ __('Vérification par téléphone') }}</h4>
                                        <p class="text-[11px] text-gray-600 leading-relaxed !mb-0">
                                            {{ __('En cas de doute, composez gratuitement le numéro vert 8585 pour confirmer l\'identité de l\'agent.') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </main>
    </MainLayout>
</template>

<style scoped>
/* Page Layout Styles */
.inner-page {
    padding: 3rem 0 6rem 0;
    background-color: #fafafa;
}

.breadcrumb {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 2rem;
    font-size: 0.825rem;
}
.bc-link {
    color: #6b7280;
    text-decoration: none;
    transition: color 0.2s;
}
.bc-link:hover {
    color: #204138;
}
.bc-sep {
    color: #d1d5db;
}
.bc-current {
    color: #204138;
    font-weight: 700;
}

.inner-layout {
    display: grid;
    grid-template-columns: 1fr;
    gap: 3rem;
}

@media (min-width: 1024px) {
    .inner-layout {
        grid-template-columns: 7fr 4fr;
    }
}

/* Sidebar Column Style */
.sidebar-col {
    position: sticky;
    top: 100px;
    height: fit-content;
}

/* Custom visual pulse for visual points */
@keyframes pulse-hotspot {
    0% {
        box-shadow: 0 0 0 0 rgba(237, 175, 17, 0.7);
    }
    70% {
        box-shadow: 0 0 0 10px rgba(237, 175, 17, 0);
    }
    100% {
        box-shadow: 0 0 0 0 rgba(237, 175, 17, 0);
    }
}

.absolute.w-8.h-8.rounded-full {
    animation: pulse-hotspot 2s infinite;
}
</style>
