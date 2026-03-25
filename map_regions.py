import json
import re

with open('paths.json', 'r') as f:
    paths = json.load(f)

# Sort by length
paths = sorted(paths, key=lambda x: x['d_length'], reverse=True)[:10]

for p in paths:
    d = p['d']
    numbers = [float(x) for x in re.findall(r'-?\d+\.\d+e?-?\d*|-?\d+', d)]
    # M x,y... -> roughly pairs
    xs = numbers[0::2]
    ys = numbers[1::2]
    if len(xs) > 0:
        min_x, max_x = min(xs), max(xs)
        min_y, max_y = min(ys), max(ys)
        cx, cy = (min_x + max_x) / 2, (min_y + max_y) / 2
        print(f"ID: {p['id']:>12} | cx: {cx:6.2f}, cy: {cy:6.2f} | X: {min_x:6.2f} - {max_x:6.2f} | Y: {min_y:6.2f} - {max_y:6.2f}")
    else:
        print(f"ID: {p['id']} - no valid coords")

