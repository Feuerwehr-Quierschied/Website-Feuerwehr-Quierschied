# === Stage 1: Asset Compilation ===
FROM node:20-alpine AS asset-builder
WORKDIR /app
# Trick: Nur package.json kopieren, damit npm install gecached wird
COPY package.json package-lock.json ./
RUN npm install
# Erst jetzt den Rest kopieren
COPY . .
RUN npm run build

# === Stage 2: PHP Application ===
FROM php:8.4-fpm-alpine

# System-Abhängigkeiten
RUN apk add --no-cache \
    libpng-dev libzip-dev zip unzip git postgresql-dev icu-dev $PHPIZE_DEPS \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && docker-php-ext-install pdo_pgsql gd zip intl \
    && apk del $PHPIZE_DEPS

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# PHP Dependencies (auch hier: erst Files, dann install für Cache)
COPY composer.json composer.lock ./
RUN composer install --no-scripts --no-autoloader --no-dev

# Projekt-Files kopieren
COPY . .

# Assets aus Stage 1 rüberholen
COPY --from=asset-builder /app/public/build ./public/build

# Autoloader optimieren
RUN composer dump-autoload --optimize

# Ordnerstruktur für Volumes vorbereiten
RUN mkdir -p storage/framework/cache/data \
             storage/framework/sessions \
             storage/framework/views \
             storage/app/public/images \
             storage/app/public/einsaetze \
             storage/app/public/aktuelles \
             storage/logs \
             bootstrap/cache

# Berechtigungen für das gesamte Projekt setzen
# Das stellt sicher, dass www-data (der Webserver-User) alles lesen/schreiben darf
RUN chown -R www-data:www-data /var/www

# Den Container als www-data laufen lassen
USER www-data

EXPOSE 9000
CMD ["php-fpm"]