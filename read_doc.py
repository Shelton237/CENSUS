import win32com.client
import sys
import os
import glob
import time
import pywintypes

sys.stdout.reconfigure(encoding='utf-8')

docs_dir = r"C:\Users\TOUTENUN\Desktop\dev\eureka\census\public\assets\documents"
matches = glob.glob(os.path.join(docs_dir, "*RGPH-RGAE.doc"))

if not matches:
    print("Document non trouvé dans", docs_dir)
    sys.exit(1)

path = os.path.abspath(matches[0])
print(f"Fichier à convertir : {path}")

docx_path = os.path.splitext(path)[0] + ".docx"
txt_path = os.path.splitext(path)[0] + ".txt"

print("Lancement de Word...")
word = win32com.client.Dispatch("Word.Application")
word.Visible = False
word.DisplayAlerts = False

def retry_com_call(func, *args, **kwargs):
    for i in range(10):
        try:
            return func(*args, **kwargs)
        except pywintypes.com_error as e:
            if e.hresult == -2147418111: # RPC_E_CALL_REJECTED
                print("Word est occupé, nouvel essai dans 1s...")
                time.sleep(1)
            else:
                raise e
    raise Exception("Word n'a pas répondu après 10 tentatives")

try:
    print("Ouverture du document...")
    doc = retry_com_call(word.Documents.Open, path)
    
    # Save as docx (FileFormat=16)
    print("Sauvegarde en DOCX...")
    retry_com_call(doc.SaveAs2, docx_path, FileFormat=16)
    
    # Save as txt (FileFormat=2)
    print("Sauvegarde en TXT...")
    retry_com_call(doc.SaveAs2, txt_path, FileFormat=2)
    
    retry_com_call(doc.Close)
    print("Conversion réussie !")
finally:
    try:
        word.Quit()
    except:
        pass
