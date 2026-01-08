FROM php:8.4-apache

# Dependencias del sistema
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

# Extensiones PHP
RUN docker-php-ext-install pdo pdo_mysql mbstring bcmath gd

# FIX REAL MPM (SOLO ESTO, SIN ln, SIN rm manual)
RUN a2dismod mpm_event \
    && a2enmod mpm_prefork

# Rewrite
RUN a2enmod rewrite

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Proyecto
WORKDIR /var/www/html
COPY . .

# Apache -> public
RUN sed -i 's|/var/www/html|/var/www/html/public|g' \
    /etc/apache2/sites-available/000-default.conf

# Laravel deps
RUN composer install --no-dev --optimize-autoloader

# Permisos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 80

# ESTO ES OBLIGATORIO
CMD ["apache2-foreground"]
