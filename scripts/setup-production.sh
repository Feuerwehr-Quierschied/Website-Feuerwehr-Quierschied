#!/bin/bash

# Production setup script for Feuerwehr Quierschied
# This script should be run on the production server

set -e

echo "Setting up production environment..."

# Check if .env.production exists
if [ ! -f .env.production ]; then
    echo "Creating .env.production from template..."
    cat > .env.production << 'ENVEOF'
APP_NAME="Feuerwehr Quierschied"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_TIMEZONE=UTC
APP_URL=https://feuerwehr-quierschied.org
APP_LOCALE=de
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=de_DE

APP_MAINTENANCE_DRIVER=file
APP_MAINTENANCE_STORE=database

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=error

DB_CONNECTION=pgsql
DB_HOST=db
DB_PORT=5432
DB_DATABASE=ffwweb_production
DB_USERNAME=ffwweb_user
DB_PASSWORD=

SESSION_DRIVER=redis
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=redis

CACHE_STORE=redis
CACHE_PREFIX=

MEMCACHED_HOST=127.0.0.1

REDIS_CLIENT=phpredis
REDIS_HOST=redis
REDIS_PASSWORD=
REDIS_PORT=6379
REDIS_DB=0
REDIS_CACHE_DB=1

MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

VITE_APP_NAME="${APP_NAME}"

# Docker specific
APP_PORT=80
REDIS_PORT=6379
DB_PORT=5432

# Certbot
CERTBOT_EMAIL=admin@feuerwehr-quierschied.org
DOMAIN=feuerwehr-quierschied.org
ENVEOF
    echo ".env.production created. Please edit it with your production values."
else
    echo ".env.production already exists."
fi

# Generate APP_KEY if not set
if ! grep -q "APP_KEY=base64:" .env.production 2>/dev/null; then
    echo "Generating APP_KEY..."
    docker compose exec -T app php artisan key:generate --force || echo "Note: Run 'docker compose exec app php artisan key:generate' after containers are up"
fi

echo "Setup complete!"
echo ""
echo "Next steps:"
echo "1. Edit .env.production with your production values (especially DB_PASSWORD, APP_KEY)"
echo "2. Run: docker compose up -d"
echo "3. Run: docker compose exec app php artisan key:generate"
echo "4. Run: docker compose exec app php artisan migrate --force"
echo "5. Run: docker compose exec certbot certbot certonly --webroot -w /var/www/certbot -d feuerwehr-quierschied.org -d www.feuerwehr-quierschied.org --email admin@feuerwehr-quierschied.org --agree-tos --non-interactive"

