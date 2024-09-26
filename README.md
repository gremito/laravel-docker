## Setup

```
# ref: https://www.twilio.com/ja/blog/get-started-docker-laravel-jp

cp web/.env.example web/.env

docker exec -it php-apache /bin/bash -c 'composer install'
docker exec -it php-apache /bin/bash -c 'php artisan key:generate'
docker exec -it php-apache /bin/bash -c 'php artisan migrate'
docker exec -it php-apache /bin/bash -c 'php artisan db:seed'
docker exec -it php-apache /bin/bash -c 'php artisan test'
```

### opentelemetry-php/context-swoole

```
# ref: https://github.com/opentelemetry-php/context-swoole

docker run -d --name jaeger \
  -p 16686:16686 \
  -p 4318:4318 \
  -p 4317:4317 \
  jaegertracing/all-in-one

curl -i 127.0.0.1:9501/swoole-context-demo

# http://127.0.0.1:16686/
```
