<script setup>
defineProps({
    title: String,
    subtitle: String
});
</script>

<template>
    <div class="mb-8 border-b border-gray-100 pb-6">
        <h1 class="text-3xl font-extrabold text-[#204138] tracking-tight">
            {{ title }}
        </h1>
        <p v-if="subtitle" class="mt-2 text-sm text-gray-500 font-medium italic">
            {{ subtitle }}
        </p>
    </div>
</template>
