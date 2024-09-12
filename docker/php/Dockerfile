FROM php:8.2.0-fpm

ARG NEW_RELIC_LICENSE_KEY
ARG NEW_RELIC_APP_NAME
ARG NEW_RELIC_AGENT_VERSION

ENV TZ Asia/Tokyo

RUN apt update

RUN apt install -y \
            g++ \
            git \
            htop \
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
            libssl-dev \
            libtidy-dev \
            libxml2-dev \
            libxrender1 \
            libxslt-dev \
            libzip-dev \
            openssl \
            procps \
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

RUN pecl install xdebug openswoole protobuf

COPY ./php.ini /usr/local/etc/php/

RUN curl -L https://download.newrelic.com/php_agent/archive/${NEW_RELIC_AGENT_VERSION}/newrelic-php5-${NEW_RELIC_AGENT_VERSION}-linux.tar.gz | tar -C /tmp -zx \
    && export NR_INSTALL_USE_CP_NOT_LN=1 \
    && export NR_INSTALL_SILENT=1 \
    && /tmp/newrelic-php5-${NEW_RELIC_AGENT_VERSION}-linux/newrelic-install install \
    && rm -rf /tmp/newrelic-php5-* /tmp/nrinstall*

RUN sed -i \
  -e "s/newrelic.license[[:space:]]*=[[:space:]]*.*/newrelic.license = ${NEW_RELIC_LICENSE_KEY}/" \
  -e "s/newrelic.appname[[:space:]]*=[[:space:]]*.*/newrelic.appname = ${NEW_RELIC_APP_NAME}/" \
  -e "\$a newrelic.daemon.address=newrelic:31339" \
  /usr/local/etc/php/conf.d/newrelic.ini

COPY --from=composer:2.4 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/laravel

EXPOSE 9000

COPY ./entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/entrypoint.sh
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
