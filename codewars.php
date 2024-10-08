<?php
function countsheep($num)
{
    $murmur = '';
    for ($i = 1; $i <= $num; $i++) {
        if ($num === 0) $murmur .= '';
        else {
            $murmur .= "$i sheep...";
        }
    }
    return $murmur;
};

//echo countsheep(4);

function twice_as_old($dad_years_old, $son_years_old)
{
    return abs($dad_years_old - $son_years_old * 2);
}

//echo twice_as_old(55, 30);

function maps($x)
{
    return array_map(function ($num) {
        return $num * 2;
    }, $x);
}

function solution($nums)
{
    $nums = $nums ?? [];
    sort($nums);
    return $nums;
}

function createPhoneNumber(array $digits): string
{
    return sprintf("(%d%d%d) %d%d%d-%d%d%d%d", ...$digits);
}

function toWeirdCase($string)
{
    $str = str_split(strtolower($string));
    for ($n = 0; $n <= count($str); $n++) {
        if ($str[$n] != " ") {
            $str[$n] = strtoupper($str[$n]);
            $n = $n + 1;
        }
    }
    return implode("", $str);
}
