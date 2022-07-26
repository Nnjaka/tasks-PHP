<?php

namespace App;

use App\DTO\Car;
use App\Model\Model_avg_prices;
use App\Model\Model_prices;
use App\Model\Prices;

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
    /**
     * @param Car[] $data
     * @return Model_avg_prices[]
     */
    public function getModelAvgPrices(array $data): array
    {
        $cars = [];
        foreach ($data as $car) {
            $cars[$car->title][$car->model][] = $car->price;
        }


        $model_prices = [];
        foreach ($cars as $title => $models) {
            foreach ($models as $model => $prices) {
                $model_prices[] = new Model_avg_prices($title, $model, array_sum($prices) / count($prices));
            }
        }

        //my vision
        $tmp = [];
        foreach ($data as $car) {
            $key = join('|', [$car->title, $car->model,]);
            if (!isset($tmp[$key])) {
                $tmp[$key] = (object)['title' => $car->title, 'model' => $car->model, 'prices' => []];
            }
            $tmp[$key]->prices[] = $car->price;
        }
        $result = [];
        foreach ($tmp as $item) {
            $result[] = new Model_avg_prices($item->title, $item->model, array_sum($item->prices) / count($item->prices));
        }
        return $result;


        return $model_prices;
    }

    //2.2* Сформировать массив данных вида string title, string model, year_prices[]
    //где массив year_prices в качестве ключей имеет year, а в качестве значений - объекты вида
    // min(price), max(price), avg(price) в указанный год
    /*
     *
     *  [
     *     (object)[
     *        'title' => 'bmw',
     *        'model' => 'x7',
     *        'year_prices' => [
     *             2022 => (object)[ 'min' => 1000, 'max' => 2000, 'avg' => 1700, ],
     *             2021 => (object)[ 'min' =>  900, 'max' => 2100, 'avg' => 1100, ],
     *             ...
     *         ]
     *     ],
     *     ...
     *  ]
     *
     *
//@todo fixme неправильно понятая задача
    */
    public function getModelPrices(array $data): array
    {
        $cars = [];
        foreach ($data as $key => $car) {
            $cars[$car->title][$car->model][$car->year]['prices'][] = $car->price;
            if (!isset($cars[$car->title][$car->model][$car->year]['min_price'])) {
                $cars[$car->title][$car->model][$car->year]['min_price'] = $car->price;
            } else {
                if ($car->price < $cars[$car->title][$car->model][$car->year]['min_price']) {
                    $cars[$car->title][$car->model][$car->year]['min_price'] = $car->price;
                }
            }
            if (!isset($cars[$car->title][$car->model][$car->year]['max_price'])) {
                $cars[$car->title][$car->model][$car->year]['max_price'] = $car->price;
            } else {
                if ($car->price > $cars[$car->title][$car->model][$car->year]['max_price']) {
                    $cars[$car->title][$car->model][$car->year]['max_price'] = $car->price;
                }
            }
        }

        $model_prices = [];
        foreach ($cars as $title => $models) {
            foreach ($models as $model => $years) {
                foreach ($years as $prices) {
                    $model_prices[] = new Model_prices($title, $model, new Prices(
                        $prices['min_price'],
                        $prices['max_price'],
                        array_sum($prices['prices']) / count($prices['prices'])
                    ));
                }
            }
        }

        return $model_prices;
    }

    /**
     * @param Car[] $data
     * @return array
     */
    public function getModelPrices2(array $data)
    {
        $cars = [];
        foreach ($data as $car) {
            $key = join('|', [$car->title, $car->model, $car->year,]);

            $cars[$key]['prices'][] = $car->price;
            if (!isset($cars[$key]['min_price'])) {
                $cars[$key]['min_price'] = $car->price;
            } else {
                if ($car->price < $cars[$key]['min_price']) {
                    $cars[$key]['min_price'] = $car->price;
                }
            }
            if (!isset($cars[$key]['max_price'])) {
                $cars[$key]['max_price'] = $car->price;
            } else {
                if ($car->price > $cars[$key]['max_price']) {
                    $cars[$key]['max_price'] = $car->price;
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
