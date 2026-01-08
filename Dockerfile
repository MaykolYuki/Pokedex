FROM php:8.4-apache

# 1. Dependencias del sistema (Agrupadas para optimizar capas)
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

# 3. FIX MPM: Eliminamos físicamente el enlace de mpm_event para evitar el error AH00534
# Esto asegura que Apache solo cargue mpm_prefork al iniciar.
RUN rm -f /etc/apache2/mods-enabled/mpm_event.load \
    && rm -f /etc/apache2/mods-enabled/mpm_event.conf \
    && a2enmod mpm_prefork

# 4. Habilitar Rewrite para Laravel
RUN a2enmod rewrite

# 5. Instalar Composer desde la imagen oficial
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 6. Configuración del Proyecto
WORKDIR /var/www/html
COPY . .

# 7. Cambiar el DocumentRoot de Apache a la carpeta /public de Laravel
RUN sed -i 's|/var/www/html|/var/www/html/public|g' \
    /etc/apache2/sites-available/000-default.conf

# 8. Dependencias de Laravel (Optimizado)
RUN composer install --no-dev --optimize-autoloader --no-interaction

# 9. Permisos (Crucial para Laravel)
# Se asigna el dueño a www-data y se dan permisos de escritura a storage y cache
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

EXPOSE 80

# 10. Comando de inicio oficial
CMD ["apache2-foreground"]
