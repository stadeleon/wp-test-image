# Allways use specific FROM tag, DON'T use 'latest'
FROM wordpress:5.2.2-php7.2-apache

# COPY . /var/www/html

## WP Plug-in AND Theme

## If your repository contains plug-ins and themes, but lacks the WP Engine, you must use the Dockerfile to upload them to the proper location.

## For instance, let’s assume that your repository contains 4 directories: mytheme1, mytheme2, myplugin1 and myplugin2. In this case, you have to add the Dockerfile along all these directories with the following content

#COPY mytheme1 /var/www/html/wp-content/themes/mytheme1/
#COPY mytheme2 /var/www/html/wp-content/themes/mytheme2/
#COPY myplugin1 /var/www/html/wp-content/plugins/myplugin1/
#COPY myplugin2 /var/www/html/wp-content/plugins/myplugin2/*




