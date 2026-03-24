<script setup>
import { ref, onMounted } from 'vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';

const isMenuOpen = ref(false);
const isSearchOpen = ref(false);
const isSticky = ref(false);

const newsletterForm = useForm({
    email: '',
});

const submitNewsletter = () => {
    newsletterForm.post(route('newsletter.store'), {
        preserveScroll: true,
        onSuccess: () => newsletterForm.reset('email'),
    });
};

const toggleMenu = () => {
    isMenuOpen.value = !isMenuOpen.value;
};

const toggleSearch = () => {
    isSearchOpen.value = !isSearchOpen.value;
};

onMounted(() => {
    window.addEventListener('scroll', () => {
        isSticky.value = window.scrollY > 60;
    });
});
</script>

<template>
    <div class="min-h-screen">
        <!-- ===================== HEADER ===================== -->
        <header class="main-header" :class="{ 'sticky-active': isSticky }" id="main-header">
            <!-- Top bar : Sélecteur de langue -->
            <div class="top-bar">
                <div class="container top-bar-inner">
                    <div class="lang-switcher">
                        <Link :href="route('set-locale', { locale: 'fr' })" class="lang-pill" :class="{ active: $page.props.locale === 'fr' }">FR</Link>
                        <Link :href="route('set-locale', { locale: 'en' })" class="lang-pill" :class="{ active: $page.props.locale === 'en' }">ENG</Link>
                    </div>
                </div>
            </div>
            <!-- Barre principale : Logo + Nav + Search -->
            <div class="main-bar">
                <div class="container main-bar-inner">
                    <div class="header-logos">
                        <img src="/assets/images/logo-rgae.jpg" alt="Logo RGAE" class="h-logo">
                        <img src="/assets/images/logo-rgph.png" alt="Logo RGPH" class="h-logo">
                        <div class="header-title-block">
                            <span class="header-title">{{ __('Recensement Général de la Population et de l\'Habitat') }}</span>
                            <span class="header-subtitle">{{ __('Recensement Général de l\'Agriculture et de l\'Élevage') }}</span>
                        </div>
                    </div>
                    <nav class="main-nav" :class="{ 'active': isMenuOpen }" id="main-nav">
                        <ul>
                            <li><Link href="/accueil" class="nav-link" :class="{ active: $page.component === 'Accueil' }">{{ __('Accueil') }}</Link></li>
                            <li><Link href="/apropos" class="nav-link" :class="{ active: $page.component === 'Apropos' }">{{ __('A propos') }}</Link></li>
                            <li><Link href="/activites" class="nav-link" :class="{ active: $page.component === 'Activites' }">{{ __('Activites') }}</Link></li>
                            <li><Link href="/actualites" class="nav-link" :class="{ active: $page.component === 'Actualites' }">{{ __('Actualites') }}</Link></li>
                            <li class="nav-search">
                                <button @click="toggleSearch" class="search-btn" aria-label="Rechercher">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#295E4D" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="11" cy="11" r="8"></circle>
                                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                    </svg>
                                </button>
                            </li>
                        </ul>
                    </nav>
                    <button @click="toggleMenu" class="mobile-menu-btn" id="mobile-menu-btn" aria-label="Menu">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
                    </button>
                </div>
            </div>
        </header>

        <!-- ===================== SEARCH MODAL ===================== -->
        <div class="search-modal" :class="{ 'active': isSearchOpen }" id="search-modal">
            <div class="search-modal-bg" @click="toggleSearch" id="close-search-bg"></div>
            <div class="search-modal-content">
                <button @click="toggleSearch" class="close-search-btn" id="close-search-btn">&times;</button>
                <form action="/recherche" method="GET" class="search-form">
                    <input type="text" name="q" placeholder="Rechercher..." class="search-input" required>
                    <button type="submit" class="search-submit">{{ __('Recherche') }}</button>
                </form>
            </div>
        </div>

        <!-- MAIN CONTENT SLOT -->
        <main>
            <slot />
        </main>

        <!-- ===================== FOOTER ===================== -->
        <footer class="main-footer">
            <div class="container grid gap-10 py-14" style="grid-template-columns: 1.5fr 1fr 1.2fr 1.5fr 1.2fr; align-items: start;">
                <!-- Col 1: Badge GPHC -->
                <div class="flex items-center justify-center">
                    <Link href="/">
                        <img src="/assets/images/badge.png" alt="Badge Recensement" class="footer-badge">
                    </Link>
                </div>
                
                <!-- Col 2: A propos -->
                <div>
                    <h4 class="text-white font-bold text-lg mb-6">{{ __('A propos') }}</h4>
                    <ol class="list-none p-0 m-0 flex flex-col gap-2.5">
                        <li><Link href="/apropos" class="text-white/70 hover:text-yellow-400 text-[15px] no-underline transition-colors">{{ __('A propos 1') }}</Link></li>
                        <li><Link href="/apropos" class="text-white/70 hover:text-yellow-400 text-[15px] no-underline transition-colors">{{ __('A propos 2') }}</Link></li>
                        <li><Link href="/apropos" class="text-white/70 hover:text-yellow-400 text-[15px] no-underline transition-colors">{{ __('A propos 3') }}</Link></li>
                        <li><Link href="/apropos" class="text-white/70 hover:text-yellow-400 text-[15px] no-underline transition-colors">{{ __('A propos 4') }}</Link></li>
                    </ol>
                </div>

                <!-- Col 3: Nos Partenaires -->
                <div>
                    <h4 class="text-white font-bold text-lg mb-6">{{ __('Nos Partenaires') }}</h4>
                    <ul class="list-none p-0 m-0 flex flex-col gap-2.5">
                        <li><a href="#" class="text-white/70 hover:text-yellow-400 text-[15px] no-underline transition-colors">UNFPA</a></li>
                        <li><a href="#" class="text-white/70 hover:text-yellow-400 text-[15px] no-underline transition-colors">FAO</a></li>
                        <li><a href="#" class="text-white/70 hover:text-yellow-400 text-[15px] no-underline transition-colors">Banque Mondiale</a></li>
                        <li><a href="#" class="text-white/70 hover:text-yellow-400 text-[15px] no-underline transition-colors">HISWACA</a></li>
                    </ul>
                </div>

                <!-- Col 4: Nous contacter -->
                <div>
                    <h4 class="text-white font-bold text-lg mb-6">{{ __('Nous contacter') }}</h4>
                    <ul class="list-none p-0 m-0 flex flex-col gap-2">
                        <li>
                            <a href="#" class="text-white/70 hover:text-yellow-400 text-[15px] no-underline transition-colors">
                                {{ __('Appeler le numéro Vert') }}
                            </a>
                        </li>
                        <li class="mt-3 text-[15px] text-white/80">{{ __('Suivez nos Réseaux Sociaux') }}</li>
                        <li>
                            <div class="flex gap-3 mt-2 mb-5">
                                <a href="#" class="w-8 h-8 rounded-full border border-white/60 flex items-center justify-center hover:opacity-70 transition-opacity bg-transparent">
                                    <img src="/assets/images/reseaux/0771d701d44dcb1757ccb3a8aba21d3febf5fafc.png" alt="Réseau Social 1" class="w-full h-full object-contain">
                                </a>
                                <a href="#" class="w-8 h-8 rounded-full border border-white/60 flex items-center justify-center hover:opacity-70 transition-opacity bg-transparent">
                                    <img src="/assets/images/reseaux/1fc8e15cdfbe56266f3f190e33d1f6a7a13f0390.png" alt="Réseau Social 2" class="w-full h-full object-contain">
                                </a>
                                <a href="#" class="w-8 h-8 rounded-full border border-white/60 flex items-center justify-center hover:opacity-70 transition-opacity bg-transparent">
                                    <img src="/assets/images/reseaux/e6b0ee7be3287671a1262e4297ebc96a08d09cb1 (1).png" alt="Réseau Social 3" class="w-full h-full object-contain">
                                </a>
                            </div>
                        </li>
                        <li class="text-[15px] text-white/80">{{ __('Souscrire à notre Newsletter') }}</li>
                        <li class="mt-2">
                            <form @submit.prevent="submitNewsletter" class="flex items-center bg-white rounded-md pl-3 pr-1.5 py-1.5 max-w-[270px]">
                                <svg class="w-5 h-5 text-gray-400 mr-2 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path></svg>
                                <input type="email" v-model="newsletterForm.email" :placeholder="__('Votre adresse E-mail...')" class="flex-1 bg-transparent border-none outline-none text-gray-700 text-sm py-1 min-w-0" :disabled="newsletterForm.processing">
                                <button type="submit" class="bg-yellow-400 hover:bg-yellow-500 rounded px-3 py-2 ml-1.5 flex items-center justify-center transition-colors shrink-0 disabled:opacity-60 border-0 cursor-pointer" :disabled="newsletterForm.processing">
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                                </button>
                            </form>
                            <div v-if="newsletterForm.errors.email" class="text-orange-300 text-xs mt-1.5 max-w-[270px] leading-snug">
                                {{ newsletterForm.errors.email }}
                            </div>
                            <div v-if="newsletterForm.recentlySuccessful" class="text-green-300 text-xs mt-1.5 max-w-[270px] leading-snug">
                                {{ $page.props.flash?.success || __('Merci pour votre inscription !') }}
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- Col 5: Logos RGAE/RGPH -->
                <div class="flex items-center justify-center gap-5">
                    <img src="/assets/images/logo-rgae.jpg" alt="Logo RGAE" class="w-[120px] h-[120px] rounded-full object-contain bg-white p-0.5">
                    <img src="/assets/images/logo-rgph.png" alt="Logo RGPH" class="w-[120px] h-[120px] rounded-full object-cover bg-white p-0.5 border-2 border-gray-300">
                </div>
            </div>
            <div class="border-t border-white/10 mt-10">
                <div class="container py-5">
                    <p class="text-center text-white/40 text-xs">&copy; {{ new Date().getFullYear() }} {{ __('Recensement Général') }} — {{ __('Tous droits réservés') }}</p>
                </div>
            </div>
        </footer>
    </div>
</template>
