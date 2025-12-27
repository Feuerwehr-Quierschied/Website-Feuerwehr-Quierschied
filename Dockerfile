# === Stage 1: Asset Compilation (Node) ===
FROM node:20-alpine AS asset-builder
WORKDIR /app
COPY . .
RUN npm install && npm run build

# === Stage 2: PHP Application ===
FROM php:8.4-fpm-alpine

# Install system dependencies & PHP extensions
RUN apk add --no-cache \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    postgresql-dev \
    icu-dev \
    $PHPIZE_DEPS \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && docker-php-ext-install pdo_pgsql gd zip intl \
    && apk del $PHPIZE_DEPS # Optional: remove build tools to save space

# Get Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy project files
COPY . .

# Copy compiled assets from Stage 1
COPY --from=asset-builder /app/public/build ./public/build

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader



# Copy app to a staging location for entrypoint
RUN mkdir -p storage/framework/cache/data \
             storage/framework/sessions \
             storage/framework/views \
             storage/app/public/images \
             storage/app/public/einsaetze \
             storage/app/public/aktuelles \
             storage/logs \
             bootstrap/cache
# Set permissions for Laravel
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache && \
    chmod -R 775 /var/www/storage /var/www/bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]