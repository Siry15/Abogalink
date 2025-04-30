FROM php:8.1-apache

# Instala extensiones necesarias
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copia el código fuente
COPY . /var/www/html/

# Habilita módulo de reescritura en Apache
RUN a2enmod rewrite

# Configura permisos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html