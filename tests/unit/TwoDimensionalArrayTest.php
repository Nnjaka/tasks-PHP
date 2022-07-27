<?php

namespace unit;

use App\TwoDimensionalArray;

class TwoDimensionalArrayTest extends \Codeception\Test\Unit
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

    public function testGetArray(){
        $array = new TwoDimensionalArray(5, 5);

        $array->set(0,1,5);
        $value = $array->get(0,1);
        $this->assertEquals(5, $value);

        $array->set(4,1,10);
        $value = $array->get(4,1);
        $this->assertEquals(10, $value);
    }

    public function testCheckEachFunction(){
        $array = new TwoDimensionalArray(4, 4);

        $array->set(0,1,5);
        $array->set(1,1,10);
        $array->set(3,3,50);
        $array->set(2,3,40);


        $array->each(function(&$value) {
            $value +=1;
            return $value;
        });

        $result = [];
        $array->each(function ($value) use (&$result){
            $result[] = $value;
//            return $value;
        });
        $this->assertEquals([1,6,1,1,1,11,1,1,1,1,1,41,1,1,1,51], $result);
    }

    public function testGenerateValue(){
        $array = new TwoDimensionalArray(2, 2);

        $array->set(0,0,5);
        $array->set(0,1,10);
        $array->set(1,0,50);
        $array->set(1,1,40);

        $generateValues = $array->values();

        $result = [];
        foreach($generateValues as $value){
            $result[] = $value;
        };

        $this->assertEquals([5, 10, 50, 40], $result);
    }

    public function testFailArray(){
        $array = new TwoDimensionalArray(5, 5);

        $this->expectException("Exception");
        $this->expectExceptionMessage("Cannot set element with row - 15, cell - 20. Not found");
        $array->set(15,20,10);

        $this->expectException("Exception");
        $this->expectExceptionMessage("Cannot get element with row - 100, cell - 100. Not found");
        $value = $array->get(100,100);
    }

    public function testGetMaxValue(){
        $array = new TwoDimensionalArray(2, 2);

        $array->set(0,0,5);
        $array->set(0,1,10);
        $array->set(1,0,50);
        $array->set(1,1,40);


    }


}