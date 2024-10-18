<?php
namespace App\Service;

class RandomService
{
    protected $number;

    public function __construct()
    {
        $this->number = mt_rand(1, 10000);
    }

    public function get_number() :int
    {
        return $this->number;
    }

    public function str_random($length = 8)
    {
        \Log::debug("RandomService str_random length: {$length}");
        return array_reduce(range(1, $length), function($p){ return $p.str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz')[0]; });
    }
}
