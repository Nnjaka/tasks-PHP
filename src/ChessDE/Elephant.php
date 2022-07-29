<?php

namespace App\ChessDE;

class Elephant extends ChessManAbstract
{

    /**
     * @inheritDoc
     */
    public static function possibleMoves(Position $start): array
    {
        $result = [];

        //ходит по диагоналям, перебираем их все
        foreach ([[1, 1], [-1, -1], [1, -1], [-1, 1]] as $shift) {
            $newPosition = clone $start;
            do {
                $newPosition = $newPosition->shift($shift[0], $shift[1]);
                if (!is_null($newPosition)) {
                    $result[] = $newPosition;
                }
            } while (!is_null($newPosition));
        }

        return $result;
    }
}