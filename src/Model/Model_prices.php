<?php

namespace App\Model;

class Model_prices
{
    public function __construct(
        public string $title,
        public string $model,
        public Prices $year_prices
    ){}

}