<?php
namespace App\Service;

class RandomNumberService
{
    protected $number;

    public function __construct()
    {
        $this->number = mt_rand(1, 10000);
    }

    public function getNumber() :int
    {
        return $this->number;
    }    
}
