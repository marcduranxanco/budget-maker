FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    git \
    nodejs \
    npm \
    && pecl install xdebug-3.1.6 \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-enable xdebug

COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN echo "zend_extension=xdebug.so" > /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_port=9003" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini


# RUN composer install

WORKDIR /app