<script setup>
defineProps({
    title: {
        type: String,
        default: 'Partenaires au Recensement'
    }
});

const partners = [
    {
        name: 'UNFPA',
        src: '/assets/images/partenaires/unfpa.png',
        href: 'https://cameroon.unfpa.org',
    },
    {
        name: 'HISWACA',
        src: '/assets/images/partenaires/HISWACA-e1770819554832.jpg',
        href: '#',
    },
    {
        name: 'World Bank Group',
        src: '/assets/images/partenaires/worldbank.svg',
        href: 'https://www.worldbank.org',
    },
    {
        name: 'FAO',
        src: '/assets/images/partenaires/fao.svg',
        href: 'https://www.fao.org',
    },
];
</script>

<template>
    <section class="bg-white py-10 overflow-hidden" style="border-top: 1px solid #e5e7eb;">
        <!-- Titre aligné à gauche, exactement comme sur la maquette -->
        <div class="container mx-auto px-6 mb-8">
            <h2 style="font-size: 56px; font-weight: 900; color: #111111; line-height: 1.15; font-family: inherit;">
                {{ title }}
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
                        v-for="partner in partners"
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
    height: 56px;
    max-width: 180px;
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
    .partner-logo { height: 42px; }
}
</style>
