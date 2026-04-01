#!/bin/bash
STORE="/var/www/sat-and-buy-apps/SAT-AND-BUY-STORE"
NAVBAR="$STORE/src/layout/navbar/Navbar.js"

echo "=== AVANT la correction ==="
grep -n "search-placeholder\|useTranslation" $NAVBAR | head -5

echo ""
echo "=== CORRECTION: common:search-placeholder -> search-placeholder ==="
sed -i "s/t(\`common:search-placeholder\`)/t('search-placeholder')/g" $NAVBAR
# Aussi gérer les variantes avec guillemets simples si elles existent
sed -i "s/t('common:search-placeholder')/t('search-placeholder')/g" $NAVBAR

echo ""
echo "=== APRES la correction ==="
grep -n "search-placeholder\|useTranslation" $NAVBAR | head -5

echo ""
echo "=== INJECTION dans le conteneur ==="
docker cp $NAVBAR sat-and-buy-apps-store-1:/app/src/layout/navbar/Navbar.js
echo "  -> Navbar.js injectee"

echo ""
echo "=== RESTART CONTENEUR ==="
docker restart sat-and-buy-apps-store-1
echo "  -> Attente 10s..."
sleep 10
docker ps --filter "name=store" --format "STATUS: {{.Status}}"

echo ""
echo "DONE"
