#!/bin/bash
set -e

COMPOSE_DIR="/var/www/sat-and-buy-apps"
STORE="$COMPOSE_DIR/SAT-AND-BUY-STORE"

echo "=== VERIFICATION des corrections dans les sources ==="
echo "--- Navbar.js ---"
grep -n "search-placeholder" $STORE/src/layout/navbar/Navbar.js | head -3
echo "--- dashboard.js sidebar ---"
grep -n "market_list\|Liste de" $STORE/src/pages/user/dashboard.js | head -3
echo "--- locales FR ---"
python3 -c "import json; d=json.load(open('$STORE/locales/fr/common.json')); print(f'FR: {len(d)} cles')"

echo ""
echo "=== npm run build DIRECTEMENT dans le conteneur existant ==="
# Le conteneur a les sources montées ou copiées dans /app
# On rebuild directement dedans pour éviter le problème de pull Docker
docker exec sat-and-buy-apps-store-1 sh -c "cd /app && npm run build 2>&1" | tail -30

echo ""
echo "=== VERIFICATION BUILD_ID apres build ==="
docker exec sat-and-buy-apps-store-1 cat /app/.next/BUILD_ID 2>/dev/null

echo ""
echo "=== RESTART du process Next.js ==="
docker restart sat-and-buy-apps-store-1
sleep 10
docker ps --filter "name=store" --format "STATUS: {{.Status}} | CREATED: {{.CreatedAt}}"

echo "DONE"
