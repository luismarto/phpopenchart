<?php
require_once '../common.php';

$chart = new Phpopenchart\Chart\Bar([
    'chart' => [
        'width' => 700,
        'height' => 170,
    ],
    'title' => [
        'text' => 'Most visited pages for www.example.com'
    ],
    'axis-label' => [
        'margin' => [
            'left' => -55,
        ]
    ],
    'dataset' => [
        'labels' => ['/wiki/Instant_messenger', '/wiki/Web_Browser', '/wiki/World_Wide_Web'],
        'data' => [50, 83, 142]
    ]
]);

$chart->setGraphPadding(new \Phpopenchart\Element\BasicPadding(5, 30, 20, 200));
$chart->render();
