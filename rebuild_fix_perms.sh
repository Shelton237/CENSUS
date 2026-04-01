#!/bin/bash
set -e

STORE="/var/www/sat-and-buy-apps/SAT-AND-BUY-STORE"
COMPOSE_DIR="/var/www/sat-and-buy-apps"

echo "=== PERMISSIONS: fixer le .next pour build exec ==="
docker exec -u root sat-and-buy-apps-store-1 sh -c "chown -R node:node /app/.next/ 2>/dev/null && echo 'chown OK'" || echo "chown skipped"

echo ""
echo "=== BUILD dans le conteneur (user node) ==="
docker exec -u node sat-and-buy-apps-store-1 sh -c "cd /app && npm run build 2>&1" | tail -40

BUILD_EXIT=${PIPESTATUS[0]}
echo "Build exit code: $BUILD_EXIT"

echo ""
echo "=== NOUVEAU BUILD_ID ==="
docker exec sat-and-buy-apps-store-1 cat /app/.next/BUILD_ID 2>/dev/null

echo ""
echo "=== RESTART NEXT.JS ==="
docker restart sat-and-buy-apps-store-1
sleep 10
docker ps --filter "name=store" --format "STATUS: {{.Status}}"

echo "DONE"
