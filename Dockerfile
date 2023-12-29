FROM php:8-apache
RUN docker-php-ext-install mysqli
RUN a2enmod rewrite
COPY . /var/www/html
EXPOSE 80
ENTRYPOINT ["sh", "-c", "chmod 777 /var/www/html/uploads && apache2-foreground"]
