FROM php:8.1-apache
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN a2enmod rewrite
COPY composer.json /var/www/html/
WORKDIR /var/www/html
RUN composer install --no-dev --prefer-dist
COPY . /var/www/html/
EXPOSE 80
CMD ["apache2-foreground"]
