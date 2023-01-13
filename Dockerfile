FROM php:8.1
COPY . /usr/src/app
WORKDIR /usr/src/app
RUN ["php","./composer.phar","install"]
CMD [ "php", "./app.php" ]