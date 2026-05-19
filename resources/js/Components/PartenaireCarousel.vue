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
    { name: 'FAO', src: 'data:image/png;base64,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_d', href: 'https://www.fao.org' },
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
    <section class="bg-white py-10 overflow-hidden" style="border-top: 1px solid #e5e7eb;">
        <!-- Titre aligné à gauche, exactement comme sur la maquette d'origine -->
        <div class="container mx-auto px-6 mb-8">
            <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-black text-[#111111] leading-[1.15]">
                {{ __(title) }}
            </h2>
        </div>

        <!-- Piste de défilement -->
        <div class="relative w-full overflow-hidden">
            <!-- Fondu gauche -->
            <div class="absolute inset-y-0 left-0 w-48 z-10 pointer-events-none"
                 style="background: linear-gradient(to right, white 0%, transparent 100%);"></div>
            <!-- Fondu droite -->
            <div class="absolute inset-y-0 right-0 w-48 z-10 pointer-events-none"
                 style="background: linear-gradient(to left, white 0%, transparent 100%);"></div>

            <!-- Track animé — doublé pour seamless loop -->
            <div class="partners-track">
                <template v-for="pass in [1, 2, 3, 4]" :key="pass">
                    <a
                        v-for="partner in displayPartners"
                        :key="pass + '-' + partner.name"
                        :href="partner.href"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="partner-item"
                        :title="partner.name"
                    >
                        <img
                            :src="partner.src"
                            :alt="partner.name"
                            class="partner-logo"
                        >
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
}

.partners-track:hover {
    animation-play-state: paused;
}

.partner-item {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    margin: 0 48px;
    transition: transform 0.25s ease;
}

.partner-item:hover {
    transform: scale(1.05);
}

.partner-logo {
    height: 76px;
    max-width: 220px;
    width: auto;
    object-fit: contain;
    /* Très légère désaturation */
    filter: grayscale(5%);
    transition: all 0.3s ease;
}

.partner-item:hover .partner-logo {
    filter: grayscale(0%);
}

@media (max-width: 768px) {
    .partner-item { margin: 0 30px; }
    .partner-logo { height: 54px; }
}
</style>
