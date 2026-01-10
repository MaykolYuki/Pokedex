FROM php:8.4-apache

# 1. Dependencias del sistema
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libwebp-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# 2. Extensiones PHP
RUN docker-php-ext-install pdo pdo_mysql mbstring bcmath gd

RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install pdo pdo_mysql mbstring bcmath gd

# 3. Habilitar Rewrite
RUN a2enmod rewrite

# 4. Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 5. Proyecto
WORKDIR /var/www/html
COPY . .

# 6. Apache -> public
RUN sed -i 's|/var/www/html|/var/www/html/public|g' \
    /etc/apache2/sites-available/000-default.conf

RUN echo "upload_max_filesize=20M" > /usr/local/etc/php/conf.d/uploads.ini \
    && echo "post_max_size=25M" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "memory_limit=256M" >> /usr/local/etc/php/conf.d/uploads.ini

# Aumentar límites de PHP para manejar strings gigantes
RUN echo "memory_limit=512M" > /usr/local/etc/php/conf.d/memory.ini \
    && echo "upload_max_filesize=30M" >> /usr/local/etc/php/conf.d/memory.ini \
    && echo "post_max_size=35M" >> /usr/local/etc/php/conf.d/memory.ini

# 7. Laravel deps
RUN composer install --no-dev --optimize-autoloader --no-interaction

# 8. Permisos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 80

# 9. LA SOLUCIÓN DEFINITIVA: 
# Ejecutamos migraciones Y LUEGO lanzamos Apache

CMD ["/bin/sh", "-c", "php artisan migrate --force && a2dismod mpm_event || true; a2dismod mpm_worker || true; a2enmod mpm_prefork || true; apache2-foreground"]


