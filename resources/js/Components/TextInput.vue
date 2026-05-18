<script setup>
import { onMounted, ref } from 'vue';

const model = defineModel({
    type: String,
    required: true,
});

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input
        class="rounded-md border border-gray-300 bg-white text-gray-900 shadow-sm focus:border-[#204138] focus:ring-[#204138] px-3 py-2"
        v-model="model"
        ref="input"
    />
</template>
