<?php
require_once '../../common.php';

(new Phpopenchart\Chart\Pie([
    'chart' => [
        'sort-data-point' => -1
    ],
    'title' => [
        'text' => 'This is a pie'
    ],
    'point-label' => [
        'show' => false,
    ],
    'dataset' => [
        'labels' => ['Some part', 'Another part', 'Biggest part'],
        'data' => [20, 35, 70]
    ]
]))->render();
