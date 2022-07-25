<?php

namespace App;

use App\Model\Model_avg_prices;
use App\Model\Model_prices;
use App\Model\Prices;
use function PHPUnit\Framework\isEmpty;

class ArrayObject
{
    /*2 - Массивы объектов
    В рамках каждой задачи нужно реализовать функцию foo(array $data), где $data - массив из stdClass.
    Структура каждого элемента одинакова, пример ниже
        {
            "title":"bmw",
            "model":"x7",
            "year":2022,
            "number":"x777xx777",
            "price":10000000
        }
    Все массивы считаем неупорядоченными.
*/

    //2.1 Сформировать массив данных model_prices[], где каждый элемент массива это
    // объект вида string title, string model, float avg(price)
    public function getModelAvgPrices(array $data): array
    {
        $cars = [];
        foreach($data as $key => $car){
            $cars[$car->title][$car->model]['prices'][] = $car->price;
        }

        $model_prices = [];
        foreach($cars as $title => $models){
            foreach ($models as $model => $property) {
                $model_prices[] = new Model_avg_prices($title, $model, (array_sum($property['prices'])/count($property['prices'])));
            }
        }
        return $model_prices;
    }

    //2.2* Сформировать массив данных вида string title, string model, year_prices[]
    //где массив year_prices в качестве ключей имеет year, а в качестве значений - объекты вида
    // min(price), max(price), avg(price) в указанный год
    public function getModelPrices(array $data): array
    {
        $cars = [];
        foreach($data as $key => $car){
            $cars[$car->title][$car->model][$car->year]['prices'][] = $car->price;
            if(!isset($cars[$car->title][$car->model][$car->year]['min_price'])){
                $cars[$car->title][$car->model][$car->year]['min_price'] = $car->price;
            } else{
                if($car->price < $cars[$car->title][$car->model][$car->year]['min_price']){
                    $cars[$car->title][$car->model][$car->year]['min_price'] = $car->price;
                }
            }
            if(!isset($cars[$car->title][$car->model][$car->year]['max_price'])){
                $cars[$car->title][$car->model][$car->year]['max_price'] = $car->price;
            } else{
                if($car->price > $cars[$car->title][$car->model][$car->year]['max_price']){
                    $cars[$car->title][$car->model][$car->year]['max_price'] = $car->price;
                }
            }
        }

        $model_prices = [];
        foreach ($cars as $title => $models) {
            foreach ($models as $model => $years) {
                foreach ($years as $prices){
                    $model_prices[] = new Model_prices($title, $model, new Prices(
                        $prices['min_price'],
                        $prices['max_price'],
                        array_sum($prices['prices'])/count($prices['prices'])
                    ));
                }
            }
        }

      return $model_prices;
    }

    public function getModelPrices2(array $data)
    {
        $cars = [];
        foreach ($data as $key => $car) {
            $cars[$car->title . ',' . $car->model . ',' . $car->year]['prices'][] = $car->price;
            if (!isset($cars[$car->title . ',' . $car->model . ',' . $car->year]['min_price'])) {
                $cars[$car->title . ',' . $car->model . ',' . $car->year]['min_price'] = $car->price;
            } else {
                if ($car->price < $cars[$car->title . ',' . $car->model . ',' . $car->year]['min_price']) {
                    $cars[$car->title . ',' . $car->model . ',' . $car->year]['min_price'] = $car->price;
                }
            }
            if (!isset($cars[$car->title . ',' . $car->model . ',' . $car->year]['max_price'])) {
                $cars[$car->title . ',' . $car->model . ',' . $car->year]['max_price'] = $car->price;
            } else {
                if ($car->price > $cars[$car->title . ',' . $car->model . ',' . $car->year]['max_price']) {
                    $cars[$car->title . ',' . $car->model . ',' . $car->year]['max_price'] = $car->price;
                }
            }
        }


        $model_prices = [];
        foreach ($cars as $model => $prices) {
            $car = explode(',', $model);
            $model_prices[] = new Model_prices($car[0], $car[1], new Prices(
                $prices['min_price'],
                $prices['max_price'],
                array_sum($prices['prices']) / count($prices['prices'])
            ));
        }

        return $model_prices;
    }
}
