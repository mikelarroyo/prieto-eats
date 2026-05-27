FROM php:8.2-fpm

# Instalar dependencias del sistema y el driver de PostgreSQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

WORKDIR /var/www/html
COPY . .

# Instalar dependencias de composer si no las tienes en el vendor
# RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
# RUN composer install
