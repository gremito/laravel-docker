#!/bin/bash
set -e

if [ ! -f "vendor/autoload.php" ]; then
    echo "===== composer install --no-progress --no-interaction ====="
    composer install --no-progress --no-interaction
fi
if [ ! -d "./vendor" ]; then
    echo "Error: vendor not found."
    exit 1
fi

if [ ! -f ".env" ]; then
    echo "===== cp .env.example .env ====="
    cp .env.example .env
else
    echo "env file exists."
fi

sed -i "s/^OCTANE_SERVER=.*/OCTANE_SERVER=roadrunner/" .env
octane_server_type=$(grep '^OCTANE_SERVER=' .env | cut -d '=' -f2-)
echo "octane_server_type: ${octane_server_type}"

APP_KEY=$(grep '^APP_KEY=' .env | cut -d '=' -f2-)
if [ -z "$APP_KEY" ]; then
  echo "APP_KEY is not set. Generating new key..."
  php artisan key:generate

  if [ $? -eq 0 ]; then
    echo "APP_KEY generated successfully."
  else
    echo "Error: Failed to generate APP_KEY."
    exit 1
  fi
fi

if [ ! -f "rr" ]; then
    echo "===== remove rr ====="
    rm -fr ./rr
fi

echo "===== vendor/bin/rr get-binary ====="
yes | ./vendor/bin/rr get-binary

echo "===== php artisan migrate ====="
php artisan migrate

echo "===== php artisan db:seed ====="
php artisan db:seed

echo "===== php artisan octane:start --server=roadrunner --host=0.0.0.0 --rpc-port=6001 --port=80 --workers=${OCTANE_WORKERS} --max-requests=${OCTANE_MAX_REQUESTS} ====="
php artisan octane:start --server=roadrunner --host=0.0.0.0 --rpc-port=6001 --port=80 --workers=${OCTANE_WORKERS} --max-requests=${OCTANE_MAX_REQUESTS}
