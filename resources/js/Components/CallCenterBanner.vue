<script setup>
defineProps({
    title: {
        type: String,
        default: "Besoin d'informations ?"
    },
    subtitle: {
        type: String,
        default: 'Contactez nous via le numéro vert dédié'
    },
    phone: {
        type: String,
        default: '+237000000'
    },
    buttonLabel: {
        type: String,
        default: 'Contacter le numéro vert'
    }
});
</script>

<template>
    <section class="cc-wrapper">
        <div class="cc-card">

            <!-- Contenu Texte -->
            <div class="cc-content">
                <h2 class="cc-title">{{ __(title) }}</h2>
                <p class="cc-subtitle">{{ __(subtitle) }}</p>
                <a :href="`tel:${phone.replace(/\s/g,'')}`" class="cc-btn">
                    <span>{{ __(buttonLabel) }}</span>
                    <svg viewBox="0 0 24 24" class="cc-btn-icon" width="22" height="22">
                        <path fill="currentColor" d="M6.62,10.79C8.06,13.62 10.38,15.94 13.21,17.38L15.41,15.18C15.69,14.9 16.08,14.82 16.43,14.93C17.55,15.3 18.75,15.5 20,15.5A1,1 0 0,1 21,16.5V20A1,1 0 0,1 20,21A17,17 0 0,1 3,4A1,1 0 0,1 4,3H7.5A1,1 0 0,1 8.5,4C8.5,5.25 8.7,6.45 9.07,7.57C9.18,7.92 9.1,8.31 8.82,8.59L6.62,10.79Z" />
                    </svg>
                </a>
            </div>

            <!-- Agent avec cercle vert sombre -->
            <div class="cc-agent-wrap">
                <div class="cc-agent-circle"></div>
                <img
                    src="/assets/images/call-center/receptioniste.png"
                    alt="Agent du centre d'appel"
                    class="cc-agent-img"
                >
            </div>

        </div>
    </section>
</template>

<style scoped>
.cc-wrapper {
    padding: 60px 0 80px;
    background: #f5f7f5;
}

.cc-card {
    max-width: 1140px;
    margin: 0 auto;
    background: #1a4132;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 80px;
    position: relative;
    overflow: hidden;
    min-height: 400px;
}

.cc-content {
    flex: 1.2;
    z-index: 2;
    padding-bottom: 20px;
}

.cc-title {
    font-family: 'Arvo', serif;
    font-size: 54px;
    font-weight: 700;
    color: #ffffff;
    margin-bottom: 15px;
    line-height: 1.2;
    white-space: nowrap; /* Empêche le retour à la ligne sur desktop */
}

.cc-subtitle {
    font-family: 'Roboto', sans-serif;
    font-size: 17px;
    font-weight: 400;
    color: #ffffff;
    margin-bottom: 45px;
    opacity: 0.95;
    letter-spacing: 0.2px;
}

.cc-btn {
    display: inline-flex;
    align-items: center;
    gap: 14px; /* Un peu plus d'espace pour correspondre à l'original */
    background: #ffffff;
    color: #1a4132;
    padding: 10px 32px;
    border-radius: 100px;
    font-family: 'Roboto', sans-serif;
    font-size: 17px;
    font-weight: 700;
    text-decoration: none;
    border: 1.6px solid #EDAF11;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    transition: all 0.2s ease;
}

.cc-btn-icon {
    transform: rotate(135deg); 
    color: #1a4132;
    width: 22px;
    height: 22px;
    margin-top: -1px;
}

.cc-btn:hover {
    background: #fdfdfd;
    box-shadow: 0 6px 15px rgba(0,0,0,0.2);
    transform: translateY(-1px);
}

.cc-agent-wrap {
    flex-shrink: 0;
    display: flex;
    align-items: flex-end;
    justify-content: center;
    position: relative;
    width: 440px;
    height: 400px;
}

.cc-agent-circle {
    position: absolute;
    bottom: 50%;
    right: 50%;
    transform: translate(65%, 55%);
    width: 330px;
    height: 330px;
    background: #116041;
    border-radius: 50%;
    z-index: 1;
}

.cc-agent-img {
    position: relative;
    z-index: 2;
    height: 100%;
    width: auto;
    object-fit: contain;
    transform: translateY(15px);
}

@media (max-width: 1024px) {
    .cc-card { padding: 0 40px; margin: 0 20px; }
    .cc-title { font-size: 42px; }
    .cc-agent-wrap { width: 380px; }
}

@media (max-width: 768px) {
    .cc-card { 
        padding: 40px 24px; 
        flex-direction: column; 
        align-items: center; 
        text-align: center;
        min-height: auto; 
    }
    .cc-agent-wrap { display: none; }
    .cc-title { font-size: 36px; }
    .cc-content { padding-bottom: 0; }
    .cc-btn { padding: 12px 28px; font-size: 16px; }
}
</style>
