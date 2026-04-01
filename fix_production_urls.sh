#!/bin/bash
set -e

ENV_FILE="/var/www/sat-and-buy-apps/env/store.prod.env"
# OLD="https://back-satbuy.dreamdigital.cm"
# NEW="https://gateway.diginova.cm"
# OLD_DOMAIN="https://store.dreamdigital.cm"
# NEW_DOMAIN="https://store.diginova.cm"

echo "=== 1. UPDATING environment file on host ==="
sed -i 's/back-satbuy.dreamdigital.cm/gateway.diginova.cm/g' $ENV_FILE
sed -i 's/store.dreamdigital.cm/store.diginova.cm/g' $ENV_FILE

echo ""
echo "=== 2. CURRENT ENV_FILE CONTENT ==="
cat $ENV_FILE

echo ""
echo "=== 3. CLEAN REBUILD Next.js inside container (~4 mins) ==="
# Next build picks up variables FROM THE CONTAINER ENVIRONMENT.
# So I MUST RESTART THE CONTAINER FIRST SO IT GETS THE NEW ENV FROM HOST ENV_FILE!
# However, Docker Compose restart will Load from host.
# But I am doing docker exec?
# Actually, I should use docker-compose up -d store if possible.

echo "--- RESTARTING container to load NEW ENV ---"
docker restart sat-and-buy-apps-store-1
sleep 5
echo "--- ENVIRONMENT check inside container ---"
docker exec sat-and-buy-apps-store-1 env | grep NEXT_PUBLIC

echo ""
echo "--- PERFORMING NEXT BUILD WITH NEW ENV ---"
docker exec -u root sat-and-buy-apps-store-1 rm -rf /app/.next
# Note: npm run build will use the environment from the docker exec (which inherit from docker inspect env)
docker exec -u node sat-and-buy-apps-store-1 sh -c 'cd /app && npm run build' > /tmp/rebuild_with_new_env_log.txt 2>&1

echo ""
echo "=== 4. RESTARTING FINAL ==="
docker restart sat-and-buy-apps-store-1
sleep 10
echo "Up and running with new env!"
docker ps --filter "name=store"

echo "DONE"
