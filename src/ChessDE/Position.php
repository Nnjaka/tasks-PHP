<?php

namespace App\ChessDE;

/**
 *   1,                8,8
 *
 *
 *
 *
 *
 *   1,1               8,1
 */
class Position
{
    public function __construct(public int $x, public int $y)
    {
    }

    /**
     * Возвращает новую координату сдвинутую в сторону от текущей или null если смещение некорректно
     * @param int $xShift
     * @param int $yShift
     * @return $this|null
     */
    public function shift(int $xShift, int $yShift): ?self
    {
        $newPosition = new Position($this->x + $xShift, $this->y + $yShift);
        return ($newPosition->isValid() ? $newPosition : null);
    }

    /**
     * Проверка является ли объект валидным
     * @return bool
     */
    private function isValid(): bool
    {
        return (
            $this->x >= 1 &&
            $this->x <= 8 &&
            $this->y >= 1 &&
            $this->y <= 8
        );
    }

    /**
     * Находятся ли 2 координаты на 1 линии
     * @param Position $position
     * @return bool
     */
    public function theSameLine(self $position): bool
    {
        return ($this->y === $position->y);
    }

    /**
     * Находятся ли 2 координаты в 1 столбце
     * @param Position $position
     * @return bool
     */
    public function theSameColumn(self $position): bool
    {
        return ($this->x === $position->x);
    }

    /**
     * Находятся ли 2 координаты на одной из диагоналей
     * @param Position $position
     * @return bool
     */
    public function theSameCrossline(self $position): bool
    {
        return (abs($position->x - $this->x) === abs($position->y - $this->y));
    }

    public function __toString(): string
    {
        return $this->x . ',' . $this->y;
    }

    /**
     * Цвет ячейки доски
     * @return Color
     */
    public function getColor(): Color {
        if ($this->y % 2 == 1) {
            //ряд начинается с черного
            return ($this->x % 2 == 1) ? Color::BLACK : Color::WHITE;
        } else {
            //ряд начинается с белого
            return ($this->x % 2 == 1) ? Color::WHITE : Color::BLACK;
        }
    }
}