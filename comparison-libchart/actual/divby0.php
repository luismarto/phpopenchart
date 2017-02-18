<?php
require_once '../../common.php';

(new Phpopenchart\Chart\Pie([
    'chart' => [
        'width' => 500,
        'height' => 250,
        'ratio' => 0.5
    ],
    'title' => [
        'text' => 'User agents for www.example.com'
    ],
    'dataset' => [
        'labels' => ['Mozilla Firefox (0)', 'Konqueror (0)', 'Other (0)'],
        'data' => [0, 0, 0]
    ]
]))->render();
