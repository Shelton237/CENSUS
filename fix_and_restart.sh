#!/bin/bash
set -e

STORE="/var/www/sat-and-buy-apps/SAT-AND-BUY-STORE"

echo "=== 1. CORRECTION sidebar 'Liste de marche' hard-coded ==="
# Remplacer le titre hard-coded corrompu par t('market_list')
sed -i 's/title: "Liste de march.*",/title: t('\''market_list'\''),/' "$STORE/src/pages/user/dashboard.js"
echo "  -> Verification:"
grep -n "market_list\|Liste de" "$STORE/src/pages/user/dashboard.js" | head -5

echo ""
echo "=== 2. UPLOAD NOUVELLES LOCALES ==="
cp /tmp/fr_common.json "$STORE/locales/fr/common.json"
cp /tmp/en_common.json "$STORE/locales/en/common.json"
python3 -c "import json; d=json.load(open('$STORE/locales/fr/common.json')); print(f'FR: {len(d)} cles')"
python3 -c "import json; d=json.load(open('$STORE/locales/en/common.json')); print(f'EN: {len(d)} cles')"

echo ""
echo "=== 3. INJECTION A CHAUD DANS LE CONTENEUR ==="
docker cp "$STORE/locales/fr/common.json" sat-and-buy-apps-store-1:/app/locales/fr/common.json
docker cp "$STORE/locales/en/common.json" sat-and-buy-apps-store-1:/app/locales/en/common.json
docker cp "$STORE/src/pages/user/dashboard.js" sat-and-buy-apps-store-1:/app/src/pages/user/dashboard.js
echo "  -> Fichiers injectes dans le conteneur"

echo ""
echo "=== 4. VERIFICATION DANS LE CONTENEUR ==="
docker exec sat-and-buy-apps-store-1 python3 -c "
import json
fr = json.load(open('/app/locales/fr/common.json'))
print(f'FR: {len(fr)} cles')
missing = [k for k in ['Total_Orders_Card','Pending_Orders_Card','Processing_Orders_Card','Complete_Orders_Card','Dashboard_Title','My_Orders_Title','search-placeholder'] if k not in fr]
print(f'Cles manquantes: {missing if missing else \"AUCUNE!\"}')
"

echo ""
echo "=== 5. RESTART DU CONTENEUR (pour recharger les locales en memoire) ==="
docker restart sat-and-buy-apps-store-1
echo "  -> Attente 8s..."
sleep 8
docker ps --filter "name=store" --format "NAME: {{.Names}} | STATUS: {{.Status}}"

echo ""
echo "DONE"
