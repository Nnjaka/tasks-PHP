<?php

namespace App;

use function PHPUnit\Framework\isEmpty;

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
    public function getPrevalentArrayAnyItem1(array $data): string
    {
        $countElem = array_count_values($data);
        $maxElem = array_search(max($countElem), $countElem);

        return "Самый часто встречающийся элемент массива - " . $maxElem . ", количество раз - " . $countElem[$maxElem];
    }

    public function getPrevalentArrayAnyItem2(array $data): string
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

        return "Самый часто встречающийся элемент массива - " . $elem . ", количество раз - " . $array[$elem];
    }

    //1.2.b если их несколько - вывести все
    public function getPrevalentArrayAllItem(array $data): string
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

        return "Самый часто встречающиеся элементы массива - " . $result . ", количество раз - " . $maxCount;
    }

    //1.3 Вывести второй самый часто встречающийся элемент массива и количество раз
    public function getSecondPrevalentArrayItem(array $data): string
    {
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
    public function getDifferenceBetweenArrayElement(array $data): string
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

    //1.5 В массиве содержащем только уникальные цифры вывести значение следующее за максимальным
    //(пример 1, 3, 4, 10, 2, 88. max = 88 следующий за ним 10)
    public function getNextValueToMax1(array $data): int
    {
        sort($data);
        array_pop($data);

        return array_pop($data);
    }

    public function getNextValueToMax2(array $data): int
    {
        rsort($data);
        $result = array_slice($data, 1, 1);

        return ($result[0]);
    }

    public function getNextValueToMax3(array $data): int
    {
       $maxValue = max($data);
       $secondMaxValue = 0;
       foreach ($data as $elem){
           if($elem != $maxValue && $elem > $secondMaxValue){
               $secondMaxValue = $elem;
           }
       }

        return $secondMaxValue;
    }

    //1.6 Вывести количество элементов массива у которых предыдущий элемент меньше текущего
    public function getCountPrevElemLessThanCurrent(array $data): int
    {
        $count = 0;
        $prevValue = null;

        foreach($data as $elem){
            if(is_null($prevValue)){
                $prevValue = $elem;
                continue;
            }
            if($elem > $prevValue){
                $count++;
                $prevValue = $elem;
            }
        }

        return $count;
    }

    //1.7 https://leetcode.com/problems/two-sum/ - в решении допустимо использовать что угодно
    public function getTwoSum(array $data, int $target): array
    {
        $result = [];
        $findValue = null;
        foreach($data as $keyFirstElem => $valueFirstElem) {
            if ($valueFirstElem > $target) {
                continue;
            } else {
                $findValue = $target - $valueFirstElem;
                foreach ($data as $keySecondElem => $valueSecondElem) {
                    if(!empty($result) || $valueSecondElem !== $findValue || $keyFirstElem === $keySecondElem){
                        continue;
                    } else {
                        $result = [$keyFirstElem, $keySecondElem];
                    }
                }
            }
        }

        return $result;
    }

    //1.8** https://leetcode.com/problems/search-insert-position/ - в решении допустимо использовать что угодно.
    // (сложность задачи - написать алгоритм O(log N). Для начала можно написать O(N))
    //1.8.a - сложность O(N)
    public function getSearchInsertPosition1(array $data, int $target): int
    {
        $result = null;
        $prevKey = null;

        foreach ($data as $key => $value) {
            if($value > $target){
                break;
            } elseif ($value == $target) {
                $result = $key;
                break;
            } else {
                $prevKey = $key;
            }
        }

        return $result ?? ++$prevKey;
    }

    //1.8.b - сложность O(log N)


}
