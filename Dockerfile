FROM php:8.0.9-alpine3.14
LABEL maintainer="dersonsena@gmail.com"

EXPOSE 80

ENV XDEBUG_MODE=develop,debug,coverage
ENV TERM="xterm"
ENV LANG="C.UTF-8"
ENV LC_ALL="C.UTF-8"

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN apk update && apk add --no-cache --update \
    $PHPIZE_DEPS \
    nano \
    libzip-dev \
    g++ \
    gcc \
    curl \
    curl-dev \
    libxml2 \
    libxml2-dev \
    zip \
    unzip \
    moreutils \
    icu-dev \
    oniguruma-dev \
    tzdata \
    file \
    shadow \
    autoconf \
    make \
    libtool \
    pcre-dev \
    libmcrypt-dev \
    sqlite-dev \
    freetds-dev \
    openldap-dev

RUN docker-php-ext-install pdo \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install mysqli \
    && docker-php-ext-install intl \
    && docker-php-ext-install mbstring \
    && docker-php-ext-install zip \
    && docker-php-ext-install curl \
    && docker-php-ext-install pdo_dblib \
    && php -m

# Installing Mcrypt extension
RUN pecl install -o -f mcrypt && docker-php-ext-enable mcrypt

# Installing Mongodb extension
RUN mkdir -p /usr/src/php/ext/mongodb \
    && curl -fsSL https://pecl.php.net/get/mongodb | tar xvz -C "/usr/src/php/ext/mongodb" --strip 1 \
    && docker-php-ext-install mongodb

# Installing XDebug
RUN pecl install -o -f xdebug && docker-php-ext-enable xdebug

# XDebug configuration changes
RUN echo "xdebug.mode=$XDEBUG_MODE" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.cli_color=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.start_with_request = yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.xdebug.discover_client_host = false" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.client_host = host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.client_port = 9000" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.idekey = PHPSTORM" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.max_nesting_level = 1500" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.log=/tmp/xdebug.log" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

RUN apk del $PHPIZE_DEPS && rm -rf /var/cache/apk/*

WORKDIR /usr/src/app