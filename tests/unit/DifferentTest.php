<?php

namespace unit;

use App\Different;

class DifferentTest extends \Codeception\Test\Unit
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

    public function testGetProbabilityLuckyTicket(){
        $number = new Different();

        $this->assertEquals(5,$number->getProbabilityLuckyTicket());
    }
}