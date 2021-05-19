FROM composer:2 AS builder

WORKDIR /app

# Copy only the files needed to download dependencies to avoid redownloading them when our code changes.
# This will download development/testing dependencies.
COPY composer.json composer.lock /app/
RUN composer install  \
    --ignore-platform-reqs \
    --no-ansi \
    --no-autoloader \
    --no-interaction \
    --no-scripts

# We need to copy our whole application so that we can generate the autoload file inside the vendor folder.
COPY . /app
RUN composer dump-autoload --optimize --classmap-authoritative


FROM php:7.4-apache

RUN apt-get update && apt-get install -y \
    locales \
    locales-all \
    && apt-get clean

RUN apt-get update && apt-get install -y libcurl4-openssl-dev pkg-config libssl-dev && \
    pecl install mongodb && \
    docker-php-ext-enable mongodb

EXPOSE 80

# Copy our application
COPY web/ /var/www/html/
COPY *.php /var/www/
# Copy the downloaded dependencies from the builder stage.
COPY --from=builder /app/vendor/ /var/www/vendor/
