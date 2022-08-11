<?php

namespace App;

class StringType
{
    /*3 - Строки*/

    //3.1 Определить является ли строка симметричной. “aba”, “abba” симметричные
    public function checkSymmetryString1(string $string): bool
    {
        $invertedString = strrev($string);
        return !strncmp($string, $invertedString, strlen($string));
    }

    public function checkSymmetryString2(string $string): bool
    {
        for($i=0; $i<strlen($string); $i++){
            if($string[$i] != $string[strlen($string)-1-$i]){
                return false;
            }
        }
        return true;
    }

    //3.2 Строка состоит из 6 цифр трамвайного билетика. Является ли он счастливым?
    public function checkLuckyTicket1(string $string): bool
    {
        $ticket = str_split($string);
        $sumLeft = array_sum(array_slice($ticket, 0, 3));
        $sumRight = array_sum(array_slice($ticket, 3, 3));
        if($sumLeft === $sumRight){
            return true;
        }
        return false;
    }

    public function checkLuckyTicket2(string $string): bool
    {
        if(((int)$string[0] + (int)$string[1] + (int)$string[2]) === ((int)$string[3] + (int)$string[4] + (int)$string[5])){
            return true;
        }
        return false;
    }

    //3.3 Сколько раз в строке встречается заданное слово.
    //3.3.a решить через трансформацию в массив
    public function getCountRepeatInStringThroughArray(string $string, string $word): int
    {
        $arrayWords = explode(' ', $string);

        $countRepeat = 0;
        for($i=0; $i<count($arrayWords); $i++){
            if($arrayWords[$i] == $word){
                $countRepeat++;
            }
        }

        return $countRepeat;
    }

    //3.3.b решить без массивов
    public function getCountRepeatInStringWithoutArray(string $string, string $word){
        return substr_count($string, $word);
    }

    //3.4 Четные и нечетные символы разделить по разным строкам
    //На вход qwerty, на выход qet и wry
    public function splitStringToEvenAndOddSymbols(string $word): array
    {
        $arrayOfString = mb_str_split($word);

        $evenSymbol = [];
        $oddSymbol = [];

        for($i=0; $i<count($arrayOfString); $i++){
            if(($i % 2) === 0){
                $evenSymbol[] = $arrayOfString[$i];
            } else {
                $oddSymbol[] = $arrayOfString[$i];
            }
        }

        return [implode($evenSymbol), implode($oddSymbol)];
    }

    //3.5 Вывести самый часто встречаемый символ в строке и количество раз
    public function getFrequentSymbol(string $word): array
    {
        $arrayOfString = mb_str_split($word);

        $arrayOfSymbols = [];
        foreach ($arrayOfString as $key => $symbol){
            if(!isset($arrayOfSymbols[$symbol])){
                $arrayOfSymbols[$symbol] = 1;
            } else {
                $arrayOfSymbols[$symbol] += 1;
            }
        }

        $elem = array_search(max($arrayOfSymbols), $arrayOfSymbols);

        return array_values([$elem, $arrayOfSymbols[$elem]]);
    }

    //3.6 Вывести 3 самых часто встречаемых символа в строке и количество раз для каждого
    public function getThreeSymbols(string $data): array
    {
        $arrayOfString = mb_str_split($data);

        $arrayOfSymbols = [];
        foreach ($arrayOfString as $key => $symbol){
            if(!isset($arrayOfSymbols[$symbol])){
                $arrayOfSymbols[$symbol] = 1;
            } else {
                $arrayOfSymbols[$symbol] += 1;
            }
        }

        arsort($arrayOfSymbols);

       return array_slice($arrayOfSymbols, 0, 3);
    }

    //3.7 https://leetcode.com/problems/palindrome-number/ - в решении допустимо использовать что угодно
    public function getPalindromeNumber(int $number): bool
    {
        if($number < 0){
            return false;
        }
        for($i=0; $i<strlen(strval($number)); $i++){
            if(strval($number)[$i] != strval($number)[strlen($number)-1-$i]){
                return false;
            }
        }
        return true;
    }

    //3.8** Вывести самую длинную подстроку которая повторяется в строке не менее двух раз.
    //По условиям задачи - такая подстрока существует и строго одна.
    //abababcccababccc - ответ abab
    public function getLongestSubstring(string $data): ?string
    {
        for($i=1; $i<strlen($data); $i++) {
            $substr = substr($data, 0, -$i);
            for ($j = 0; $j < strlen($data); $j++) {
                if (substr_count($data, $substr) > 1) {
                    return $substr;
                }
            }
        }
        return null;
    }

    //3.9(6.4) String49. Дана строка, состоящая из русских слов, набранных заглавными буквами и разделенных пробелами
    // (одним или несколькими). Преобразовать каждое слово в строке, заменив в нем все предыдущие вхождения его
    // последней буквы на символ «.» (точка). Например, слово «МИНИМУМ» надо преобразовать в «.ИНИ.УМ».
    // Количество пробелов между словами не изменять.
    //строку в массив не преобразовывать
    public function replaceAllPreviousOccurrences(string $string){
        $length = strlen($string) - 1;
        $firstSymbol = $string[$length];

        for($i = $length-1; $i>= 0; $i--){
            if($string[$i] !== ' ' && $string[$i+1] === ' '){
                $firstSymbol = $string[$i];
            } else if ($string[$i] === $firstSymbol){
                $string[$i] = '.';
            }
        }
        return $string;
    }

}