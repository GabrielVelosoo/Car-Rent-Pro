#!/bin/sh

echo "Starting the entrypoint..."

# Install Composer dependencies
echo "Install Composer dependencies..."
composer install --optimize-autoloader

if [ $? -ne 0 ]; then
    echo "Error install Composer dependencies!"
    exit 1
fi

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

# Create storage link
echo "Creating storage link..."
php artisan storage:link

if [ $? -ne 0 ]; then
    echo "Error creating storage link!"
    exit 1
fi

echo "Migrations, seeders, and storage link created successfully!"

echo "Starting Apache..."
exec apache2-foreground
