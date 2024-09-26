#!/bin/sh

echo "Install Composer dependencies..."
composer install --optimize-autoloader

echo "Run migrations..."
php artisan migrate --force

echo "Create storage link..."
php artisan storage:link

# Start PHP-FPM
php-fpm &

# Start Nginx
nginx -g 'daemon off;'
