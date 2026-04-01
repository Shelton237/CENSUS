const fs = require('fs');
const files = ['order-tracking.js', 'market-list.js', 'update-profile.js', 'remote_pages/my-account.js', 'remote_pages/my-orders.js', 'remote_pages/change-password.js'];

files.forEach(f => {
  if (fs.existsSync(f)) {
    let c = fs.readFileSync(f, 'utf8');
    c = c.replace(/useTranslation\(\)/g, "useTranslation('common')");
    
    // Explicit replacements for order-tracking.js
    c = c.replace(/Mise ├á jour :{" "}/g, "{t('OT_Update')}");
    c = c.replace(/Mise à jour :{" "}/g, "{t('OT_Update')}");
    c = c.replace(/Date pr├®vue :{" "}/g, "{t('OT_Scheduled')}");
    c = c.replace(/Date prévue :{" "}/g, "{t('OT_Scheduled')}");
    c = c.replace(/"Validation..."/g, "t('OT_Validating')");
    c = c.replace(/Confirm├®e le{" "}/g, "{t('OT_Confirmed_On')}");
    c = c.replace(/Confirmée le{" "}/g, "{t('OT_Confirmed_On')}");
    c = c.replace(/Rafra├«chir/g, "{t('OT_Refresh')}");
    c = c.replace(/Rafraîchir/g, "{t('OT_Refresh')}");
    c = c.replace(/Aucune commande sur cette ├®tape./g, "{t('OT_No_Orders_Step')}");
    c = c.replace(/Aucune commande sur cette étape./g, "{t('OT_No_Orders_Step')}");
    c = c.replace(/ÔÇö/g, '—');

    fs.writeFileSync(f, c);
    console.log('Fixed ' + f);
  }
});
