#!/bin/bash
set -e
BASE="/var/www/sat-and-buy-apps/SAT-AND-BUY-STORE"

echo "=== VERIFICATION DES TRADUCTIONS ==="
echo "order-tracking.js : $(grep -c "t('OT_" $BASE/src/pages/user/order-tracking.js) occurrences t('OT_*')"
echo "my-account.js     : $(grep -c "t('MA_" $BASE/src/pages/user/my-account.js) occurrences t('MA_*')"
echo "my-orders.js      : $(grep -c "t('MO_" $BASE/src/pages/user/my-orders.js) occurrences t('MO_*')"
echo "change-password.js: $(grep -c "t('CP_" $BASE/src/pages/user/change-password.js) occurrences t('CP_*')"

echo ""
echo "=== CLES DANS LES LOCALES ==="
echo "FR common.json - nb cles OT_ : $(cat $BASE/locales/fr/common.json | grep -c 'OT_')"
echo "FR common.json - nb cles MA_ : $(cat $BASE/locales/fr/common.json | grep -c 'MA_')"
echo "FR common.json - nb cles MO_ : $(cat $BASE/locales/fr/common.json | grep -c 'MO_')"
echo "FR common.json - nb cles CP_ : $(cat $BASE/locales/fr/common.json | grep -c 'CP_')"

echo ""
echo "=== REBUILD NEXT.JS ==="
cd $BASE
npm run build 2>&1 | tail -40

echo ""
echo "=== RESTART PM2 ==="
pm2 restart sat-store 2>&1 || pm2 restart all 2>&1 || echo "PM2 restart: check manually"

echo ""
echo "=== DONE ==="
