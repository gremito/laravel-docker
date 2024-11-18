```
# ref: https://www.twilio.com/ja/blog/get-started-docker-laravel-jp

cp web/.env.example web/.env

docker exec -it php-apache /bin/bash -c 'composer install'
docker exec -it php-apache /bin/bash -c 'php artisan key:generate'
docker exec -it php-apache /bin/bash -c 'php artisan migrate'
docker exec -it php-apache /bin/bash -c 'php artisan db:seed'
docker exec -it php-apache /bin/bash -c 'php artisan test'

# Protobuf
cd grpc/
# ref: https://github.com/grpc/grpc/tree/master/src/php
protoc -I=proto/ --php_out=./ --grpc_out=./ --plugin=protoc-gen-grpc=/root/grpc/cmake/build/grpc_php_plugin proto/hello.proto
# ref: https://openswoole.com/docs/grpc/grpc-compiler#install-openswoole-grpc-code-generator-plugin
protoc --proto_path=proto/  --proto_path=proto/ \
                            --php_out=./ \
                            --openswoole-grpc_out=./ \
                            --plugin=protoc-gen-grpc=protoc-gen-openswoole-grpc \
                            proto/hello.proto
```
