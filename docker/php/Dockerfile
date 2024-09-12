FROM php:8.1.29-apache

ARG NEW_RELIC_LICENSE_KEY
ARG NEW_RELIC_APP_NAME

ENV TZ Asia/Tokyo

RUN apt update

RUN apt install -y \
            g++ \
            git \
            libbz2-dev \
            libc-client-dev \
            libenchant-2-dev \
            libffi-dev \
            libfontconfig1 \
            libfreetype6-dev \
            libgmp3-dev \
            libicu-dev \
            libjpeg62-turbo-dev \
            libkrb5-dev \
            libldap2-dev \
            libmcrypt-dev \
            libonig-dev \
            libpng-dev \
            libpspell-dev \
            libsnmp-dev \
            libtidy-dev \
            libxml2-dev \
            libxrender1 \
            libxslt-dev \
            libzip-dev \
            unzip \
            vim \
            wget \
            zip \
            zlib1g-dev

RUN docker-php-ext-configure imap --with-kerberos --with-imap-ssl

RUN wget https://ftp.gnu.org/gnu/sed/sed-4.8.tar.xz \
            && tar -Jxvf sed-4.8.tar.xz \
            && cd sed-4.8 \
            && ./configure \
            && make \
            && make install \
            && cd ../

RUN docker-php-ext-install \
            bcmath \
            bz2 \
            calendar \
            dba \
            enchant \
            exif \
            ffi \
            gd \
            gettext \
            gmp \
            imap \
            intl \
            ldap \
            mbstring \
            mysqli \
            opcache \
            pcntl \
            pdo \
            pdo_mysql \
            pspell \
            shmop \
            snmp \
            soap \
            sockets \
            sysvmsg \
            sysvsem \
            sysvshm \
            tidy \
            xsl \
            zip

RUN pecl install xdebug

COPY ./php.ini /usr/local/etc/php/

RUN echo "newrelic.enabled=true" >> /usr/local/etc/php/conf.d/newrelic.ini \
    && echo "newrelic.license=${NEW_RELIC_LICENSE_KEY}" >> /usr/local/etc/php/conf.d/newrelic.ini \
    && echo "newrelic.appname=${NEW_RELIC_APP_NAME}" >> /usr/local/etc/php/conf.d/newrelic.ini \
    && echo "newrelic.daemon.address=newrelic:31339" >> /usr/local/etc/php/conf.d/newrelic.ini \
    && echo "newrelic.daemon.port=31339" >> /usr/local/etc/php/conf.d/newrelic.ini

WORKDIR /var/www/laravel

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
