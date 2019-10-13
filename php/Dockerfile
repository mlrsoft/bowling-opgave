
FROM php:7.2.23-fpm-alpine3.10
LABEL maintainer="michalelundrasmussen@gmail.com"

# Install composer
RUN curl -sS https://getcomposer.org/installer | php \
        && mv composer.phar /usr/local/bin/ \
        && ln -s /usr/local/bin/composer.phar /usr/local/bin/composer


USER www-data:www-data

# Install dependencies
COPY composer.* ./

RUN composer install --no-scripts --no-autoloader

COPY ./app ./app
COPY ./tests ./tests
COPY phpunit.xml .
RUN composer dump-autoload

