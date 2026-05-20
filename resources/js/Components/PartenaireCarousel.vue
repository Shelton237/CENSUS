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

const faoBase64 = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAawAAAB2CAMAAACjxFdjAAAAkFBMVEX///8xjd4ti94qit0iiN35/P77/f8eh9y41vPF3vXs9fz0+f3l8fvw9/09lODp8/zR5fdWoeNqq+aKvOtKm+Kdxu41kN90sOjd7PqDuOqw0fFepOTg7frO4/c2k+AShNyky/CPv+yYxO6sz/HA2vR+tOmsyu5VnuMAf9t3rudmquat0fFhpOWKuOqYxu8Aetk6Hmf8AAAgAElEQVR4nO19C5vaOM92YjsnciBAjgRIgKRp0z77/f9/91mSHQKEgZnOtrvvVte12yGYxPFtyZIsyYbxLrLCvduUQx+ZRMnq2/HsFf777vKH/nYK4225ykwhODNHYlwIZkbDyQ2s393BP6Qo9I4/DnwK04SYyYWZ5Of4D16/n+z4mJhiHqgLcX5Ynxe/u6//dXIridQzqAgvcSiL393d/zAtm8y5RYpxuVIBoVy8/lI4lWf/7k7/N2mZJuIaJmFmUT/k5Qaoy6skyvi1hOTmuv0D1y8na9tPmYqLLMlP7j4IfaVJWJYfFt55U0WmmCKadfHv7fl/j+J8AhUTZpXuF/P6nl+4m4hN8OKH9I/t9SsplQJtXInq1Tl4u7kVb0znotuLfv9ruvmHDKNInItYizZPkFLUDuYIFxObX8hcblmWzQd/Gx7LsvupqbUoiuKVEYplL4+fboxa37ORR1jSLF/9nb0vM60eMjG8T423wgu9V0PZOMIZ3vkbTctE8Pp8exV68epsO5qZuX6hy67UoJPPnsLhZlTIWSTS+wbBFskN73+aZCPOPGnf89RtX2nqvXf2+MhNvn7nbzQtemY625uLAXRjuH+/WdoIkw+vgAVT/5PBWg5aV2DmJs5W97dPpZUsybwf09bZeKvx51nzjsemDtNU347dM/p0sLbwhuLFyfYRsCzvjpk/QkGkNQu2kir4pnbvmqyIedjm7pvBLAyruWgm5evPTQXaB0C/HSwrhzHg3Wt3KOu6rt4FVlwenP69HZ2hWIsx+Qqw7AasumWt4IBfSzBve9iKHP7JRz1D5C+KEgIrImu7fK+d9tlgFQfsvfPBWz6gC1iNkIP38zdsD4preOVm3wCMnN+yliunXQavk+1uvllzwLcQXapuI9F61bkrwbqfFy/SZ4PVMJaVpll/rv0xAcv8';

const defaultPartners = [
    { name: 'UNFPA', src: '/assets/images/partenaire/unfpa.png', href: 'https://cameroon.unfpa.org' },
    { name: 'HISWACA', src: '/assets/images/partenaire/hiswaca-e1770819554832.jpg', href: '#' },
    { name: 'Banque Mondiale', src: '/assets/images/partenaire/worldbank.svg', href: 'https://www.worldbank.org' },
    { name: 'FAO', src: faoBase64, href: 'https://www.fao.org' },
];

const displayPartners = computed(() => {
    if (props.partners && props.partners.length > 0) {
        return props.partners.map(p => {
            let src = p.logo;
            if (p.name === 'FAO' || (src && src.includes('fao.png'))) {
                src = faoBase64;
            } else if (src && !src.startsWith('http') && !src.startsWith('/assets') && !src.startsWith('/storage')) {
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
