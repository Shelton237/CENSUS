#!/bin/bash
STORE="/var/www/sat-and-buy-apps/SAT-AND-BUY-STORE/src"

echo "=== DASHBOARD.JS FULL ==="
cat $STORE/pages/user/dashboard.js

echo ""
echo "=== SEARCH PLACEHOLDER location ==="
grep -rn "search-placeholder" $STORE/ 2>/dev/null
