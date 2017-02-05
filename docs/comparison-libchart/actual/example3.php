<?php
require_once '../common.php';

(new Phpopenchart\Chart\Pie([
    'chart' => [
        'width' => 500,
        'height' => 250,
    ],
    'title' => [
        'text' => 'User agents for www.example.com'
    ],
    'dataset' => [
        'labels' => ['Mozilla Firefox (80)', 'Konqueror (75)', 'Other (50)'],
        'data' => [80, 75, 50]
    ]
]))->render();
