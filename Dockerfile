FROM php:fpm
# RUN docker-php-ext-install
# WORKDIR /src/public
# COPY . .
# CMD ["php", "src/public/index.php"]

RUN docker-php-ext-install pdo pdo_mysql

RUN pecl install xdebug && docker-php-ext-enable xdebug

