#!/usr/bin/env bash

# ubuntu
sudo apt-get update

# php 7
sudo add-apt-repository -y ppa:ondrej/php
sudo apt-get update
sudo apt-get install -y php7.0 php7.0-fpm php7.0-cli

# composer
sudo curl -sS https://getcomposer.org/installer | sudo php
sudo mv composer.phar /usr/local/bin/composer

# apache
sudo service apache2 stop

# nginx
sudo apt-get install -y nginx
sudo cp /vagrant/vagrant/nginx.conf /etc/nginx/sites-available/default
sudo service nginx restart

cd /var/www/html/wall/ && composer install

sudo touch /var/www/html/wall/src/app/var/csv/db.csv.lastId
sudo chmod 777 /var/www/html/wall/src/app/var/csv/db.csv.lastId
sudo touch /var/www/html/wall/src/app/var/csv/db.csv
sudo chmod 777 /var/www/html/wall/src/app/var/csv/db.csv
