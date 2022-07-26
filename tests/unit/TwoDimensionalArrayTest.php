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
        $array = new TwoDimensionalArray(5, 5);

        $array->set(0,1,5);
        $array->set(1,1,10);
        $array->set(4,4,50);
        $array->set(2,3,40);



        $maxValue = function(array $data){
            $count = count($data);
            $max = 0;

            for($i=0; $i<$count; $i++){
                for($j=0; $j<count($data[$i]); $j++){
                    if($data[$i][$j] > $max){
                        $max = $data[$i][$j];
                    }
                }
            }

            return $max;
        };


        $result = $array->each($maxValue);
        $this->assertEquals(50, $result);

        $array->set(4,2,100);
        $result = $array->each($maxValue);
        $this->assertEquals(100, $result);
    }

    public function testGenerateKeyValue(){
        $array = new TwoDimensionalArray(2, 2);

        $array->set(0,0,5);
        $array->set(0,1,10);
        $array->set(1,0,50);
        $array->set(1,1,40);

        $generateValues = $array->generateKeyValue();

        $result = [];
        foreach($generateValues as $value){
            $result[] = $value;
        };

        $this->assertEquals([
            ['0,0,5'],
            ['0,1,10'],
            ['1,0,50'],
            ['1,1,40']

        ], $result);
    }

    public function testFailArray(){
        $array = new TwoDimensionalArray(5, 5);

        $this->expectException("Exception");
        $this->expectExceptionMessage("Cannot set element with a - 15, b - 20. Not found");
        $array->set(15,20,10);

        $this->expectException("Exception");
        $this->expectExceptionMessage("Cannot get element with a - 100, b - 100. Not found");
        $value = $array->get(100,100);
    }


}