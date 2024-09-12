#!/bin/bash

# エラー発生時にスクリプトを停止する
set -e

# Octaneがインストール済みか確認
if ! composer show | grep -q "laravel/octane"; then
  echo "Octane is not installed. Running composer install..."
  composer install --optimize-autoloader --no-dev
else
  echo "Octane is already installed. Skipping composer install."
fi

# Octane サーバーを起動
echo "Starting Octane server with server=swoole, host=0.0.0.0, port=9000..."
php artisan octane:start --server=swoole --host=0.0.0.0 --port=9000
