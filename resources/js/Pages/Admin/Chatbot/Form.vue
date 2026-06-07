<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3';
import PageHeader from '@/Components/PageHeader.vue';

const props = defineProps({ entry: Object });

const isEdit = !!props.entry;

const form = useForm({
    title:      props.entry?.title ?? '',
    content:    props.entry?.content ?? '',
    category:   props.entry?.category ?? '',
    is_active:  props.entry?.is_active ?? true,
    sort_order: props.entry?.sort_order ?? 0,
});

const submit = () => {
    if (isEdit) {
        form.patch(route('admin.chatbot.update', props.entry.id));
    } else {
        form.post(route('admin.chatbot.store'));
    }
};
</script>

<template>
    <Head :title="isEdit ? 'Modifier une entrée' : 'Nouvelle entrée'" />

    <AuthenticatedLayout>
        <div class="py-10 bg-[#f8faf9] min-h-[calc(100vh-64px)]">
            <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">

                <div class="flex items-center gap-4 mb-8">
                    <Link :href="route('admin.chatbot.index')" class="text-[#204138]/60 hover:text-[#204138] transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    </Link>
                    <PageHeader
                        :title="isEdit ? 'Modifier une entrée' : 'Nouvelle entrée'"
                        :subtitle="isEdit ? 'Modifiez le contenu injecté dans le chatbot.' : 'Ajoutez une connaissance au chatbot.'"
                    />
                </div>

                <form @submit.prevent="submit" class="space-y-6">

                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-5">

                        <!-- Titre -->
                        <div>
                            <label class="block text-sm font-bold text-[#204138] mb-1.5">Titre <span class="text-red-500">*</span></label>
                            <input
                                v-model="form.title"
                                type="text"
                                placeholder="Ex : Qu'est-ce que le RGPH ?"
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#204138]/30 focus:border-[#204138]"
                            />
                            <p v-if="form.errors.title" class="mt-1 text-xs text-red-500">{{ form.errors.title }}</p>
                        </div>

                        <!-- Catégorie -->
                        <div>
                            <label class="block text-sm font-bold text-[#204138] mb-1.5">Catégorie</label>
                            <input
                                v-model="form.category"
                                type="text"
                                placeholder="Ex : FAQ, Procédures, Contact..."
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#204138]/30 focus:border-[#204138]"
                            />
                        </div>

                        <!-- Contenu -->
                        <div>
                            <label class="block text-sm font-bold text-[#204138] mb-1.5">Contenu <span class="text-red-500">*</span></label>
                            <textarea
                                v-model="form.content"
                                rows="8"
                                placeholder="Rédigez ici la connaissance que le chatbot doit maîtriser..."
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#204138]/30 focus:border-[#204138] resize-y"
                            ></textarea>
                            <p class="mt-1 text-xs text-gray-400">{{ form.content.length }} caractères</p>
                            <p v-if="form.errors.content" class="mt-1 text-xs text-red-500">{{ form.errors.content }}</p>
                        </div>

                        <!-- Ordre + Statut -->
                        <div class="flex gap-6">
                            <div class="flex-1">
                                <label class="block text-sm font-bold text-[#204138] mb-1.5">Ordre d'affichage</label>
                                <input
                                    v-model.number="form.sort_order"
                                    type="number"
                                    min="0"
                                    class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#204138]/30 focus:border-[#204138]"
                                />
                                <p class="mt-1 text-xs text-gray-400">Les entrées de plus petit ordre sont injectées en premier.</p>
                            </div>
                            <div class="flex items-end pb-0.5">
                                <label class="flex items-center gap-3 cursor-pointer">
                                    <button
                                        type="button"
                                        @click="form.is_active = !form.is_active"
                                        class="w-10 h-5 rounded-full relative transition-colors"
                                        :class="form.is_active ? 'bg-emerald-500' : 'bg-gray-200'"
                                    >
                                        <span class="absolute top-0.5 w-4 h-4 bg-white rounded-full shadow transition-all" :class="form.is_active ? 'left-5' : 'left-0.5'"></span>
                                    </button>
                                    <span class="text-sm font-bold text-[#204138]">{{ form.is_active ? 'Active' : 'Inactive' }}</span>
                                </label>
                            </div>
                        </div>

                    </div>

                    <!-- Actions -->
                    <div class="flex justify-end gap-3">
                        <Link
                            :href="route('admin.chatbot.index')"
                            class="px-6 py-2.5 text-sm font-bold text-gray-600 border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors"
                        >Annuler</Link>
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="px-6 py-2.5 text-sm font-bold text-white bg-[#204138] rounded-xl hover:bg-[#2b5549] transition-colors disabled:opacity-50"
                        >
                            {{ form.processing ? 'Enregistrement...' : (isEdit ? 'Mettre à jour' : 'Créer') }}
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
