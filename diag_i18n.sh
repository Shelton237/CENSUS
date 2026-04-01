#!/bin/bash
STORE="/var/www/sat-and-buy-apps/SAT-AND-BUY-STORE"

echo "=== i18n.json ==="
cat $STORE/i18n.json 2>/dev/null

echo ""
echo "=== NAMESPACE DANS NAVBAR ==="
grep -n "useTranslation\|t(\`common:\|t('common:" $STORE/src/layout/navbar/Navbar.js 2>/dev/null | head -15

echo ""
echo "=== LOCALES DOSSIER STRUCTURE ==="
ls -la $STORE/locales/
ls -la $STORE/locales/fr/
ls -la $STORE/locales/en/

echo "DONE"
