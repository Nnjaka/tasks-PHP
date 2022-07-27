<?php

namespace App;

class TwoDimensionalArray
{
    /*4 - Двумерные массивы
    Как известно в PHP массивы одномерные. Классический способ задать двумерный массив - использовать массив в массиве.
*/

    //4.1 Реализовать класс представляющий собой двумерный массив.
    //__construct(int $a, int $b) - размеры массива
    //get(int $a, int $b): mixed
    //set(int $a, int $b, mixed $value)

    //4.2* Обогатить класс из прошлой задачи функцией each(callable $func(&$value))
    private array $array;

    public function __construct(public int $a, public int $b)
    {
        $array = [];
        for ($i = 0; $i < $a; $i++) {
            for ($j = 0; $j < $b; $j++) {
                $array[$i][$j] = null;
            }
        }
        $this->array = $array;
    }

    public function fillRandom(): void
    {
        foreach ($this->array as $i => $row) {
            foreach ($row as $j => $value) {
                $this->set($i, $j, mt_rand(0, 1000));
            }
        }
    }

    public function set(int $a, int $b, mixed $value)
    {
        if (!array_key_exists($a, $this->array) || !array_key_exists($b, $this->array)) {
            throw new \Exception('Cannot set element with a - ' . $a . ', b - ' . $b . '. Not found');
        }
        $this->array[$a][$b] = $value;
    }

    public function get(int $a, int $b): mixed
    {
        if (!array_key_exists($a, $this->array) || !array_key_exists($b, $this->array)) {
            throw new \Exception('Cannot get element with a - ' . $a . ', b - ' . $b . '. Not found');
        }
        return $this->array[$a][$b];
    }

    //4.2* Обогатить класс из прошлой задачи функцией each(callable $func(&$value))

    public function each(\Closure $func): void
    {
        //@todo implement
        $func($this->array);
    }

    //4.3* Обогатить класс из прошлой задачи генератором возвращающим ключ-значение для всех элементов двумерного массива
    public function values(): \Generator
    {
        foreach ($this->array as $i => $row) {
            foreach ($row as $j => $value) {
                yield [$i, $j] => $value;
            }
        }
    }

}
