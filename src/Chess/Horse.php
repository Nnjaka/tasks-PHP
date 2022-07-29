<?php

namespace App\Chess;

require_once __DIR__ . '/Chessman.php';
require_once __DIR__ . '/Position.php';

class Horse extends Chessman
{
    public static function possibleMoves(Position $position)
    {
        $positions = [];

        $possibleShifts = [
            [2,1],
            [2,-1],
            [-2,1],
            [-2,-1],
            [1, 2],
            [1,-2],
            [-1,2],
            [-1,-2]
        ];

        foreach($possibleShifts as $possibleShift){
            if(($position->x + $possibleShift[0]) > 8 ||
                ($position->y + $possibleShift[1]) > 8 ||
                ($position->x + $possibleShift[0]) < 1 ||
                ($position->y + $possibleShift[1]) < 1) {
                continue;
            }else{
                $positions[] = new Position($position->x + $possibleShift[0], $position->y + $possibleShift[1]);
            }

        }

        return $positions;
    }

    public function checkCountStep(int $x1, int $y1, int $x2, int $y2, int $steps): bool
    {
        if(self::minMovesCount(new Position($x1, $y1), new Position($x2, $y2)) === $steps){
            return true;
        }
        return false;
    }
}
