<?php
require_once '../common.php';

(new \Phpopenchart\Chart\Column([
    'chart' => [
        'width'  => 800,
        'height' => 300,
        'column-padding' => [5, 30, 30, 30],
    ],
    'title'  => [
        'text' => 'Monthly values',
    ],
    'dataset' => [
        'series' => ['Apartments', 'Houses', 'Hotels'],
        'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        'data'   => [
            [15480, 9048, 6541, 2354, 7415, 8745, 3154],
            [3296, 1564, 845, 4578, 2164, 3658, 1145],
            [152, 97, 154, 385, 80, 648, 54],
        ],
    ]
]))->render();
