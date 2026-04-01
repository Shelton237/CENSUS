import json
try:
    with open('/app/locales/fr/common.json', 'r', encoding='utf-8') as f:
        data = json.load(f)
        key = 'search-placeholder'
        if key in data:
            print(f"KEY_FOUND: {key} = {data[key]}")
        else:
            print(f"KEY_NOT_FOUND: {key}")
            # Print ALL keys for diagnostic
            print(f"KEYS: {list(data.keys())}")
except Exception as e:
    print(f"ERROR: {e}")
