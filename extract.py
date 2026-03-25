import xml.etree.ElementTree as ET
import json

try:
    tree = ET.parse('/tmp/cameroon_paths.svg')
    root = tree.getroot()
    paths = []
    
    for elem in root.iter():
        if 'path' in elem.tag.lower():
            d = elem.get('d')
            if d and len(d) > 200:
                # Store enough to identify it
                paths.append({
                    'id': elem.get('id', 'no-id'),
                    'd_length': len(d),
                    'class': elem.get('class', ''),
                    'd': d
                })

    paths.sort(key=lambda x: x['d_length'], reverse=True)
    
    print("Found", len(paths), "large paths in cameroon_paths.svg:")
    for p in paths[:25]:
        print(f"ID: {p['id']}, Length: {p['d_length']}, Class: {p['class']}")
        
    with open('c:\\Users\\TOUTENUN\\Desktop\\dev\\eureka\\census\\cameroon_extracted.json', 'w') as f:
        json.dump(paths[:15], f, indent=2)

except Exception as e:
    print("Error:", e)
