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
    libpq-dev

# Configuring and installing PHP extensions
RUN docker-php-ext-install gd \
    && docker-php-ext-install zip mysqli pdo_mysql pgsql pdo_pgsql

# Copying Composer to the image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create a user not root
RUN adduser -D myuser

# Setting the default working directory
WORKDIR /var/www

# Copy the project files to the container
COPY . /var/www

# Ensure that the storage and bootstrap/cache directories exist and are writable
RUN mkdir -p /var/www/storage/logs /var/www/bootstrap/cache \
    && chown -R myuser:myuser /var/www/storage /var/www/bootstrap/cache

# Switch to the new user
USER myuser

# Copy custom PHP-FPM configuration (www.conf)
COPY ./dockerfiles/php-fpm/www.conf /usr/local/etc/php-fpm.d/www.conf

# Copy the startup script
COPY start.sh /usr/local/bin/start.sh

# Switch back to root to change permissions
USER root

# Make the startup script executable
RUN chmod +x /usr/local/bin/start.sh

# Switch back to myuser
USER myuser

# Install Composer dependencies
RUN composer install --optimize-autoloader

# Exposing port 9000 to Nginx server
EXPOSE 9000

# Command to start the application
CMD ["/usr/local/bin/start.sh"]
