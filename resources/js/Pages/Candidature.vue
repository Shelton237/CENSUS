<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

const page = usePage();
const __ = (key) => page.props.translations?.[key] || key;

const form = useForm({
    first_name: '',
    last_name: '',
    gender: '',
    birth_date: '',
    id_card_number: '',
    phone: '',
    email: '',
    region: '',
    city: '',
    arrondissement: '',
    education_level: '',
    languages: '',
    previous_experience: '',
    experience_details: '',
    has_smartphone: '',
    has_email: '',
    fonctionnaire: '',
});

const submitted = ref(false);

const submitForm = () => {
    form.post(route('candidature.store'), {
        onSuccess: () => {
            submitted.value = true;
            form.reset();
        },
        onError: () => {},
    });
};

const regions = [
    'Adamaoua', 'Centre', 'Est', 'Extrême-Nord', 'Littoral',
    'Nord', 'Nord-Ouest', 'Ouest', 'Sud', 'Sud-Ouest'
];

const educationLevels = [
    'BEPC / GCE O-Level',
    'Baccalauréat / GCE A-Level',
    'BTS / HND',
    'Licence / Bachelor',
    'Master / Maîtrise',
    'Doctorat',
];

const fieldClass = (hasError) =>
    `w-full px-4 py-3 rounded-xl border text-sm transition-colors duration-150 focus:outline-none focus:ring-2 ${
        hasError
            ? 'border-red-300 bg-red-50 focus:border-red-400 focus:ring-red-100'
            : 'border-gray-200 bg-white focus:border-[#EDAF11] focus:ring-[#EDAF11]/20'
    }`;
</script>

