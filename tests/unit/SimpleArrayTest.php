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

        $this->assertEquals(8, $result);
    }

    public function testGetUniqueArrayItem2(){
        $data = [5, 6, 3, 3, 7, 4, 20, 3, 33, 3, 4, 1, 9];

        $this->assertIsArray($data);

        $array = new SimpleArray();
        $result = $array->getUniqueArrayItem1($data);

        $this->assertEquals(9, $result);
    }

    public function testGetUniqueArrayItem3(){
        $data = [5, 6, 3, 3, 7, 4, 20, 3, 33, 3, 4, 1, 9, 0, -1];

        $this->assertIsArray($data);

        $array = new SimpleArray();
        $result = $array->getUniqueArrayItem1($data);

        $this->assertEquals(11, $result);
    }

    public function testGetPrevalentArrayAnyItem1(){
        $data = [5, 6, 3, 3, 7, 4, 20, 3, 33, 3, 4, 1, 9, 0, -1];

        $this->assertIsArray($data);

        $array = new SimpleArray();
        $result = $array->getPrevalentArrayAnyItem1($data);

        $this->assertStringContainsString( "Самый часто встречающийся элемент массива - 3, количество раз - 4", $result);
    }

    public function testGetPrevalentArrayAnyItem2(){
        $data = [5, 6, 3, 3, 7, 4, 20, 3, 33, 3, 4, 1, 9, 0, -1];

        $this->assertIsArray($data);

        $array = new SimpleArray();
        $result = $array->getPrevalentArrayAnyItem2($data);

        $this->assertStringContainsString( "Самый часто встречающийся элемент массива - 3, количество раз - 4", $result);
    }


    public function testGetPrevalentArrayAllItem(){
        $data = [5, 6, 20, 3, 7, 4, 0, 20, 20, 33, 4, 1, -6, -1, -6, 0, 4];

        $this->assertIsArray($data);

        $array = new SimpleArray();
        $result = $array->getPrevalentArrayAllItem($data);

        $this->assertStringContainsString( "Самый часто встречающиеся элементы массива - 20, 4, количество раз - 3", $result);
    }

    public function testGetSecondPrevalentArrayItem(){
        $data = [5, 6, 20, 3, 7, 4, 0, 20, 20, 33, 4, 1, -6, -1, -6, 4];

        $this->assertIsArray($data);

        $array = new SimpleArray();
        $result = $array->getSecondPrevalentArrayItem($data);

        $this->assertStringContainsString( "Второй самый часто встречающийся элемент массива - -6, количество раз - 2", $result);
    }

    public function testGetDifferenceBetweenArrayElement(){
        $data = [5, 6, 20, 3, 7, 4, 0, 20, 20, 33, 4, 1, -6, -1, -6, 4, 20, 20];

        $this->assertIsArray($data);

        $array = new SimpleArray();
        $result = $array->getDifferenceBetweenArrayElement($data);

        $this->assertStringContainsString( "Cамый частый - 5 раз, самый редкий - 1 раз, разница итого - 4", $result);
    }


}