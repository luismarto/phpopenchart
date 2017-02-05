<?php
require_once '../common.php';

$chart = new Phpopenchart\Chart\Bar([
    'chart'   => [
        'width' => 500,
        'height' => 250,
        'bar-padding' => [5, 30, 30, 75],
    ],
    'title' => [
        'text' => 'Monthly usage for www.example.com'
    ],
    'axis-label' => [
        'margin' => [
            'left' => -10,
        ]
    ],
    'dataset' => [
        'labels' => ['Jan 2005', 'Feb 2005', 'March 2005', 'April 2005'],
        'data' => [
            [273, new \Phpopenchart\Color\Color(255, 0, 0)],
            [321, new \Phpopenchart\Color\ColorHex('#2C46B5')],
            [442, '#7ED13B'],
            [711, '#F79647']
        ]
    ]
]);

$chart->render();
