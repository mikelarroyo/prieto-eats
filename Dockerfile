FROM php:8.4-cli

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpq-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    nodejs \
    npm \
    ca-certificates \
    && update-ca-certificates \
    && docker-php-ext-install pdo pdo_pgsql mbstring bcmath gd

# Crear config OpenSSL personalizada con seguridad reducida para compatibilidad con PostgreSQL de Render
RUN printf 'openssl_conf=openssl_init\n\n[openssl_init]\nssl_conf=ssl_sect\n\n[ssl_sect]\nsystem_default=system_default_sect\n\n[system_default_sect]\nMinProtocol=TLSv1\nCipherString=DEFAULT@SECLEVEL=0\n' > /etc/ssl/openssl_custom.cnf

ENV OPENSSL_CONF=/etc/ssl/openssl_custom.cnf
ENV PGGSSENCMODE=disable

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

# Crear .env para el build
RUN cp .env.example .env

# Instalar dependencias PHP
RUN composer install --no-dev --optimize-autoloader

# Generar clave de app
RUN php artisan key:generate --force

# Instalar dependencias JS y compilar assets
RUN npm ci && npm run build

# Crear directorios necesarios y permisos
RUN mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache storage/logs \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 8000

CMD sh -c "rm -f .env && php artisan config:clear && \
    for i in 1 2 3 4 5; do \
        php artisan migrate --force && break; \
        echo 'Reintentando migracion en 5s...' && sleep 5; \
    done && \
    (php artisan db:seed --force 2>/dev/null || true) && \
    php artisan serve --host=0.0.0.0 --port=8000"
