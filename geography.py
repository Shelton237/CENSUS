import json
import re

with open('paths.json', 'r') as f:
    paths = json.load(f)

# Sort by length
paths = sorted(paths, key=lambda x: x['d_length'], reverse=True)[:10]

results = []
for p in paths:
    d = p['d']
    # Use robust regex for coordinates that can handle .3e-5 or 0.5 without spaces
    numbers = [float(x) for x in re.findall(r'-?\d+\.?\d*(?:e-?\d+)?', d)]
    xs = numbers[0::2]
    ys = numbers[1::2]
    if len(xs) > 0 and len(ys) > 0:
        min_x, max_x = min(xs), max(xs)
        min_y, max_y = min(ys), max(ys)
        cx, cy = sum(xs)/len(xs), sum(ys)/len(ys) # Average is a robust center
        results.append({
            'id': p['id'],
            'cx': cx, 'cy': cy,
            'min_y': min_y, 'max_y': max_y,
            'min_x': min_x, 'max_x': max_x,
            'len': p['d_length']
        })

# Print nicely formatted and save to file
with open('geography_out.json', 'w') as f:
    json.dump(sorted(results, key=lambda x: x['cy']), f, indent=2)

print("Saved output to geography_out.json")

