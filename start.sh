#!/bin/sh

FLAG_FILE="/var/www/.migrations_done"

echo "Install Composer dependencies..."
composer install --optimize-autoloader

# Check if migrations have already been performed
if [ ! -f "$FLAG_FILE" ]; then
    echo "Run migrations..."
    php artisan migrate --force

    echo "Create storage link..."
    php artisan storage:link

    # create the flag file
    touch "$FLAG_FILE"
    echo "Migrations and seeds executed successfully!"
else
    echo "Migrations have already been executed previously. Skipping execution."
fi

echo "Starting the PHP-FPM..."
php-fpm
