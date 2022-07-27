<?php

namespace App;

class Different
{
    //5.1  Определить вероятность получения счастливого трамвайного билетика (6 цифр)
    public function getProbabilityLuckyTicket(): int
    {
        $count = 0;
        for($left=0; $left<=999; $left++){
            for($right=0; $right<=999; $right++){
                if(
                    floor($left / 100) + floor($left % 100 / 10) + floor($left % 10) ==
                    floor($right / 100) + floor($right % 100 / 10) + floor($right % 10)
                ){
                    $count++;
                }
            }
        }

    $result = round($count/999999*100, 2);
    return $result;
    }
}