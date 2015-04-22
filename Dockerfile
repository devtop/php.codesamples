FROM php:5.6-apache
#COPY ./setup/apache2/php.codesamples.conf /etc/apache2/sites-enabled
RUN /usr/sbin/a2enmod rewrite
