#!/bin/bash
set -e

echo "=== NETTOYAGE .next et rebuild complet ==="
docker exec -u root sat-and-buy-apps-store-1 sh -c "rm -rf /app/.next && mkdir /app/.next && chown -R node:node /app/.next && chown -R node:node /app/src /app/locales /app/public"
echo "  .next nettoyé et permissions fixes"

echo ""
echo "=== BUILD Next.js (user node, ~3-4 min) ==="
docker exec -u node sat-and-buy-apps-store-1 sh -c "cd /app && npm run build 2>&1"
BUILD_EXIT=$?
echo "Build exit: $BUILD_EXIT"

echo ""
echo "=== NOUVEAU BUILD_ID ==="
docker exec sat-and-buy-apps-store-1 cat /app/.next/BUILD_ID 2>/dev/null || echo "Build ID pas genere"

echo ""
echo "=== RESTART ==="
docker restart sat-and-buy-apps-store-1
sleep 12
docker ps --filter "name=store" --format "STATUS: {{.Status}}"

echo "DONE"
