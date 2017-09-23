FROM php:7.1-fpm-alpine

ENV NODE_VERSION 7.5.0
ARG TZ='Asia/Tokyo'

WORKDIR /var/www
RUN apk update && \
    docker-php-ext-install pdo pdo_mysql

# timezone settings
RUN apk --update add tzdata && \
    cp /usr/share/zoneinfo/${TZ} /etc/localtime && \
    apk del tzdata && \
    echo $TZ >  /etc/timezone && \
    echo "[Date]" >> /usr/local/etc/php/conf.d/date.ini && \
    echo "date.timezone = $TZ" >> /usr/local/etc/php/conf.d/date.ini
