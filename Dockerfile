# Allways use specific FROM tag, DON'T use 'latest'
FROM wordpress:5.2.2-php7.2-apache

RUN apt-get update -y && apt install -yq vim iputils-ping
RUN apt-get clean
COPY . /var/www/html

## WP Plug-in AND Theme

#CREATE USER 'root'@'%' IDENTIFIED BY 'rootpassword';
#GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' IDENTIFIED BY 'rootpassword' WITH GRANT OPTION MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;
#FLUSH PRIVILEGES;
#GRANT ALL PRIVILEGES ON wp_test.* TO "wpuser"@"%" IDENTIFIED BY "wppassword";
#sudo vim /etc/mysql/mysql.conf.d/mysqld.cnf
#bind-address = 0.0.0.0

## If your repository contains plug-ins and themes, but lacks the WP Engine, you must use the Dockerfile to upload them to the proper location.

## For instance, let’s assume that your repository contains 4 directories: mytheme1, mytheme2, myplugin1 and myplugin2. In this case, you have to add the Dockerfile along all these directories with the following content

#COPY mytheme1 /var/www/html/wp-content/themes/mytheme1/
#COPY mytheme2 /var/www/html/wp-content/themes/mytheme2/
#COPY myplugin1 /var/www/html/wp-content/plugins/myplugin1/
#COPY myplugin2 /var/www/html/wp-content/plugins/myplugin2/*




