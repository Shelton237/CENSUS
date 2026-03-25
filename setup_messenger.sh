#!/bin/bash
PASS='Pluton@2015'
echo "1. Configuring .env..."
echo "$PASS" | sudo -S sed -i 's/^PORT=.*/PORT=3001/' /var/www/ADS360WHATSAPP/.env.development
echo "$PASS" | sudo -S sed -i 's/^PORT=.*/PORT=3001/' /var/www/ADS360WHATSAPP/.env.production

echo "2. Configuring systemd service..."
echo "$PASS" | sudo -S tee /etc/systemd/system/ads360whatsapp.service <<EOT
[Unit]
Description=ADS360 WhatsApp backend
After=network.target

[Service]
Type=simple
User=www-data
WorkingDirectory=/var/www/ADS360WHATSAPP
Environment=NODE_ENV=production
EnvironmentFile=/var/www/ADS360WHATSAPP/.env.production
ExecStart=/usr/bin/node /var/www/ADS360WHATSAPP/dist/main.js
Restart=on-failure
RestartSec=5
StandardOutput=append:/var/log/ads360whatsapp-service.log
StandardError=append:/var/log/ads360whatsapp-service.log

[Install]
WantedBy=multi-user.target
EOT

echo "3. Preparing logs..."
echo "$PASS" | sudo -S touch /var/log/ads360whatsapp-service.log
echo "$PASS" | sudo -S chown www-data:www-data /var/log/ads360whatsapp-service.log

echo "4. Enabling Apache modules..."
echo "$PASS" | sudo -S a2enmod proxy proxy_http headers rewrite

echo "5. Configuring Apache VirtualHosts..."
echo "$PASS" | sudo -S tee /etc/apache2/sites-available/messenger.ads360.digital.conf <<EOT
<VirtualHost *:80>
    ServerName messenger.ads360.digital
    ProxyPreserveHost On
    ProxyPass / http://localhost:3001/
    ProxyPassReverse / http://localhost:3001/
    ErrorLog \${APACHE_LOG_DIR}/messenger_ads360_80_error.log
    CustomLog \${APACHE_LOG_DIR}/messenger_ads360_80_access.log combined

    RewriteEngine on
    RewriteCond %{SERVER_NAME} =messenger.ads360.digital
    RewriteRule ^ https://%{SERVER_NAME}%{REQUEST_URI} [END,NE,R=permanent]
</VirtualHost>
EOT

echo "$PASS" | sudo -S tee /etc/apache2/sites-available/messenger.ads360.digital-le-ssl.conf <<EOT
<IfModule mod_ssl.c>
<VirtualHost *:443>
    ServerName messenger.ads360.digital
    ProxyPreserveHost On
    ProxyPass / http://localhost:3001/
    ProxyPassReverse / http://localhost:3001/
    ErrorLog \${APACHE_LOG_DIR}/messenger_ads360_443_error.log
    CustomLog \${APACHE_LOG_DIR}/messenger_ads360_443_access.log combined

    SSLCertificateFile /etc/letsencrypt/live/messenger.ads360.digital/fullchain.pem
    SSLCertificateKeyFile /etc/letsencrypt/live/messenger.ads360.digital/privkey.pem
    Include /etc/letsencrypt/options-ssl-apache.conf
</VirtualHost>
</IfModule>
EOT

echo "6. Applying changes..."
echo "$PASS" | sudo -S systemctl daemon-reload
echo "$PASS" | sudo -S systemctl enable ads360whatsapp
echo "$PASS" | sudo -S systemctl restart ads360whatsapp
echo "$PASS" | sudo -S a2ensite messenger.ads360.digital.conf
echo "$PASS" | sudo -S a2ensite messenger.ads360.digital-le-ssl.conf
echo "$PASS" | sudo -S systemctl reload apache2

echo "DONE"
