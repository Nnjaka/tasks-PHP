<?php

namespace unit;

use App\SimpleArray;
use function PHPUnit\Framework\assertEquals;
use \Codeception\Example;

class SimpleArrayTest extends \Codeception\Test\Unit
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

    public function testGetUniqueArrayItem1(){
        $data = [5, 6, 3, 3, 7, 4, 20, 3, 33, 3, 4, 1];

        $this->assertIsArray($data);

        $array = new SimpleArray();
        $result = $array->getUniqueArrayItem1($data);

        $this->assertIsInt($result);
        $this->assertEquals(8, $result);
    }

    public function testGetUniqueArrayItem2(){
        $data = [5, 6, 3, 3, 7, 4, 20, 3, 33, 3, 4, 1, 9];

        $this->assertIsArray($data);

        $array = new SimpleArray();
        $result = $array->getUniqueArrayItem1($data);

        $this->assertIsInt($result);
        $this->assertEquals(9, $result);
    }

    public function testGetUniqueArrayItem3(){
        $data = [5, 6, 3, 3, 7, 4, 20, 3, 33, 3, 4, 1, 9, 0, -1];

        $this->assertIsArray($data);

        $array = new SimpleArray();
        $result = $array->getUniqueArrayItem1($data);

        $this->assertIsInt($result);
        $this->assertEquals(11, $result);
    }

    public function testGetPrevalentArrayAnyItem1(){
        $data = [5, 6, 3, 3, 7, 4, 20, 3, 33, 3, 4, 1, 9, 0, -1];

        $this->assertIsArray($data);

        $array = new SimpleArray();
        $result = $array->getPrevalentArrayAnyItem1($data);

        $this->assertIsString($result);
        $this->assertStringContainsString( "Самый часто встречающийся элемент массива - 3, количество раз - 4", $result);
    }

    public function testGetPrevalentArrayAnyItem2(){
        $data = [5, 6, 3, 3, 7, 4, 20, 3, 33, 3, 4, 1, 9, 0, -1];

        $this->assertIsArray($data);

        $array = new SimpleArray();
        $result = $array->getPrevalentArrayAnyItem2($data);

        $this->assertIsString($result);
        $this->assertStringContainsString( "Самый часто встречающийся элемент массива - 3, количество раз - 4", $result);
    }


    public function testGetPrevalentArrayAllItem(){
        $data = [5, 6, 20, 3, 7, 4, 0, 20, 20, 33, 4, 1, -6, -1, -6, 0, 4];

        $this->assertIsArray($data);

        $array = new SimpleArray();
        $result = $array->getPrevalentArrayAllItem($data);

        $this->assertIsString($result);
        $this->assertStringContainsString( "Самый часто встречающиеся элементы массива - 20, 4, количество раз - 3", $result);
    }

    public function testGetSecondPrevalentArrayItem(){
        $data = [5, 6, 20, 3, 7, 4, 0, 20, 20, 33, 4, 1, -6, -1, -6, 4];

        $this->assertIsArray($data);

        $array = new SimpleArray();
        $result = $array->getSecondPrevalentArrayItem($data);

        $this->assertIsString($result);
        $this->assertStringContainsString( "Второй самый часто встречающийся элемент массива - -6, количество раз - 2", $result);
    }

    public function testGetDifferenceBetweenArrayElement(){
        $data = [5, 6, 20, 3, 7, 4, 0, 20, 20, 33, 4, 1, -6, -1, -6, 4, 20, 20];

        $this->assertIsArray($data);

        $array = new SimpleArray();
        $result = $array->getDifferenceBetweenArrayElement($data);

        $this->assertIsString($result);
        $this->assertStringContainsString( "Cамый частый - 5 раз, самый редкий - 1 раз, разница итого - 4", $result);
    }

    public function testGetNextValueToMax1(){
        $data = [1, 3, 4, 10, 2, 88];

        $this->assertIsArray($data);

        $array = new SimpleArray();
        $result = $array->getNextValueToMax1($data);

        $this->assertIsInt($result);
        $this->assertEquals(10, $result);
    }

    public function testGetNextValueToMax2(){
        $data = [1, 3, 4, 10, 2, 88];

        $this->assertIsArray($data);

        $array = new SimpleArray();
        $result = $array->getNextValueToMax2($data);

        $this->assertIsInt($result);
        $this->assertEquals(10, $result);
    }

    public function testGetNextValueToMax3(){
        $data = [1, 3, 4, 10, 2, 88];

        $this->assertIsArray($data);

        $array = new SimpleArray();
        $result = $array->getNextValueToMax3($data);

        $this->assertIsInt($result);
        $this->assertEquals(10, $result);
    }

    public function testGetCountPrevElemLessThanCurrent(){
        $data = [1, 3, 4, 10, 2, 88];

        $this->assertIsArray($data);

        $array = new SimpleArray();
        $result = $array->getCountPrevElemLessThanCurrent($data);

        $this->assertIsInt($result);
        $this->assertEquals(4, $result);
    }

    public function testGetTwoSum(){
        $data = [1, 3, 4, 10, 2, 88];
        $target = 7;

        $this->assertIsArray($data);

        $array = new SimpleArray();
        $result = $array->getTwoSum($data, $target);

        $this->assertIsArray($result);
        $this->assertEquals([1, 2], $result);
    }

    public function testGetSearchInsertPosition(){
        $data = [1,3,5,6];
        $array = new SimpleArray();

        $target = 5;
        $result = $array->getSearchInsertPosition($data, $target);

        $this->assertIsInt($result);
        $this->assertEquals(2, $result);

        $target = 7;
        $result = $array->getSearchInsertPosition($data, $target);

        $this->assertIsInt($result);
        $this->assertEquals(4, $result);

        $target = 2;
        $result = $array->getSearchInsertPosition($data, $target);

        $this->assertIsInt($result);
        $this->assertEquals(1, $result);

        $target = -1;
        $result = $array->getSearchInsertPosition($data, $target);

        $this->assertIsInt($result);
        $this->assertEquals(0, $result);
    }
}