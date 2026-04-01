<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead

        <style>
            #global-loader {
                position: fixed;
                top: 0; left: 0; width: 100%; height: 100%;
                background: #295E4D;
                z-index: 999999;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                transition: opacity 0.5s ease;
            }
            .loader-logo {
                width: 120px;
                height: auto;
                margin-bottom: 25px;
                animation: pulse 2s infinite ease-in-out;
            }
            .loader-spinner {
                width: 40px;
                height: 40px;
                border: 4px solid rgba(255,255,255,0.2);
                border-top-color: #DAA520;
                border-radius: 50%;
                animation: spin 1s infinite linear;
            }
            @keyframes spin { to { transform: rotate(360deg); } }
            @keyframes pulse { 
                0%, 100% { transform: scale(1); opacity: 0.8; }
                50% { transform: scale(1.1); opacity: 1; }
            }
            .fade-out { opacity: 0 !important; pointer-events: none; }
        </style>
    </head>
    <body class="font-sans antialiased">
        <!-- GLOBAL LOADER -->
        <div id="global-loader">
            <img src="/assets/images/badge.png" alt="Logo" class="loader-logo" style="width: 180px;">
            <div class="loader-spinner"></div>
        </div>

        @inertia

        <script>
            // On load, hide the loader with a small intentional delay for smoother effect
            window.addEventListener('load', function() {
                const loader = document.getElementById('global-loader');
                setTimeout(() => {
                    loader.classList.add('fade-out');
                    setTimeout(() => loader.remove(), 600);
                }, 800);
            });
        </script>
    </body>
</html>
