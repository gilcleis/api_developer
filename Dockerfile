FROM wyveo/nginx-php-fpm:php74

WORKDIR /usr/share/nginx/
RUN rm -rf html
COPY . /usr/share/nginx
RUN chmod -R 777 /usr/share/nginx/storage/*
RUN ln -s public html
RUN cp .env.example .env
run apt update
run apt install curl -y
run curl -sL https://deb.nodesource.com/setup_15.x -o nodesource_setup.sh

run bash nodesource_setup.sh
run apt-get install yarn -y
run apt install nodejs -y
run npm install
run npm run dev
run composer install
run php artisan key:generate

