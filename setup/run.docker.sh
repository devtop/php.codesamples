#!/bin/bash
docker run -p 81:80 -it -d --name my-apache-php-app \
 -v "$PWD/src:/var/www/src:ro" \
 -v "$PWD/public:/var/www/html:ro" \
 -v "$PWD/view:/var/www/view:ro" \
  -v "$PWD/application:/var/www/application:ro" \
php:5.6-apache