#!/bin/sh

set -e

composer_install() {
  echo "===== composer install ====="
  composer install --no-progress --no-interaction
}
composer_update() {
  echo "===== composer update ====="
  composer update --no-dev --optimize-autoloader
}
reset_checksum() {
  echo "===== md5sum composer.json composer.lock > composer-checksum ====="
  md5sum composer.json composer.lock > composer-checksum
}
artisan_migration() {
  echo "===== php artisan migrate ====="
  php artisan migrate
}
artisan_seed() {
  echo "===== php artisan db:seed ====="
  php artisan db:seed
}

if [ ! -f ".env" ]; then
    echo "===== cp .env.example .env ====="
    cp .env.example .env
else
    echo "env file exists."
fi

# sed -i "s/^OCTANE_SERVER=.*/OCTANE_SERVER=roadrunner/" .env
# octane_server_type=$(grep '^OCTANE_SERVER=' .env | cut -d '=' -f2-)
# echo "octane_server_type: ${octane_server_type}"

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

if [ ! -f composer-checksum ]; then
  # 初回セットアップ
  composer_install
  echo "===== rr get-binary ====="
  yes | ./vendor/bin/rr get-binary
  sudo chmod +x root:root ./rr
  artisan_migration
  artisan_seed
  reset_checksum
else
  # composer.json と composer.lock のハッシュ値を比較
  current_json_hash=$(md5sum composer.json | cut -d ' ' -f1)
  current_lock_hash=$(md5sum composer.lock | cut -d ' ' -f1)
  prev_json_hash=$(grep 'composer.json' composer-checksum | cut -d ' ' -f1)
  prev_lock_hash=$(grep 'composer.lock' composer-checksum | cut -d ' ' -f1)
  json_changed=$([ "$current_json_hash" != "$prev_json_hash" ] && echo true || echo false)
  lock_changed=$([ "$current_lock_hash" != "$prev_lock_hash" ] && echo true || echo false)
  if [ "$json_changed" = true ] && [ "$lock_changed" = true ]; then
    # composer.jsonまたはcomposer.lockが変更されている場合は再セットアップ
    composer_install
    reset_checksum
  elif [ "$json_changed" = true ]; then
    # composer.jsonのみ変更がある場合はcomposer update
    composer_update
    reset_checksum
  elif [ "$lock_changed" = true ]; then
    # composer.lockのみ変更がある場合は例外
    echo "Error: composer.lockの変更のみでcomposer.jsonの変更がありません。"
    exit 1
  fi
  artisan_migration
fi

exec "$@"
