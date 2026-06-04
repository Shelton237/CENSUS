<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import { ref, watch } from 'vue';

const props = defineProps({
    candidatures: Object,
    filters:      Object,
    stats:        Object,
});

const regions = [
    'Adamaoua','Centre','Est','Extrême-Nord','Littoral',
    'Nord','Nord-Ouest','Ouest','Sud','Sud-Ouest',
];

const search = ref(props.filters?.search ?? '');
const region = ref(props.filters?.region ?? '');
const status = ref(props.filters?.status ?? '');

let searchTimer = null;
watch(search, (val) => {
    clearTimeout(searchTimer);
    searchTimer = setTimeout(() => applyFilters(), 400);
});
watch([region, status], () => applyFilters());

const applyFilters = () => {
    router.get(route('admin.candidatures.index'), {
        search: search.value || undefined,
        region: region.value || undefined,
        status: status.value || undefined,
    }, { preserveScroll: true, replace: true });
};

const resetFilters = () => {
    search.value = '';
    region.value = '';
    status.value = '';
};

const exportUrl = () => {
    const params = new URLSearchParams();
    if (region.value) params.append('region', region.value);
    if (status.value) params.append('status', status.value);
    return route('admin.candidatures.export') + (params.toString() ? '?' + params.toString() : '');
};

const statusConfig = {
    pending:  { label: 'En attente', cls: 'bg-yellow-100 text-yellow-800' },
    reviewed: { label: 'Examiné',    cls: 'bg-blue-100 text-blue-800' },
    accepted: { label: 'Accepté',    cls: 'bg-green-100 text-green-800' },
    rejected: { label: 'Rejeté',     cls: 'bg-red-100 text-red-800' },
};

const updateStatus = (id, val) => {
    router.patch(route('admin.candidatures.status', id), { status: val }, { preserveScroll: true });
};

const expanded = ref(null);
const toggle = (id) => { expanded.value = expanded.value === id ? null : id; };
</script>

