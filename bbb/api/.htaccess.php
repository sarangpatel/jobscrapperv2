<IfModule mod_rewrite.c>
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule api/(.*)$ index.php?request=$1 [QSA,NC,L]
</IfModule>