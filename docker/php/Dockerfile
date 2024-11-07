FROM php:8.2.0-cli

ENV TZ Asia/Tokyo

RUN apt-get update

RUN apt-get install -y \
            autoconf \
            cmake \
            curl \
            g++ \
            git \
            htop \
            libbz2-dev \
            libc-ares2 \
            libc-client-dev \
            libcurl4-gnutls-dev \
            libcurl4-openssl-dev \
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
            libprotobuf-dev \
            libpspell-dev \
            libsnmp-dev \
            libssl-dev \
            libtidy-dev \
            libxml2-dev \
            libxrender1 \
            libxslt-dev \
            libzip-dev \
            openssl \
            pkg-config \
            procps \
            protobuf-compiler \
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

# redis
RUN pecl install redis \
  && docker-php-ext-enable redis

# apcu
RUN pecl install apcu \
  && docker-php-ext-enable apcu

# xdebug
RUN pecl install xdebug

# # c-ares
# WORKDIR /tmp
# RUN wget https://github.com/c-ares/c-ares/releases/download/v1.34.2/c-ares-1.34.2.tar.gz
# RUN mkdir -p c-ares && tar -zxvf c-ares-1.34.2.tar.gz -C c-ares --strip-components=1
# WORKDIR c-ares
# RUN ./configure && make && make install
# WORKDIR /root

# gRPCインストール
# ref: https://github.com/grpc/grpc/tree/master/src/php#grpc_php_plugin-protoc-plugin
RUN MAKEFLAGS="-j 4" pecl install grpc
WORKDIR /root
RUN git clone https://github.com/grpc/grpc
WORKDIR grpc
RUN git submodule update --init
RUN mkdir -p cmake/build
WORKDIR cmake/build
RUN cmake ../..
RUN make protoc grpc_php_plugin
WORKDIR /root

COPY ./php.ini /usr/local/etc/php/
COPY ./xdebug.ini /usr/local/etc/php/
COPY ./php-fpm.conf /usr/local/etc/php-fpm.d/www.conf

RUN pecl clear-cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2.4 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/laravel

COPY ./entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/entrypoint.sh
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
