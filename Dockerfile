FROM php:8.0.0-fpm-alpine


RUN apk add --no-cache nginx wget

RUN mkdir -p /run/nginx

COPY docker/nginx.conf /etc/nginx/nginx.conf

RUN mkdir -p /app
COPY . /app

RUN sh -c "wget http://getcomposer.org/composer.phar && chmod a+x composer.phar && mv composer.phar /usr/local/bin/composer"
RUN apk add --no-cache zip libzip-dev
RUN docker-php-ext-configure zip
RUN docker-php-ext-install zip
RUN docker-php-ext-install pdo_mysql pdo

RUN cd /app && \
    /usr/local/bin/composer install --ignore-platform-reqs

# RUN composer dump-autoload --optimize

RUN chown -R www-data: /app

CMD sh /app/docker/startup.sh
