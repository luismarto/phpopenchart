<?php
require_once '../../common.php';

$chart = new Phpopenchart\Chart\Column([
    'chart' => [
        'width' => 500,
        'height' => 250,
    ],
    'title' => [
        'text' => 'User agents for www.example.com'
    ],
    'dataset' => [
        'labels' => ['Mozilla Firefox (0)', 'Konqueror (0)', 'Other (0)'],
        'data' => [0, 0, 0]
    ]
]);

$chart->render();
