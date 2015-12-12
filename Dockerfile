FROM php:7-apache
COPY . /var/www
RUN a2enmod rewrite && sed -i 's_DocumentRoot /var/www/html_DocumentRoot /var/www/public/_' /etc/apache2/apache2.conf
WORKDIR /var/www/public
