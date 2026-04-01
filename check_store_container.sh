#!/bin/bash
echo "=== STORE CONTAINER DETAILS ==="
docker inspect sat-and-buy-apps-store-1 --format "Image: {{.Config.Image}} | Created: {{.Created}} | Started: {{.State.StartedAt}}" 2>/dev/null

echo ""
echo "=== STORE GIT LOG (dans le conteneur) ==="
docker exec sat-and-buy-apps-store-1 git log --oneline -10 2>/dev/null || echo "Git non accessible dans le conteneur"

echo ""
echo "=== STORE GIT STATUS (dans le conteneur) ==="
docker exec sat-and-buy-apps-store-1 git status --short 2>/dev/null || echo "Git status non accessible"

echo ""
echo "=== BUILD ID ACTUEL ==="
docker exec sat-and-buy-apps-store-1 cat /app/.next/BUILD_ID 2>/dev/null || docker exec sat-and-buy-apps-store-1 cat /usr/src/app/.next/BUILD_ID 2>/dev/null || echo "BUILD_ID introuvable"

echo ""
echo "=== STRUCTURE DOSSIER STORE ==="
docker exec sat-and-buy-apps-store-1 ls /app/ 2>/dev/null || docker exec sat-and-buy-apps-store-1 ls /usr/src/app/ 2>/dev/null || docker exec sat-and-buy-apps-store-1 ls / 2>/dev/null | head -20

echo ""
echo "=== VERIF LOCALES DANS LE CONTENEUR ==="
docker exec sat-and-buy-apps-store-1 sh -c 'ls /app/locales/ 2>/dev/null || ls /usr/src/app/locales/ 2>/dev/null || echo "locales introuvable"'

echo ""
echo "=== DOCKER COMPOSE FILE ==="
find /var/www/sat-and-buy-apps -name "docker-compose*.yml" -maxdepth 3 2>/dev/null | head -5

echo "DONE"
