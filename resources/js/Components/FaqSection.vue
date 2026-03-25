<script setup>
import { ref } from 'vue';

const faqs = ref([
    {
        question: "Pourquoi le recensement ?",
        answer: "Le recensement permet de connaître précisément la population et ses besoins pour mieux planifier les infrastructures (écoles, hôpitaux, routes) et orienter les politiques publiques pour le développement du Cameroun.",
        open: false
    },
    {
        question: "Comment vérifier mon agent recenseur ?",
        answer: "Chaque agent porte un gilet officiel jaune floqué du logo et dispose d'un badge d'identification avec sa photo, son nom et le cachet officiel du BUCREP. En cas de doute, scannez le QR code sur son badge ou appelez le numéro vert.",
        open: false
    },
    {
        question: "Quelles sont les données collectées ?",
        answer: "Nous collectons des informations démographiques (âge, sexe), socio-économiques (profession, éducation), sanitaires et des données sur le logement. Aucune information bancaire ou code secret ne vous sera jamais demandé.",
        open: false
    },
    {
        question: "Le recensement est-il obligatoire ?",
        answer: "Oui, participer au recensement est une obligation civique. Un dénombrement exact est essentiel pour que l'État puisse allouer les budgets et les services publics de manière équitable dans chaque région.",
        open: false
    },
    {
        question: "Mes données sont-elles protégées ?",
        answer: "Absolument. Conformément à la loi sur le secret statistique, vos informations individuelles sont strictement confidentielles. Elles sont anonymisées et utilisées uniquement pour produire des statistiques globales.",
        open: false
    },
    {
        question: "Comment participer au recrutement des agents ?",
        answer: "Vous pouvez postuler directement sur ce portail via le bouton 'Devenir Agent Recenseur'. Les critères incluent le niveau d'étude (minimum Baccalauréat), la maîtrise des langues locales et la résidence dans la zone de collecte.",
        open: false
    }
]);

const toggleFaq = (index) => {
    faqs.value[index].open = !faqs.value[index].open;
};
</script>

<template>
    <section class="faq-section" id="faq">
        <div class="container">
            <div class="section-header text-center mb-16">
                <span class="faq-badge">{{ __('Foire aux Questions') }}</span>
                <h2 class="faq-title">{{ __('Questions Fréquentes') }}</h2>
                <p class="faq-subtitle">{{ __('Retrouvez les réponses aux questions les plus posées sur le 4ème RGPH et le RGAE.') }}</p>
            </div>

            <div class="faq-grid">
                <div v-for="(faq, index) in faqs" :key="index" 
                     class="faq-item" :class="{ 'active': faq.open }"
                     @click="toggleFaq(index)">
                    <div class="faq-question">
                        <span>{{ __(faq.question) }}</span>
                        <div class="faq-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                        </div>
                    </div>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            {{ __(faq.answer) }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="faq-footer mt-12 text-center">
                <p class="text-gray-500 mb-6">{{ __('Vous ne trouvez pas votre réponse ?') }}</p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="tel:8000" class="faq-contact-btn">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        {{ __('Appeler le numéro Vert') }}
                    </a>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
.faq-section {
    padding: 100px 0;
    background: #fdfdfd;
}

.faq-badge {
    background: #eef2f1;
    color: #204138;
    padding: 6px 16px;
    border-radius: 100px;
    font-size: 11px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 1px;
    display: inline-block;
    margin-bottom: 16px;
}

.faq-title {
    font-size: 42px;
    font-weight: 900;
    color: #1a1a1a;
    margin-bottom: 20px;
}

.faq-subtitle {
    color: #666;
    max-width: 600px;
    margin: 0 auto;
    font-size: 16px;
    line-height: 1.6;
}

.faq-grid {
    max-width: 1140px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 24px;
    align-items: start;
}

@media (max-width: 1024px) {
    .faq-grid {
        grid-template-columns: 1fr;
        max-width: 700px;
    }
}

.faq-item {
    background: white;
    border: 1px solid #eee;
    border-radius: 20px;
    overflow: hidden;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.faq-item:hover {
    border-color: #2E6B5E;
    box-shadow: 0 10px 30px rgba(46, 107, 94, 0.05);
}

.faq-item.active {
    border-color: #2E6B5E;
    background: #fcfdfc;
    box-shadow: 0 10px 40px rgba(46, 107, 94, 0.08);
}

.faq-question {
    padding: 24px 32px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
}

.faq-question span {
    font-size: 18px;
    font-weight: 800;
    color: #1a4132;
    line-height: 1.4;
}

.faq-icon {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: #f5f7f6;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #2E6B5E;
    transition: all 0.4s ease;
    flex-shrink: 0;
}

.faq-item.active .faq-icon {
    transform: rotate(45deg);
    background: #2E6B5E;
    color: white;
}

.faq-answer {
    max-height: 0;
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.faq-item.active .faq-answer {
    max-height: 300px;
}

.faq-answer-content {
    padding: 0 32px 32px;
    color: #555;
    line-height: 1.8;
    font-size: 15px;
}

.faq-contact-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: #204138;
    color: white;
    padding: 14px 32px;
    border-radius: 100px;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.2s;
    box-shadow: 0 10px 20px rgba(32, 65, 56, 0.2);
}

.faq-contact-btn:hover {
    background: #2b5549;
    transform: translateY(-2px);
}

@media (max-width: 768px) {
    .faq-title { font-size: 32px; }
    .faq-question { padding: 20px 24px; }
    .faq-question span { font-size: 16px; }
}
</style>
