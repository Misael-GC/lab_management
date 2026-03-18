FROM php:8.3-fpm-alpine

# Instalar extensiones PDO + opcache (seguridad y rendimiento)
RUN docker-php-ext-install pdo pdo_mysql opcache

# Copiar config opcache
COPY docker/php/opcache.ini /usr/local/etc/php/conf.d/opcache.ini

WORKDIR /var/www/html

# No correr como root — buena práctica de seguridad
RUN addgroup -g 1000 appgroup && adduser -u 1000 -G appgroup -s /bin/sh -D appuser
USER appuser