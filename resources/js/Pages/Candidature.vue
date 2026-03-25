<script setup>
import { ref, computed } from 'vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

// Form Data structure
const form = useForm({
    // Step 1: Informations Personnelles
    first_name: '',
    last_name: '',
    gender: '',
    birth_date: '',
    id_card_number: '',

    // Step 2: Coordonnées & Localisation
    phone: '',
    email: '',
    region: '',
    city: '',
    address: '',

    // Step 3: Compétences & Expérience
    education_level: '',
    languages: [],
    previous_experience: false,
    experience_details: ''
});

// Wizard State
const currentStep = ref(1);
const totalSteps = 3;
const successMessage = ref('');
const slideDirection = ref('forward'); // 'forward' | 'backward'

// Regions list
const regions = [
    'Adamaoua', 'Centre', 'Est', 'Extrême-Nord', 'Littoral',
    'Nord', 'Nord-Ouest', 'Ouest', 'Sud', 'Sud-Ouest'
];

const nextStep = () => {
    if (currentStep.value < totalSteps) {
        slideDirection.value = 'forward';
        currentStep.value++;
    }
};

const prevStep = () => {
    if (currentStep.value > 1) {
        slideDirection.value = 'backward';
        currentStep.value--;
    }
};

const submitForm = () => {
    form.post(route('candidature.store'), {
        onSuccess: () => {
            currentStep.value = 1;
            form.reset();
            successMessage.value = "Votre candidature a été soumise avec succès ! Vous serez contacté très prochainement.";
            setTimeout(() => { successMessage.value = ''; }, 6000);
        },
        onError: (errors) => {
            console.error(errors);
            if (errors.first_name || errors.last_name || errors.gender || errors.birth_date || errors.id_card_number) {
                slideDirection.value = 'backward';
                currentStep.value = 1;
            } else if (errors.phone || errors.email || errors.region || errors.city || errors.address) {
                slideDirection.value = 'backward';
                currentStep.value = 2;
            }
        }
    });
};

// Progress bar calculation
const completionPercentage = computed(() => {
    return ((currentStep.value - 1) / (totalSteps - 1)) * 100;
});
</script>

