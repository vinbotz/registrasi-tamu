#!/bin/sh

# Set permission untuk folder penting Laravel
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Laravel commands
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Jalankan migrasi (hapus --force jika takut migrate otomatis)
php artisan migrate --force

# Jalankan Apache
apache2-foreground
