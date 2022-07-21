<?php

namespace App;

class SimpleArray
{
    /*1 - Одномерные массивы
    В рамках каждой задачи нужно реализовать функцию foo(array $data), где $data - какой-то массив с числовыми ключами.
    Допускается несколько вариантов решения.
    Некоторые задачи можно очень легко решить с помощью встроенных php функций, - я не против такого решения, но лучше
    сделать альтернативное решение на каких-то более универсальных приемах.

    Все массивы считаем неупорядоченными.
    Все массивы считаем содержащими один тип данных (int если в задаче не указано иное)
    */

    //1.1 Посчитать количество уникальных элементов массива
    public function getUniqueArrayItem1(array $data): int
    {
        return count(array_unique($data));
    }

    public function getUniqueArrayItem2(array $data): int
    {
        $newArray = [];
        foreach ($data as $key => $value){
            if(!key_exists($value, $newArray)){
                $newArray[$value] = 1;
            }
        }
        return count($newArray);
    }

    public function getUniqueArrayItem3(array $data): int
    {
        sort($data);
        $count = 0;
        $prevValue = 0;
        foreach ($data as $key => $value){
            if($value !=$prevValue){
                $count++;
                $prevValue = $value;
            } else {
                $prevValue = $value;
            }
        }

        return $count;
    }

    //1.2 Вывести самый часто встречающийся элемент массива и количество раз.
    //1.2.a если их несколько - вывести любой
    public function getPrevalentArrayAnyItem1(array $data)
    {
        $countElem = array_count_values($data);
        $maxElem = array_search(max($countElem), $countElem);

        return "Самый часто встречающийся элемент массива - $maxElem, количество раз - $countElem[$maxElem]";
    }

    public function getPrevalentArrayAnyItem2(array $data)
    {
        $array = [];
        foreach($data as $elem){
            if(!isset($array[$elem])){
                $array[$elem] = 1;
            } else {
                $array[$elem] += 1;
            }
        }

        $elem = array_search(max($array), $array);

        return "Самый часто встречающийся элемент массива - $elem, количество раз - $array[$elem]";
    }

    //1.2.b если их несколько - вывести все
    public function getPrevalentArrayAllItem(array $data)
    {
        $array = [];
        foreach($data as $elem){
            if(!isset($array[$elem])){
                $array[$elem] = 1;
            } else {
                $array[$elem] += 1;
            }
        }

        $maxCount = max($array);

        $array = array_filter($array, fn($key, $value) => $key == $maxCount, ARRAY_FILTER_USE_BOTH);
        $result = implode(', ', array_keys($array));

        return "Самый часто встречающиеся элементы массива - $result, количество раз - $maxCount";
    }

    //1.3 Вывести второй самый часто встречающийся элемент массива и количество раз
    public function getSecondPrevalentArrayItem(array $data){
        $array = [];
        foreach ($data as $elem){
            if(!isset($array[$elem])){
                $array[$elem] = 1;
            } else {
                $array[$elem] += 1;
            }
        }

        arsort($array);
        $maxElem = $array[array_key_first($array)];

        $result = [];
        foreach ($array as $key => $value){
            if($value == $maxElem || !empty($result)){
                continue;
            } else {
                $result[$key] = $value;
            }
        }

        return "Второй самый часто встречающийся элемент массива - ". key($result) . ", количество раз - " . current($result);
    }

    //1.4 Вывести разницу в количестве раз между самым частым и самым редким элементом массива
    //(пример: [1, 1, 1, 2, 2, 3, 3 , 4, 4 ,4, 5] - самый частый 3 раза, самый редкий 1 раз, разница итого 2)
    public function getDifferenceBetweenArrayElement(array $data)
    {
        $array = [];
        foreach ($data as $elem) {
            if (!isset($array[$elem])) {
                $array[$elem] = 1;
            } else {
                $array[$elem] += 1;
            }
        }

        arsort($array);

        $diff = $array[array_key_first($array)] - $array[array_key_last($array)];

        return "Cамый частый - ". $array[array_key_first($array)] ." раз, самый редкий - ". $array[array_key_last($array)] . " раз, разница итого - ". $diff;
    }
}