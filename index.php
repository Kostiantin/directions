<?php

require('vendor/autoload.php');

use KZ\DifferentDirections;
use KZ\Directions;

$filePath = dirname(__FILE__) . '/input_data.txt';

$file = new SplFileObject($filePath);

$differentDirections = new DifferentDirections($file, new Directions());


echo '<pre>';
print_r($differentDirections->__toString());
echo '</pre>';die;


