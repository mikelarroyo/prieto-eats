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

# Deshabilitar GSSAPI y bajar nivel de seguridad SSL para compatibilidad con PostgreSQL externo
ENV PGGSSENCMODE=disable
RUN find /etc/ssl -name "openssl.cnf" -exec sed -i \
    's/@SECLEVEL=2/@SECLEVEL=1/g; s/MinProtocol = TLSv1.2/MinProtocol = TLSv1/g' {} \; 2>/dev/null || true \
    && echo "" >> /etc/ssl/openssl.cnf \
    && echo "[system_default_sect]" >> /etc/ssl/openssl.cnf \
    && echo "MinProtocol = TLSv1" >> /etc/ssl/openssl.cnf \
    && echo "CipherString = DEFAULT@SECLEVEL=1" >> /etc/ssl/openssl.cnf

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
    php artisan serve --host=0.0.0.0 --port=8000"
