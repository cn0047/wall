#!/usr/bin/env bash

# ubuntu
sudo apt-get update

# php 7
sudo add-apt-repository -y ppa:ondrej/php
sudo apt-get update
sudo apt-get install -y php7.0 php7.0-fpm php7.0-cli php7.0-pdo php7.0-mysql

# phalcon
sudo curl -s https://packagecloud.io/install/repositories/phalcon/stable/script.deb.sh | sudo bash
sudo apt-get install php7.0-phalcon

# composer
sudo curl -sS https://getcomposer.org/installer | sudo php
sudo mv composer.phar /usr/local/bin/composer

# mysql
sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password password m_root_pass'
sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password m_root_pass'
sudo apt-get -y install mysql-server
# init db
mysql -uroot -pm_root_pass -e 'create database walldb'
mysql -uroot -pm_root_pass -e "create user 'walldbuser'@'localhost' identified by 'wallDBpass_11'"
mysql -uroot -pm_root_pass -e "grant all privileges on walldb.* to 'walldbuser'@'localhost' with grant option"
mysql -uroot -pm_root_pass walldb < /var/www/html/wall/src/app/migrations/mysql/init.sql

# apache
sudo service apache2 stop

# nginx
sudo apt-get install -y nginx
sudo cp /vagrant/vagrant/nginx.conf /etc/nginx/sites-available/default
sudo service nginx restart

# init composer
cd /var/www/html/wall/ && composer install

# init csv db
sudo touch /var/www/html/wall/src/app/var/csv/db.csv.lastId
sudo chmod 777 /var/www/html/wall/src/app/var/csv/db.csv.lastId
sudo touch /var/www/html/wall/src/app/var/csv/db.csv
sudo chmod 777 /var/www/html/wall/src/app/var/csv/db.csv

# init phalcon cache
sudo chmod 777 -R /var/www/html/wall/src/app/implementation/phalcon/cache

# init mysql config
sudo cp /var/www/html/wall/src/app/config/mysql.php.template /var/www/html/wall/src/app/config/mysql.php
sudo sed -i "s/'password' => ''/'password' => 'wallDBpass_11'/" /var/www/html/wall/src/app/config/mysql.php

# smoke test
php /var/www/html/wall/src/app/implementation/plainphp/cli.php message create 'It works!'
