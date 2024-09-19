FROM php:8.3.10-apache

# Setting the default working directory
WORKDIR /var/www/html

# Installing the required dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    unzip \
    git \
    libicu-dev \
    libxml2-dev \
    libonig-dev \
    libcurl4-openssl-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Configuring and installing PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip intl xml opcache mysqli pdo pdo_mysql curl

RUN a2enmod rewrite

# Configure DocumentRoot
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

# Copying Composer to the image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copying the source code to the working directory
COPY . /var/www/html

RUN rm -rf /var/www/html/vendor

RUN chown -R www-data:www-data /var/www/html

RUN composer clear-cache

# Installing Composer Dependencies
USER www-data
RUN composer install --no-dev --optimize-autoloader

USER root

# Exposing port 80 to Apache server
EXPOSE 80
