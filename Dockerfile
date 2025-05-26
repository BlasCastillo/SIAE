# ----------------------------------------
# Etapa 1: Instalación de dependencias con Composer
# ----------------------------------------
FROM composer:2.7 as builder

WORKDIR /app
COPY composer.json composer.lock ./

# Instalar dependencias sin scripts de post-instalación
RUN composer install \
    --no-dev \
    --no-interaction \
    --optimize-autoloader \
    --ignore-platform-reqs \
    --no-scripts

# ----------------------------------------
# Etapa 2: Entorno de producción PHP
# ----------------------------------------
FROM php:8.2-fpm-alpine

WORKDIR /app

# Instalar dependencias del sistema y extensiones PHP
RUN apk add --no-cache \
    postgresql-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libwebp-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        gd \
        pdo \
        pdo_pgsql \
        zip \
    && docker-php-ext-enable gd

# Copiar código de la aplicación
COPY . .
COPY --from=builder /app/vendor ./vendor

# Configurar permisos y optimización de Laravel
RUN chown -R www-data:www-data /app \
    && chmod -R 775 storage bootstrap/cache \
    && php artisan config:clear \
    && php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

EXPOSE 10000
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=10000"]
