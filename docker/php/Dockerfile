FROM php:8.1.29-apache

RUN apt update

RUN apt install -y \
            g++ \
            libicu-dev \
            libpq-dev \
            libzip-dev \
            wget \
            zip \
            zlib1g-dev

RUN wget https://ftp.gnu.org/gnu/sed/sed-4.8.tar.xz \
            && tar -Jxvf sed-4.8.tar.xz \
            && cd sed-4.8 \
            && ./configure \
            && make \
            && make install \
            && cd ../

RUN docker-php-ext-install \
            intl \
            opcache \
            pdo \
            pdo_mysql \
            mysqli

RUN pecl install xdebug

COPY ./php.ini /usr/local/etc/php/

WORKDIR /var/www/laravel

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
