<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';
import { Head, usePage } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';

const page = usePage();
const __ = (key) => {
    return page.props.translations?.[key] || key;
};

// Données de la galerie photo du terrain
const activeActivityTab = ref('all');
const activeRegionTab = ref('all');
const visiblePhotosCount = ref(12);
const activeLightboxIndex = ref(null);

const galleryActivityTabs = computed(() => [
    { id: 'all', label: __('Toutes les activités') },
    { id: 'collecte', label: __('Collecte') },
    { id: 'sensibilisation', label: __('Sensibilisation') },
    { id: 'formation', label: __('Formations') },
    { id: 'supervision', label: __('Supervision') },
    { id: 'evenement', label: __('Événements & Défilés') }
]);

const galleryRegionTabs = computed(() => [
    { id: 'all', label: __('Toutes les régions') },
    { id: 'centre', label: __('Centre') },
    { id: 'est', label: __('Est') },
    { id: 'littoral', label: __('Littoral') },
    { id: 'ouest', label: __('Ouest') }
]);

const getCategoryLabel = (category) => {
    const map = {
        'collecte': 'Collecte',
        'sensibilisation': 'Sensibilisation',
        'formation': 'Formations',
        'supervision': 'Supervision',
        'evenement': 'Événements & Défilés'
    };
    const key = map[category] || category;
    return __(key);
};

const getRegionLabel = (region) => {
    const map = {
        'centre': 'Centre',
        'est': 'Est',
        'littoral': 'Littoral',
        'ouest': 'Ouest'
    };
    const key = map[region] || region;
    return __(key);
};

