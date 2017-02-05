<?php
require_once '../common.php';

(new Libchart\Chart\Pie([
    'chart' => [
        'width' => 500,
        'height' => 250,
    ],
    'title' => [
        'text' => 'User agents for www.example.com'
    ],
    'dataset' => [
        'labels' => ['One (80)', 'Null', 'Two (50)', 'Three (70)'],
        'data' => [80, 0, 50, 70]
    ]
]))->render();
