FROM php:8.0-apache
#Install git
RUN apt-get update \
    && apt-get install -y git
RUN docker-php-ext-install pdo pdo_mysql mysqli
RUN a2enmod rewrite
#Install Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php --install-dir=. --filename=composer
RUN mv composer /usr/local/bin/
RUN echo "ServerName BarDown" >> /etc/apache2/apache2.conf
RUN echo "<Directory '/var/www/html/BarDown'>\n \
    Options Indexes FollowSymLinks Includes ExecCGI\n \
    AllowOverride All\n \
    Require all granted\n \
</Directory>" >> /etc/apache2/apache2.conf
COPY ./src/ /var/www/html/BarDown/
RUN mv /var/www/html/BarDown/dockerEnv.php /var/www/html/BarDown/env.php
EXPOSE 80