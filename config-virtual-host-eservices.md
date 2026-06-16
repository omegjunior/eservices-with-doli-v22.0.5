# ---------------------------------------------------------------------------
# 1. Dolibarr complet
# ---------------------------------------------------------------------------
<VirtualHost *:80>
    ServerName service-public.archidiocesedecotonou.org
    DocumentRoot /var/www/html

    <Directory /var/www/html>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>

# ---------------------------------------------------------------------------
# 2. Site web centralis▒ (module Website Dolibarr)
# ---------------------------------------------------------------------------
<VirtualHost *:80>
    ServerName service-support.archidiocesedecotonou.org
    DocumentRoot /var/www/html/documents/website/service-support

    # Verrouiller tout documents/ ▒ remplace le .htaccess natif Dolibarr
    <Directory /var/www/html/documents>
        AllowOverride None
        Require all denied
    </Directory>

    # Ouvrir uniquement le dossier du site g▒n▒r▒
    <Directory /var/www/html/documents/website/service-support>
        Options -Indexes
        AllowOverride None
        Require all granted
        DirectoryIndex index.php
    </Directory>

    # Exposer uniquement les m▒dias du site centralis▒
    Alias /medias/image/service-support /var/www/html/documents/medias/image/service-support
    <Directory /var/www/html/documents/medias/image/service-support>
        Options -Indexes
        AllowOverride None
        Require all granted
    </Directory>

    # Ajout : CSS compil▒ Tailwind
    Alias /medias/css/service-support /var/www/html/documents/medias/css/service-support
    <Directory /var/www/html/documents/medias/css/service-support>
        Options -Indexes
        AllowOverride None
        Require all granted
    </Directory>
</VirtualHost>

# ---------------------------------------------------------------------------
# 3. Interface ticket Secr▒tariat (entit▒ 1)
# ---------------------------------------------------------------------------
<VirtualHost *:80>
    ServerName service-support-secretariat.archidiocesedecotonou.org
    DocumentRoot /var/www/html/public/ticket

    <Directory /var/www/html/public/ticket>
        AllowOverride All
        Require all granted
    </Directory>

    RewriteEngine On
    # Injecter entity=1 si absent de la query string
    RewriteCond %{QUERY_STRING} !(?:^|&)entity=
    RewriteCond %{QUERY_STRING} .+
    RewriteRule ^ %{REQUEST_URI}?%{QUERY_STRING}&entity=1 [L,QSA]
    
    # Si query string vide
    RewriteCond %{QUERY_STRING} !(?:^|&)entity=
    RewriteCond %{QUERY_STRING} ^$
    RewriteRule ^ %{REQUEST_URI}?%{QUERY_STRING}&entity=1 [L,QSA]
</VirtualHost>

# ---------------------------------------------------------------------------
# 4. Interface ticket ▒conomat (entit▒ 2)
# ---------------------------------------------------------------------------
<VirtualHost *:80>
    ServerName service-support-economat.archidiocesedecotonou.org
    DocumentRoot /var/www/html/public/ticket

    <Directory /var/www/html/public/ticket>
        AllowOverride All
        Require all granted
    </Directory>

    RewriteEngine On
    # Injecter entity=1 si absent de la query string
    RewriteCond %{QUERY_STRING} !(?:^|&)entity=
    RewriteCond %{QUERY_STRING} .+
    RewriteRule ^ %{REQUEST_URI}?%{QUERY_STRING}&entity=2 [L,QSA]
    
    # Si query string vide
    RewriteCond %{QUERY_STRING} !(?:^|&)entity=
    RewriteCond %{QUERY_STRING} ^$
    RewriteRule ^ %{REQUEST_URI}?%{QUERY_STRING}&entity=2 [L,QSA]
</VirtualHost>

# ---------------------------------------------------------------------------
# 5. Interface ticket Chancellerie (entit▒ 3)
# ---------------------------------------------------------------------------
<VirtualHost *:80>
    ServerName service-support-chancellerie.archidiocesedecotonou.org
    DocumentRoot /var/www/html/public/ticket

    <Directory /var/www/html/public/ticket>
        AllowOverride All
        Require all granted
    </Directory>

    RewriteEngine On
    # Injecter entity=1 si absent de la query string
    RewriteCond %{QUERY_STRING} !(?:^|&)entity=
    RewriteCond %{QUERY_STRING} .+
    RewriteRule ^ %{REQUEST_URI}?%{QUERY_STRING}&entity=3 [L,QSA]
    
    # Si query string vide
    RewriteCond %{QUERY_STRING} !(?:^|&)entity=
    RewriteCond %{QUERY_STRING} ^$
    RewriteRule ^ %{REQUEST_URI}?%{QUERY_STRING}&entity=3 [L,QSA]
</VirtualHost>