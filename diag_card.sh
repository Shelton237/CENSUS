#!/bin/bash
STORE="/var/www/sat-and-buy-apps/SAT-AND-BUY-STORE/src"
echo "=== CARD COMPONENT ==="
cat $STORE/components/order-card/Card.js 2>/dev/null

echo ""
echo "=== SIDEBAR 'Liste de' (hard-coded) ==="
grep -n "Liste\|market_list\|march" $STORE/pages/user/dashboard.js 2>/dev/null

echo ""
echo "=== SEARCH HEADER (où est le placeholder) ==="
grep -rn "search-placeholder" $STORE/ 2>/dev/null | head -5

echo "DONE"
