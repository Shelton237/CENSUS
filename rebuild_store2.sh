#!/bin/bash
set -e

COMPOSE_DIR="/var/www/sat-and-buy-apps"
STORE_LOCALES="/var/www/sat-and-buy-apps/SAT-AND-BUY-STORE/locales"

echo "=== VERIFICATION que les locales sont bien dans les sources ==="
python3 -c "import json; d=json.load(open('$STORE_LOCALES/fr/common.json')); print(f'FR sources: {len(d)} cles')"
python3 -c "import json; d=json.load(open('$STORE_LOCALES/en/common.json')); print(f'EN sources: {len(d)} cles')"

echo ""
echo "=== CHECK DOCKERFILE store ==="
cat "$COMPOSE_DIR/SAT-AND-BUY-STORE/Dockerfile" 2>/dev/null || find "$COMPOSE_DIR" -name "Dockerfile" | head -5

echo ""
echo "=== STRATEGY: copier locales directement dans le conteneur en cours ==="
echo "  -> cp dans le conteneur (sans rebuild)..."
docker cp "$STORE_LOCALES/fr/common.json" sat-and-buy-apps-store-1:/app/locales/fr/common.json
echo "  OK: fr/common.json copie dans le conteneur"
docker cp "$STORE_LOCALES/en/common.json" sat-and-buy-apps-store-1:/app/locales/en/common.json
echo "  OK: en/common.json copie dans le conteneur"

echo ""
echo "=== VERIFICATION dans le conteneur ==="
docker exec sat-and-buy-apps-store-1 python3 -c "import json; d=json.load(open('/app/locales/fr/common.json')); print(f'Conteneur FR: {len(d)} cles')" 2>/dev/null || \
  docker exec sat-and-buy-apps-store-1 sh -c "cat /app/locales/fr/common.json | grep -c '\".*\":'" 

echo ""
echo "=== REBUILD du conteneur avec --no-cache (sans pull) ==="
cd "$COMPOSE_DIR"
docker compose build --no-cache --pull=false store 2>&1 | tail -30

echo ""
echo "=== RELANCE -d ==="
docker compose up -d store 2>&1

sleep 5
echo ""
echo "=== STATUS FINAL ==="
docker ps --filter "name=store" --format "NAME: {{.Names}} | STATUS: {{.Status}} | CREATED: {{.CreatedAt}}"

echo ""
echo "=== VERIFICATION locales dans le NOUVEAU conteneur ==="
docker exec sat-and-buy-apps-store-1 sh -c "python3 -c \"import json; d=json.load(open('/app/locales/fr/common.json')); print(f'Conteneur FR: {len(d)} cles')\" 2>/dev/null || echo 'python non dispo'"

echo "DONE"
