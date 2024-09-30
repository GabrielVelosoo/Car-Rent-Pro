#!/bin/sh

echo "Install Composer dependencies..."
composer install --optimize-autoloader

echo "Generate application key..."
php artisan key:generate

echo "Run migrations..."
php artisan migrate --force

echo "Seed the database..."
php artisan db:seed --force

echo "Create storage link..."
php artisan storage:link

echo "Clear caches..."
php artisan view:clear
php artisan cache:clear
php artisan config:clear

# Start PHP-FPM
php-fpm &

# Start Nginx
nginx -g 'daemon off;'
