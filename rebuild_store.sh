#!/bin/bash
set -e

COMPOSE_DIR="/var/www/sat-and-buy-apps"
STORE_SRC="/var/www/sat-and-buy-apps/sat-and-buy-apps"

echo "=== 1. COPIE DES LOCALES ==="

# Trouver le bon dossier locales dans le repo
LOCALES_PATH=""
for candidate in \
  "$COMPOSE_DIR/store/locales" \
  "$STORE_SRC/store/locales" \
  "$COMPOSE_DIR/SAT-AND-BUY-STORE/locales" \
  "$STORE_SRC/SAT-AND-BUY-STORE/locales"; do
  if [ -d "$candidate" ]; then
    LOCALES_PATH="$candidate"
    echo "  -> Dossier locales trouvé : $LOCALES_PATH"
    break
  fi
done

# Sinon chercher par find
if [ -z "$LOCALES_PATH" ]; then
  LOCALES_PATH=$(find /var/www -maxdepth 6 -type d -name "locales" 2>/dev/null | grep -v node_modules | head -1)
  echo "  -> Dossier locales (find) : $LOCALES_PATH"
fi

if [ -z "$LOCALES_PATH" ]; then
  echo "  ERREUR: Impossible de trouver le dossier locales sur le serveur!"
  exit 1
fi

echo "  Copie fr/common.json..."
mkdir -p "$LOCALES_PATH/fr"
cp /tmp/fr_common.json "$LOCALES_PATH/fr/common.json"
echo "  OK: $LOCALES_PATH/fr/common.json"

echo "  Copie en/common.json..."
mkdir -p "$LOCALES_PATH/en"
cp /tmp/en_common.json "$LOCALES_PATH/en/common.json"
echo "  OK: $LOCALES_PATH/en/common.json"

echo ""
echo "=== 2. VERIFICATION des cles ==="
python3 -c "import json; d=json.load(open('$LOCALES_PATH/fr/common.json')); print(f'FR: {len(d)} cles')" 2>/dev/null || \
  echo "FR cles: $(grep -c '\"' $LOCALES_PATH/fr/common.json)"
python3 -c "import json; d=json.load(open('$LOCALES_PATH/en/common.json')); print(f'EN: {len(d)} cles')" 2>/dev/null || \
  echo "EN cles: $(grep -c '\"' $LOCALES_PATH/en/common.json)"

echo ""
echo "=== 3. REBUILD DU CONTENEUR STORE ==="
cd "$COMPOSE_DIR"
echo "  -> docker compose build store..."
docker compose build store 2>&1 | tail -20

echo ""
echo "  -> docker compose up -d store..."
docker compose up -d store 2>&1

echo ""
echo "=== 4. STATUS FINAL ==="
sleep 3
docker ps --filter "name=store" --format "NAME: {{.Names}} | STATUS: {{.Status}}"

echo ""
echo "DONE"
