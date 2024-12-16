FROM php:8.1-apache
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
COPY . /var/www/html/
EXPOSE 80
RUN a2enmod rewrite
CMD ["apache2-foreground"]
