<?php

namespace unit;

use App\Different;
use App\IntegerType;

class IntegerTypeTest extends \Codeception\Test\Unit
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

    public function testCheckPowOfThree(){
        $number = new IntegerType();

        $this->assertTrue($number->checkPowOfThree(3));
        $this->assertTrue($number->checkPowOfThree(27));
        $this->assertTrue($number->checkPowOfThree(81));
        $this->assertFalse($number->checkPowOfThree(0));
        $this->assertFalse($number->checkPowOfThree(1));
        $this->assertFalse($number->checkPowOfThree(2));
        $this->assertFalse($number->checkPowOfThree(100));
    }
}