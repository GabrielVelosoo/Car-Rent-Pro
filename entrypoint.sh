#!/bin/sh

# Exibe uma mensagem de início
echo "Iniciando o entrypoint..."

# Executa as migrations
echo "Executando as migrations..."
if php artisan migrate --force; then
    echo "Migrations executadas com sucesso!"
else
    echo "Erro ao executar as migrations!"
    exit 1
fi

# Inicia o servidor PHP-FPM
echo "Iniciando o PHP-FPM..."
exec php-fpm
