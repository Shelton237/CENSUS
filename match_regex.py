import re
import math

with open('/tmp/cameroon_paths.svg', 'r', encoding='utf-8') as f:
    svg_content = f.read()

# Find all paths
paths = []
for m in re.finditer(r'<path[^>]*id="([^"]+)"[^>]*d="([^"]+)"', svg_content):
    id_str = m.group(1)
    d_str = m.group(2)
    if len(d_str) > 2000:
        numbers = [float(x) for x in re.findall(r'-?\d+\.\d+e?-?\d*|-?\d+', d_str)]
        xs = numbers[0::2]
        ys = numbers[1::2]
        if xs and ys:
            cx = (min(xs) + max(xs)) / 2
            cy = (min(ys) + max(ys)) / 2
            paths.append({'id': id_str, 'cx': cx, 'cy': cy, 'length': len(d_str)})

print(f"Found {len(paths)} long paths.")

# Find all texts
texts = []
for m in re.finditer(r'<text[^>]*y="([^"]+)"[^>]*x="([^"]+)"[^>]*>.*?<tspan[^>]*>(.*?)</tspan>', svg_content, flags=re.DOTALL):
    y = float(m.group(1))
    x = float(m.group(2))
    name = m.group(3).strip()
    # Filter for realistic region names
    if name in ["Adamaoua", "Centre", "East", "Est", "Far North", "Extrême-Nord", "Littoral", "North", "Nord", "Northwest", "Nord-Ouest", "South", "Sud", "Southwest", "Sud-Ouest", "West", "Ouest"]:
        texts.append({'name': name, 'x': x, 'y': y})

print(f"Found {len(texts)} text labels.")

for t in texts:
    min_dist = float('inf')
    best_path = None
    for p in paths:
        dist = math.hypot(p['cx'] - t['x'], p['cy'] - t['y'])
        if dist < min_dist:
            min_dist = dist
            best_path = p
    if best_path:
        print(f"Region: {t['name']:<15} -> Path ID: {best_path['id']:<15} (dist: {min_dist:.1f}, len: {best_path['length']})")
