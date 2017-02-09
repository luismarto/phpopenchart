<?php
require_once '../common.php';

$chart = new Phpopenchart\Chart\Bar([
    'chart'      => [
        'width'       => 700,
        'height'      => 170,
        'bar-padding' => [5, 30, 20, 200],
    ],
    'title'      => [
        'text' => 'Most visited pages for www.example.com'
    ],
    'label-axis' => [
        'align' => [
            'horizontal' => 'left'
        ]
    ],
    'dataset'    => [
        'labels' => ['/wiki/Instant_messenger', '/wiki/Web_Browser', '/wiki/World_Wide_Web'],
        'data'   => [50, 83, 142]
    ]
]);

$chart->render();
