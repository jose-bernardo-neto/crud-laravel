FROM php:8.2-apache

WORKDIR /var/www/html

# Instala dependências do Laravel (PHP, Composer, etc.)
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql zip

# Copia o projeto e instala dependências
COPY . .
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader

# Configura Apache
RUN chmod -R 777 storage bootstrap/cache
RUN a2enmod rewrite
COPY .docker/apache.conf /etc/apache2/sites-available/000-default.conf

# Gera caches de produção
RUN php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache

EXPOSE 80
CMD ["apache2-foreground"]