<template>
    <Head>
        <title>Recrutement des Agents Recenseurs</title>
        <meta name="description" content="Postulez pour devenir agent recenseur pour le 4ème RGPH du Cameroun.">
    </Head>

    <MainLayout>
        <!-- Hero Section pour la candidature -->
        <section class="candidature-hero relative pt-32 pb-20 overflow-hidden bg-[#204138]">
            <div class="absolute inset-0 z-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
            <div class="container relative z-10 text-center">
                <span class="inline-block py-1 px-3 rounded-full bg-[#EDAF11]/20 text-[#EDAF11] font-bold text-sm tracking-widest uppercase mb-4">{{ __('Rejoignez-nous') }}</span>
                <h1 class="text-4xl md:text-5xl font-black text-white mb-6 leading-tight">{{ __('Devenez Agent Recenseur') }}</h1>
                <p class="text-xl text-white/80 max-w-2xl mx-auto leading-relaxed">
                    {{ __('Participez activement au développement du pays en rejoignant l\'équipe nationale du 4ème RGPH. Soumettez votre candidature en quelques étapes.') }}
                </p>
            </div>
        </section>

        <!-- Formulaire Multi-étapes -->
        <section class="candidature-form-section py-20 bg-gray-50 relative">
            <div class="container max-w-4xl relative z-10">
                
                <!-- Stepper Progress -->
                <div class="stepper-wrapper mb-16 relative">
                    <div class="progress-bar-bg absolute top-1/2 left-0 w-full h-2 bg-gray-200 rounded-full -translate-y-1/2 z-0"></div>
                    <div class="progress-bar-fill absolute top-1/2 left-0 h-2 bg-[#EDAF11] rounded-full -translate-y-1/2 z-0 transition-all duration-500" :style="{ width: `${completionPercentage}%` }"></div>
                    
                    <div class="flex justify-between relative z-10">
                        <!-- Step 1 Indicator -->
                        <div class="step-indicator flex flex-col items-center gap-3">
                            <div class="w-12 h-12 rounded-full flex items-center justify-center font-bold text-lg shadow-lg transition-colors duration-300"
                                 :class="currentStep >= 1 ? 'bg-[#EDAF11] text-white' : 'bg-white text-gray-400 border-2 border-gray-200'">
                                1
                            </div>
                            <span class="text-sm font-bold" :class="currentStep >= 1 ? 'text-[#204138]' : 'text-gray-400'">{{ __('Identité') }}</span>
                        </div>
                        
                        <!-- Step 2 Indicator -->
                        <div class="step-indicator flex flex-col items-center gap-3">
                            <div class="w-12 h-12 rounded-full flex items-center justify-center font-bold text-lg shadow-lg transition-colors duration-300"
                                 :class="currentStep >= 2 ? 'bg-[#EDAF11] text-white' : 'bg-white text-gray-400 border-2 border-gray-200'">
                                2
                            </div>
                            <span class="text-sm font-bold" :class="currentStep >= 2 ? 'text-[#204138]' : 'text-gray-400'">{{ __('Contact') }}</span>
                        </div>

                        <!-- Step 3 Indicator -->
                        <div class="step-indicator flex flex-col items-center gap-3">
                            <div class="w-12 h-12 rounded-full flex items-center justify-center font-bold text-lg shadow-lg transition-colors duration-300"
                                 :class="currentStep >= 3 ? 'bg-[#EDAF11] text-white' : 'bg-white text-gray-400 border-2 border-gray-200'">
                                3
                            </div>
                            <span class="text-sm font-bold" :class="currentStep >= 3 ? 'text-[#204138]' : 'text-gray-400'">{{ __('Expérience') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Bandeau de succès -->
                <transition name="fade-banner">
                    <div v-if="successMessage" class="mb-8 flex items-center gap-4 bg-green-50 border border-green-200 text-green-800 rounded-2xl px-6 py-4 shadow-sm">
                        <svg class="w-6 h-6 text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span class="font-semibold">{{ successMessage }}</span>
                    </div>
                </transition>

                <!-- Form Container -->
                <div class="form-container bg-white/80 backdrop-blur-xl rounded-[2rem] shadow-2xl border border-white p-8 md:p-14">
                    <form @submit.prevent="submitForm">

                        <!-- Steps animés avec une seule transition -->
                        <transition :name="slideDirection === 'forward' ? 'slide-forward' : 'slide-backward'" mode="out-in">

                            <!-- STEP 1: Informations Personnelles -->
                            <div v-if="currentStep === 1" class="form-step">
                                <h2 class="text-2xl font-black text-[#204138] mb-8 flex items-center gap-3">
                                    <svg class="w-6 h-6 text-[#EDAF11]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    {{ __('Informations Personnelles') }}
                                </h2>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="input-group">
                                        <label class="block text-sm font-bold mb-2" :class="form.errors.first_name ? 'text-red-500' : 'text-gray-700'">{{ __('Prénom') }} *</label>
                                        <input type="text" v-model="form.first_name" class="w-full px-5 py-4 rounded-xl border focus:ring-2 transition-all appearance-none" :class="form.errors.first_name ? 'border-red-300 focus:border-red-500 focus:ring-red-500/20 bg-red-50' : 'border-gray-200 focus:border-[#EDAF11] focus:ring-[#EDAF11]/20 bg-gray-50 focus:bg-white'">
                                        <p v-if="form.errors.first_name" class="mt-2 text-sm text-red-500">{{ form.errors.first_name }}</p>
                                    </div>
                                    <div class="input-group">
                                        <label class="block text-sm font-bold mb-2" :class="form.errors.last_name ? 'text-red-500' : 'text-gray-700'">{{ __('Nom') }} *</label>
                                        <input type="text" v-model="form.last_name" class="w-full px-5 py-4 rounded-xl border focus:ring-2 transition-all appearance-none" :class="form.errors.last_name ? 'border-red-300 focus:border-red-500 focus:ring-red-500/20 bg-red-50' : 'border-gray-200 focus:border-[#EDAF11] focus:ring-[#EDAF11]/20 bg-gray-50 focus:bg-white'">
                                        <p v-if="form.errors.last_name" class="mt-2 text-sm text-red-500">{{ form.errors.last_name }}</p>
                                    </div>
                                    <div class="input-group">
                                        <label class="block text-sm font-bold mb-2" :class="form.errors.gender ? 'text-red-500' : 'text-gray-700'">{{ __('Genre') }} *</label>
                                        <select v-model="form.gender" class="w-full px-5 py-4 rounded-xl border focus:ring-2 transition-all appearance-none" :class="form.errors.gender ? 'border-red-300 focus:border-red-500 focus:ring-red-500/20 bg-red-50' : 'border-gray-200 focus:border-[#EDAF11] focus:ring-[#EDAF11]/20 bg-gray-50 focus:bg-white'">
                                            <option value="" disabled>{{ __('Sélectionnez...') }}</option>
                                            <option value="M">{{ __('Masculin') }}</option>
                                            <option value="F">{{ __('Féminin') }}</option>
                                        </select>
                                        <p v-if="form.errors.gender" class="mt-2 text-sm text-red-500">{{ form.errors.gender }}</p>
                                    </div>
                                    <div class="input-group">
                                        <label class="block text-sm font-bold mb-2" :class="form.errors.birth_date ? 'text-red-500' : 'text-gray-700'">{{ __('Date de naissance') }} *</label>
                                        <input type="date" v-model="form.birth_date" class="w-full px-5 py-4 rounded-xl border focus:ring-2 transition-all appearance-none" :class="form.errors.birth_date ? 'border-red-300 focus:border-red-500 focus:ring-red-500/20 bg-red-50' : 'border-gray-200 focus:border-[#EDAF11] focus:ring-[#EDAF11]/20 bg-gray-50 focus:bg-white'">
                                        <p v-if="form.errors.birth_date" class="mt-2 text-sm text-red-500">{{ form.errors.birth_date }}</p>
                                    </div>
                                    <div class="input-group md:col-span-2">
                                        <label class="block text-sm font-bold mb-2" :class="form.errors.id_card_number ? 'text-red-500' : 'text-gray-700'">{{ __('Numéro de CNI / Récépissé') }} *</label>
                                        <input type="text" v-model="form.id_card_number" class="w-full px-5 py-4 rounded-xl border focus:ring-2 transition-all appearance-none" :class="form.errors.id_card_number ? 'border-red-300 focus:border-red-500 focus:ring-red-500/20 bg-red-50' : 'border-gray-200 focus:border-[#EDAF11] focus:ring-[#EDAF11]/20 bg-gray-50 focus:bg-white'" placeholder="Ex: 123456789">
                                        <p v-if="form.errors.id_card_number" class="mt-2 text-sm text-red-500">{{ form.errors.id_card_number }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- STEP 2: Coordonnées & Localisation -->
                            <div v-else-if="currentStep === 2" class="form-step">
                                <h2 class="text-2xl font-black text-[#204138] mb-8 flex items-center gap-3">
                                    <svg class="w-6 h-6 text-[#EDAF11]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    {{ __('Coordonnées & Localisation') }}
                                </h2>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="input-group">
                                        <label class="block text-sm font-bold text-gray-700 mb-2">{{ __('Téléphone') }} *</label>
                                        <input type="tel" v-model="form.phone" class="w-full px-5 py-4 rounded-xl border border-gray-200 focus:border-[#EDAF11] focus:ring-2 focus:ring-[#EDAF11]/20 transition-all bg-gray-50 focus:bg-white" placeholder="Ex: +237 600 00 00 00">
                                    </div>
                                    <div class="input-group">
                                        <label class="block text-sm font-bold text-gray-700 mb-2">{{ __('Email') }}</label>
                                        <input type="email" v-model="form.email" class="w-full px-5 py-4 rounded-xl border border-gray-200 focus:border-[#EDAF11] focus:ring-2 focus:ring-[#EDAF11]/20 transition-all bg-gray-50 focus:bg-white" placeholder="Ex: e.g@email.com">
                                    </div>
                                    <div class="input-group">
                                        <label class="block text-sm font-bold text-gray-700 mb-2">{{ __('Région de résidence') }} *</label>
                                        <select v-model="form.region" class="w-full px-5 py-4 rounded-xl border border-gray-200 focus:border-[#EDAF11] focus:ring-2 focus:ring-[#EDAF11]/20 transition-all bg-gray-50 focus:bg-white appearance-none">
                                            <option value="" disabled>{{ __('Sélectionnez...') }}</option>
                                            <option v-for="reg in regions" :key="reg" :value="reg">{{ reg }}</option>
                                        </select>
                                    </div>
                                    <div class="input-group">
                                        <label class="block text-sm font-bold text-gray-700 mb-2">{{ __('Ville / Arrondissement') }} *</label>
                                        <input type="text" v-model="form.city" class="w-full px-5 py-4 rounded-xl border border-gray-200 focus:border-[#EDAF11] focus:ring-2 focus:ring-[#EDAF11]/20 transition-all bg-gray-50 focus:bg-white">
                                    </div>
                                    <div class="input-group md:col-span-2">
                                        <label class="block text-sm font-bold text-gray-700 mb-2">{{ __('Adresse détaillée (Quartier)') }} *</label>
                                        <input type="text" v-model="form.address" class="w-full px-5 py-4 rounded-xl border border-gray-200 focus:border-[#EDAF11] focus:ring-2 focus:ring-[#EDAF11]/20 transition-all bg-gray-50 focus:bg-white">
                                    </div>
                                </div>
                            </div>

                            <!-- STEP 3: Compétences & Expérience -->
                            <div v-else class="form-step">
                                <h2 class="text-2xl font-black text-[#204138] mb-8 flex items-center gap-3">
                                    <svg class="w-6 h-6 text-[#EDAF11]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                    {{ __('Compétences & Expérience') }}
                                </h2>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="input-group md:col-span-2">
                                        <label class="block text-sm font-bold text-gray-700 mb-2">{{ __('Niveau d\'études le plus élevé') }} *</label>
                                        <select v-model="form.education_level" class="w-full px-5 py-4 rounded-xl border border-gray-200 focus:border-[#EDAF11] focus:ring-2 focus:ring-[#EDAF11]/20 transition-all bg-gray-50 focus:bg-white appearance-none">
                                            <option value="" disabled>{{ __('Sélectionnez...') }}</option>
                                            <option value="BEPC">{{ __('BEPC / Equivalent') }}</option>
                                            <option value="BAC">{{ __('Baccalauréat / Equivalent') }}</option>
                                            <option value="LICENCE">{{ __('Licence (BAC+3)') }}</option>
                                            <option value="MASTER">{{ __('Master (BAC+5) et plus') }}</option>
                                        </select>
                                    </div>

                                    <div class="input-group md:col-span-2">
                                        <label class="block text-sm font-bold text-gray-700 mb-4">{{ __('Avez-vous déjà participé à un recensement similaire ?') }}</label>
                                        <div class="flex items-center gap-8">
                                            <label class="flex items-center gap-3 cursor-pointer">
                                                <input type="radio" v-model="form.previous_experience" :value="true" class="w-5 h-5 text-[#EDAF11] border-gray-300 focus:ring-[#EDAF11]">
                                                <span class="text-gray-700 font-semibold">{{ __('Oui') }}</span>
                                            </label>
                                            <label class="flex items-center gap-3 cursor-pointer">
                                                <input type="radio" v-model="form.previous_experience" :value="false" class="w-5 h-5 text-[#EDAF11] border-gray-300 focus:ring-[#EDAF11]">
                                                <span class="text-gray-700 font-semibold">{{ __('Non') }}</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div v-if="form.previous_experience" class="input-group md:col-span-2 animate-fade-in">
                                        <label class="block text-sm font-bold text-gray-700 mb-2">{{ __('Détaillez brièvement votre expérience') }}</label>
                                        <textarea v-model="form.experience_details" rows="3" class="w-full px-5 py-4 rounded-xl border border-gray-200 focus:border-[#EDAF11] focus:ring-2 focus:ring-[#EDAF11]/20 transition-all bg-gray-50 focus:bg-white" placeholder="Décrivez votre rôle et l'année..."></textarea>
                                    </div>
                                </div>
                            </div>

                        </transition>

                        <!-- FORM CONTROLS -->
                        <div class="flex items-center justify-between mt-12 pt-8 border-t border-gray-100">
                            <button type="button" v-if="currentStep > 1" @click="prevStep" 
                                    class="px-8 py-4 rounded-full font-bold text-gray-600 bg-gray-100 hover:bg-gray-200 transition-colors flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                                {{ __('Précédent') }}
                            </button>
                            <div v-else></div> <!-- Spacer -->

                            <button type="button" v-if="currentStep < totalSteps" @click="nextStep"
                                    class="px-8 py-4 rounded-full font-bold text-white bg-[#204138] hover:bg-[#2b5549] shadow-lg shadow-[#204138]/20 transition-all flex items-center gap-2 group">
                                {{ __('Suivant') }}
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </button>

                            <button type="submit" v-if="currentStep === totalSteps" :disabled="form.processing"
                                    class="px-10 py-4 rounded-full font-black text-[#204138] bg-[#EDAF11] hover:bg-[#f6b713] shadow-lg shadow-[#EDAF11]/30 transition-all flex items-center gap-2 hover:scale-105 disabled:opacity-50">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                {{ __('Soumettre ma candidature') }}
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </section>
    </MainLayout>
</template>

<style scoped>
/* === Transitions directionnelles pour le wizard === */

/* Avancer (étape suivante) : entre par la droite, sort par la gauche */
.slide-forward-enter-active,
.slide-forward-leave-active {
    transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
}
.slide-forward-enter-from {
    transform: translateX(40px);
    opacity: 0;
}
.slide-forward-leave-to {
    transform: translateX(-40px);
    opacity: 0;
}

/* Reculer (étape précédente) : entre par la gauche, sort par la droite */
.slide-backward-enter-active,
.slide-backward-leave-active {
    transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
}
.slide-backward-enter-from {
    transform: translateX(-40px);
    opacity: 0;
}
.slide-backward-leave-to {
    transform: translateX(40px);
    opacity: 0;
}

/* === Bandeau de succès === */
.fade-banner-enter-active,
.fade-banner-leave-active {
    transition: all 0.4s ease;
}
.fade-banner-enter-from,
.fade-banner-leave-to {
    opacity: 0;
    transform: translateY(-10px);
}

/* === Fade-in pour le champ experience_details === */
.animate-fade-in {
    animation: fadeIn 0.4s ease-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

/* === Chevron custom pour les selects === */
.input-group select {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
    background-position: right 1rem center;
    background-repeat: no-repeat;
    background-size: 1.5em 1.5em;
}
</style>
