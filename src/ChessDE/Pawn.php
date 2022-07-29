<?php

namespace App\ChessDE;

class Pawn extends ChessManAbstract
{

    /**
     * @inheritDoc
     */
    public static function possibleMoves(Position $start): array
    {
        if ($start->y == 2) {
            return [
                $start->shift(0, 1),
                $start->shift(0, 2),
            ];
        };

        $newPosition = $start->shift(0, 1);

        if (!is_null($newPosition)) {
            return [$newPosition];
        } else {
            return [];
        }
    }
}