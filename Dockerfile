FROM php:8.2-apache

# Enable Apache rewrite module
RUN a2enmod rewrite

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    zip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    curl \
    && docker-php-ext-install pdo_mysql zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy Laravel app files
COPY . .

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Laravel Config Caching
RUN cp .env.example .env && php artisan key:generate && php artisan config:cache

# Apache config
COPY ./docker/vhost.conf /etc/apache2/sites-available/000-default.conf

EXPOSE 80
