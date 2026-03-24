<script setup>
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Recensement Général 2024 - Cameroun" />
    
    <main class="landing-container">
        <div class="content-wrapper">
            <!-- Badge Central -->
            <div class="badge-container">
                <img src="/assets/images/badge.png" alt="Badge Recensement Général 2024" class="central-badge">
            </div>

            <!-- Description -->
            <div class="description-container">
                <p>
                    {{ __('Landing description') }}
                </p>
            </div>

            <!-- Sélecteur de langue -->
            <div class="language-selector">
                <Link :href="route('set-locale', { locale: 'fr' })" class="btn btn-gold">{{ __('Accéder au site en Français') }}</Link>
                <Link :href="route('set-locale', { locale: 'en' })" class="btn btn-gold">{{ __('Accéder au site en Anglais') }}</Link>
            </div>

            <!-- Logos Partenaires -->
            <div class="partners-container">
                <div class="institutional-logos">
                    <img src="/assets/images/logo-rgae.jpg" alt="Logo RGAE" class="footer-logo">
                    <img src="/assets/images/logo-rgph.png" alt="Logo RGPH" class="footer-logo">
                </div>
            </div>
        </div>
    </main>
</template>
