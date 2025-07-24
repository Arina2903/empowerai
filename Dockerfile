FROM php:8.2-apache

# Install required extensions
RUN apt-get update && apt-get install -y \
    git zip unzip curl libpng-dev libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Enable Apache rewrite module
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy Laravel files
COPY . .

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-interaction --prefer-dist

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

EXPOSE 80
