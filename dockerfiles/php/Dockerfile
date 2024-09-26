FROM php:8.3.10-fpm-alpine3.20

# Installing the required dependencies
RUN apk add --no-cache \
    bash \
    curl \
    libpng-dev \
    libjpeg-turbo-dev \
    libzip-dev \
    zlib-dev \
    git \
    libpq-dev \
    nginx

# Configuring and installing PHP extensions
RUN docker-php-ext-install gd zip mysqli pdo_mysql pgsql pdo_pgsql

# Copying Composer to the image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Setting the default working directory
WORKDIR /var/www

# Copy the project files to the container
COPY . /var/www

# Create necessary directories and set permissions
RUN mkdir -p /var/www/storage/logs /var/www/bootstrap/cache \
    && chown -R www-data:www-data /var/www/storage /var/www/public

# Copy Nginx configuration file
COPY ./dockerfiles/nginx/nginx.conf /etc/nginx/nginx.conf
COPY ./dockerfiles/nginx/default.conf /etc/nginx/conf.d/default.conf

# Copy FastCGI parameters file
COPY ./dockerfiles/nginx/fastcgi_params /etc/nginx/fastcgi_params

# Copy PHP-FPM configuration file
COPY ./dockerfiles/php-fpm/www.conf /usr/local/etc/php-fpm.d/www.conf

# Copy the startup script
COPY ./dockerfiles/nginx/start.sh /dockerfiles/nginx/start.sh

# Make the startup script executable
RUN chmod +x /dockerfiles/nginx/start.sh

# Install Composer dependencies
RUN composer install --optimize-autoloader

# Exposing ports for Nginx and PHP-FPM
EXPOSE 80
EXPOSE 9000

# Command to start the application
CMD ["/dockerfiles/nginx/start.sh"]
