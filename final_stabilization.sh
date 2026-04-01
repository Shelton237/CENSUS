#!/bin/bash
set -e

STORE="/var/www/sat-and-buy-apps/SAT-AND-BUY-STORE"

echo "=== 1. UPLOADING files to server host ==="
# Move to final locations on host
mv /tmp/fr_common.json $STORE/locales/fr/common.json
mv /tmp/en_common.json $STORE/locales/en/common.json
mv /tmp/Navbar.js $STORE/src/layout/navbar/Navbar.js
mv /tmp/login.js $STORE/src/pages/auth/login.js
mv /tmp/signup.js $STORE/src/pages/auth/signup.js

echo "=== 2. INJECTING into container ==="
docker cp $STORE/locales/fr/common.json sat-and-buy-apps-store-1:/app/locales/fr/common.json
docker cp $STORE/locales/en/common.json sat-and-buy-apps-store-1:/app/locales/en/common.json
docker cp $STORE/src/layout/navbar/Navbar.js sat-and-buy-apps-store-1:/app/src/layout/navbar/Navbar.js
docker cp $STORE/src/pages/auth/login.js sat-and-buy-apps-store-1:/app/src/pages/auth/login.js
docker cp $STORE/src/pages/auth/signup.js sat-and-buy-apps-store-1:/app/src/pages/auth/signup.js

# Ensure permissions
docker exec -u root sat-and-buy-apps-store-1 chown -R node:node /app/src /app/locales /app/public

echo "=== 3. CLEAN REBUILD (~4 mins) ==="
docker exec -u root sat-and-buy-apps-store-1 rm -rf /app/.next
docker exec -u node sat-and-buy-apps-store-1 sh -c 'cd /app && npm run build' > /tmp/final_build_log.txt 2>&1

echo "=== 4. RESTARTING ==="
docker restart sat-and-buy-apps-store-1
echo "Up and running!"
docker ps --filter "name=store"
