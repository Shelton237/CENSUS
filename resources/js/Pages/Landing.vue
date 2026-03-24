<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';

const showContent = ref(false);

onMounted(() => {
    setTimeout(() => {
        showContent.value = true;
    }, 100);
});
</script>

<template>
    <Head>
        <title>Bienvenue</title>
        <meta name="description" content="Portail officiel du 4ème Recensement Général de la Population et de l'Habitat (RGPH) et du RGAE au Cameroun.">
    </Head>
    
    <main class="landing-container">
        <!-- Overlay décoratif pour la profondeur -->
        <div class="landing-overlay"></div>

        <Transition name="fade-up">
            <div v-if="showContent" class="content-wrapper glass-card">
                
                <!-- Badge Central (Plus élégant) -->
                <div class="badge-container mb-6">
                    <img src="/assets/images/badge.png" alt="Badge Recensement Général 2024" class="central-badge">
                </div>

                <!-- Texte d'accueil -->
                <div class="description-container">
                    <h1 class="welcome-title">Bienvenue / Welcome</h1>
                    <p class="welcome-text">
                        {{ __('Landing description') }}
                    </p>
                </div>

                <!-- Sélecteur de langue (Premium Buttons) -->
                <div class="language-selector mt-8">
                    <Link :href="route('set-locale', { locale: 'fr' })" class="btn btn-premium primary">
                        <span class="btn-text">Français</span>
                        <div class="btn-hover-effect"></div>
                    </Link>
                    <Link :href="route('set-locale', { locale: 'en' })" class="btn btn-premium secondary">
                        <span class="btn-text">English</span>
                        <div class="btn-hover-effect"></div>
                    </Link>
                </div>

                <!-- Logos Partenaires en bas de carte -->
                <div class="partners-container border-t border-white/10 mt-10 pt-8">
                    <span class="partners-label">En partenariat avec</span>
                    <div class="institutional-logos">
                        <img src="/assets/images/logo-rgae.jpg" alt="Logo RGAE" class="footer-logo">
                        <img src="/assets/images/logo-rgph.png" alt="Logo RGPH" class="footer-logo">
                    </div>
                </div>
            </div>
        </Transition>

        <!-- Signature ou Slogan discret en bas de page -->
        <div class="footer-note" v-if="showContent">
            <p>&copy; 2024 CENSUS Cameroun - Tous droits réservés</p>
        </div>
    </main>
</template>

<style scoped>
.fade-up-enter-active, .fade-up-leave-active {
    transition: all 1s cubic-bezier(0.16, 1, 0.3, 1);
}
.fade-up-enter-from, .fade-up-leave-to {
    opacity: 0;
    transform: translateY(30px);
}
</style>

