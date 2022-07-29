<?php

namespace App\Chess;

require_once __DIR__ . '/Chessman.php';
require_once __DIR__ . '/Position.php';

class Queen extends Chessman
{
    public static function possibleMoves(Position $position)
    {
        $positions = [];

        //диагонали
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


        //прямые линии
        for($step=1; $step < 8; $step++ ){
            if($position->x + $step > 0 && $position->x + $step <= 8){
                $positions[] = new Position($position->x + $step, $position->y);
            }
        }

        for($step=1; $step < 8; $step++ ){
            if($position->x - $step > 0 && $position->x - $step <= 8){
                $positions[] = new Position($position->x - $step, $position->y);
            }
        }

        for($step=1; $step < 8; $step++ ){
            if($position->y - $step > 0 && $position->y - $step <= 8){
                $positions[] = new Position($position->x, $position->y - $step);
            }
        }

        for($step=1; $step < 8; $step++ ){
            if($position->y + $step > 0 && $position->y + $step <= 8){
                $positions[] = new Position($position->x, $position->y + $step);
            }
        }

        return $positions;
    }
}
