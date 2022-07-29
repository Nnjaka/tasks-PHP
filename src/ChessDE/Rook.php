<?php

namespace App\ChessDE;

class Rook extends ChessManAbstract
{

    /**
     * @inheritDoc
     */
    public static function possibleMoves(Position $start): array
    {
        $result = [];
        //ходит по прямым
        foreach (range(1, 8) as $x) {
            if ($x != $start->x) {
                $result[] = new Position($x, $start->y);
            }
        }

        foreach (range(1, 8) as $y) {
            if ($y != $start->y) {
                $result[] = new Position($start->x, $y);
            }
        }

        return $result;
    }
}