FROM php:8.2-apache

# Instalar extensión mysqli
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Copiar archivos del proyecto al servidor Apache
COPY src/ /var/www/html/

EXPOSE 80