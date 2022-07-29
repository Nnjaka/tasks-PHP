<?php

namespace App\Chess;

use phpDocumentor\Reflection\PseudoTypes\PositiveInteger;

require_once __DIR__ . '/Chessman.php';
require_once __DIR__ . '/Position.php';

abstract class Chessman
{
    abstract static function possibleMoves(Position $position);

    public static function minMovesCount(Position $startPosition, Position $targetPosition): int|null
    {
        if($startPosition == $targetPosition){
            return 0;
        }

        $count = 0;
        $possibleMoves = static::possibleMoves(new Position($startPosition->x,$startPosition->y));
        $verifiedCoordinates[] = $startPosition;

        while(!empty($possibleMoves)) {
            $count++;
            foreach ($possibleMoves as $oneMove) {
                if ($oneMove == $targetPosition) {
                    return $count;
                }
                if(empty(array_search($oneMove, $verifiedCoordinates))){
                    $verifiedCoordinates[] = $oneMove;
                    $newValues = static::possibleMoves(new Position((int)$oneMove->x, (int)$oneMove->y));

                    foreach ($newValues as $newValue){
                        if(empty(array_search($newValue, $verifiedCoordinates))){
                            $possibleMoves[] = $newValue;
                        }
                    }
                }
            }
            $possibleMoves = array_slice($possibleMoves, 1);
        }

        return null;
    }
}