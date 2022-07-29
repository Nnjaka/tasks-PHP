<?php

namespace App\ChessDE;

abstract class ChessManAbstract
{
    /**
     * Рассчет минимального количества ходов фигуры на перемещение из одной позиции в другую или null если невозможно
     * @param Position $start
     * @param Position $target
     * @return int|null
     */
    public static final function minMovesCount(Position $start, Position $target): ?int
    {

        //позиции которые мы уже достигли и на каком ходе
        $reachedPositions = [];
        $reachedPositions[(string)$start] = 0;

        //позиции ходы ИЗ которых нужно проверить
        $positionsToCheck = [$start];

        $moveNumber = 1;
        while (count($positionsToCheck)) {
            $newPositionsToCheck = [];
            foreach ($positionsToCheck as $currentPosition) {
                $newMoves = static::possibleMoves($currentPosition);
                foreach ($newMoves as $newPosition) {
                    //проверяем действительно ли это новая координата
                    if (!isset($reachedPositions[(string)$newPosition])) {
                        //мы нашли новую координату
                        $reachedPositions[(string)$newPosition] = $moveNumber;
                        $newPositionsToCheck[(string)$newPosition] = $newPosition;

                        //досрочный выход если мы нашли нужную
                        if ($newPosition === $target) {
                            return $moveNumber;
                        }
                    }
                }
            }
            $positionsToCheck = $newPositionsToCheck;
            $moveNumber++;
        }

        //строго говоря если мы тут - значит найти ничего не удалось
        //оставил такой код на случай если уберем досрочный выход
        return $reachedPositions[(string)$target] ?? null;
    }

    /**
     * Массив возможных координат куда можно попасть за 1 ход из указанной
     * @param Position $start
     * @return Position[]
     */
    abstract public static function possibleMoves(Position $start): array;
}