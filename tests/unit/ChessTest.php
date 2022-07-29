<?php

namespace unit;

use App\Chess\Position;
use App\Chess\Queen;

class ChessTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;


    /**
     * @dataProvider allProvider
     */
    public function testQueen(Position $start, Position $target)
    {
        $moves = Queen::minMovesCount($start, $target);

        if ($start == $target) {
            $this->assertEquals(0, $moves);
        } elseif ($start->theSameColumn($target) || $start->theSameLine($target) || $start->theSameCrossline($target)) {
            $this->assertEquals(1, $moves);
        } else {
            $this->assertEquals(2, $moves);
        }
    }

    protected function allProvider()
    {
        $result = [];

        foreach (range(1, 8) as $x1) {
            foreach (range(1, 8) as $y1) {
                foreach (range(1, 8) as $x2) {
                    foreach (range(1, 8) as $y2) {
                        $result["($x1,$y1)->($x2,$y2)"] = [
                            'start' => new Position($x1, $y1),
                            'target' => new Position($x2, $y2),
                        ];
                    }
                }
            }
        }
        return $result;
    }


}