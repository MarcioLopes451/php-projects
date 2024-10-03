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

echo countsheep(4);
