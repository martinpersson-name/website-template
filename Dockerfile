FROM php:7.4-apache
RUN docker-php-ext-install mysqli
RUN mkdir -p /customers/6/6/d/example.com/httpd.www /customers/6/6/d/example.com/httpd.private
COPY httpd.www /customers/6/6/d/example.com/httpd.www
COPY httpd.private /customers/6/6/d/example.com/httpd.private
COPY php.ini /usr/local/etc/php/
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
RUN a2enmod rewrite
RUN echo "DocumentRoot /customers/6/6/d/example.com/httpd.www" > /etc/apache2/sites-available/000-default.conf
RUN echo "<Directory /customers/6/6/d/example.com/httpd.www>\nOptions Indexes FollowSymLinks\nAllowOverride All\nRequire all granted\n</Directory>" >> /etc/apache2/sites-available/000-default.conf
EXPOSE 80