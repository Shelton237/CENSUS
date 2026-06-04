"""
Lecture d'un fichier .doc (Word 97-2003) via extraction binaire de texte.
Fallback si win32com n'est pas disponible.
"""
import re

path = r"C:\Users\TOUTENUN\Desktop\dev\eureka\census\public\assets\documents\Activités 4ème RGPH-RGAE.doc"

with open(path, "rb") as f:
    data = f.read()

# Extraire les chaînes de caractères lisibles (ASCII + latin1)
# Les fichiers .doc stockent le texte en UTF-16LE dans le stream WordDocument
# On cherche des séquences de caractères imprimables
text_chunks = []

# Méthode 1 : chercher des séquences de bytes UTF-16LE (texte Word)
i = 0
current = []
while i < len(data) - 1:
    # Lire un caractère UTF-16LE (2 bytes)
    b1, b2 = data[i], data[i+1]
    if b2 == 0 and 32 <= b1 <= 126:  # Caractère ASCII imprimable en UTF-16LE
        current.append(chr(b1))
    elif b2 == 0 and b1 in (9, 10, 13):  # Tab, newline
        if current:
            current.append('\n')
    else:
        if len(current) > 3:
            text_chunks.append(''.join(current))
        current = []
    i += 2

# Méthode 2 : extraire aussi le texte ASCII direct
ascii_strings = re.findall(rb'[\x20-\x7E\x09\x0A\x0D]{4,}', data)
ascii_text = '\n'.join(s.decode('latin-1', errors='replace') for s in ascii_strings)

print("=== TEXTE UTF-16LE EXTRAIT ===")
full_text = '\n'.join(text_chunks)
# Filtrer les lignes significatives
for line in full_text.split('\n'):
    line = line.strip()
    if len(line) > 5:
        print(line)

print("\n\n=== TEXTE ASCII EXTRAIT (filtré) ===")
for line in ascii_text.split('\n'):
    line = line.strip()
    # Garder seulement les lignes qui semblent être du contenu réel
    if len(line) > 10 and not line.startswith('http') and not all(c in '0123456789abcdefABCDEF-_.' for c in line):
        print(line)
