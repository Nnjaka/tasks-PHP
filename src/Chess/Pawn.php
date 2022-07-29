<?php

namespace App\Chess;

require_once __DIR__ . '/Chessman.php';
require_once __DIR__ . '/Position.php';

class Pawn extends Chessman
{
    public static function possibleMoves(Position $position)
    {
        $positions = [];

        if($position->y === 2){
            for($step=1; $step < 3; $step++){
                $positions[] = new Position($position->x, $position->y + $step);
            }
        } else {
                if($position->x + 1 <= 8){
                    $positions[] = new Position($position->x, $position->y + 1);
                }
        }

        return $positions;
    }
}


