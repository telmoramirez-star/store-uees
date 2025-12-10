# Usa una imagen base de PHP optimizada para la web (ej. fpm)
FROM php:8.2-fpm-alpine

# Instala dependencias del sistema necesarias para PHP y Laravel
RUN apk update && apk add \
    git \
    curl \
    libzip-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    supervisor \
    bash \
    mysql-client \
    # Dependencias de PHP
    && docker-php-ext-install pdo_mysql zip \
    && docker-php-ext-configure gd --with-jpeg \
    && docker-php-ext-install gd

# Instala Composer
ENV COMPOSER_ALLOW_SUPERUSER 1
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Establece el directorio de trabajo
WORKDIR /var/www/html

# Copia los archivos del proyecto (excluye .env, vendor y node_modules vía .dockerignore)
COPY . .

# Instala dependencias de PHP (Laravel)
RUN composer install --no-dev --optimize-autoloader

# Configura permisos para Laravel
RUN chown -R www-data:www-data /var/www/html/storage \
    && chown -R www-data:www-data /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# Copia la configuración de supervisor (si es necesaria para colas, ej. Laravel Horizon)
# COPY supervisord.conf /etc/supervisord.conf

# Expone el puerto por defecto de PHP-FPM
EXPOSE 9000

# Comando para ejecutar el servidor PHP-FPM
CMD ["php-fpm"]

# NOTA: Necesitarás un contenedor NGINX separado que se comunicará con este FPM a través del puerto 9000.