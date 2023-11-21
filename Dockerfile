FROM php:8.1-fpm

WORKDIR /var/www/html/api_fanwitch

RUN apt-get update \
    && apt-get install -y \
        libzip-dev \
        zip \
        unzip \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip pdo pdo_mysql

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
