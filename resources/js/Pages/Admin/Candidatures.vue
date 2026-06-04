<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    candidatures: Object,
});

const statusLabels = {
    pending:  { label: 'En attente',   color: 'bg-yellow-100 text-yellow-800' },
    reviewed: { label: 'Examiné',      color: 'bg-blue-100 text-blue-800' },
    accepted: { label: 'Accepté',      color: 'bg-green-100 text-green-800' },
    rejected: { label: 'Rejeté',       color: 'bg-red-100 text-red-800' },
};

const updateStatus = (id, status) => {
    router.patch(route('admin.candidatures.status', id), { status }, { preserveScroll: true });
};

const expanded = ref(null);
const toggle = (id) => { expanded.value = expanded.value === id ? null : id; };
</script>

<template>
    <Head title="Candidatures" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Candidatures reçues
                <span class="ml-2 text-sm font-normal text-gray-500">({{ candidatures.total }} au total)</span>
            </h2>
        </template>

        <div class="py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <!-- Table -->
                <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Candidat</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Région</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Niveau</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Smartphone</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Statut</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Reçu</th>
                                <th class="px-4 py-3"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <template v-for="c in candidatures.data" :key="c.id">
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-4 py-3">
                                        <div class="font-semibold text-gray-900">{{ c.first_name }} {{ c.last_name }}</div>
                                        <div class="text-xs text-gray-400">{{ c.email }}</div>
                                    </td>
                                    <td class="px-4 py-3 text-gray-700">{{ c.region }}</td>
                                    <td class="px-4 py-3 text-gray-700 text-xs">{{ c.education_level }}</td>
                                    <td class="px-4 py-3">
                                        <span :class="c.has_smartphone === 'oui' ? 'text-green-600 font-semibold' : 'text-red-500'">
                                            {{ c.has_smartphone === 'oui' ? '✓ Oui' : '✗ Non' }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <select @change="updateStatus(c.id, $event.target.value)" :value="c.status"
                                                class="text-xs border border-gray-200 rounded px-2 py-1 bg-white cursor-pointer focus:outline-none focus:border-[#204138]">
                                            <option value="pending">En attente</option>
                                            <option value="reviewed">Examiné</option>
                                            <option value="accepted">Accepté</option>
                                            <option value="rejected">Rejeté</option>
                                        </select>
                                    </td>
                                    <td class="px-4 py-3 text-xs text-gray-400">{{ new Date(c.created_at).toLocaleDateString('fr-FR') }}</td>
                                    <td class="px-4 py-3">
                                        <button @click="toggle(c.id)" class="text-xs text-[#204138] hover:underline cursor-pointer">
                                            {{ expanded === c.id ? 'Réduire' : 'Détails' }}
                                        </button>
                                    </td>
                                </tr>
                                <!-- Détails expandables -->
                                <tr v-if="expanded === c.id" class="bg-[#204138]/5">
                                    <td colspan="7" class="px-4 py-4">
                                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-xs">
                                            <div>
                                                <p class="font-bold text-gray-500 uppercase tracking-wider mb-1">Contact</p>
                                                <p class="text-gray-800">{{ c.phone }}</p>
                                                <p class="text-gray-800">{{ c.email }}</p>
                                            </div>
                                            <div>
                                                <p class="font-bold text-gray-500 uppercase tracking-wider mb-1">Localisation</p>
                                                <p class="text-gray-800">{{ c.city }}, {{ c.region }}</p>
                                                <p class="text-gray-400">CNI: {{ c.id_card_number }}</p>
                                            </div>
                                            <div>
                                                <p class="font-bold text-gray-500 uppercase tracking-wider mb-1">Profil</p>
                                                <p class="text-gray-800">{{ c.gender === 'M' ? 'Masculin' : 'Féminin' }} — {{ new Date(c.birth_date).toLocaleDateString('fr-FR') }}</p>
                                                <p class="text-gray-800">Fonctionnaire : {{ c.fonctionnaire }}</p>
                                            </div>
                                            <div>
                                                <p class="font-bold text-gray-500 uppercase tracking-wider mb-1">Expérience</p>
                                                <p class="text-gray-800">{{ c.previous_experience || 'Non renseigné' }}</p>
                                                <p class="text-gray-600 italic" v-if="c.experience_details">{{ c.experience_details }}</p>
                                            </div>
                                            <div class="col-span-2">
                                                <p class="font-bold text-gray-500 uppercase tracking-wider mb-1">Langues locales</p>
                                                <p class="text-gray-800">{{ c.languages }}</p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div v-if="candidatures.last_page > 1" class="px-4 py-3 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500">
                        <span>Page {{ candidatures.current_page }} / {{ candidatures.last_page }}</span>
                        <div class="flex gap-2">
                            <a v-if="candidatures.prev_page_url" :href="candidatures.prev_page_url" class="px-3 py-1 border border-gray-200 rounded hover:bg-gray-50">← Précédent</a>
                            <a v-if="candidatures.next_page_url" :href="candidatures.next_page_url" class="px-3 py-1 border border-gray-200 rounded hover:bg-gray-50">Suivant →</a>
                        </div>
                    </div>

                    <div v-if="candidatures.data.length === 0" class="px-4 py-12 text-center text-gray-400 text-sm">
                        Aucune candidature reçue pour le moment.
                    </div>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
