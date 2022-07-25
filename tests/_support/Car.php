<?php

namespace _support;

class Car
{
    public function __construct (
        public string $title,
        public string $model,
        public int $year,
        public string $number,
        public int $price,
    ){}


}