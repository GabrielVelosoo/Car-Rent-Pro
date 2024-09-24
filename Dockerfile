FROM php:8.3.10-apache

# Setting the default working directory
WORKDIR /var/www/html

# Installing the required dependencies
RUN apt-get update && apt-get install -y --no-install-recommends \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    mysql-client \
    libzip-dev \
    unzip \
    git \
    libicu-dev \
    libxml2-dev \
    libonig-dev \
    libcurl4-openssl-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip intl xml opcache mysqli pdo pdo_mysql curl \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Enable Apache Rewrite Module
RUN a2enmod rewrite

# Copying Composer to the image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copying the source code to the working directory
COPY . /var/www/html

# Remove the vendor directory if it exists
RUN rm -rf /var/www/html/vendor

# Set permissions
RUN chown -R www-data:www-data /var/www/html

# Install Composer Dependencies
USER www-data
RUN composer install --no-dev --optimize-autoloader

USER root

# Copy entrypoint script
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Set entrypoint
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]

# Exposing port 80 to Apache server
EXPOSE 80
