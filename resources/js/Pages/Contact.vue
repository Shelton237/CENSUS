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

                    <!-- Coordonnées de contact -->
                    <div style="margin-top: 50px; border-top: 1px solid #EEE; padding-top: 36px;">
                        <p style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.14em; color: #9CA3AF; margin-bottom: 20px; text-align: center;">Autres moyens de nous joindre</p>
                        <div style="display: flex; flex-direction: column; gap: 12px;">

                            <!-- Téléphone -->
                            <a href="tel:+237693873145" style="display: flex; align-items: center; gap: 14px; padding: 16px 18px; background: #F7F9F8; border-left: 4px solid #204138; text-decoration: none; transition: background 0.2s;">
                                <span style="width: 38px; height: 38px; background: #204138; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81 19.79 19.79 0 01.02 1.18 2 2 0 012 .02h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.91 7.91a16 16 0 006.18 6.18l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>
                                </span>
                                <div>
                                    <p style="font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.12em; color: #9CA3AF; margin: 0 0 2px;">Téléphone</p>
                                    <p style="font-size: 17px; font-weight: 800; color: #204138; margin: 0; letter-spacing: 0.04em;">(+237) 6 93 87 31 45</p>
                                </div>
                            </a>

                            <!-- Email -->
                            <a href="mailto:recensement90@gmail.com" style="display: flex; align-items: center; gap: 14px; padding: 16px 18px; background: #F7F9F8; border-left: 4px solid #EDAF11; text-decoration: none; transition: background 0.2s;">
                                <span style="width: 38px; height: 38px; background: #EDAF11; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                                </span>
                                <div>
                                    <p style="font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.12em; color: #9CA3AF; margin: 0 0 2px;">Adresse e-mail</p>
                                    <p style="font-size: 15px; font-weight: 700; color: #204138; margin: 0;">recensement90@gmail.com</p>
                                </div>
                            </a>

                            <!-- Messenger -->
                            <a href="https://m.me/Cameroon-CENSUS-2026" target="_blank" rel="noopener noreferrer" style="display: flex; align-items: center; gap: 14px; padding: 16px 18px; background: #F7F9F8; border-left: 4px solid #1877F2; text-decoration: none; transition: background 0.2s;">
                                <span style="width: 38px; height: 38px; background: #1877F2; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="white"><path d="M12 2C6.477 2 2 6.145 2 11.243c0 2.908 1.438 5.504 3.688 7.2V22l3.37-1.85c.9.249 1.853.383 2.942.383 5.523 0 10-4.145 10-9.243C22 6.145 17.523 2 12 2zm1.007 12.433l-2.548-2.717-4.973 2.717 5.472-5.808 2.61 2.717 4.91-2.717-5.471 5.808z"/></svg>
                                </span>
                                <div>
                                    <p style="font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.12em; color: #9CA3AF; margin: 0 0 2px;">Messenger</p>
                                    <p style="font-size: 15px; font-weight: 700; color: #204138; margin: 0;">Cameroon-CENSUS-2026</p>
                                </div>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </main>
    </MainLayout>
</template>
