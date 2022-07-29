<?php

namespace App\Chess;

require_once __DIR__ . '/Chessman.php';
require_once __DIR__ . '/Position.php';

class Elephant extends Chessman
{
    public static function possibleMoves(Position $position)
    {
        $positions = [];

        for($step=1; $step < 8; $step++ ){
            if($position->x + $step > 0 && $position->y + $step > 0 && $position->x + $step <= 8 && $position->y + $step <= 8){
                $positions[] = new Position($position->x + $step, $position->y + $step);
            }
        }

        for($step=1; $step < 8; $step++ ){
            if($position->x - $step > 0 && $position->y - $step > 0 && $position->x - $step <= 8 && $position->y - $step <= 8){
                $positions[] = new Position($position->x - $step, $position->y - $step);
            }
        }

        for($step=1; $step < 8; $step++ ){
            if($position->x + $step > 0 && $position->y - $step > 0 && $position->x + $step <= 8 && $position->y - $step <= 8){
                $positions[] = new Position($position->x + $step, $position->y - $step);
            }
        }

        for($step=1; $step < 8; $step++ ){
            if($position->x - $step > 0 && $position->y + $step > 0 && $position->x - $step <= 8 && $position->y + $step <= 8){
                $positions[] = new Position($position->x - $step, $position->y + $step);
            }
        }

        return $positions;
    }

    public function isPossibleMoveFromOneStep(int $x1, int $y1, int $x2, int $y2): bool{
        if(self::minMovesCount(new Position($x1, $y1), new Position($x2, $y2)) === 1){
            return true;
        }
        return false;
    }
}
