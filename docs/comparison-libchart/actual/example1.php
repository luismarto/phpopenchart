<?php
require_once '../common.php';

(new Phpopenchart\Chart\Column([
    'chart' => [
        'width' => 500,
        'height' => 250,
        'sort-data-point' => 1
    ],
    'title' => [
        'text' => 'Monthly usage for www.example.com'
    ],
    'dataset' => [
        'labels' => ['Jan 2005', 'April 2005', 'March 2005', 'Feb 2005'],
        'data' => [273, 711, 442, 321],
    ]
]))->render();
