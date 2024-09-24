#!/bin/sh

echo "Starting the entrypoint..."

# Install Composer dependencies
echo "Install Composer dependencies..."
composer install --optimize-autoloader

if [ $? -ne 0 ]; then
    echo "Error install Composer dependencies!"
    exit 1
fi

# Waiting MySQL ready
echo "Aguardando MySQL..."
until nc -z mysql 3306; do
    sleep 1
done

# Run migrations
echo "Run migrations..."
php artisan migrate --force

if [ $? -ne 0 ]; then
    echo "Error run migrations!"
    exit 1
fi

# Run seeders
echo "Run seeders..."
php artisan db:seed --force

if [ $? -ne 0 ]; then
    echo "Error run seeders!"
    exit 1
fi

echo "Migrations and seeders run success!"

echo "Starting Apache..."
exec apache2-foreground
