FROM php:8.2-fpm

# Install system dependencies, including GD extension
RUN apt-get update && apt-get install -y \
    git curl zip unzip libzip-dev libonig-dev libxml2-dev libpq-dev libjpeg-dev libpng-dev \
    && docker-php-ext-configure gd --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql mbstring zip gd

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy project files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

# Set Laravel permissions
RUN chown -R www-data:www-data . && chmod -R 775 storage bootstrap/cache

# Start Laravel
CMD php artisan serve --host=0.0.0.0 --port=8080
