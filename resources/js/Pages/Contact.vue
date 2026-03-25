<script setup>
import { ref } from 'vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    message: ''
});

const submit = () => {
    // form.post('/contact-submit');
    alert("Message envoyé ! (Simulation Inertia)");
};
</script>

<template>
    <MainLayout>
        <!-- Hero -->
        <section class="relative pt-32 pb-20 overflow-hidden bg-[#204138]">
            <div class="absolute inset-0 z-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
            <div class="container relative z-10 text-center">
                <span class="inline-block py-1 px-3 rounded-full bg-[#EDAF11]/20 text-[#EDAF11] font-bold text-sm tracking-widest uppercase mb-4">Contactez-nous</span>
                <h1 class="text-4xl md:text-5xl font-black text-white mb-6 leading-tight">Nous contacter</h1>
                <p class="text-xl text-white/80 max-w-2xl mx-auto leading-relaxed">Une question sur le recensement ou une requête administrative ? Notre équipe vous répondra dans les meilleurs délais.</p>
            </div>
        </section>

        <main class="inner-page" style="padding: 60px 0; background: #FDFDFD;">
            <div class="container">
                <div style="max-width: 650px; margin: 0 auto; background: white; padding: 50px; border-radius: 20px; box-shadow: 0 10px 40px rgba(0,0,0,0.06); border: 1px solid #F0F0F0;">

                    <form @submit.prevent="submit">
                        <div style="margin-bottom: 25px;">
                            <label style="display: block; font-weight: 700; margin-bottom: 10px; font-size: 14px; text-transform: uppercase; color: #555;">Nom complet</label>
                            <input v-model="form.name" type="text" style="width: 100%; padding: 16px; border: 2px solid #F0F0F0; border-radius: 12px; font-size: 16px; outline: none; transition: border-color 0.2s;" placeholder="Jean Dupont" required>
                        </div>
                        
                        <div style="margin-bottom: 25px;">
                            <label style="display: block; font-weight: 700; margin-bottom: 10px; font-size: 14px; text-transform: uppercase; color: #555;">Adresse E-mail</label>
                            <input v-model="form.email" type="email" style="width: 100%; padding: 16px; border: 2px solid #F0F0F0; border-radius: 12px; font-size: 16px; outline: none; transition: border-color 0.2s;" placeholder="jean.dupont@exemple.cm" required>
                        </div>

                        <div style="margin-bottom: 35px;">
                            <label style="display: block; font-weight: 700; margin-bottom: 10px; font-size: 14px; text-transform: uppercase; color: #555;">Votre Message</label>
                            <textarea v-model="form.message" style="width: 100%; height: 160px; padding: 16px; border: 2px solid #F0F0F0; border-radius: 12px; font-size: 16px; outline: none; resize: vertical; transition: border-color 0.2s;" placeholder="Comment pouvons-nous vous aider ?" required></textarea>
                        </div>

                        <button type="submit" :disabled="form.processing" style="background: #295E4D; color: white; border: none; padding: 18px 35px; font-size: 16px; font-weight: 900; border-radius: 12px; cursor: pointer; width: 100%; transition: transform 0.2s, background 0.2s;">
                            ENVOYER LE MESSAGE
                        </button>
                    </form>

                    <div style="margin-top: 50px; border-top: 1px solid #EEE; padding-top: 30px; text-align: center;">
                        <span style="display: block; font-weight: 700; margin-bottom: 10px; font-size: 14px; color: #666;">NUMÉRO VERT DÉDIÉ</span>
                        <a href="tel:+237000000" style="color: #E8AA00; font-size: 28px; font-weight: 900; text-decoration: none; letter-spacing: 1px;">(+237) XXXXXXXX</a>
                    </div>
                </div>
            </div>
        </main>
    </MainLayout>
</template>
