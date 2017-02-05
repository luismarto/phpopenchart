<?php
require_once '../common.php';

$chart = new Libchart\Chart\Column([
    'chart'   => [
        'width' => 500,
        'height' => 250,
    ],
    'title' => [
        'text' => 'Monthly usage for www.example.com'
    ],
    'dataset' => [
        'labels' => ['Jan 2005', 'Feb 2005', 'March 2005', 'April 2005'],
        'data' => [
            [273, new \Libchart\Color\Color(255, 0, 0)],
            [321, new \Libchart\Color\ColorHex('#2C46B5')],
            [442, '#7ED13B'],
            [711, '#F79647']
        ]
    ]
]);

$chart->render();
