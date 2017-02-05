<?php
require_once '../common.php';

(new Phpopenchart\Chart\Pie([
    'chart' => [
        'width' => 500,
        'height' => 250,
    ],
    'title' => [
        'text' => 'Sales for 2006'
    ],
    'dataset' => [
        'labels' => ['a (4872)', 'b (4774)', 'c (288)', 'd (18)', 'e (9)', 'f (0)', 'g (0)'],
        'data' => [4872, 4774, 288, 18, 9, 0, 0]
    ]
]))->render();
