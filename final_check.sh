#!/bin/bash
echo "=== STATUS DU CONTENEUR STORE ==="
docker ps --filter "name=store" --format "NAME: {{.Names}} | STATUS: {{.Status}} | IMAGE: {{.Image}} | CREATED: {{.CreatedAt}}"

echo ""
echo "=== LOCALES DANS LE CONTENEUR ACTUEL ==="
docker exec sat-and-buy-apps-store-1 python3 -c "
import json
fr = json.load(open('/app/locales/fr/common.json'))
en = json.load(open('/app/locales/en/common.json'))
print(f'FR: {len(fr)} cles')
print(f'EN: {len(en)} cles')
expected = ['SEO_Title','Dashboard_Title','My_Orders_Title','Order_Tracking_Title','My_Account_Title','Update_Profile_Title','Change_Password_Title','Logout_Title','search-placeholder']
missing = [k for k in expected if k not in fr]
print(f'Cles manquantes: {missing if missing else \"AUCUNE - tout est present!\"}')
" 2>/dev/null

echo ""
echo "=== BUILD_ID DU CONTENEUR ==="
docker exec sat-and-buy-apps-store-1 cat /app/.next/BUILD_ID 2>/dev/null || echo "BUILD_ID introuvable"

echo ""
echo "=== IMAGE DOCKER STORE (date du build) ==="
docker inspect sat-and-buy-apps-store --format "Created: {{.Created}}" 2>/dev/null || \
  docker images sat-and-buy-apps-store --format "REPO: {{.Repository}} | TAG: {{.Tag}} | CREATED: {{.CreatedAt}}"

echo "DONE"
