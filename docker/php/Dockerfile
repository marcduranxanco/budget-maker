FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    git \
    nodejs \
    npm \
    && docker-php-ext-install pdo_mysql

COPY --from=composer /usr/bin/composer /usr/bin/composer

# RUN composer install

WORKDIR /app