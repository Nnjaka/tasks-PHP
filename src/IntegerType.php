<?php

namespace App;

class IntegerType
{
    //6.3 While4◦ . Дано целое число N (> 0). Если оно является степенью числа 3, то вывести TRUE,
    // если не является — вывести FALSE.
    public function checkPowOfThree(int $number): bool
    {
        if($number < 3 || $number % 3 !== 0){
            return false;
        }

       while($number != 1){
           if($number % 3 !== 0){
               return false;
           }
           $number = $number / 3;
       }
       return true;
    }
}

