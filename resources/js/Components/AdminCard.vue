<script setup>
defineProps({
    title: {
        type: String,
        default: 'Titre'
    },
    value: {
        type: [String, Number],
        default: '0'
    },
    trend: {
        type: String,
        default: null
    },
    icon: {
        type: String,
        default: 'chart'
    }
});
</script>

<template>
    <div class="bg-white rounded-2xl p-6 border-b-4 border-[#EDAF11]/20 shadow-sm hover:shadow-md transition-shadow group">
        <div class="flex items-start justify-between">
            <div class="space-y-4">
                <span class="text-sm font-semibold text-gray-400 uppercase tracking-widest">{{ title }}</span>
                <div class="flex items-center gap-2">
                    <h3 class="text-3xl font-black text-[#204138] group-hover:text-[#295E4D] transition-colors leading-none">
                        {{ value }}
                    </h3>
                </div>
                <div v-if="trend" class="flex items-center gap-1.5 text-xs font-bold leading-none">
                    <span :class="trend.startsWith('+') ? 'text-green-500' : 'text-red-500'">
                        {{ trend }}
                    </span>
                    <span class="text-gray-400 font-medium lowercase">depuis le dernier relevé</span>
                </div>
            </div>
            
            <div class="w-12 h-12 rounded-xl bg-[#204138]/5 flex items-center justify-center text-[#204138] group-hover:bg-[#204138] group-hover:text-white transition-all duration-300">
                <slot name="icon">
                    <svg v-if="icon === 'chart'" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    <svg v-else-if="icon === 'users'" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    <svg v-else-if="icon === 'map'" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5-2V4l5 2m0 14l5-2m-5 2V6m5 12l5-2V4l-5 2m0 14V6"></path></svg>
                </slot>
            </div>
        </div>
    </div>
</template>
