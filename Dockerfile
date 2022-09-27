FROM git-devel.torche.id:5050/root/php-8.1

COPY . /var/www/html/
COPY ./php.ini $PHP_INI_DIR/php.ini
COPY vhost.conf /etc/apache2/sites-available/000-default.conf