const galleryPhotos = [
    // Existing drive-based photos (marked with region: 'centre')
    { id: 1, driveId: '1FWtGiJvEm0qcSSZARSjlhNW9KPzWWORP', category: 'sensibilisation', region: 'centre', caption: 'Sensibilisation des communautés locales', date: '13 Mai 2026' },
    { id: 2, driveId: '1oqwbSYvhZ8bz7XUu1jrnTYI6fRlTOknv', category: 'collecte', region: 'centre', caption: 'Collecte numérique auprès des ménages', date: '13 Mai 2026' },
    { id: 3, driveId: '1oTJAEN1sH2PVTvQGwv7cvKjYWvQatCNh', category: 'collecte', region: 'centre', caption: 'Enregistrement des données sur le terrain', date: '13 Mai 2026' },
    { id: 4, driveId: '1oKrXVGw5kMrlikCOUVHD4T-Ne3Lc-Lzm', category: 'supervision', region: 'centre', caption: 'Briefing quotidien de l\'équipe de supervision', date: '13 Mai 2026' },
    { id: 5, driveId: '1vS22wToWoNEmm9NlRHibyJmiLe-A1VrG', category: 'collecte', region: 'centre', caption: 'Déploiement des agents recenseurs dans les ménages', date: '14 Mai 2026' },
    { id: 6, driveId: '13VVf3MGzXC8Lby_UHlm7Br8OcxjuQ37w', category: 'collecte', region: 'centre', caption: 'Entretien avec les chefs de familles', date: '14 Mai 2026' },
    { id: 7, driveId: '1puNrSajizGJ2oOmWKQ7-eon4KNXVpKJ2', category: 'sensibilisation', region: 'centre', caption: 'Explications des objectifs du dénombrement', date: '14 Mai 2026' },
    { id: 8, driveId: '1WHyeqhOu0iOyjT_R4nWLPUswEA_KYgU2', category: 'formation', region: 'centre', caption: 'Atelier pratique d\'utilisation des tablettes', date: '14 Mai 2026' },
    { id: 9, driveId: '1zk353AM9DgpgiMtd7LR44g2Gy-ELJ3Mk', category: 'sensibilisation', region: 'centre', caption: 'Campagne de communication de proximité', date: '14 Mai 2026' },
    { id: 10, driveId: '13fNVmJSjE9A5rMKDDtvUyeXZ7h5yk0kV', category: 'supervision', region: 'centre', caption: 'Réunion technique des superviseurs de zone', date: '14 Mai 2026' },
    { id: 11, driveId: '1IDlgsOi72Bm1cO0NQ2xtDPOF8xWlWu4y', category: 'collecte', region: 'centre', caption: 'Vérification de la couverture géographique', date: '14 Mai 2026' },
    { id: 12, driveId: '1RbGNNSREOMiIQQJKBh-7WRSfZuwj-uy7', category: 'formation', region: 'centre', caption: 'Session de renforcement des capacités', date: '14 Mai 2026' },
    { id: 13, driveId: '1sEDX69lTRGMNwPv37muBo7puTjz2VPIl', category: 'collecte', region: 'centre', caption: 'Suivi cartographique en temps réel', date: '14 Mai 2026' },
    { id: 14, driveId: '1O9VHYAmab0v6_z8PK6XpwYo-txYYmjwq', category: 'sensibilisation', region: 'centre', caption: 'Échanges constructifs avec la population', date: '14 Mai 2026' },
    { id: 15, driveId: '1tgenkvIt9EHzUgjT6-XToZd5kz_lxn3O', category: 'supervision', region: 'centre', caption: 'Point d\'avancement des équipes de collecte', date: '14 Mai 2026' },
    { id: 16, driveId: '1kx0OSmB7TlaafL2zBs7VT6cWCJbENeXJ', category: 'collecte', region: 'centre', caption: 'Saisie rigoureuse des formulaires statistiques', date: '15 Mai 2026' },
    { id: 17, driveId: '1HuDKPkvYxixYgZ8XlQoGhXl7h283Cyt1', region: 'centre', category: 'formation', caption: 'Instruction pratique sur le terrain', date: '15 Mai 2026' },
    { id: 18, driveId: '1JJiiX3diLNbAusdP1rbZ59ymGj4vyv8Z', category: 'collecte', region: 'centre', caption: 'Validation finale des questionnaires d\'enquête', date: '15 Mai 2026' },

    // Group 1: Après le Défilé à Moloundou (Region: est, Category: evenement)
    { id: 19, type: 'video', src: '/assets/images/phototheque/Après le Défilé à Moloundou Dernière arrondissement frontalier avec le Congo/WhatsApp Video 2026-05-20 at 13.03.125.mp4', category: 'evenement', region: 'est', caption: 'Célébration patriotique après le défilé à Moloundou', date: '20 Mai 2026' },
    { id: 20, type: 'video', src: '/assets/images/phototheque/Après le Défilé à Moloundou Dernière arrondissement frontalier avec le Congo/WhatsApp Video 2026-05-20 at 13.03.15.mp4', category: 'evenement', region: 'est', caption: 'Défilé du 20 Mai des équipes du RGPH à la frontière Congolaise', date: '20 Mai 2026' },
    { id: 21, type: 'video', src: '/assets/images/phototheque/Après le Défilé à Moloundou Dernière arrondissement frontalier avec le Congo/WhatsApp Video 2026-05-20 at 13.03.16.mp4', category: 'evenement', region: 'est', caption: 'Déploiement festif des équipes de recensement à Moloundou', date: '20 Mai 2026' },
    { id: 22, type: 'video', src: '/assets/images/phototheque/Après le Défilé à Moloundou Dernière arrondissement frontalier avec le Congo/WhatsApp Video 2026-05-20 at 13.03.162.mp4', category: 'evenement', region: 'est', caption: 'Engagement citoyen et défilé de l\'unité nationale', date: '20 Mai 2026' },

    // Group 2: Baré bakem au défil (Region: littoral, Category: evenement)
    { id: 23, type: 'image', src: '/assets/images/phototheque/Baré bakem au défil/WhatsApp Image 2026-05-20 at 13.03.16.jpeg', category: 'evenement', region: 'littoral', caption: 'Équipe du RGPH au défilé officiel de Baré-Bakem', date: '20 Mai 2026' },
    { id: 24, type: 'image', src: '/assets/images/phototheque/Baré bakem au défil/WhatsApp Image 2026-05-20 at 13.03.17.jpeg', category: 'evenement', region: 'littoral', caption: 'Défilé de l\'unité nationale et promotion du RGPH à Baré-Bakem', date: '20 Mai 2026' },

    // Group 3: Journée de sensibilisation au stade de TOKET (Region: ouest, Category: sensibilisation/evenement)
    { id: 25, type: 'image', src: '/assets/images/phototheque/Journée de sensibilisation au stade de TOKET pour le défilé du 20 Mai la célébration de la fête de l\'unité nationale à bafoussam/WhatsApp Image 2026-05-20 at 13.03.12.jpeg', category: 'sensibilisation', region: 'ouest', caption: 'Grande mobilisation pour le RGPH au stade de Toket à Bafoussam', date: '20 Mai 2026' },
    { id: 26, type: 'image', src: '/assets/images/phototheque/Journée de sensibilisation au stade de TOKET pour le défilé du 20 Mai la célébration de la fête de l\'unité nationale à bafoussam/WhatsApp Image 2026-05-20 at 13.03.124.jpeg', category: 'evenement', region: 'ouest', caption: 'Campagne de sensibilisation du défilé du 20 Mai à Bafoussam', date: '20 Mai 2026' },
    { id: 27, type: 'image', src: '/assets/images/phototheque/Journée de sensibilisation au stade de TOKET pour le défilé du 20 Mai la célébration de la fête de l\'unité nationale à bafoussam/WhatsApp Image 2026-05-20 at 13.03.13.jpeg', category: 'sensibilisation', region: 'ouest', caption: 'Distribution de flyers informatifs au stade Toket', date: '20 Mai 2026' },
    { id: 28, type: 'image', src: '/assets/images/phototheque/Journée de sensibilisation au stade de TOKET pour le défilé du 20 Mai la célébration de la fête de l\'unité nationale à bafoussam/WhatsApp Image 2026-05-20 at 13.03.133.jpeg', category: 'sensibilisation', region: 'ouest', caption: 'Rassemblement citoyen pour le recensement de la population', date: '20 Mai 2026' },
    { id: 29, type: 'image', src: '/assets/images/phototheque/Journée de sensibilisation au stade de TOKET pour le défilé du 20 Mai la célébration de la fête de l\'unité nationale à bafoussam/WhatsApp Image 2026-05-20 at 13.03.14.jpeg', category: 'sensibilisation', region: 'ouest', caption: 'Échanges avec la jeunesse bafoussamaise au stade de Toket', date: '20 Mai 2026' },
    { id: 30, type: 'image', src: '/assets/images/phototheque/Journée de sensibilisation au stade de TOKET pour le défilé du 20 Mai la célébration de la fête de l\'unité nationale à bafoussam/WhatsApp Image 2026-05-20 at 13.03.17.jpeg', category: 'sensibilisation', region: 'ouest', caption: 'Sensibilisation festive et dynamique des équipes terrain', date: '20 Mai 2026' },
    { id: 31, type: 'image', src: '/assets/images/phototheque/Journée de sensibilisation au stade de TOKET pour le défilé du 20 Mai la célébration de la fête de l\'unité nationale à bafoussam/WhatsApp Image 2026-05-20 at 13.03.193.jpeg', category: 'evenement', region: 'ouest', caption: 'Mobilisation générale pour la fête de l\'unité nationale', date: '20 Mai 2026' },
    { id: 32, type: 'video', src: '/assets/images/phototheque/Journée de sensibilisation au stade de TOKET pour le défilé du 20 Mai la célébration de la fête de l\'unité nationale à bafoussam/WhatsApp Video 2026-05-20 at 13.03.12.mp4', category: 'sensibilisation', region: 'ouest', caption: 'Ambiance et ferveur patriotique au stade Toket pour le RGPH', date: '20 Mai 2026' },
    { id: 33, type: 'video', src: '/assets/images/phototheque/Journée de sensibilisation au stade de TOKET pour le défilé du 20 Mai la célébration de la fête de l\'unité nationale à bafoussam/WhatsApp Video 2026-05-20 at 13.03.13.mp4', category: 'sensibilisation', region: 'ouest', caption: 'Animation et chants pour la sensibilisation au recensement', date: '20 Mai 2026' }
];

