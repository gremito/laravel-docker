FROM php:8.0-apache

RUN apt update

RUN apt install -y \
            g++ \
            libicu-dev \
            libpq-dev \
            libzip-dev \
            zip \
            zlib1g-dev

RUN docker-php-ext-install \
            intl \
            opcache \
            pdo \
            pdo_mysql \
            mysqli

WORKDIR /var/www/laravel

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
