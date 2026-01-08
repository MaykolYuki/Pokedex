FROM php:8.4-apache

# 1. Dependencias del sistema
RUN apt-get update && apt-get install -y \
    libpng-dev \
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

# 7. Laravel deps
RUN composer install --no-dev --optimize-autoloader --no-interaction

# 8. Permisos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 80

# 9. LA SOLUCIÓN DEFINITIVA: 
# Desactivamos cualquier MPM que no sea prefork justo antes de lanzar Apache
CMD ["/bin/sh", "-c", "a2dismod mpm_event || true; a2dismod mpm_worker || true; a2enmod mpm_prefork || true; apache2-foreground"]