<template>
    <Head title="Candidatures" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Candidatures</h2>
                <a :href="exportUrl()"
                   class="flex items-center gap-2 bg-[#204138] hover:bg-[#2b5549] text-white text-xs font-bold px-4 py-2 rounded-md transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    Exporter CSV
                </a>
            </div>
        </template>

        <div class="py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

                <!-- ─ Stat cards ─ -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="bg-white border border-gray-200 rounded-lg px-5 py-4">
                        <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Total</p>
                        <p class="text-2xl font-black text-[#204138] tabular-nums">{{ stats.total }}</p>
                    </div>
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg px-5 py-4">
                        <p class="text-xs text-yellow-600 uppercase tracking-wider mb-1">En attente</p>
                        <p class="text-2xl font-black text-yellow-700 tabular-nums">{{ stats.pending }}</p>
                    </div>
                    <div class="bg-green-50 border border-green-200 rounded-lg px-5 py-4">
                        <p class="text-xs text-green-600 uppercase tracking-wider mb-1">Acceptés</p>
                        <p class="text-2xl font-black text-green-700 tabular-nums">{{ stats.accepted }}</p>
                    </div>
                    <div class="bg-red-50 border border-red-200 rounded-lg px-5 py-4">
                        <p class="text-xs text-red-400 uppercase tracking-wider mb-1">Rejetés</p>
                        <p class="text-2xl font-black text-red-500 tabular-nums">{{ stats.rejected }}</p>
                    </div>
                </div>

                <!-- ─ Filtres ─ -->
                <div class="bg-white border border-gray-200 rounded-lg px-5 py-4 flex flex-wrap gap-3 items-end">
                    <!-- Recherche -->
                    <div class="flex-1 min-w-[200px]">
                        <label class="block text-xs font-semibold text-gray-500 mb-1.5 uppercase tracking-wider">Rechercher</label>
                        <div class="relative">
                            <svg class="absolute left-3 top-2.5 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35" stroke-linecap="round"/>
                            </svg>
                            <input v-model="search" type="text" placeholder="Nom, email, CNI..."
                                   class="w-full pl-9 pr-3 py-2 text-sm border border-gray-200 rounded-md focus:outline-none focus:border-[#204138] text-gray-900 bg-white">
                        </div>
                    </div>

                    <!-- Région -->
                    <div class="min-w-[160px]">
                        <label class="block text-xs font-semibold text-gray-500 mb-1.5 uppercase tracking-wider">Région</label>
                        <select v-model="region"
                                class="w-full px-3 py-2 text-sm border border-gray-200 rounded-md focus:outline-none focus:border-[#204138] text-gray-900 bg-white cursor-pointer">
                            <option value="">Toutes</option>
                            <option v-for="r in regions" :key="r" :value="r">{{ r }}</option>
                        </select>
                    </div>

                    <!-- Statut -->
                    <div class="min-w-[140px]">
                        <label class="block text-xs font-semibold text-gray-500 mb-1.5 uppercase tracking-wider">Statut</label>
                        <select v-model="status"
                                class="w-full px-3 py-2 text-sm border border-gray-200 rounded-md focus:outline-none focus:border-[#204138] text-gray-900 bg-white cursor-pointer">
                            <option value="">Tous</option>
                            <option value="pending">En attente</option>
                            <option value="reviewed">Examiné</option>
                            <option value="accepted">Accepté</option>
                            <option value="rejected">Rejeté</option>
                        </select>
                    </div>

                    <!-- Reset -->
                    <button v-if="search || region || status" @click="resetFilters"
                            class="px-3 py-2 text-xs text-gray-500 hover:text-gray-800 border border-gray-200 rounded-md hover:bg-gray-50 transition-colors cursor-pointer">
                        Réinitialiser
                    </button>

                    <div class="ml-auto text-xs text-gray-400 self-center">
                        {{ candidatures.total }} résultat{{ candidatures.total > 1 ? 's' : '' }}
                    </div>
                </div>

                <!-- ─ Table ─ -->
                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Candidat</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Région</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider hidden md:table-cell">Niveau</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider hidden lg:table-cell">Smartphone</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Statut</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider hidden sm:table-cell">Reçu</th>
                                <th class="px-4 py-3 w-16"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <template v-for="c in candidatures.data" :key="c.id">
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-4 py-3">
                                        <div class="font-semibold text-gray-900">{{ c.first_name }} {{ c.last_name }}</div>
                                        <div class="text-xs text-gray-400">{{ c.email }}</div>
                                    </td>
                                    <td class="px-4 py-3 text-gray-700 text-sm">{{ c.region }}</td>
                                    <td class="px-4 py-3 text-gray-600 text-xs hidden md:table-cell">{{ c.education_level }}</td>
                                    <td class="px-4 py-3 hidden lg:table-cell">
                                        <span :class="c.has_smartphone === 'oui' ? 'text-green-600 font-semibold' : 'text-red-400'">
                                            {{ c.has_smartphone === 'oui' ? '✓ Oui' : '✗ Non' }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <select @change="updateStatus(c.id, $event.target.value)" :value="c.status"
                                                class="text-xs border border-gray-200 rounded px-2 py-1.5 bg-white cursor-pointer focus:outline-none focus:border-[#204138] text-gray-800">
                                            <option value="pending">En attente</option>
                                            <option value="reviewed">Examiné</option>
                                            <option value="accepted">Accepté</option>
                                            <option value="rejected">Rejeté</option>
                                        </select>
                                    </td>
                                    <td class="px-4 py-3 text-xs text-gray-400 hidden sm:table-cell">
                                        {{ new Date(c.created_at).toLocaleDateString('fr-FR') }}
                                    </td>
                                    <td class="px-4 py-3 text-right">
                                        <button @click="toggle(c.id)" class="text-xs text-[#204138] hover:underline cursor-pointer whitespace-nowrap">
                                            {{ expanded === c.id ? '▲ Fermer' : '▼ Détails' }}
                                        </button>
                                    </td>
                                </tr>

                                <!-- Détails expandables -->
                                <tr v-if="expanded === c.id" class="bg-[#204138]/[0.03]">
                                    <td colspan="7" class="px-6 py-5">
                                        <div class="grid grid-cols-2 md:grid-cols-4 gap-5 text-xs">
                                            <div>
                                                <p class="font-bold text-gray-400 uppercase tracking-wider mb-2">Contact</p>
                                                <p class="text-gray-800 mb-0.5">{{ c.phone }}</p>
                                                <p class="text-gray-800">{{ c.email }}</p>
                                            </div>
                                            <div>
                                                <p class="font-bold text-gray-400 uppercase tracking-wider mb-2">Localisation</p>
                                                <p class="text-gray-800 mb-0.5">{{ c.city }}, {{ c.region }}</p>
                                                <p class="text-gray-400">CNI: {{ c.id_card_number }}</p>
                                            </div>
                                            <div>
                                                <p class="font-bold text-gray-400 uppercase tracking-wider mb-2">Profil</p>
                                                <p class="text-gray-800 mb-0.5">{{ c.gender === 'M' ? 'Masculin' : 'Féminin' }} — {{ c.birth_date ? new Date(c.birth_date).toLocaleDateString('fr-FR') : '—' }}</p>
                                                <p class="text-gray-800">Fonctionnaire : <strong>{{ c.fonctionnaire }}</strong></p>
                                            </div>
                                            <div>
                                                <p class="font-bold text-gray-400 uppercase tracking-wider mb-2">Expérience</p>
                                                <p class="text-gray-800 mb-0.5">{{ c.previous_experience || 'Non renseigné' }}</p>
                                                <p class="text-gray-500 italic" v-if="c.experience_details">{{ c.experience_details }}</p>
                                            </div>
                                            <div class="col-span-2">
                                                <p class="font-bold text-gray-400 uppercase tracking-wider mb-2">Langues locales</p>
                                                <p class="text-gray-800">{{ c.languages || '—' }}</p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </template>

                            <tr v-if="candidatures.data.length === 0">
                                <td colspan="7" class="px-4 py-12 text-center text-gray-400 text-sm">
                                    Aucune candidature ne correspond aux filtres.
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div v-if="candidatures.last_page > 1" class="px-4 py-3 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500">
                        <span>Page {{ candidatures.current_page }} / {{ candidatures.last_page }} — {{ candidatures.total }} entrées</span>
                        <div class="flex gap-2">
                            <a v-if="candidatures.prev_page_url" :href="candidatures.prev_page_url"
                               class="px-3 py-1.5 border border-gray-200 rounded hover:bg-gray-50 transition-colors">← Précédent</a>
                            <a v-if="candidatures.next_page_url" :href="candidatures.next_page_url"
                               class="px-3 py-1.5 border border-gray-200 rounded hover:bg-gray-50 transition-colors">Suivant →</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
