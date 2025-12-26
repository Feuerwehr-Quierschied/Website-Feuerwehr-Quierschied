#!/bin/bash

# Script to create .env.dev file from template
# Usage: ./scripts/create-env-dev.sh

set -e

if [ -f .env.dev ]; then
    echo ".env.dev already exists. Backing up to .env.dev.backup"
    cp .env.dev .env.dev.backup
fi

cat > .env.dev << 'ENVEOF'
# Application Configuration
APP_NAME="Feuerwehr Quierschied (Dev)"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_TIMEZONE=UTC
APP_URL=https://dev.feuerwehr-quierschied.org
APP_LOCALE=de
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=de_DE

APP_MAINTENANCE_DRIVER=file
APP_MAINTENANCE_STORE=database

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

# Database Configuration
DB_CONNECTION=pgsql
DB_HOST=db
DB_PORT=5432
DB_DATABASE=ffwweb_dev
DB_USERNAME=ffwweb_dev_user
DB_PASSWORD=

# Session Configuration
SESSION_DRIVER=redis
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=redis

# Cache Configuration
CACHE_STORE=redis
CACHE_PREFIX=

MEMCACHED_HOST=127.0.0.1

# Redis Configuration
REDIS_CLIENT=phpredis
REDIS_HOST=redis
REDIS_PASSWORD=
REDIS_PORT=6379
REDIS_DB=0
REDIS_CACHE_DB=1

# Mail Configuration
MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="dev@feuerwehr-quierschied.org"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

VITE_APP_NAME="${APP_NAME}"

# Docker Compose Configuration
# Container Names
APP_CONTAINER_NAME=laravel_app_dev
NGINX_CONTAINER_NAME=laravel_nginx_dev
DB_CONTAINER_NAME=laravel_db_dev
REDIS_CONTAINER_NAME=laravel_redis_dev
CERTBOT_CONTAINER_NAME=laravel_certbot_dev

# Network Configuration
NETWORK_NAME=laravel_network_dev

# Port Configuration
HTTP_PORT=8080
HTTPS_PORT=8443
DB_PORT=5432
REDIS_PORT=6379

# Volume Names
DB_VOLUME=pg_data_dev
REDIS_VOLUME=redis_data_dev
CERTBOT_WWW_VOLUME=certbot-www-dev
CERTBOT_CERTS_VOLUME=certbot-certs-dev

# Nginx Configuration
NGINX_CONFIG_PATH=./docker/nginx.dev.conf

# Certbot Configuration
CERTBOT_EMAIL=admin@feuerwehr-quierschied.org
DOMAIN=dev.feuerwehr-quierschied.org
ENVEOF

echo ".env.dev file created successfully!"
echo ""
echo "Next steps:"
echo "1. Edit .env.dev and set DB_PASSWORD"
echo "2. Generate APP_KEY: docker compose -f docker-compose.dev.yaml exec app php artisan key:generate"
echo "3. Update other values as needed"

