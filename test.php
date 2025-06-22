<?php


require 'vendor/autoload.php';

use RidiumFramework\Support\Arr\Arr;


$array = [1, 3, 5, 8, 9];

$hasEven = Arr::some($array, function ($value) {
    return $value % 2 === 0;
});

var_dump($hasEven); // true, because 8 is even