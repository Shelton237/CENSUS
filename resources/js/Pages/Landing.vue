<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';

const showBadge = ref(false);
const showText = ref(false);
const showActions = ref(false);

onMounted(() => {
    setTimeout(() => { showBadge.value = true; }, 100);
    setTimeout(() => { showText.value = true; }, 400);
    setTimeout(() => { showActions.value = true; }, 700);
});
</script>

<template>
    <Head>
        <title>{{ __('Bienvenue') }}</title>
        <meta name="description" :content="__('Portail officiel description')">
    </Head>
    
    <main class="landing-container">
        <div class="content-wrapper">
            <!-- Badge Central -->
            <Transition name="fade-up">
                <div v-show="showBadge" class="badge-container">
                    <img src="/assets/images/badge.png" alt="Badge Recensement Général 2024" class="central-badge">
                </div>
            </Transition>

            <!-- Description -->
            <Transition name="fade-up">
                <div v-show="showText" class="description-container">
                    <p>
                        {{ __('Landing description') }}
                    </p>
                </div>
            </Transition>

            <!-- Sélecteur de langue -->
            <Transition name="fade-up">
                <div v-show="showActions" class="language-selector">
                    <Link :href="route('set-locale', { locale: 'fr' })" class="btn btn-gold">{{ __('Accéder au site en Français') }}</Link>
                    <Link :href="route('set-locale', { locale: 'en' })" class="btn btn-gold">{{ __('Accéder au site en Anglais') }}</Link>
                </div>
            </Transition>

            <!-- Logos Partenaires -->
            <Transition name="fade-up">
                <div v-show="showActions" class="partners-container">
                    <div class="institutional-logos">
                        <img src="/assets/images/logo-rgae.jpg" alt="Logo RGAE" class="footer-logo">
                        <img src="/assets/images/logo-rgph.png" alt="Logo RGPH" class="footer-logo">
                    </div>
                </div>
            </Transition>
        </div>
    </main>
</template>

<style scoped>
.fade-up-enter-active {
    transition: all 1s cubic-bezier(0.16, 1, 0.3, 1);
}
.fade-up-enter-from {
    opacity: 0;
    transform: translateY(20px);
}
</style>
