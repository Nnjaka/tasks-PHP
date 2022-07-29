<?php

namespace unit;

use App\ChessDE\Elephant;
use App\ChessDE\Rook;
use App\ChessDE\Horse;
use App\ChessDE\Pawn;
use App\ChessDE\Position;
use App\ChessDE\Queen;

class ChessDETest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @dataProvider pawnProvider
     */
    public function testPawn(Position $start, Position $target, int|null $result)
    {
        $moves = Pawn::minMovesCount($start, $target);
        $this->assertEquals($result, $moves);
    }

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

    /**
     * @dataProvider allProvider
     */
    public function testRook(Position $start, Position $target)
    {
        $moves = Rook::minMovesCount($start, $target);

        if ($start == $target) {
            $this->assertEquals(0, $moves);
        } elseif ($start->theSameColumn($target) || $start->theSameLine($target)) {
            $this->assertEquals(1, $moves);
        } else {
            $this->assertEquals(2, $moves);
        }
    }

    /**
     * @dataProvider allProvider
     */
    public function testElephant(Position $start, Position $target)
    {
        $moves = Elephant::minMovesCount($start, $target);

        if ($start == $target) {
            $this->assertEquals(0, $moves);
        } elseif ($start->theSameCrossline($target)) {
            $this->assertEquals(1, $moves);
        } elseif ($start->getColor() !== $target->getColor())  {
            //на другой цвет попасть фигура не может
            $this->assertEquals(null, $moves);
        } else {
            $this->assertEquals(2, $moves);
        }
    }

    /**
     * @dataProvider horseProvider
     */
    public function testHorse(Position $start, Position $target, int|null $result)
    {
        $moves = Horse::minMovesCount($start, $target);
        $this->assertEquals($result, $moves);
    }

    protected function pawnProvider()
    {
        return [
            'xxxxxx' => ['start' => new Position(1, 2), 'target' => new Position(1, 4), 'result' => 1],
            'line up' => ['start' => new Position(1, 1), 'target' => new Position(1, 3), 'result' => 2],
            'line down' => ['start' => new Position(2, 2), 'target' => new Position(2, 1), 'result' => null],
            'right' => ['start' => new Position(2, 2), 'target' => new Position(1, 2), 'result' => null],
            'diag' => ['start' => new Position(1, 1), 'target' => new Position(2, 2), 'result' => null],
            'none' => ['start' => new Position(1, 1), 'target' => new Position(1, 1), 'result' => 0],
        ];
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

    protected function horseProvider()
    {
        return [
            'up-right' => ['start' => new Position(1, 1), 'target' => new Position(3, 2), 'result' => 1],
            'up-right, left-up' => ['start' => new Position(1, 1), 'target' => new Position(1, 3), 'result' => 2],
            'none' => ['start' => new Position(1, 1), 'target' => new Position(1, 1), 'result' => 0],
        ];
    }

}