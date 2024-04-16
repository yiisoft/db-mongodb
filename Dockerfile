# Important! Do not use this image in production!

ARG PHP_VERSION
FROM --platform=linux/amd64 php:${PHP_VERSION}-cli-alpine

RUN apk --no-cache add unzip zlib-dev libzip-dev autoconf g++ make

RUN docker-php-ext-install zip opcache
RUN pecl install pcov-1.0.11 mongodb
RUN docker-php-ext-enable pcov mongodb

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER 1

WORKDIR /code

CMD ["sleep", "infinity"]
