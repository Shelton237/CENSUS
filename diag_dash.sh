#!/bin/bash
STORE="/var/www/sat-and-buy-apps/SAT-AND-BUY-STORE/src"
echo "=== TOUTES LES CLES t() DANS DASHBOARD ==="
grep -o "t('[^']*')" $STORE/pages/user/dashboard.js 2>/dev/null

echo ""
echo "=== SIDEBAR HARD-CODED (Liste de marche) ==="
grep -n "Liste de" $STORE/pages/user/dashboard.js 2>/dev/null

echo ""
echo "=== CARD COMPONENT (Total_Orders_Card etc) ==="
cat $STORE/components/order-card/Card.js 2>/dev/null | head -60

echo ""
echo "=== SEARCH PLACEHOLDER USAGE ==="
grep -r "search-placeholder" $STORE/ 2>/dev/null | head -10

echo "DONE"
