<?php

namespace unit;

use App\ArrayObject;
use App\SimpleArray;
use function PHPUnit\Framework\assertEquals;
use \Codeception\Example;

class ArrayObjectTestTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    public function testGetModelPrices(){
        $data = new \stdClass();

        $data->cars = [];

        $car1 = new \stdClass();
        $car1->title = 'bmw';
        $car1->model = 'x7';
        $car1->year = 2022;
        $car1->number = 'x777xx777';
        $car1->price = 10000000;

        $car2 = new \stdClass();
        $car2->title = 'audi';
        $car2->model = 'r8';
        $car2->year = 2021;
        $car2->number = 'x111xx777';
        $car2->price = 20000000;

        $data->cars[] = $car1;
        $data->cars[] = $car2;


        $array = new ArrayObject();
        $array->getModelPrices($data);
    }


}