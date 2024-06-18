```
# ref: https://www.twilio.com/ja/blog/get-started-docker-laravel-jp

cp web/.env.example web/.env

docker exec -it php-apache /bin/bash -c 'composer install'
docker exec -it php-apache /bin/bash -c 'php artisan key:generate'
docker exec -it php-apache /bin/bash -c 'php artisan migrate'
docker exec -it php-apache /bin/bash -c 'php artisan db:seed'
docker exec -it php-apache /bin/bash -c 'php artisan test'
```
