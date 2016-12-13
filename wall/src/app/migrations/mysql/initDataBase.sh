mysql -uroot -e 'create database walldb'
mysql -uroot -e "CREATE USER 'walldbuser'@'localhost' IDENTIFIED BY 'walldbpass'"
mysql -uroot -e "GRANT ALL PRIVILEGES ON walldb.* TO 'walldbuser'@'localhost' WITH GRANT OPTION;"
mysql -uwalldbuser -pwalldbpass -Dwalldb
