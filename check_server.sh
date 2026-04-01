#!/bin/bash
echo "=== /var/www CONTENTS ==="
ls /var/www/ 2>/dev/null

echo ""
echo "=== FIND SAT-AND-BUY STORE ==="
find /var/www -maxdepth 5 -name "package.json" 2>/dev/null | xargs grep -l "sat-and-buy" 2>/dev/null

echo ""
echo "=== DOCKER CONTAINERS ==="
docker ps --format "NAME: {{.Names}} | STATUS: {{.Status}} | IMAGE: {{.Image}}" 2>/dev/null || echo "Docker not accessible or no containers"

echo ""
echo "=== PM2 PROCESSES ==="
export NVM_DIR="/root/.nvm"
[ -s "$NVM_DIR/nvm.sh" ] && source "$NVM_DIR/nvm.sh" 2>/dev/null
pm2 list 2>/dev/null || /usr/local/bin/pm2 list 2>/dev/null || echo "pm2 not found in PATH"

echo ""
echo "=== NVM NODE VERSIONS ==="
ls /root/.nvm/versions/node/ 2>/dev/null || echo "NVM not found"

echo "DONE"
