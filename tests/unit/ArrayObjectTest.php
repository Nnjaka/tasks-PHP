<?php

namespace unit;

use App\DTO\Car;
use App\ArrayObject;

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
            new Car('bmw', 'x7', 2022, 'x777xx777', 1),
            new Car('bmw', 'x7', 2022, 'x777xx111', 9),
            new Car('bmw', 'x7', 2021, 'a445aa967', 5),
            new Car('bmw', 'x7', 2021, 'a444aa767', 7),
            new Car('bmw', 'x7', 2021, 'a445aa967', 1),
            new Car('bmw', 'x7', 2021, 'a445aa967', 1),
            new Car('bmw', 'x7', 2021, 'a445aa967', 1),
            new Car('mercedes', 'gls', 2021, 'a777aa777', 8),
            new Car('mercedes', 'e', 2021, 'a777aa767', 7),
            new Car('mercedes', 'e', 2021, 'a777aa767', 1),
            new Car('mercedes', 'e', 2020, 'a777aa967', 2),
            new Car('mercedes', 'e', 2019, 'a777aa967', 3),
            new Car('audi', 'a8', 2021, 'x111xx777', 12),
            new Car('audi', 'a8', 2021, 'x111xx777', 10),
            new Car('audi', 'a8', 2022, 'x111xx777', 16),
        ]);

        $this->assertIsArray($result);

        $resultPrices = [];

        foreach ($result as $cars){
            $resultPrices[$cars->title][$cars->model] = $cars->year_prices;
            foreach ($resultPrices[$cars->title][$cars->model] as $key =>$elem){
                $resultPrices[$cars->title][$cars->model][$key] = [$elem->min, $elem->max, $elem->avg];
            }
        }

        $this->assertEquals([
            'audi' => [
                'a8' =>
                    [
                        2022 => [10, 16, 13],
                        2021 => [10, 12, 11],
                    ]
            ],
            'bmw' => [
                'x7' =>
                    [
                        2022 => [1, 9, 5],
                        2021 => [1, 7, 3]
                    ]
            ],
            'mercedes' => [
                'gls' =>
                    [
                        2021 => [8, 8, 8]
                    ],
                'e' =>
                    [
                        2021 => [1, 7, 4],
                        2020 => [2, 2, 2],
                        2019 => [3, 3, 3]
                    ]
            ]
        ], $resultPrices);
    }
}