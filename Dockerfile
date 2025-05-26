# Etapa de construcción de dependencias
FROM composer:2.7 as build
WORKDIR /app
COPY composer.* ./
RUN composer install --no-dev --no-interaction --optimize-autoloader --ignore-platform-reqs

# Etapa final de producción
FROM php:8.2-fpm-alpine
WORKDIR /app
COPY --from=build /app/vendor ./vendor
COPY . .

# Instalar dependencias para PostgreSQL, GD y extensiones PHP
RUN apk add --no-cache \
    postgresql-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libwebp-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_pgsql \
    && docker-php-ext-enable gd

# Permisos y optimización de Laravel
RUN chmod -R 775 storage bootstrap/cache \
    && php artisan config:clear \
    && php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

EXPOSE 10000
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=10000"]
