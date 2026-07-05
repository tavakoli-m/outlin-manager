<?php

use Morilog\Jalali\Jalalian;

function convertPersianToEnglish(string $value): string
{
    $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    $arabic  = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
    $english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

    return str_replace(
        array_merge($persian, $arabic),
        array_merge($english, $english),
        $value
    );
}


function convertEnglishToPersian(string $number): string
{
    $number = str_replace('0', '۰', $number);
    $number = str_replace('1', '۱', $number);
    $number = str_replace('2', '۲', $number);
    $number = str_replace('3', '۳', $number);
    $number = str_replace('4', '۴', $number);
    $number = str_replace('5', '۵', $number);
    $number = str_replace('6', '۶', $number);
    $number = str_replace('7', '۷', $number);
    $number = str_replace('8', '۸', $number);
    $number = str_replace('9', '۹', $number);
    return $number;
}

function jalaliDate($date, $format = '%B %d، %Y')
{
    $date = Jalalian::forge($date)->format($format);
    return convertEnglishToPersian($date);
}
