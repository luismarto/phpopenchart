<?php
//ini_set('display_errors', 1);
error_reporting(-1);

include "../vendor/autoload.php";

use Libchart\Chart\Column;
use Libchart\Chart\Bar;
use Libchart\Chart\Line;
use Libchart\Chart\Pie;

header("Content-type: image/png");

$chart = new Column([
    'width'  => 600,
    'height' => 300,
    'title'  => [
        'text' => 'Values',
        'size' => 14,
        'color' => '#666666',
        'height' => 26,
        'padding' => [15, 0, 15, 0]
    ],
    'dataset' => [
        ['Feb', 3296, '#cccccc'],
        ['asd', 0],
        ['Feb', 5015],
    ]
]);
$chart->render();

//$chart = (new Column([
//    'width'  => 600,
//    'height' => 300,
//    'title'  => [
//        'text' => 'Values',
//        'size' => 14,
//        'color' => '#666666',
//        'height' => 26,
//        'padding' => [15, 0, 15, 0]
//    ],
//    'dataset' => [
//        [
//            'points' => [
//                ['Feb', 3296, '#cccccc'],
//                ['asd', 0],
//                ['Feb', 5015],
//            ],
//            'name' => 'adasd'
//        ],
//        [
//            'points' => [
//                ['Feb', 12],
//                ['asd', 432],
//                ['Feb', 784],
//            ],
//            'name' => '12321'
//        ],
//    ]
//]))->render();

//$chart->render();
