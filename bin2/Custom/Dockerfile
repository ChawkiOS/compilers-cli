#runs on our generated code image:
FROM irestful/generated-code:16.12.20
MAINTAINER Steve Rodrigue <steve@irestful.net>

#set the source code version:
ENV COMPOSER_HASH 55d6ead61b29c7bdee5cccfb50076874187bd9f21f65d8991d46ec5cc90518f447387fb9f76ebae1fbbacf329e583e30

#create the /code folder:
RUN set -xe \
    && mkdir /code \
    && chown -R www-data:www-data /code

#move the source code to /code:
ADD . /code

#add the php ini file:
ADD conf/php/additional_php.ini /usr/local/etc/php/conf.d/additional_php.ini

#set the workdir to /code:
WORKDIR /code

#set permissions on folders:
RUN set -xe \
    && mkdir /var/www/.composer \
    && chmod -R 777 /var/www/.composer \
    && mkdir /code/vendor \
    && chmod -R 777 /code/vendor

#download composer:
RUN set -xe \
    && php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php -r "if (hash_file('SHA384', 'composer-setup.php') === '${COMPOSER_HASH}') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
    && php composer-setup.php \
    && php -r "unlink('composer-setup.php');"

#set the user to non-root (for composer):
USER www-data

#set the workdir to /code:
WORKDIR /code

#install the app:
RUN set -xe \
    && php composer.phar install --prefer-source

#set the user to root:
USER root

#cleanup:
RUN set -xe \
    && rm -R -f /tmp/code
