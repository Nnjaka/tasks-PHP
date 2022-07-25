<?php

namespace App\Model;

class Model_avg_prices
{
    public function __construct(
        public string $title,
        public string $model,
        public float $avg
    ){}

}