#!/bin/sh

echo "Iniciando o entrypoint..."

# Executa as migrations
echo "Executando as migrations..."
php artisan migrate --force

if [ $? -ne 0 ]; then
    echo "Erro ao executar as migrations!"
    exit 1
fi

echo "Migrations executadas com sucesso!"
echo "Iniciando o PHP-FPM..."
exec php-fpm