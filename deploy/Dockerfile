# Usa una imagen base de PHP-FPM
FROM php:8.3-fpm-alpine

# Define el directorio de trabajo donde estará el código
WORKDIR /var/www/html

# Instala dependencias necesarias (sin NGINX ni Supervisor)
RUN apk update && apk add --no-cache \
    git \
    curl \
    libzip-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    bash \
    mysql-client \
    # Dependencias de PHP
    && docker-php-ext-install pdo_mysql zip \
    && docker-php-ext-configure gd --with-jpeg \
    && docker-php-ext-install gd \
    && rm -rf /var/cache/apk/*

# Instala Composer
ENV COMPOSER_ALLOW_SUPERUSER 1
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copia los archivos del proyecto
COPY .. .

# Instala dependencias de PHP (Laravel)
RUN composer install --no-dev --optimize-autoloader

# Configura permisos para Laravel
RUN chown -R www-data:www-data /var/www/html/storage \
    && chown -R www-data:www-data /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# Comando de ejecución: Iniciar PHP-FPM
CMD ["php-fpm"]