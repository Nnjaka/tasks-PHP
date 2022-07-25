<?php

namespace App\Model;

class Prices
{
    public function __construct(
        public float $min,
        public float $max,
        public float $avg
    ){}

}