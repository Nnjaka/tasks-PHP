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

    public function __construct(public int $rows, public int $cells)
    {
        $array = [];
        for ($i = 0; $i < $this->rows; $i++) {
            for ($j = 0; $j < $this->cells; $j++) {
                $array[$i][$j] = null;
            }
        }
        $this->array = $array;
    }

    public function fillRandom(): void
    {
        $this->each(function (&$value) {
            $value = mt_rand(0, 1000);
            return $value;
        });
    }

    public function set(int $row, int $cell, mixed $value)
    {
        if (!array_key_exists($row, $this->array) || !array_key_exists($cell, $this->array)) {
            throw new \Exception('Cannot set element with row - ' . $row . ', cell - ' . $cell . '. Not found');
        }
        $this->array[$row][$cell] = $value;
    }

    public function get(int $row, int $cell): mixed
    {
        if (!array_key_exists($row, $this->array) || !array_key_exists($cell, $this->array)) {
            throw new \Exception('Cannot get element with a - ' . $row . ', b - ' . $cell . '. Not found');
        }
        return $this->array[$row][$cell];
    }

    //4.2* Обогатить класс из прошлой задачи функцией each(callable $func(&$value))
    public function each(\Closure $func): void
    {
        foreach ($this->array as $i => $row) {
            foreach ($row as $j => $value) {
                $newValue = $func($value);
                $this->set($i, $j, $newValue);
            }
        }
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

//4.4 Найти максимальное значение в двумерном массиве
//4.4.a без использования доп функций двумерного массива
function getMaxValue(): int
{
    $rows = 3;
    $cells = 3;
    $maxValue = 0;

    $objArray = new TwoDimensionalArray($rows, $cells);
    $objArray->fillRandom();

    for($i=0; $i<$rows; $i++){
        for ($j=0; $j<$cells; $j++){
            if($objArray->get($i, $j) > $maxValue){
                $maxValue = $objArray->get($i, $j);
            }
        }
    }

   return $maxValue;
}

//4.4.b с использованием each
function getMaxValueWithEach()
{
    $maxValue = 0;

    $objArray = new TwoDimensionalArray(3, 3);
    $objArray->fillRandom();

    $objArray->each(function($value) use (&$maxValue) {
        if($value > $maxValue){
            $maxValue = $value;
        }
        return  $value;
    });

    return $maxValue;
}

//4.4.c с использованием генератора
function getMaxValueWithGenerator(): int
{
    $maxValue = 0;

    $objArray = new TwoDimensionalArray(3, 3);
    $objArray->fillRandom();

    foreach($objArray->values() as $value){
        if($value > $maxValue){
            $maxValue = $value;
        }
    };

    return $maxValue;
}

//4.4 Найти сумму элементов центральной диагонали (Наш массив квадратный)
function getSumElemOfcentralDiagonal(): int
{
    $size = 2;
    $sumElem= 0;

    $objArray = new TwoDimensionalArray($size, $size);
    $objArray->fillRandom();

    for($i=0; $i<$size; $i++){
        $sumElem += $objArray->get($i, $i);
    }

    return $sumElem;
}