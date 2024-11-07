```
# ref: https://www.twilio.com/ja/blog/get-started-docker-laravel-jp

cp web/.env.example web/.env

docker exec -it php-apache /bin/bash -c 'composer install'
docker exec -it php-apache /bin/bash -c 'php artisan key:generate'
docker exec -it php-apache /bin/bash -c 'php artisan migrate'
docker exec -it php-apache /bin/bash -c 'php artisan db:seed'
docker exec -it php-apache /bin/bash -c 'php artisan test'

# Protobuf
# ref: https://github.com/grpc/grpc/tree/master/src/php
# ref: https://openswoole.com/docs/grpc/grpc-compiler#install-openswoole-grpc-code-generator-plugin
cd grpc/proto
/root/grpc/cmake/build/third_party/protobuf/protoc --php_out=../ \
                                                    --openswoole-grpc_out=../ \
                                                    --plugin=protoc-gen-grpc=protoc-gen-openswoole-grpc \
                                                    hello.proto
```