const filteredGalleryPhotos = computed(() => {
    return galleryPhotos.filter(p => {
        const matchesActivity = activeActivityTab.value === 'all' || p.category === activeActivityTab.value;
        const matchesRegion = activeRegionTab.value === 'all' || p.region === activeRegionTab.value;
        return matchesActivity && matchesRegion;
    });
});

const openLightbox = (photo) => {
    const index = galleryPhotos.findIndex(p => p.id === photo.id);
    if (index !== -1) {
        activeLightboxIndex.value = index;
    }
};

const closeLightbox = () => {
    activeLightboxIndex.value = null;
};

const nextLightboxPhoto = () => {
    if (activeLightboxIndex.value !== null) {
        activeLightboxIndex.value = (activeLightboxIndex.value + 1) % galleryPhotos.length;
    }
};

const prevLightboxPhoto = () => {
    if (activeLightboxIndex.value !== null) {
        activeLightboxIndex.value = (activeLightboxIndex.value - 1 + galleryPhotos.length) % galleryPhotos.length;
    }
};

const handleKeyDown = (e) => {
    if (activeLightboxIndex.value === null) return;
    if (e.key === 'Escape') closeLightbox();
    else if (e.key === 'ArrowRight') nextLightboxPhoto();
    else if (e.key === 'ArrowLeft') prevLightboxPhoto();
};

