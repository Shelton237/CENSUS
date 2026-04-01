#!/bin/bash
echo "=== LOCALES FR common.json (clés de traduction) ==="
docker exec sat-and-buy-apps-store-1 cat /app/locales/fr/common.json 2>/dev/null | python3 -c "import json,sys; d=json.load(sys.stdin); print(f'Nombre de cles: {len(d)}'); [print(k) for k in sorted(d.keys())]" 2>/dev/null || docker exec sat-and-buy-apps-store-1 sh -c 'cat /app/locales/fr/common.json 2>/dev/null | grep -c ":" && echo "cles totales"'

echo ""
echo "=== MANIFEST.JSON ==="
docker exec sat-and-buy-apps-store-1 cat /app/public/manifest.json 2>/dev/null || echo "manifest.json introuvable dans /app/public/"

echo ""
echo "=== PAGES USER (fichiers traduits) ==="
docker exec sat-and-buy-apps-store-1 sh -c "ls /app/src/pages/user/ 2>/dev/null"

echo ""
echo "=== OCCURRENCES t() dans order-tracking ==="
docker exec sat-and-buy-apps-store-1 sh -c "grep -c \"t('OT_\" /app/src/pages/user/order-tracking.js 2>/dev/null && echo 'occ OT_'"

echo ""
echo "=== OCCURRENCES t() dans market-list ==="
docker exec sat-and-buy-apps-store-1 sh -c "grep -c \"t('\" /app/src/pages/user/market-list.js 2>/dev/null && echo 'occ t()'"

echo ""
echo "=== ICONS PWA dans /app/public/ ==="
docker exec sat-and-buy-apps-store-1 sh -c "ls -la /app/public/*.png /app/public/*.ico /app/public/*.json 2>/dev/null"

echo ""
echo "=== BUILD_ID confirme ==="
docker exec sat-and-buy-apps-store-1 cat /app/.next/BUILD_ID 2>/dev/null

echo "DONE"
