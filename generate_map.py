import json
import xml.etree.ElementTree as ET

tree = ET.parse('node_modules/@svg-maps/cameroon/cameroon.svg')
root = tree.getroot()

namespace = {'svg': 'http://www.w3.org/2000/svg'}
# The svg uses xmlns="http://www.w3.org/2000/svg", so elements are in this namespace
paths = []
for path in root.findall('.//{http://www.w3.org/2000/svg}path'):
    paths.append({
        'id': path.get('id'),
        'name': path.get('aria-label'),
        'd': path.get('d')
    })

vue_template = f"""<script setup>
import {{ ref, defineEmits }} from 'vue';

const emit = defineEmits(['region-hover', 'region-leave']);

const hoveredRegion = ref(null);

const regions = {json.dumps(paths, indent=4)};

const onMouseEnter = (region) => {{
    hoveredRegion.value = region.id;
    emit('region-hover', region);
}};

const onMouseLeave = (region) => {{
    hoveredRegion.value = null;
    emit('region-leave', region);
}};
</script>

<template>
    <div class="carte-interactive-container">
        <svg 
            xmlns="http://www.w3.org/2000/svg" 
            viewBox="0 0 793 1160" 
            class="cameroon-map"
        >
            <path
                v-for="region in regions"
                :key="region.id"
                :id="region.id"
                :d="region.d"
                class="region-path"
                :class="{{ active: hoveredRegion === region.id }}"
                @mouseenter="onMouseEnter(region)"
                @mouseleave="onMouseLeave(region)"
            />
        </svg>
    </div>
</template>

<style scoped>
.carte-interactive-container {{
    width: 100%;
    max-width: 600px;
    margin: 0 auto;
}}

.cameroon-map {{
    width: 100%;
    height: auto;
    filter: drop-shadow(0 10px 15px rgba(0,0,0,0.1));
}}

.region-path {{
    fill: #204138; /* Couleur de base */
    stroke: #ffffff;
    stroke-width: 2;
    cursor: pointer;
    transition: all 0.3s ease;
}}

.region-path:hover, .region-path.active {{
    fill: #EDAF11; /* Couleur au survol */
    transform: translateY(-2px);
    stroke-width: 3;
}}
</style>
"""

with open('resources/js/Components/CarteInteractive.vue', 'w', encoding='utf-8') as f:
    f.write(vue_template)

print("Created resources/js/Components/CarteInteractive.vue successfully.")
