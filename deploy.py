# -*- coding: utf-8 -*-
"""
deploy.py -- Script de deploiement complet pour CENSUS -> census.diginova.cm
"""

import sys, io
# Force UTF-8 sur stdout pour eviter les erreurs cp1252 sur Windows
if sys.stdout.encoding != 'utf-8':
    sys.stdout = io.TextIOWrapper(sys.stdout.buffer, encoding='utf-8', errors='replace')
if sys.stderr.encoding != 'utf-8':
    sys.stderr = io.TextIOWrapper(sys.stderr.buffer, encoding='utf-8', errors='replace')

"""
============================================================================
Ce script effectue un déploiement complet de l'application Laravel/Inertia/Vue :

  1.  git pull          — Synchronise le code source depuis GitHub
  2.  composer install  — Installe/met à jour les dépendances PHP
  3.  npm ci            — Installe les dépendances Node.js
  4.  npm run build     — Compile les assets Vite (JS/CSS)
  5.  artisan migrate   — Applique les migrations de base de données
  6.  artisan cache:clear / config:clear / view:clear / route:clear
  7.  Correction des permissions (www-data)
  8.  Vérification de santé du site

Usage :
  python deploy.py              # Déploiement complet
  python deploy.py --no-migrate # Sans migrations (ex: hotfix)
  python deploy.py --assets-only # Rebuild assets uniquement
"""

import paramiko
import sys
import time
import urllib.request
import argparse

# ─── Paramètres de connexion ────────────────────────────────────────────────
HOST        = "38.242.223.70"
USER        = "root"
PASSWORD    = "tTW4vLpR3KY5Led7M3tu"
REMOTE_ROOT = "/var/www/census"
SITE_URL    = "https://census.diginova.cm/"

# ─── Couleurs ANSI pour la console ──────────────────────────────────────────
GREEN  = "\033[92m"
YELLOW = "\033[93m"
RED    = "\033[91m"
BLUE   = "\033[94m"
CYAN   = "\033[96m"
BOLD   = "\033[1m"
RESET  = "\033[0m"

def ok(msg):    print(f"  {GREEN}[OK]{RESET} {msg}")
def warn(msg):  print(f"  {YELLOW}[!!]{RESET} {msg}")
def error(msg): print(f"  {RED}[KO]{RESET} {msg}")
def info(msg):  print(f"  {CYAN}->{RESET} {msg}")
def step(n, total, msg): print(f"\n{BOLD}{BLUE}[{n}/{total}]{RESET} {BOLD}{msg}{RESET}")
def banner(msg): print(f"\n{'='*60}\n  {BOLD}{msg}{RESET}\n{'='*60}")

# ─── Exécution d'une commande SSH ────────────────────────────────────────────
def run(ssh, cmd, cwd=None, timeout=300, allow_fail=False):
    full_cmd = f"cd {cwd} && {cmd}" if cwd else cmd
    stdin, stdout, stderr = ssh.exec_command(full_cmd, timeout=timeout)
    exit_code = stdout.channel.recv_exit_status()
    out = stdout.read().decode("utf-8", errors="replace").strip()
    err = stderr.read().decode("utf-8", errors="replace").strip()
    if out:
        for line in out.split("\n"):
            print(f"    {line}")
    if err and exit_code != 0:
        for line in err.split("\n")[:10]:  # Limiter l'output d'erreur
            warn(line)
    if exit_code != 0 and not allow_fail:
        raise RuntimeError(f"Commande échouée (code {exit_code}): {cmd}")
    return out, err, exit_code

# ─── Vérification de santé HTTP ──────────────────────────────────────────────
def health_check(url, max_retries=5, delay=5):
    info(f"Vérification du site : {url}")
    for attempt in range(1, max_retries + 1):
        try:
            req = urllib.request.Request(url, headers={"User-Agent": "deploy-healthcheck/1.0"})
            with urllib.request.urlopen(req, timeout=15) as resp:
                code = resp.getcode()
                if code == 200:
                    ok(f"Site répond HTTP {code} (tentative {attempt}/{max_retries})")
                    return True
                else:
                    warn(f"HTTP {code} reçu (tentative {attempt}/{max_retries})")
        except Exception as e:
            warn(f"Tentative {attempt}/{max_retries} échouée : {e}")
        if attempt < max_retries:
            info(f"Nouvelle tentative dans {delay}s...")
            time.sleep(delay)
    error("Le site ne répond pas correctement après le déploiement !")
    return False

