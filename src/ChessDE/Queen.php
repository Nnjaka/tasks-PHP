<?php

namespace App\ChessDE;

class Queen extends ChessManAbstract
{

    /**
     * @inheritDoc
     */
    public static function possibleMoves(Position $start): array
    {
        $result = [];
        //королева ходит по прямым
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

        //королева ходит по диагоналям, перебираем их все
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