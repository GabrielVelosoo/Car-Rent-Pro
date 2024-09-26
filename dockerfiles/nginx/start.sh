#!/bin/sh

# Waiting for the database to be ready
if [ "$DB_CONNECTION" = "mysql" ]; then
    echo "Waiting for MySQL..."
    while ! nc -z mysql 3306; do
        sleep 1
    done
    echo "MySQL is ready. Continue..."
elif [ "$DB_CONNECTION" = "pgsql" ]; then
    echo "Waiting for PostgreSQL..."
    while ! nc -z postgres 5432; do
        sleep 1
    done
    echo "PostgreSQL is ready. Continue..."
fi

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
