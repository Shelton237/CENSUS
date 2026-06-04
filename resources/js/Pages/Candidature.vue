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
    education_level: '',
    languages: '',
    previous_experience: '',
    experience_details: '',
    has_smartphone: '',
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

const inputClass = (hasError) =>
    `w-full px-3 py-2.5 rounded-md border text-sm transition-colors duration-150 focus:outline-none focus:ring-1 bg-white ${
        hasError
            ? 'border-red-400 focus:border-red-500 focus:ring-red-200'
            : 'border-gray-300 focus:border-[#204138] focus:ring-[#204138]/20'
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

        <!-- ══ HERO BANNER ══ -->
        <section class="bg-[#204138] pt-28 pb-12">
            <div class="container max-w-6xl mx-auto px-4">
                <p class="text-[#EDAF11] text-xs font-bold uppercase tracking-[0.18em] mb-3">Recrutement National 2026</p>
                <h1 class="text-3xl md:text-4xl font-black text-white leading-tight mb-4 max-w-2xl">
                    Devenez Agent Recenseur<br>RGPH4 & RGAE
                </h1>
                <p class="text-white/70 text-sm max-w-xl mb-8 leading-relaxed">
                    Le Bureau Central des Recensements et des Études de Population (BUCREP) recrute des agents de collecte pour les 10 régions du Cameroun.
                </p>
                <div class="flex flex-wrap gap-4">
                    <div class="flex items-center gap-2 bg-white/10 border border-white/20 rounded px-4 py-2.5">
                        <svg class="w-4 h-4 text-[#EDAF11] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <div>
                            <div class="text-white font-black text-lg leading-none tabular-nums">32 059</div>
                            <div class="text-white/60 text-[10px] uppercase tracking-wider">Postes à pourvoir</div>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 bg-white/10 border border-white/20 rounded px-4 py-2.5">
                        <svg class="w-4 h-4 text-[#EDAF11] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        <div>
                            <div class="text-white font-black text-lg leading-none">10 Régions</div>
                            <div class="text-white/60 text-[10px] uppercase tracking-wider">Contrat CDD rémunéré</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ══ SUCCÈS ══ -->
        <div v-if="submitted" class="bg-gray-50 py-20 text-center px-4">
            <div class="w-16 h-16 bg-[#204138]/10 rounded-full flex items-center justify-center mx-auto mb-5">
                <svg class="w-8 h-8 text-[#204138]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <h2 class="text-2xl font-black text-[#204138] mb-3">Candidature soumise avec succès</h2>
            <p class="text-sm text-gray-600 max-w-md mx-auto leading-relaxed">
                Votre dossier a été enregistré. Vous serez contacté(e) par téléphone ou par email si vous êtes présélectionné(e) pour la phase suivante.
            </p>
            <div class="mt-6 text-xs text-gray-400">
                Pour toute question : <a href="mailto:recensement90@gmail.com" class="text-[#204138] hover:underline">recensement90@gmail.com</a>
            </div>
        </div>

        <!-- ══ CORPS ══ -->
        <div v-else class="bg-gray-50 py-10">
            <div class="container max-w-6xl mx-auto px-4">

                <!-- Breadcrumb -->
                <nav class="flex items-center gap-2 text-xs text-gray-400 mb-8">
                    <a href="/accueil" class="hover:text-[#204138] transition-colors">Accueil</a>
                    <span class="text-gray-300">/</span>
                    <span class="text-[#204138] font-medium">Recrutement</span>
                </nav>

                <div class="grid grid-cols-1 lg:grid-cols-[320px_1fr] gap-8 items-start">

                    <!-- ══ SIDEBAR ══ -->
                    <aside class="space-y-4 lg:sticky lg:top-24">

                        <!-- Critères d'éligibilité -->
                        <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
                            <div class="border-l-4 border-[#EDAF11] px-5 py-4">
                                <h3 class="text-xs font-bold text-[#204138] uppercase tracking-wider mb-4">Critères d'éligibilité</h3>
                                <ul class="space-y-2.5">
                                    <li v-for="item in [
                                        'Être camerounais(e)',
                                        '18 à 50 ans au 1er janvier',
                                        'Niveau BEPC minimum ou GCE O-Level',
                                        'Aptitude physique au travail de terrain',
                                        'Parler une langue locale de l\'arrondissement ciblé',
                                        'Posséder un smartphone Android',
                                        'Disposer d\'une adresse e-mail active',
                                        'Disponible pendant toute la durée de l\'opération',
                                    ]" :key="item" class="flex items-start gap-2.5 text-xs text-gray-600 leading-relaxed">
                                        <svg class="w-3.5 h-3.5 text-[#204138] mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                        {{ item }}
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Pièces à fournir -->
                        <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
                            <div class="border-l-4 border-[#204138] px-5 py-4">
                                <h3 class="text-xs font-bold text-[#204138] uppercase tracking-wider mb-1">Pièces à fournir</h3>
                                <p class="text-[10px] text-gray-400 uppercase tracking-wider font-medium mb-4">Si présélectionné(e)</p>
                                <ul class="space-y-2.5">
                                    <li v-for="doc in [
                                        'Lettre de candidature timbrée',
                                        'CV avec expériences en collecte',
                                        'Photocopie CNI en cours de validité',
                                        'Photocopie du diplôme le plus élevé',
                                        'Certificat médical (moins de 3 mois)',
                                        'Justificatif d\'expérience si applicable',
                                    ]" :key="doc" class="flex items-start gap-2.5 text-xs text-gray-600 leading-relaxed">
                                        <svg class="w-3.5 h-3.5 text-gray-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                        {{ doc }}
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Avertissements -->
                        <div class="bg-amber-50 border border-amber-200 border-l-4 border-l-amber-400 rounded-lg px-5 py-4">
                            <h3 class="text-xs font-bold text-amber-800 uppercase tracking-wider mb-3">À noter</h3>
                            <ul class="space-y-2">
                                <li class="text-xs text-amber-800 leading-relaxed">Formation obligatoire de <strong>28 jours</strong> en chef-lieu d'arrondissement</li>
                                <li class="text-xs text-amber-800 leading-relaxed">Candidature multiple = <strong>rejet automatique</strong></li>
                                <li class="text-xs text-amber-800 leading-relaxed">Dossier incomplet = <strong>élimination</strong></li>
                                <li class="text-xs text-amber-800 leading-relaxed">Fonctionnaires : autorisation hiérarchique requise</li>
                            </ul>
                        </div>

                        <!-- Contact -->
                        <div class="bg-white border border-gray-200 rounded-lg px-5 py-4 text-xs text-gray-500 space-y-1">
                            <p class="font-bold text-gray-700 text-[11px] uppercase tracking-wider mb-2">Questions ?</p>
                            <p>
                                <a href="tel:+237693873145" class="text-[#204138] hover:underline">(+237) 6 93 87 31 45</a>
                            </p>
                            <p>
                                <a href="mailto:recensement90@gmail.com" class="text-[#204138] hover:underline">recensement90@gmail.com</a>
                            </p>
                        </div>

                    </aside>

                    <!-- ══ FORMULAIRE ══ -->
                    <div class="bg-white border border-gray-200 rounded-lg">

                        <!-- En-tête -->
                        <div class="px-8 py-6 border-b border-gray-100">
                            <h2 class="text-lg font-black text-[#204138]">Formulaire de Candidature</h2>
                            <p class="text-xs text-gray-400 mt-1">Tous les champs marqués d'un (*) sont obligatoires</p>
                        </div>

                        <form @submit.prevent="submitForm" class="px-8 py-7 space-y-8" autocomplete="off">

                            <!-- Erreur globale -->
                            <div v-if="Object.keys(form.errors).length > 0" class="p-4 bg-red-50 border border-red-200 rounded-md text-sm text-red-700 flex items-start gap-3">
                                <svg class="w-4 h-4 text-red-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <p class="font-semibold text-sm">Veuillez corriger les erreurs ci-dessous avant de soumettre.</p>
                            </div>

                            <!-- ─ Section 1 : Identité ─ -->
                            <div>
                                <div class="flex items-center gap-3 mb-5 pb-2.5 border-b border-gray-100">
                                    <span class="text-[10px] font-bold text-white bg-[#204138] rounded px-2 py-0.5 uppercase tracking-wider">01</span>
                                    <span class="text-sm font-bold text-[#204138] uppercase tracking-wider">Informations personnelles</span>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Prénom *</label>
                                        <input type="text" v-model="form.first_name" :class="inputClass(form.errors.first_name)" placeholder="Jean">
                                        <p v-if="form.errors.first_name" class="mt-1 text-xs text-red-500">{{ form.errors.first_name }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Nom de famille *</label>
                                        <input type="text" v-model="form.last_name" :class="inputClass(form.errors.last_name)" placeholder="Dupont">
                                        <p v-if="form.errors.last_name" class="mt-1 text-xs text-red-500">{{ form.errors.last_name }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Genre *</label>
                                        <select v-model="form.gender" :class="inputClass(form.errors.gender)">
                                            <option value="" disabled>Sélectionnez...</option>
                                            <option value="M">Masculin</option>
                                            <option value="F">Féminin</option>
                                        </select>
                                        <p v-if="form.errors.gender" class="mt-1 text-xs text-red-500">{{ form.errors.gender }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Date de naissance *</label>
                                        <input type="date" v-model="form.birth_date" :class="inputClass(form.errors.birth_date)">
                                        <p v-if="form.errors.birth_date" class="mt-1 text-xs text-red-500">{{ form.errors.birth_date }}</p>
                                    </div>
                                    <div class="sm:col-span-2">
                                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Numéro CNI *</label>
                                        <input type="text" v-model="form.id_card_number" :class="inputClass(form.errors.id_card_number)" placeholder="Ex: 12345678AB">
                                        <p v-if="form.errors.id_card_number" class="mt-1 text-xs text-red-500">{{ form.errors.id_card_number }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- ─ Section 2 : Coordonnées ─ -->
                            <div>
                                <div class="flex items-center gap-3 mb-5 pb-2.5 border-b border-gray-100">
                                    <span class="text-[10px] font-bold text-white bg-[#204138] rounded px-2 py-0.5 uppercase tracking-wider">02</span>
                                    <span class="text-sm font-bold text-[#204138] uppercase tracking-wider">Coordonnées & Localisation</span>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Téléphone *</label>
                                        <input type="tel" v-model="form.phone" :class="inputClass(form.errors.phone)" placeholder="6 XX XX XX XX">
                                        <p v-if="form.errors.phone" class="mt-1 text-xs text-red-500">{{ form.errors.phone }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Adresse e-mail *</label>
                                        <input type="email" v-model="form.email" :class="inputClass(form.errors.email)" placeholder="vous@exemple.cm">
                                        <p v-if="form.errors.email" class="mt-1 text-xs text-red-500">{{ form.errors.email }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Région *</label>
                                        <select v-model="form.region" :class="inputClass(form.errors.region)">
                                            <option value="" disabled>Sélectionnez une région...</option>
                                            <option v-for="r in regions" :key="r" :value="r">{{ r }}</option>
                                        </select>
                                        <p v-if="form.errors.region" class="mt-1 text-xs text-red-500">{{ form.errors.region }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Ville / Arrondissement *</label>
                                        <input type="text" v-model="form.city" :class="inputClass(form.errors.city)" placeholder="Yaoundé, Douala...">
                                        <p v-if="form.errors.city" class="mt-1 text-xs text-red-500">{{ form.errors.city }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- ─ Section 3 : Qualifications ─ -->
                            <div>
                                <div class="flex items-center gap-3 mb-5 pb-2.5 border-b border-gray-100">
                                    <span class="text-[10px] font-bold text-white bg-[#204138] rounded px-2 py-0.5 uppercase tracking-wider">03</span>
                                    <span class="text-sm font-bold text-[#204138] uppercase tracking-wider">Qualifications & Expérience</span>
                                </div>
                                <div class="space-y-5">
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Niveau d'études *</label>
                                        <select v-model="form.education_level" :class="inputClass(form.errors.education_level)">
                                            <option value="" disabled>Sélectionnez votre niveau...</option>
                                            <option v-for="lvl in educationLevels" :key="lvl" :value="lvl">{{ lvl }}</option>
                                        </select>
                                        <p v-if="form.errors.education_level" class="mt-1 text-xs text-red-500">{{ form.errors.education_level }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Langues locales parlées *</label>
                                        <input type="text" v-model="form.languages" :class="inputClass(form.errors.languages)" placeholder="Ex: Ewondo, Bamiléké, Fulfuldé...">
                                        <p class="text-[10px] text-gray-400 mt-1">Indiquez les langues de votre arrondissement cible</p>
                                        <p v-if="form.errors.languages" class="mt-1 text-xs text-red-500">{{ form.errors.languages }}</p>
                                    </div>

                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                        <div>
                                            <label class="block text-xs font-semibold text-gray-600 mb-2">Possédez-vous un smartphone Android ? *</label>
                                            <div class="flex gap-5">
                                                <label class="flex items-center gap-2 cursor-pointer text-sm text-gray-700">
                                                    <input type="radio" v-model="form.has_smartphone" value="oui" class="accent-[#204138] w-4 h-4">
                                                    Oui
                                                </label>
                                                <label class="flex items-center gap-2 cursor-pointer text-sm text-gray-700">
                                                    <input type="radio" v-model="form.has_smartphone" value="non" class="accent-[#204138] w-4 h-4">
                                                    Non
                                                </label>
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block text-xs font-semibold text-gray-600 mb-2">Êtes-vous fonctionnaire ? *</label>
                                            <div class="flex gap-5">
                                                <label class="flex items-center gap-2 cursor-pointer text-sm text-gray-700">
                                                    <input type="radio" v-model="form.fonctionnaire" value="oui" class="accent-[#204138] w-4 h-4">
                                                    Oui
                                                </label>
                                                <label class="flex items-center gap-2 cursor-pointer text-sm text-gray-700">
                                                    <input type="radio" v-model="form.fonctionnaire" value="non" class="accent-[#204138] w-4 h-4">
                                                    Non
                                                </label>
                                            </div>
                                            <p v-if="form.fonctionnaire === 'oui'" class="mt-2 text-xs text-amber-700 bg-amber-50 border border-amber-200 px-3 py-2 rounded-md">
                                                Une autorisation hiérarchique sera exigée lors du dépôt de dossier physique.
                                            </p>
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Expérience en collecte de données</label>
                                        <select v-model="form.previous_experience" :class="inputClass(false)">
                                            <option value="" disabled>Sélectionnez...</option>
                                            <option value="aucune">Aucune expérience</option>
                                            <option value="rgph2005">RGPH 2005</option>
                                            <option value="rgph2021">RGPH 2021 / 2023</option>
                                            <option value="enquete">Autre enquête statistique</option>
                                            <option value="autre">Autre expérience terrain</option>
                                        </select>
                                    </div>

                                    <div v-if="form.previous_experience !== '' && form.previous_experience !== 'aucune'">
                                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Décrivez brièvement votre expérience</label>
                                        <textarea v-model="form.experience_details" rows="3" :class="inputClass(false)" style="resize: vertical; min-height: 80px;" placeholder="Organisation, année, zone géographique..."></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- ─ Consentement + Soumission ─ -->
                            <div class="pt-5 border-t border-gray-100 space-y-5">
                                <div class="flex items-start gap-3 p-4 bg-gray-50 border border-gray-200 rounded-md">
                                    <svg class="w-4 h-4 text-gray-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <p class="text-xs text-gray-500 leading-relaxed">
                                        En soumettant ce formulaire, je certifie que les informations fournies sont exactes et complètes. Je reconnais que toute fausse déclaration entraîne l'élimination immédiate de ma candidature. Les données sont traitées conformément à la réglementation en vigueur.
                                    </p>
                                </div>

                                <button
                                    type="submit"
                                    :disabled="form.processing"
                                    class="w-full py-3.5 bg-[#204138] hover:bg-[#2b5549] text-white font-bold text-xs uppercase tracking-[0.15em] rounded-md transition-colors duration-200 disabled:opacity-60 cursor-pointer flex items-center justify-center gap-3">
                                    <svg v-if="form.processing" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
                                    </svg>
                                    <svg v-else class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
