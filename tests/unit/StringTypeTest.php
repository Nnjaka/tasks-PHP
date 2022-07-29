<?php

namespace unit;

use App\StringType;

class StringTypeTest extends \Codeception\Test\Unit
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

    /**
     * @dataProvider symmetryDataprovider
     */
    public function testSymmetryString(string $s, bool $expected)
    {
        $string = new StringType();
        $result = $string->checkSymmetryString1($s);
        $this->assertEquals($expected, $result);
    }

    protected function symmetryDataprovider()
    {
        return [
            ['a', true,],
            ['aa', true,],
            ['aba', true,],
            ['a5b5a', true,],
            ['a5bb5a', true,],
            ['a5bbc5a', false,],
            ['abcde', false,],
        ];
    }


    public function testCheckSymmetryString1()
    {
        $string = new StringType();

        $data = 'aba';
        $result = $string->checkSymmetryString1($data);
        $this->assertIsBool($result);
        $this->assertTrue($result);

        $data = 'abba';
        $result = $string->checkSymmetryString1($data);
        $this->assertIsBool($result);
        $this->assertTrue($result);

        $data = 'ab ba';
        $result = $string->checkSymmetryString1($data);
        $this->assertIsBool($result);
        $this->assertTrue($result);

        $data = 'ab!ba';
        $result = $string->checkSymmetryString1($data);
        $this->assertIsBool($result);
        $this->assertTrue($result);

        $data = 'ab1!1ba';
        $result = $string->checkSymmetryString1($data);
        $this->assertIsBool($result);
        $this->assertTrue($result);

        $data = 'ab!.ba';
        $result = $string->checkSymmetryString1($data);
        $this->assertIsBool($result);
        $this->assertFalse($result);

        $data = 'ab!.ba ';
        $result = $string->checkSymmetryString1($data);
        $this->assertIsBool($result);
        $this->assertFalse($result);
    }

    public function testCheckSymmetryString2()
    {
        $string = new StringType();

        $data = 'aba';
        $result = $string->checkSymmetryString2($data);
        $this->assertIsBool($result);
        $this->assertTrue($result);

        $data = 'abba';
        $result = $string->checkSymmetryString2($data);
        $this->assertIsBool($result);
        $this->assertTrue($result);

        $data = 'ab ba';
        $result = $string->checkSymmetryString2($data);
        $this->assertIsBool($result);
        $this->assertTrue($result);

        $data = 'ab!ba';
        $result = $string->checkSymmetryString2($data);
        $this->assertIsBool($result);
        $this->assertTrue($result);

        $data = 'ab1!1ba';
        $result = $string->checkSymmetryString2($data);
        $this->assertIsBool($result);
        $this->assertTrue($result);

        $data = 'ab!.ba';
        $result = $string->checkSymmetryString2($data);
        $this->assertIsBool($result);
        $this->assertFalse($result);

        $data = 'ab!.ba ';
        $result = $string->checkSymmetryString2($data);
        $this->assertIsBool($result);
        $this->assertFalse($result);
    }

    public function testCheckLuckyTicket1()
    {
        $string = new StringType();

        $data = '123321';
        $result = $string->checkLuckyTicket1($data);
        $this->assertIsBool($result);
        $this->assertTrue($result);

        $data = '000000';
        $result = $string->checkLuckyTicket1($data);
        $this->assertIsBool($result);
        $this->assertTrue($result);

        $data = '119821';
        $result = $string->checkLuckyTicket1($data);
        $this->assertIsBool($result);
        $this->assertTrue($result);

        $data = '119000';
        $result = $string->checkLuckyTicket1($data);
        $this->assertIsBool($result);
        $this->assertFalse($result);

        $data = '11900a';
        $result = $string->checkLuckyTicket1($data);
        $this->assertIsBool($result);
        $this->assertFalse($result);
    }

    public function testCheckLuckyTicket2()
    {
        $string = new StringType();

        $data = '123321';
        $result = $string->checkLuckyTicket2($data);
        $this->assertIsBool($result);
        $this->assertTrue($result);

        $data = '000000';
        $result = $string->checkLuckyTicket2($data);
        $this->assertIsBool($result);
        $this->assertTrue($result);

        $data = '119821';
        $result = $string->checkLuckyTicket2($data);
        $this->assertIsBool($result);
        $this->assertTrue($result);

        $data = '119000';
        $result = $string->checkLuckyTicket2($data);
        $this->assertIsBool($result);
        $this->assertFalse($result);

        $data = '11900a';
        $result = $string->checkLuckyTicket2($data);
        $this->assertIsBool($result);
        $this->assertFalse($result);
    }

    public function testGetCountRepeatInStringThroughArray()
    {
        $string = new StringType();

        $data = 'Сколько раз в строке встречается заданное слово';
        $word = 'раз';

        $result = $string->getCountRepeatInStringThroughArray($data, $word);
        $this->assertIsInt($result);
        $this->assertEquals(1, $result);

        $data = 'Сколько слово раз в строке встречается слово заданное слово';
        $word = 'слово';

        $result = $string->getCountRepeatInStringThroughArray($data, $word);
        $this->assertIsInt($result);
        $this->assertEquals(3, $result);

        $data = 'Сколько слово раз в строке встречается заданное слово';
        $word = 'Слово';

        $result = $string->getCountRepeatInStringThroughArray($data, $word);
        $this->assertIsInt($result);
        $this->assertEquals(0, $result);
    }

    public function testGetCountRepeatInStringWithoutArray()
    {
        $string = new StringType();

        $data = 'Сколько раз в строке встречается заданное слово';
        $word = 'раз';

        $result = $string->getCountRepeatInStringWithoutArray($data, $word);
        $this->assertIsInt($result);
        $this->assertEquals(1, $result);

        $data = 'Сколько слово раз в строке встречается слово заданное слово';
        $word = 'слово';

        $result = $string->getCountRepeatInStringWithoutArray($data, $word);
        $this->assertIsInt($result);
        $this->assertEquals(3, $result);

        $data = 'Сколько слово раз в строке встречается заданное слово';
        $word = 'Cлово';

        $result = $string->getCountRepeatInStringWithoutArray($data, $word);
        $this->assertIsInt($result);
        $this->assertEquals(0, $result);
    }

    public function testSplitStringToEvenAndOddSymbols()
    {
        $string = new StringType();

        $data = 'слово';

        $result = $string->splitStringToEvenAndOddSymbols($data);
        $this->assertIsArray($result);
        $this->assertEquals(['соо', 'лв'], $result);

        $data = 'вселенная';

        $result = $string->splitStringToEvenAndOddSymbols($data);
        $this->assertIsArray($result);
        $this->assertEquals(['вееня', 'слна'], $result);
    }

    public function testGetFrequentSymbol()
    {
        $string = new StringType();

        $data = 'слово';

        $result = $string->getFrequentSymbol($data);
        $this->assertIsArray($result);
        $this->assertEquals(['о', 2], $result);

        $data = 'ооооффф';

        $result = $string->getFrequentSymbol($data);
        $this->assertIsArray($result);
        $this->assertEquals(['о', 4], $result);

        $data = 'фооооффф';

        $result = $string->getFrequentSymbol($data);
        $this->assertIsArray($result);
        $this->assertEquals(['ф', 4], $result);
    }

    public function testGetThreeSymbols()
    {
        $string = new StringType();

        $data = 'словоооовввс';

        $result = $string->getThreeSymbols($data);
        $this->assertIsArray($result);
        $this->assertEquals(['о' => 5, 'в' => 4, 'с' => 2], $result);

        $data = 'abc';

        $result = $string->getThreeSymbols($data);
        $this->assertIsArray($result);
        $this->assertEquals(['a' => 1, 'b' => 1, 'c' => 1], $result);
    }

    public function testGetPalindromeNumber()
    {
        $string = new StringType();

        $data = 121;

        $result = $string->getPalindromeNumber($data);
        $this->assertIsBool($result);
        $this->assertTrue($result);

        $data = 1221;

        $result = $string->getPalindromeNumber($data);
        $this->assertIsBool($result);
        $this->assertTrue($result);

        $data = 0;

        $result = $string->getPalindromeNumber($data);
        $this->assertIsBool($result);
        $this->assertTrue($result);

        $data = -12;

        $result = $string->getPalindromeNumber($data);
        $this->assertIsBool($result);
        $this->assertFalse($result);

        $data = 1234;

        $result = $string->getPalindromeNumber($data);
        $this->assertIsBool($result);
        $this->assertFalse($result);
    }

    public function testGetLongestSubstring()
    {
        $string = new StringType();

        $data = 'abababcccababccc';

        $result = $string->getLongestSubstring($data);
        $this->assertIsString($result);
        $this->assertEquals('abab', $result);

        $data = 'resultasresultyuresulresult';

        $result = $string->getLongestSubstring($data);
        $this->assertIsString($result);
        $this->assertEquals('result', $result);

    }
}