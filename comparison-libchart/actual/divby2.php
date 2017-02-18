<?php
require_once '../../common.php';

$chart = new Phpopenchart\Chart\Bar([
    'chart'      => [
        'width'       => 600,
        'height'      => 250,
        'bar-padding' => [5, 30, 30, 125],
    ],
    'label-axis' => [
        'align' => [
            'horizontal' => 'left'
        ]
    ],
    'title'      => [
        'text' => 'User agents for www.example.com'
    ],
    'dataset'    => [
        'labels' => ['Mozilla Firefox (0)', 'Konqueror (0)', 'Other (0)'],
        'data'   => [0, 0, 0]
    ]
]);

$chart->render();
