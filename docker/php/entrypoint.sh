#!/bin/bash
set -e

if [ ! -f "vendor/autoload.php" ]; then
    composer install --no-progress --no-interaction
fi

if [ ! -f ".env" ]; then
    echo "Creating env file for env $APP_ENV"
    cp .env.example .env
else
    echo "env file exists."
fi

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

php artisan octane:start --server=roadrunner --host=0.0.0.0 --rpc-port=6001 --port=80 --workers=${OCTANE_WORKERS} --max-requests=${OCTANE_MAX_REQUESTS}