# ─── Déploiement principal ────────────────────────────────────────────────────
def deploy(no_migrate=False, assets_only=False):
    banner("DEPLOIEMENT CENSUS -> census.diginova.cm")
    print(f"  Serveur  : {HOST}")
    print(f"  Dossier  : {REMOTE_ROOT}")
    print(f"  URL      : {SITE_URL}")
    print(f"  Mode     : {'assets uniquement' if assets_only else 'complet (sans migrations)' if no_migrate else 'complet'}")

    TOTAL_STEPS = 5 if assets_only else (7 if no_migrate else 8)

    # ── Connexion SSH ─────────────────────────────────────────────────────────
    print(f"\n{CYAN}Connexion SSH à {HOST}...{RESET}")
    ssh = paramiko.SSHClient()
    ssh.set_missing_host_key_policy(paramiko.AutoAddPolicy())
    try:
        ssh.connect(HOST, username=USER, password=PASSWORD, timeout=30)
    except Exception as e:
        error(f"Impossible de se connecter : {e}")
        sys.exit(1)
    ok(f"Connexion SSH établie\n")

    n = 0

    try:
        if not assets_only:
            # ── ÉTAPE 1 : Git pull ────────────────────────────────────────────
            n += 1
            step(n, TOTAL_STEPS, "Synchronisation du code source (git pull)")
            run(ssh, "git reset --hard && git clean -fd", cwd=REMOTE_ROOT, allow_fail=True)
            out, err, code = run(ssh, "git pull", cwd=REMOTE_ROOT)
            if "Already up to date" in out:
                warn("Déjà à jour — aucun changement de code source")
            else:
                ok("Code mis à jour depuis GitHub")

            # ── ÉTAPE 2 : Composer install ────────────────────────────────────
            n += 1
            step(n, TOTAL_STEPS, "Installation des dépendances PHP (composer)")
            run(ssh,
                "composer install --no-interaction --no-dev --optimize-autoloader --quiet",
                cwd=REMOTE_ROOT, timeout=300)
            ok("Dépendances Composer installées")

        # ── ÉTAPE 3 : npm ci ──────────────────────────────────────────────────
        n += 1
        step(n, TOTAL_STEPS, "Installation des dépendances Node.js (npm ci)")
        run(ssh, "npm ci --silent", cwd=REMOTE_ROOT, timeout=300)
        ok("Dépendances npm installées")

        # ── ÉTAPE 4 : npm run build ───────────────────────────────────────────
        n += 1
        step(n, TOTAL_STEPS, "Compilation des assets Vite (npm run build)")
        info("Cela peut prendre 1-3 minutes...")
        run(ssh, "npm run build", cwd=REMOTE_ROOT, timeout=600)
        ok("Assets compilés avec succès")

        if not assets_only:
            # ── ÉTAPE 5 : Migrations ──────────────────────────────────────────
            if not no_migrate:
                n += 1
                step(n, TOTAL_STEPS, "Migrations de la base de données")
                run(ssh,
                    "php artisan migrate --force --no-interaction",
                    cwd=REMOTE_ROOT, timeout=120)
                ok("Migrations appliquées")

            # ── ÉTAPE 6 : Vider les caches ────────────────────────────────────
            n += 1
            step(n, TOTAL_STEPS, "Vidage des caches Laravel")
            caches = [
                "php artisan cache:clear",
                "php artisan config:clear",
                "php artisan view:clear",
                "php artisan route:clear",
                "php artisan event:clear",
            ]
            for cmd in caches:
                run(ssh, cmd, cwd=REMOTE_ROOT)
            ok("Tous les caches vidés")

            # ── ÉTAPE 7 : Reconstruire les caches optimisés ───────────────────
            n += 1
            step(n, TOTAL_STEPS, "Reconstruction des caches optimisés")
            run(ssh, "php artisan config:cache", cwd=REMOTE_ROOT)
            run(ssh, "php artisan route:cache", cwd=REMOTE_ROOT)
            run(ssh, "php artisan view:cache", cwd=REMOTE_ROOT, allow_fail=True)
            ok("Caches de production reconstruits")

        # ── ÉTAPE FINALE : Permissions ────────────────────────────────────────
        n += 1
        step(n, TOTAL_STEPS, "Correction des permissions")
        run(ssh, f"chown -R www-data:www-data {REMOTE_ROOT}/public/build/", cwd=None)
        run(ssh, f"chown -R www-data:www-data {REMOTE_ROOT}/storage/", cwd=None, allow_fail=True)
        run(ssh, f"chown -R www-data:www-data {REMOTE_ROOT}/lang/", cwd=None)
        run(ssh, f"chmod -R 755 {REMOTE_ROOT}/public/build/", cwd=None)
        ok("Permissions corrigées")

    except RuntimeError as e:
        error(f"\nDéploiement interrompu : {e}")
        ssh.close()
        sys.exit(1)

    ssh.close()

    # ── Vérification de santé ─────────────────────────────────────────────────
    print(f"\n{BOLD}{'='*60}{RESET}")
    print(f"  Attente de 3s avant la vérification de santé...")
    time.sleep(3)
    success = health_check(SITE_URL)

    # ── Résumé final ──────────────────────────────────────────────────────────
    print(f"\n{'='*60}")
    if success:
        print(f"  {GREEN}{BOLD}[SUCCES] DEPLOIEMENT REUSSI !{RESET}")
    else:
        print(f"  {YELLOW}{BOLD}[AVERTISSEMENT] Deploiement termine mais le site ne repond pas correctement.{RESET}")
        print(f"    Verifiez les logs : journalctl -u nginx ou les logs PHP-FPM")
    print(f"  {BOLD}URL{RESET} : {SITE_URL}")
    print(f"{'='*60}\n")

    return success


# ─── Point d'entrée ───────────────────────────────────────────────────────────
if __name__ == "__main__":
    parser = argparse.ArgumentParser(
        description="Script de déploiement Census → census.diginova.cm"
    )
    parser.add_argument(
        "--no-migrate",
        action="store_true",
        help="Sauter les migrations de base de données"
    )
    parser.add_argument(
        "--assets-only",
        action="store_true",
        help="Rebuild les assets Vite uniquement (sans git pull, composer, migrations)"
    )
    args = parser.parse_args()

    ok = deploy(no_migrate=args.no_migrate, assets_only=args.assets_only)
    sys.exit(0 if ok else 1)
