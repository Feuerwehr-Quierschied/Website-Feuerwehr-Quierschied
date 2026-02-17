FROM serversideup/php:8.4-fpm-nginx

# Switch to root to install extensions
USER root
RUN install-php-extensions intl

# Drop back to the default unprivileged user
USER www-data