<?php

namespace unit;

use _support\Car;
use App\ArrayObject;
use App\SimpleArray;
use function PHPUnit\Framework\assertEquals;
use \Codeception\Example;


class ArrayObjectTest extends \Codeception\Test\Unit
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

    public function testGetModelAvgPrices(){
        $array = new ArrayObject();
        $result = $array->getModelAvgPrices([
            new Car('bmw', 'x7', 2022, 'x777xx777', 1),
            new Car('bmw', 'x7', 2022, 'x777xx111', 9),
            new Car('bmw', 'x3', 2021, 'a444aa767', 7),
            new Car('bmw', 'x3', 2020, 'a445aa967', 1),
            new Car('mercedes', 'gls', 2021, 'a777aa777', 8),
            new Car('mercedes', 'e', 2021, 'a777aa767', 7),
            new Car('mercedes', 'e', 2020, 'a777aa967', 2),
            new Car('mercedes', 'e', 2019, 'a777aa967', 3),
        ]);
        $this->assertIsArray($result);

        $resultAVG = [];
        foreach ($result as $cars){
            $resultAVG[] = $cars->avg;
        }

        $this->assertEquals([5, 4, 8, 4], $resultAVG);
    }

    public function testGetModelPrices(){
        $array = new ArrayObject();
        $result = $array->getModelPrices([
            new Car('audi', 'a8', 2022, 'x111xx777', 10),
            new Car('audi', 'a8', 2022, 'x111xx777', 10),
            new Car('bmw', 'x7', 2022, 'x777xx777', 1),
            new Car('bmw', 'x7', 2022, 'x777xx111', 9),
            new Car('bmw', 'x7', 2021, 'a444aa767', 7),
            new Car('bmw', 'x7', 2021, 'a445aa967', 1),
            new Car('bmw', 'x7', 2021, 'a445aa967', 1),
            new Car('bmw', 'x7', 2021, 'a445aa967', 1),
            new Car('mercedes', 'gls', 2021, 'a777aa777', 8),
            new Car('mercedes', 'e', 2021, 'a777aa767', 7),
            new Car('mercedes', 'e', 2021, 'a777aa767', 1),
            new Car('mercedes', 'e', 2020, 'a777aa967', 2),
            new Car('mercedes', 'e', 2019, 'a777aa967', 3),
            new Car('bmw', 'x7', 2021, 'a445aa967', 5),
            new Car('audi', 'a8', 2022, 'x111xx777', 12),
            new Car('audi', 'a8', 2022, 'x111xx777', 10),
        ]);
        $this->assertIsArray($result);

        $resultPrices = [];

        foreach ($result as $cars){
            $resultPrices[$cars->title][$cars->model][] = $cars->year_prices->min;
            $resultPrices[$cars->title][$cars->model][] = $cars->year_prices->max;
            $resultPrices[$cars->title][$cars->model][] = $cars->year_prices->avg;
        }

        $this->assertEquals([
            'audi' => ['a8' => [10, 12, 10.5]],
            'bmw' => ['x7' => [1, 9, 5, 1, 7, 3]],
            'mercedes' =>  [
                'gls' => [8, 8, 8],
                'e' => [1, 7, 4, 2, 2, 2, 3, 3, 3],
            ],

        ], $resultPrices);
    }

    public function testGetModelPrices2(){
        $array = new ArrayObject();
        $result = $array->getModelPrices2([
            new Car('audi', 'a8', 2022, 'x111xx777', 10),
            new Car('audi', 'a8', 2022, 'x111xx777', 10),
            new Car('bmw', 'x7', 2022, 'x777xx777', 1),
            new Car('bmw', 'x7', 2022, 'x777xx111', 9),
            new Car('bmw', 'x7', 2021, 'a444aa767', 7),
            new Car('bmw', 'x7', 2021, 'a445aa967', 1),
            new Car('bmw', 'x7', 2021, 'a445aa967', 1),
            new Car('bmw', 'x7', 2021, 'a445aa967', 1),
            new Car('mercedes', 'gls', 2021, 'a777aa777', 8),
            new Car('mercedes', 'e', 2021, 'a777aa767', 7),
            new Car('mercedes', 'e', 2021, 'a777aa767', 1),
            new Car('mercedes', 'e', 2020, 'a777aa967', 2),
            new Car('mercedes', 'e', 2019, 'a777aa967', 3),
            new Car('bmw', 'x7', 2021, 'a445aa967', 5),
            new Car('audi', 'a8', 2022, 'x111xx777', 12),
            new Car('audi', 'a8', 2022, 'x111xx777', 10),
        ]);
        $this->assertIsArray($result);

        $resultPrices = [];

        foreach ($result as $cars){
            $resultPrices[$cars->title][$cars->model][] = $cars->year_prices->min;
            $resultPrices[$cars->title][$cars->model][] = $cars->year_prices->max;
            $resultPrices[$cars->title][$cars->model][] = $cars->year_prices->avg;
        }

        $this->assertEquals([
            'audi' => ['a8' => [10, 12, 10.5]],
            'bmw' => ['x7' => [1, 9, 5, 1, 7, 3]],
            'mercedes' =>  [
                'gls' => [8, 8, 8],
                'e' => [1, 7, 4, 2, 2, 2, 3, 3, 3],
            ],

        ], $resultPrices);
    }
}