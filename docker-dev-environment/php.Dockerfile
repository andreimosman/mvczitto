FROM php:fpm

WORKDIR /mvczitto/app

RUN apt-get update

RUN apt-get install -y \
        zlib1g-dev \
        libpng-dev \
        libicu-dev \
        libxml2-dev \
        libzip-dev 


RUN docker-php-ext-install gd
RUN docker-php-ext-install gettext
RUN docker-php-ext-install intl
RUN docker-php-ext-install mysqli
RUN docker-php-ext-install pdo
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install posix
RUN docker-php-ext-install xml
RUN docker-php-ext-install zip
RUN docker-php-ext-install sockets

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
