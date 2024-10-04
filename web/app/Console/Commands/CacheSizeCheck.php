<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class CacheSizeCheck extends Command
{
    protected $signature = 'cache:size-check';
    protected $description = 'Display cache item sizes';

    public function handle()
    {
        $cacheStore = Cache::getStore();

        if (method_exists($cacheStore, 'getRedis')) {
            $redis = $cacheStore->getRedis();
            $keys = $redis->keys('*');

            foreach ($keys as $key) {
                $value = $redis->get($key);
                $size = strlen(serialize($value));
                $this->info("Key: $key, Size: $size bytes");
            }
        } else {
            $this->error('This cache store does not support size checking.');
        }
    }
}
