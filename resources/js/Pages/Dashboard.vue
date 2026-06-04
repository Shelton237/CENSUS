<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    articles_count:      Number,
    partners_count:      Number,
    candidatures_count:  Number,
    pending_count:       Number,
    accepted_count:      Number,
    rejected_count:      Number,
    by_region:           Array,
    by_status:           Object,
    by_education:        Array,
    recent_articles:     Array,
    recent_candidatures: Array,
});

const regionMax = computed(() =>
    props.by_region?.length ? Math.max(...props.by_region.map(r => r.total)) : 1
);

const educationMax = computed(() =>
    props.by_education?.length ? Math.max(...props.by_education.map(e => e.total)) : 1
);

const statusConfig = {
    pending:  { label: 'En attente', color: 'bg-yellow-400' },
    reviewed: { label: 'Examiné',    color: 'bg-blue-400' },
    accepted: { label: 'Accepté',    color: 'bg-green-500' },
    rejected: { label: 'Rejeté',     color: 'bg-red-400' },
};

const total = computed(() => props.candidatures_count || 1);
</script>

<template>
    <Head title="Tableau de Bord" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800">Console d'Administration — RGPH4 & RGAE</h2>
        </template>

        <div class="py-8 bg-gray-50 min-h-screen">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

                <!-- ─ KPIs principaux ─ -->
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                    <div class="bg-white border border-gray-200 rounded-lg px-4 py-4 col-span-2 md:col-span-1 lg:col-span-2 flex items-center gap-4 border-l-4 border-l-[#204138]">
                        <div class="w-10 h-10 bg-[#204138]/8 rounded-lg flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-[#204138]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wider">Candidatures</p>
                            <p class="text-2xl font-black text-[#204138] tabular-nums">{{ candidatures_count }}</p>
                        </div>
                    </div>
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg px-4 py-4">
                        <p class="text-xs text-yellow-600 uppercase tracking-wider mb-1">En attente</p>
                        <p class="text-2xl font-black text-yellow-700 tabular-nums">{{ pending_count }}</p>
                    </div>
                    <div class="bg-green-50 border border-green-200 rounded-lg px-4 py-4">
                        <p class="text-xs text-green-600 uppercase tracking-wider mb-1">Acceptées</p>
                        <p class="text-2xl font-black text-green-700 tabular-nums">{{ accepted_count }}</p>
                    </div>
                    <div class="bg-white border border-gray-200 rounded-lg px-4 py-4">
                        <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Articles</p>
                        <p class="text-2xl font-black text-gray-700 tabular-nums">{{ articles_count }}</p>
                    </div>
                    <div class="bg-white border border-gray-200 rounded-lg px-4 py-4">
                        <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Partenaires</p>
                        <p class="text-2xl font-black text-gray-700 tabular-nums">{{ partners_count }}</p>
                    </div>
                </div>

                <!-- ─ Graphiques ─ -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                    <!-- Candidatures par région -->
                    <div class="lg:col-span-2 bg-white border border-gray-200 rounded-lg p-6">
                        <div class="flex items-center justify-between mb-5">
                            <h3 class="font-bold text-[#204138] text-sm uppercase tracking-wider">Candidatures par région</h3>
                            <a :href="route('admin.candidatures.index')" class="text-xs text-[#204138] hover:underline">Voir tout →</a>
                        </div>
                        <div v-if="by_region && by_region.length" class="space-y-3">
                            <div v-for="r in by_region" :key="r.region" class="flex items-center gap-3">
                                <span class="text-xs text-gray-500 w-28 shrink-0 truncate">{{ r.region }}</span>
                                <div class="flex-1 h-5 bg-gray-100 rounded overflow-hidden">
                                    <div class="h-full bg-[#204138] rounded transition-all duration-700"
                                         :style="`width: ${Math.round((r.total / regionMax) * 100)}%`">
                                    </div>
                                </div>
                                <span class="text-xs font-bold text-[#204138] tabular-nums w-8 text-right">{{ r.total }}</span>
                            </div>
                        </div>
                        <div v-else class="py-8 text-center text-sm text-gray-400">
                            Aucune candidature reçue pour le moment.
                        </div>
                    </div>

                    <!-- Répartition par statut (donut CSS) -->
                    <div class="bg-white border border-gray-200 rounded-lg p-6">
                        <h3 class="font-bold text-[#204138] text-sm uppercase tracking-wider mb-5">Répartition statuts</h3>
                        <div class="space-y-3">
                            <div v-for="(cfg, key) in statusConfig" :key="key" class="flex items-center gap-3">
                                <div class="w-2.5 h-2.5 rounded-full shrink-0" :class="cfg.color"></div>
                                <span class="text-xs text-gray-500 flex-1">{{ cfg.label }}</span>
                                <div class="w-24 h-1.5 bg-gray-100 rounded overflow-hidden">
                                    <div class="h-full rounded transition-all duration-700"
                                         :class="cfg.color"
                                         :style="`width: ${total > 0 ? Math.round(((by_status?.[key] ?? 0) / total) * 100) : 0}%`">
                                    </div>
                                </div>
                                <span class="text-xs font-bold text-gray-700 tabular-nums w-8 text-right">{{ by_status?.[key] ?? 0 }}</span>
                            </div>
                        </div>

                        <div class="mt-6 pt-5 border-t border-gray-100">
                            <h4 class="font-bold text-[#204138] text-xs uppercase tracking-wider mb-3">Niveau d'études</h4>
                            <div class="space-y-2">
                                <div v-for="e in by_education?.slice(0,4)" :key="e.education_level" class="flex items-center gap-2">
                                    <span class="text-[10px] text-gray-500 w-24 truncate shrink-0">{{ e.education_level?.split('/')[0]?.trim() }}</span>
                                    <div class="flex-1 h-1.5 bg-gray-100 rounded overflow-hidden">
                                        <div class="h-full bg-[#EDAF11] rounded"
                                             :style="`width: ${Math.round((e.total / educationMax) * 100)}%`">
                                        </div>
                                    </div>
                                    <span class="text-[10px] font-bold text-gray-600 tabular-nums">{{ e.total }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ─ Activité récente ─ -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                    <!-- Dernières candidatures -->
                    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                            <h3 class="font-bold text-[#204138] text-sm uppercase tracking-wider">Dernières candidatures</h3>
                            <a :href="route('admin.candidatures.index')" class="text-xs text-[#204138] hover:underline">Gérer →</a>
                        </div>
                        <div class="divide-y divide-gray-50">
                            <div v-for="c in recent_candidatures" :key="c.id"
                                 class="px-6 py-3.5 flex items-center justify-between hover:bg-gray-50 transition-colors">
                                <div>
                                    <p class="text-sm font-semibold text-gray-800">{{ c.name }}</p>
                                    <p class="text-xs text-gray-400">{{ c.region }} · {{ c.created_at }}</p>
                                </div>
                                <span :class="{
                                    'bg-yellow-100 text-yellow-700': c.status === 'pending',
                                    'bg-blue-100 text-blue-700': c.status === 'reviewed',
                                    'bg-green-100 text-green-700': c.status === 'accepted',
                                    'bg-red-100 text-red-600': c.status === 'rejected',
                                }" class="text-[10px] font-bold px-2 py-1 rounded uppercase">
                                    {{ { pending:'En attente', reviewed:'Examiné', accepted:'Accepté', rejected:'Rejeté' }[c.status] }}
                                </span>
                            </div>
                            <div v-if="!recent_candidatures?.length" class="px-6 py-8 text-center text-sm text-gray-400">
                                Aucune candidature reçue.
                            </div>
                        </div>
                    </div>

                    <!-- Derniers articles + progression recensement -->
                    <div class="space-y-6">
                        <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
                            <div class="px-6 py-4 border-b border-gray-100">
                                <h3 class="font-bold text-[#204138] text-sm uppercase tracking-wider">Progression du recensement</h3>
                            </div>
                            <div class="px-6 py-5 space-y-4">
                                <div>
                                    <div class="flex justify-between text-xs text-gray-500 mb-1.5">
                                        <span class="font-semibold">Phase de Cartographie</span>
                                        <span class="font-bold text-[#204138]">98 %</span>
                                    </div>
                                    <div class="w-full bg-gray-100 h-2 rounded-full overflow-hidden">
                                        <div class="bg-[#204138] h-full rounded-full" style="width:98%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex justify-between text-xs text-gray-500 mb-1.5">
                                        <span class="font-semibold">Recensement Pilote</span>
                                        <span class="font-bold text-[#EDAF11]">45 %</span>
                                    </div>
                                    <div class="w-full bg-gray-100 h-2 rounded-full overflow-hidden">
                                        <div class="bg-[#EDAF11] h-full rounded-full" style="width:45%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex justify-between text-xs text-gray-500 mb-1.5">
                                        <span class="font-semibold">Dénombrement National</span>
                                        <span class="text-gray-300 font-semibold">Bientôt</span>
                                    </div>
                                    <div class="w-full bg-gray-100 h-2 rounded-full overflow-hidden">
                                        <div class="bg-gray-200 h-full rounded-full" style="width:0%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
                            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                                <h3 class="font-bold text-[#204138] text-sm uppercase tracking-wider">Derniers articles</h3>
                                <a href="/admin/articles" class="text-xs text-[#204138] hover:underline">Gérer →</a>
                            </div>
                            <div class="divide-y divide-gray-50">
                                <div v-for="a in recent_articles" :key="a.title"
                                     class="px-6 py-3.5 flex items-center gap-3 hover:bg-gray-50 transition-colors">
                                    <div class="w-7 h-7 bg-[#204138]/8 rounded-md flex items-center justify-center shrink-0">
                                        <svg class="w-3.5 h-3.5 text-[#204138]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm text-gray-800 font-medium truncate">{{ a.title }}</p>
                                        <p class="text-xs text-gray-400">{{ a.created_at }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
