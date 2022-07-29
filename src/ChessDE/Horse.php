<?php

namespace App\ChessDE;

class Horse extends ChessManAbstract
{

    /**
     * @inheritDoc
     */
    public static function possibleMoves(Position $start): array
    {
        $result = [];

        foreach ([
                     [2, 1], [2, -1],
                     [-2, 1], [-2, -1],
                     [1, 2], [-1, 2],
                     [1, -2], [-1, -2],
                 ] as $shift) {
            $newPosition = $start->shift($shift[0], $shift[1]);
            if (!is_null($newPosition)) {
                $result[] = $newPosition;
            }
        }
        return $result;
    }
}