onMounted(() => {
    window.addEventListener('keydown', handleKeyDown);
});

onUnmounted(() => {
    window.removeEventListener('keydown', handleKeyDown);
});
</script>

<template>
    <Head>
        <title>Photothèque | RGPH4 & RGAE Cameroun</title>
        <meta name="description" content="Photos et vidéos de terrain du 4ème RGPH et RGAE — agents recenseurs déployés dans toutes les régions du Cameroun.">
        <meta property="og:title" content="Photothèque | RGPH4 & RGAE Cameroun">
        <meta property="og:description" content="Galerie officielle du recensement — photos et vidéos de nos équipes de terrain dans les 10 régions du Cameroun.">
        <meta property="og:image" content="https://census.diginova.cm/assets/images/backgrounds/cameroon_people_map.png">
        <meta property="og:type" content="website">
        <meta property="og:locale" content="fr_FR">
        <meta property="og:site_name" content="Recensement Cameroun 2026">
        <meta property="og:url" content="https://census.diginova.cm/phototheque">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@recensement90">
        <meta name="twitter:title" content="Photothèque | RGPH4 & RGAE Cameroun">
        <meta name="twitter:image" content="https://census.diginova.cm/assets/images/backgrounds/cameroon_people_map.png">
    </Head>

    <MainLayout>
        <!-- Hero Section -->
        <section class="relative pt-32 pb-20 overflow-hidden bg-[#204138]">
            <div class="absolute inset-0 z-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
            <div class="container relative z-10 text-center">
                <span class="inline-block py-1 px-3 rounded-full bg-[#EDAF11]/20 text-[#EDAF11] font-bold text-sm tracking-widest uppercase mb-4">{{ __('Médiathèque') }}</span>
                <h1 class="text-4xl md:text-5xl font-black text-white mb-6 leading-tight">{{ __('La Photothèque du Terrain') }}</h1>
                <p class="text-xl text-white/80 max-w-2xl mx-auto leading-relaxed">{{ __('Découvrez en images et en vidéos le travail de nos équipes déployées au cœur des communautés.') }}</p>
            </div>
        </section>

        <!-- Galerie de terrain -->
        <section class="field-gallery-section" style="padding: 80px 0; background: #FAFDFB;">
            <div class="container mx-auto px-4 md:px-6">
                
                <!-- Filtres Double-Axe Premium -->
                <div class="bg-white rounded-[32px] p-6 md:p-8 border border-[#E5E9E7] shadow-[0_20px_40px_rgba(32,65,56,0.02)] max-w-5xl mx-auto mb-16">
                    <!-- Axe 1: Activités -->
                    <div class="mb-6">
                        <span class="block text-xs font-bold text-[#204138]/50 uppercase tracking-widest mb-3 text-center md:text-left">
                            {{ __('Filtrer par Activité') }}
                        </span>
                        <div class="flex flex-wrap justify-center md:justify-start gap-2.5">
                            <button 
                                v-for="tab in galleryActivityTabs" 
                                :key="tab.id"
                                @click="activeActivityTab = tab.id; visiblePhotosCount = 12;"
                                class="px-5 py-2.5 rounded-full text-xs md:text-sm font-extrabold transition-all duration-300 border flex items-center gap-2"
                                :class="activeActivityTab === tab.id 
                                    ? 'bg-[#204138] border-[#204138] text-white shadow-md shadow-[#204138]/10' 
                                    : 'bg-white border-[#E5E9E7] text-[#204138] hover:border-[#204138]/40 hover:bg-[#204138]/5'"
                            >
                                <span v-if="tab.id === 'all'" class="w-1.5 h-1.5 rounded-full bg-current"></span>
                                {{ tab.label }}
                            </button>
                        </div>
                    </div>

                    <!-- Séparateur discret -->
                    <div class="h-px bg-gray-100 my-6"></div>

                    <!-- Axe 2: Régions -->
                    <div>
                        <span class="block text-xs font-bold text-[#204138]/50 uppercase tracking-widest mb-3 text-center md:text-left">
                            {{ __('Filtrer par Région') }}
                        </span>
                        <div class="flex flex-wrap justify-center md:justify-start gap-2.5">
                            <button 
                                v-for="tab in galleryRegionTabs" 
                                :key="tab.id"
                                @click="activeRegionTab = tab.id; visiblePhotosCount = 12;"
                                class="px-5 py-2.5 rounded-full text-xs md:text-sm font-extrabold transition-all duration-300 border flex items-center gap-2"
                                :class="activeRegionTab === tab.id 
                                    ? 'bg-[#EDAF11] border-[#EDAF11] text-[#204138] shadow-md shadow-[#EDAF11]/10' 
                                    : 'bg-white border-[#E5E9E7] text-[#204138] hover:border-[#204138]/40 hover:bg-[#204138]/5'"
                            >
                                <span v-if="tab.id === 'all'" class="w-1.5 h-1.5 rounded-full bg-current"></span>
                                {{ tab.label }}
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Grille de Photos -->
                <div class="gallery-grid">
                    <div 
                        v-for="photo in filteredGalleryPhotos.slice(0, visiblePhotosCount)" 
                        :key="photo.id"
                        class="gallery-card group relative overflow-hidden rounded-[24px] cursor-pointer"
                        @click="openLightbox(photo)"
                    >
                        <div class="gallery-img-wrapper h-full relative aspect-square md:aspect-[4/3] overflow-hidden">
                            <!-- Type Vidéo local -->
                            <video 
                                v-if="photo.type === 'video'"
                                :src="photo.src" 
                                class="gallery-img w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                muted 
                                loop 
                                playsinline
                                @mouseenter="$event.target.play()"
                                @mouseleave="$event.target.pause(); $event.target.currentTime = 0;"
                            ></video>
                            <!-- Type Image local -->
                            <img 
                                v-else-if="photo.src"
                                :src="photo.src" 
                                :alt="__(photo.caption)"
                                class="gallery-img w-full h-full object-cover transition-transform duration-700 group-hover:scale-106"
                                loading="lazy"
                            />
                            <!-- Type Image Drive -->
                            <img 
                                v-else
                                :src="`https://drive.google.com/thumbnail?id=${photo.driveId}&sz=w800`" 
                                :alt="__(photo.caption)"
                                class="gallery-img w-full h-full object-cover transition-transform duration-700 group-hover:scale-106"
                                loading="lazy"
                            />

                            <!-- Overlay de lecture pour les vidéos -->
                            <div v-if="photo.type === 'video'" class="absolute inset-0 flex items-center justify-center pointer-events-none z-10 transition-transform duration-300 group-hover:scale-110">
                                <div class="bg-black/40 backdrop-blur-md text-white p-3.5 rounded-full shadow-lg border border-white/20">
                                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z"/>
                                    </svg>
                                </div>
                            </div>

                            <!-- Overlay de carte (Catégorie, Région, Caption) -->
                            <div class="gallery-card-overlay">
                                <div class="flex items-center justify-between w-full mb-1">
                                    <span class="gallery-card-category">{{ getCategoryLabel(photo.category) }}</span>
                                    <span v-if="photo.region" class="px-2 py-0.5 rounded text-[10px] font-bold bg-[#EDAF11] text-[#204138] uppercase tracking-wider">
                                        {{ getRegionLabel(photo.region) }}
                                    </span>
                                </div>
                                <h3 class="gallery-card-title">{{ __(photo.caption) }}</h3>
                                <span class="gallery-card-date">{{ __(photo.date) }}</span>
                            </div>

                            <!-- Icône Zoom/Expansion -->
                            <div class="gallery-card-icon">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bouton Voir Plus -->
                <div v-if="visiblePhotosCount < filteredGalleryPhotos.length" class="text-center mt-16">
                    <button 
                        @click="visiblePhotosCount += 6"
                        class="inline-flex items-center gap-3 bg-[#204138] text-white px-10 py-4 rounded-full font-bold hover:bg-[#EDAF11] hover:text-[#204138] transition-all shadow-md hover:-translate-y-0.5 duration-300"
                    >
                        {{ __('Charger plus d\'images') }}
                        <svg class="w-5 h-5 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 13l-7 7-7-7m14-6l-7 7-7-7" />
                        </svg>
                    </button>
                </div>
            </div>
        </section>

        <!-- ===================== LIGHTBOX MODAL ===================== -->
        <Transition name="fade">
            <div v-if="activeLightboxIndex !== null" class="gallery-lightbox" @click.self="closeLightbox">
                <div class="lightbox-content-wrapper">
                    <!-- Bouton Fermer -->
                    <button class="lightbox-close-btn" @click="closeLightbox" aria-label="Close">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <!-- Navigation Gauche -->
                    <button class="lightbox-arrow lightbox-arrow-left" @click="prevLightboxPhoto" aria-label="Previous">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>

                    <!-- Image / Vidéo Container -->
                    <div class="lightbox-img-container w-full aspect-video md:aspect-auto max-h-[75vh]">
                        <!-- Si c'est une vidéo locale -->
                        <video 
                            v-if="galleryPhotos[activeLightboxIndex].type === 'video'"
                            :src="galleryPhotos[activeLightboxIndex].src" 
                            class="lightbox-img w-full h-full max-h-[75vh] object-contain"
                            controls 
                            autoplay
                        ></video>
                        <!-- Si c'est une image locale -->
                        <img 
                            v-else-if="galleryPhotos[activeLightboxIndex].src"
                            :src="galleryPhotos[activeLightboxIndex].src" 
                            :alt="__(galleryPhotos[activeLightboxIndex].caption)"
                            class="lightbox-img w-full h-full max-h-[75vh] object-contain"
                        />
                        <!-- Si c'est une image Drive -->
                        <img 
                            v-else
                            :src="`https://drive.google.com/thumbnail?id=${galleryPhotos[activeLightboxIndex].driveId}&sz=w1000`" 
                            :alt="__(galleryPhotos[activeLightboxIndex].caption)"
                            class="lightbox-img"
                        />
                    </div>

                    <!-- Navigation Droite -->
                    <button class="lightbox-arrow lightbox-arrow-right" @click="nextLightboxPhoto" aria-label="Next">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>

                    <!-- Infos Image -->
                    <div class="lightbox-info">
                        <div class="flex items-center justify-center gap-3 mb-2 flex-wrap">
                            <span class="lightbox-category">{{ getCategoryLabel(galleryPhotos[activeLightboxIndex].category) }}</span>
                            <span v-if="galleryPhotos[activeLightboxIndex].region" class="px-2 py-0.5 rounded text-[10px] font-bold bg-[#EDAF11] text-[#204138] uppercase tracking-wider">
                                {{ getRegionLabel(galleryPhotos[activeLightboxIndex].region) }}
                            </span>
                        </div>
                        <h3 class="lightbox-title">{{ __(galleryPhotos[activeLightboxIndex].caption) }}</h3>
                        <span class="lightbox-date">{{ __(galleryPhotos[activeLightboxIndex].date) }}</span>
                    </div>
                </div>
            </div>
        </Transition>
    </MainLayout>
</template>
