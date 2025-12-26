#!/bin/bash

# Initialize certbot and obtain SSL certificates
# This script should be run once to get initial certificates

set -e

DOMAIN="feuerwehr-quierschied.org"
EMAIL="${CERTBOT_EMAIL:-admin@feuerwehr-quierschied.org}"

echo "Initializing SSL certificates for ${DOMAIN}..."

# Switch to initial HTTP-only nginx config
echo "Switching to HTTP-only nginx config..."
sed -i 's|./docker/nginx.production.conf|./docker/nginx.initial.conf|g' docker-compose.yaml

# Make sure nginx is running with HTTP config first
echo "Starting nginx with HTTP-only config..."
docker compose up -d nginx app db redis

# Wait for nginx to be ready
echo "Waiting for services to start..."
sleep 10

# Request certificates
echo "Requesting SSL certificates from Let's Encrypt..."
docker compose run --rm certbot certbot certonly \
    --webroot \
    --webroot-path=/var/www/certbot \
    -d ${DOMAIN} \
    -d www.${DOMAIN} \
    --email ${EMAIL} \
    --agree-tos \
    --non-interactive \
    --force-renewal

# Switch back to production HTTPS config
echo "Switching to HTTPS nginx config..."
sed -i 's|./docker/nginx.initial.conf|./docker/nginx.production.conf|g' docker-compose.yaml

echo "Certificates obtained successfully!"
echo "Restarting nginx with HTTPS configuration..."
docker compose restart nginx

echo "SSL setup complete!"
echo "Your site should now be accessible at https://${DOMAIN}"

