<script setup>
import { computed } from 'vue';

const props = defineProps({
    title: {
        type: String,
        default: 'Partenaires au Recensement'
    },
    partners: {
        type: Array,
        default: () => []
    }
});

const defaultPartners = [
    { name: 'UNFPA', src: '/assets/images/partenaire/unfpa.png', href: 'https://cameroon.unfpa.org' },
    { name: 'HISWACA', src: '/assets/images/partenaire/hiswaca-e1770819554832.jpg', href: '#' },
    { name: 'Banque Mondiale', src: '/assets/images/partenaire/worldbank.svg', href: 'https://www.worldbank.org' },
    { name: 'FAO', src: '/assets/images/partenaire/fao.png', href: 'https://www.fao.org' },
];

const displayPartners = computed(() => {
    if (props.partners && props.partners.length > 0) {
        return props.partners.map(p => {
            let src = p.logo;
            if (src && !src.startsWith('http') && !src.startsWith('/assets') && !src.startsWith('/storage')) {
                src = `/storage/${src}`;
            }
            return {
                name: p.name,
                src: src,
                href: p.website || '#'
            };
        });
    }
    return defaultPartners;
});
</script>

<template>
    <section class="bg-gradient-to-b from-[#1a4132]/5 to-transparent py-20 overflow-hidden border-t border-gray-100">
        <!-- Section Titre Institutionnelle -->
        <div class="container mx-auto px-6 mb-12 text-center md:text-left">
            <span class="text-[#EDAF11] font-bold uppercase tracking-widest text-xs md:text-sm">{{ __('Coopération & Appuis') }}</span>
            <h2 class="text-3xl md:text-5xl font-black text-[#1a4132] mt-3 mb-4 leading-tight">
                {{ __(title) }}
            </h2>
            <p class="text-gray-600 max-w-2xl text-sm md:text-base">
                {{ __('Ils soutiennent le Recensement Général de la Population et de l\'Habitat pour planifier le développement durable du Cameroun.') }}
            </p>
        </div>

        <!-- Piste de défilement (Carousel Track) -->
        <div class="relative w-full overflow-hidden py-4">
            <!-- Dégradé de fondu gauche -->
            <div class="absolute inset-y-0 left-0 w-32 md:w-64 z-10 pointer-events-none bg-gradient-to-r from-[#fafafa] via-[#fafafa]/90 to-transparent"></div>
            <!-- Dégradé de fondu droit -->
            <div class="absolute inset-y-0 right-0 w-32 md:w-64 z-10 pointer-events-none bg-gradient-to-l from-[#fafafa] via-[#fafafa]/90 to-transparent"></div>

            <!-- Track animé avec des cartes uniformes -->
            <div class="partners-track">
                <template v-for="pass in [1, 2, 3, 4]" :key="pass">
                    <a
                        v-for="partner in displayPartners"
                        :key="pass + '-' + partner.name"
                        :href="partner.href"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="partner-card"
                        :title="partner.name"
                    >
                        <div class="partner-logo-wrapper">
                            <img
                                :src="partner.src"
                                :alt="partner.name"
                                class="partner-logo"
                            >
                        </div>
                    </a>
                </template>
            </div>
        </div>
    </section>
</template>

<style scoped>
@keyframes scroll-loop {
    0%   { transform: translateX(0); }
    100% { transform: translateX(-25%); }
}

.partners-track {
    display: flex;
    align-items: center;
    width: max-content;
    animation: scroll-loop 35s linear infinite;
    will-change: transform;
    gap: 2rem;
}

.partners-track:hover {
    animation-play-state: paused;
}

.partner-card {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    width: 220px;
    height: 110px;
    background: #ffffff;
    border: 1px solid rgba(0, 0, 0, 0.06);
    border-radius: 16px;
    box-shadow: 0 4px 20px -5px rgba(0, 0, 0, 0.04);
    padding: 1.25rem;
    transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
}

.partner-card:hover {
    transform: translateY(-5px);
    border-color: rgba(237, 175, 17, 0.4);
    box-shadow: 0 12px 30px -10px rgba(26, 65, 50, 0.15);
}

.partner-logo-wrapper {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.partner-logo {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
    filter: grayscale(15%) opacity(0.85);
    transition: all 0.3s ease;
}

.partner-card:hover .partner-logo {
    filter: grayscale(0%) opacity(1);
    transform: scale(1.03);
}

@media (max-width: 768px) {
    .partner-card {
        width: 180px;
        height: 90px;
        border-radius: 12px;
        padding: 0.85rem;
    }
}
</style>