<template>
    <Head>
        <title>Recrutement Agents Recenseurs | RGPH4 & RGAE Cameroun</title>
        <meta name="description" content="Postulez pour devenir agent recenseur du 4ème RGPH et RGAE du Cameroun. 32 059 postes à pourvoir.">
        <meta property="og:title" content="Recrutement Agents Recenseurs | RGPH4 & RGAE Cameroun">
        <meta property="og:image" content="https://census.diginova.cm/assets/images/backgrounds/cameroon_people_map.png">
    </Head>

    <MainLayout>
        <!-- Hero -->
        <section class="relative pt-32 pb-16 bg-[#204138] overflow-hidden">
            <div class="absolute inset-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
            <div class="container relative z-10 text-center">
                <span class="inline-block py-1 px-3 rounded-full bg-[#EDAF11]/20 text-[#EDAF11] font-bold text-xs tracking-widest uppercase mb-4">Recrutement national 2026</span>
                <h1 class="text-4xl md:text-5xl font-black text-white mb-4 leading-tight">Devenez Agent Recenseur</h1>
                <p class="text-lg text-white/75 max-w-xl mx-auto">
                    <span class="font-black text-[#EDAF11] text-2xl">32 059</span> postes sur contrat à durée déterminée dans les 10 régions du Cameroun.
                </p>
            </div>
        </section>

        <!-- Succès -->
        <div v-if="submitted" class="bg-green-50 border-b border-green-200 py-10 text-center px-4">
            <div class="w-14 h-14 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <h2 class="text-xl font-black text-green-800 mb-2">Candidature soumise avec succès !</h2>
            <p class="text-sm text-green-700 max-w-md mx-auto">Votre dossier a été enregistré. Vous serez contacté(e) si vous êtes présélectionné(e) pour la phase suivante.</p>
        </div>

        <!-- Corps principal : sidebar + formulaire -->
        <div v-else class="bg-[#F7F9F8] py-12">
            <div class="container max-w-6xl mx-auto px-4">
                <div class="grid grid-cols-1 lg:grid-cols-[340px_1fr] gap-8 items-start">

                    <!-- ═══ SIDEBAR GAUCHE ═══ -->
                    <aside class="space-y-5 lg:sticky lg:top-24">

                        <!-- Critères d'éligibilité -->
                        <div class="bg-white rounded-2xl p-6 border border-[#204138]/8">
                            <div class="flex items-center gap-2.5 mb-5">
                                <div class="w-7 h-7 bg-[#204138] rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <h3 class="font-bold text-[#204138] text-sm">Critères d'éligibilité</h3>
                            </div>
                            <ul class="space-y-2.5">
                                <li v-for="item in [
                                    'Être camerounais(e)',
                                    'Âgé(e) de 18 à 50 ans au 1er janvier',
                                    'Niveau minimum BEPC ou GCE O-Level',
                                    'Aptitude physique au travail de terrain',
                                    'Parler une langue locale de l\'arrondissement ciblé',
                                    'Posséder un smartphone Android',
                                    'Disposer d\'une adresse e-mail',
                                    'Disponible pendant toute la durée de l\'opération',
                                ]" :key="item" class="flex items-start gap-2 text-xs text-gray-600">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#EDAF11] mt-1.5 flex-shrink-0"></span>
                                    {{ item }}
                                </li>
                            </ul>
                        </div>

                        <!-- Pièces à fournir -->
                        <div class="bg-white rounded-2xl p-6 border border-[#204138]/8">
                            <div class="flex items-center gap-2.5 mb-4">
                                <div class="w-7 h-7 bg-[#EDAF11] rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3.5 h-3.5 text-[#204138]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <h3 class="font-bold text-[#204138] text-sm">Pièces à fournir</h3>
                            </div>
                            <p class="text-[10px] text-gray-400 uppercase tracking-wider font-semibold mb-3">Si présélectionné(e)</p>
                            <ul class="space-y-2.5">
                                <li v-for="doc in [
                                    'Lettre de candidature timbrée',
                                    'CV avec expériences en collecte de données',
                                    'Photocopie CNI en cours de validité',
                                    'Photocopie du diplôme le plus élevé',
                                    'Certificat médical (moins de 3 mois)',
                                    'Justificatif d\'expérience (si applicable)',
                                ]" :key="doc" class="flex items-start gap-2 text-xs text-gray-600">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#204138] mt-1.5 flex-shrink-0"></span>
                                    {{ doc }}
                                </li>
                            </ul>
                        </div>

                        <!-- Avertissements -->
                        <div class="bg-amber-50 rounded-2xl p-5 border border-amber-200">
                            <h3 class="font-bold text-amber-800 text-xs uppercase tracking-wider mb-3">Points importants</h3>
                            <ul class="space-y-2.5">
                                <li class="flex items-start gap-2 text-xs text-amber-800">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mt-1.5 flex-shrink-0"></span>
                                    Formation obligatoire de <strong>28 jours</strong> en chef-lieu d'arrondissement
                                </li>
                                <li class="flex items-start gap-2 text-xs text-amber-800">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mt-1.5 flex-shrink-0"></span>
                                    Candidature dans plusieurs arrondissements = <strong>rejet automatique</strong>
                                </li>
                                <li class="flex items-start gap-2 text-xs text-amber-800">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mt-1.5 flex-shrink-0"></span>
                                    Dossier incomplet ou frauduleux = <strong>élimination immédiate</strong>
                                </li>
                                <li class="flex items-start gap-2 text-xs text-amber-800">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mt-1.5 flex-shrink-0"></span>
                                    Fonctionnaires : autorisation hiérarchique requise
                                </li>
                                <li class="flex items-start gap-2 text-xs text-amber-800">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mt-1.5 flex-shrink-0"></span>
                                    Anciens candidats (2021/2023) doivent repostuler
                                </li>
                            </ul>
                        </div>

                    </aside>

                    <!-- ═══ FORMULAIRE ═══ -->
                    <div class="bg-white rounded-2xl border border-[#204138]/8 overflow-hidden">

                        <!-- En-tête formulaire -->
                        <div class="bg-[#204138] px-8 py-6">
                            <h2 class="text-xl font-black text-white">Formulaire de Candidature</h2>
                            <p class="text-sm text-white/60 mt-1">Remplissez tous les champs marqués d'un astérisque (*)</p>
                        </div>

                        <form @submit.prevent="submitForm" class="p-8 space-y-8">

                            <!-- Erreur globale -->
                            <div v-if="Object.keys(form.errors).length > 0" class="p-4 bg-red-50 border border-red-200 rounded-xl text-sm text-red-700 flex items-start gap-3">
                                <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <div>
                                    <p class="font-bold">Veuillez corriger les erreurs ci-dessous avant de soumettre.</p>
                                </div>
                            </div>

                            <!-- ── Section 1 : Identité ── -->
                            <fieldset>
                                <legend class="flex items-center gap-2 mb-5 pb-3 border-b border-gray-100 w-full">
                                    <span class="w-6 h-6 bg-[#204138] rounded-md flex items-center justify-center text-white text-xs font-black flex-shrink-0">1</span>
                                    <span class="text-sm font-bold text-[#204138] uppercase tracking-wider">Informations personnelles</span>
                                </legend>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                    <div>
                                        <label class="block text-xs font-bold text-gray-700 mb-1.5 uppercase tracking-wide">Prénom *</label>
                                        <input type="text" v-model="form.first_name" :class="fieldClass(form.errors.first_name)" placeholder="Jean">
                                        <p v-if="form.errors.first_name" class="mt-1 text-xs text-red-500">{{ form.errors.first_name }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-gray-700 mb-1.5 uppercase tracking-wide">Nom *</label>
                                        <input type="text" v-model="form.last_name" :class="fieldClass(form.errors.last_name)" placeholder="Dupont">
                                        <p v-if="form.errors.last_name" class="mt-1 text-xs text-red-500">{{ form.errors.last_name }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-gray-700 mb-1.5 uppercase tracking-wide">Genre *</label>
                                        <select v-model="form.gender" :class="fieldClass(form.errors.gender)">
                                            <option value="" disabled>Sélectionnez...</option>
                                            <option value="M">Masculin</option>
                                            <option value="F">Féminin</option>
                                        </select>
                                        <p v-if="form.errors.gender" class="mt-1 text-xs text-red-500">{{ form.errors.gender }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-gray-700 mb-1.5 uppercase tracking-wide">Date de naissance *</label>
                                        <input type="date" v-model="form.birth_date" :class="fieldClass(form.errors.birth_date)">
                                        <p v-if="form.errors.birth_date" class="mt-1 text-xs text-red-500">{{ form.errors.birth_date }}</p>
                                    </div>
                                    <div class="sm:col-span-2">
                                        <label class="block text-xs font-bold text-gray-700 mb-1.5 uppercase tracking-wide">Numéro CNI *</label>
                                        <input type="text" v-model="form.id_card_number" :class="fieldClass(form.errors.id_card_number)" placeholder="Ex: 12345678AB">
                                        <p v-if="form.errors.id_card_number" class="mt-1 text-xs text-red-500">{{ form.errors.id_card_number }}</p>
                                    </div>
                                </div>
                            </fieldset>

                            <!-- ── Section 2 : Coordonnées ── -->
                            <fieldset>
                                <legend class="flex items-center gap-2 mb-5 pb-3 border-b border-gray-100 w-full">
                                    <span class="w-6 h-6 bg-[#204138] rounded-md flex items-center justify-center text-white text-xs font-black flex-shrink-0">2</span>
                                    <span class="text-sm font-bold text-[#204138] uppercase tracking-wider">Coordonnées & Localisation</span>
                                </legend>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                    <div>
                                        <label class="block text-xs font-bold text-gray-700 mb-1.5 uppercase tracking-wide">Téléphone *</label>
                                        <input type="tel" v-model="form.phone" :class="fieldClass(form.errors.phone)" placeholder="6 XX XX XX XX">
                                        <p v-if="form.errors.phone" class="mt-1 text-xs text-red-500">{{ form.errors.phone }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-gray-700 mb-1.5 uppercase tracking-wide">Adresse e-mail *</label>
                                        <input type="email" v-model="form.email" :class="fieldClass(form.errors.email)" placeholder="vous@exemple.cm">
                                        <p v-if="form.errors.email" class="mt-1 text-xs text-red-500">{{ form.errors.email }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-gray-700 mb-1.5 uppercase tracking-wide">Région *</label>
                                        <select v-model="form.region" :class="fieldClass(form.errors.region)">
                                            <option value="" disabled>Sélectionnez une région...</option>
                                            <option v-for="r in regions" :key="r" :value="r">{{ r }}</option>
                                        </select>
                                        <p v-if="form.errors.region" class="mt-1 text-xs text-red-500">{{ form.errors.region }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-gray-700 mb-1.5 uppercase tracking-wide">Ville / Arrondissement *</label>
                                        <input type="text" v-model="form.city" :class="fieldClass(form.errors.city)" placeholder="Yaoundé, Douala...">
                                        <p v-if="form.errors.city" class="mt-1 text-xs text-red-500">{{ form.errors.city }}</p>
                                    </div>
                                </div>
                            </fieldset>

                            <!-- ── Section 3 : Qualifications ── -->
                            <fieldset>
                                <legend class="flex items-center gap-2 mb-5 pb-3 border-b border-gray-100 w-full">
                                    <span class="w-6 h-6 bg-[#204138] rounded-md flex items-center justify-center text-white text-xs font-black flex-shrink-0">3</span>
                                    <span class="text-sm font-bold text-[#204138] uppercase tracking-wider">Qualifications & Expérience</span>
                                </legend>
                                <div class="space-y-5">
                                    <div>
                                        <label class="block text-xs font-bold text-gray-700 mb-1.5 uppercase tracking-wide">Niveau d'études *</label>
                                        <select v-model="form.education_level" :class="fieldClass(form.errors.education_level)">
                                            <option value="" disabled>Sélectionnez votre niveau...</option>
                                            <option v-for="lvl in educationLevels" :key="lvl" :value="lvl">{{ lvl }}</option>
                                        </select>
                                        <p v-if="form.errors.education_level" class="mt-1 text-xs text-red-500">{{ form.errors.education_level }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-gray-700 mb-1.5 uppercase tracking-wide">Langues locales parlées *</label>
                                        <input type="text" v-model="form.languages" :class="fieldClass(form.errors.languages)" placeholder="Ex: Ewondo, Bamiléké, Fulfuldé...">
                                        <p class="text-[10px] text-gray-400 mt-1">Indiquez les langues locales de votre arrondissement cible</p>
                                        <p v-if="form.errors.languages" class="mt-1 text-xs text-red-500">{{ form.errors.languages }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-gray-700 mb-1.5 uppercase tracking-wide">Possédez-vous un smartphone Android ? *</label>
                                        <div class="flex gap-4">
                                            <label class="flex items-center gap-2 cursor-pointer">
                                                <input type="radio" v-model="form.has_smartphone" value="oui" class="accent-[#204138]">
                                                <span class="text-sm text-gray-700">Oui</span>
                                            </label>
                                            <label class="flex items-center gap-2 cursor-pointer">
                                                <input type="radio" v-model="form.has_smartphone" value="non" class="accent-[#204138]">
                                                <span class="text-sm text-gray-700">Non</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-gray-700 mb-1.5 uppercase tracking-wide">Êtes-vous fonctionnaire ? *</label>
                                        <div class="flex gap-4">
                                            <label class="flex items-center gap-2 cursor-pointer">
                                                <input type="radio" v-model="form.fonctionnaire" value="oui" class="accent-[#204138]">
                                                <span class="text-sm text-gray-700">Oui</span>
                                            </label>
                                            <label class="flex items-center gap-2 cursor-pointer">
                                                <input type="radio" v-model="form.fonctionnaire" value="non" class="accent-[#204138]">
                                                <span class="text-sm text-gray-700">Non</span>
                                            </label>
                                        </div>
                                        <p v-if="form.fonctionnaire === 'oui'" class="mt-2 text-xs text-amber-700 bg-amber-50 px-3 py-2 rounded-lg">
                                            Une autorisation hiérarchique sera exigée lors du dépôt de dossier.
                                        </p>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-gray-700 mb-1.5 uppercase tracking-wide">Avez-vous une expérience en collecte de données ?</label>
                                        <select v-model="form.previous_experience" :class="fieldClass(false)">
                                            <option value="" disabled>Sélectionnez...</option>
                                            <option value="aucune">Aucune expérience</option>
                                            <option value="rgph2005">RGPH 2005</option>
                                            <option value="rgph2021">RGPH 2021 / 2023</option>
                                            <option value="enquete">Autre enquête statistique</option>
                                            <option value="autre">Autre</option>
                                        </select>
                                    </div>
                                    <div v-if="form.previous_experience && form.previous_experience !== 'aucune'">
                                        <label class="block text-xs font-bold text-gray-700 mb-1.5 uppercase tracking-wide">Détails de l'expérience</label>
                                        <textarea v-model="form.experience_details" rows="3" :class="fieldClass(false)" placeholder="Décrivez brièvement votre expérience..."></textarea>
                                    </div>
                                </div>
                            </fieldset>

                            <!-- ── Consentement + Soumission ── -->
                            <div class="pt-4 border-t border-gray-100 space-y-5">
                                <p class="text-xs text-gray-500 leading-relaxed bg-gray-50 p-4 rounded-xl">
                                    En soumettant ce formulaire, je certifie que les informations fournies sont exactes et complètes. Je reconnais que toute fausse déclaration entraîne l'élimination immédiate de ma candidature.
                                </p>
                                <button
                                    type="submit"
                                    :disabled="form.processing"
                                    class="w-full py-4 bg-[#204138] hover:bg-[#2b5549] text-white font-black text-sm uppercase tracking-widest rounded-xl transition-colors duration-200 disabled:opacity-60 cursor-pointer flex items-center justify-center gap-3">
                                    <svg v-if="form.processing" class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
                                    </svg>
                                    <svg v-else class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7m0 0l-7 7m7-7H3"/>
                                    </svg>
                                    {{ form.processing ? 'Envoi en cours...' : 'Soumettre ma candidature' }}
                                </button>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>

    </MainLayout>
</template>
