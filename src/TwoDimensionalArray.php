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
    public array $array;

    public function __construct(protected int $a, protected int $b)
    {
        $array = [];
        for($i=0; $i < $a; $i++){
            for($j=0; $j < $b; $j++){
                $array[$i][$j] = 0;
            }
        }

        $this->array = $array;
    }

    public function get(int $a, int $b): mixed
    {
        if(!array_key_exists($a, $this->array) || !array_key_exists($b, $this->array)){
            throw new \Exception('Cannot get element with a - ' . $a . ', b - ' . $b . '. Not found');
        }
        return $this->array[$a][$b];
    }

    public function set(int $a, int $b, mixed $value)
    {
        if(!array_key_exists($a, $this->array) || !array_key_exists($b, $this->array)){
            throw new \Exception('Cannot set element with a - ' . $a . ', b - ' . $b . '. Not found');
        }
        $this->array[$a][$b] = $value;
    }

    //4.2* Обогатить класс из прошлой задачи функцией each(callable $func(&$value))
    public function each(\Closure $func): mixed
    {
      return $func($this->array);
    }

    //4.3* Обогатить класс из прошлой задачи генератором возвращающим ключ-значение для всех элементов двумерного массива
    public function generateKeyValue(){
        $count = count($this->array);

        for($i=0; $i<$count; $i++){
            for($j=0; $j<count($this->array[$i]); $j++){
                yield ([implode(',',[$i,$j, $this->array[$i][$j]])]);
            }
        }
    }


    //4.4 Найти максимальное значение в двумерном массиве
    //4.4.a без использования доп функций
    public function getMaxValue()
    {
        $count = count($this->array);
        $max = 0;

        for($i=0; $i<$count; $i++){
            for($j=0; $j<count($this->array[$i]); $j++){
                if($this->array[$i][$j] > $max){
                    $max = $this->array[$i][$j];
                }
            }
        }

        return $max;
    }


}
