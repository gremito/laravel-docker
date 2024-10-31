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

/root/grpc/cmake/build/third_party/protobuf/protoc -I=. grpc/hello.proto \
                                                    --php_out=app/Grpc \
                                                    --grpc_out=app/Grpc \
                                                    --plugin=protoc-gen-grpc=/root/grpc/cmake/build/grpc_php_plugin

# ref: https://openswoole.com/docs/grpc/grpc-compiler#install-openswoole-grpc-code-generator-plugin
/root/grpc/cmake/build/third_party/protobuf/protoc --php_out=grpc \
                                                    --openswoole-grpc_out=grpc \
                                                    --plugin=protoc-gen-grpc=protoc-gen-openswoole-grpc \
                                                    grpc/proto/hello.proto
```
