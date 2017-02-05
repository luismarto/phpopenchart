<?php
require_once '../common.php';

(new Phpopenchart\Chart\Bar([
    'chart' => [
        'width' => 500,
        'height' => 250,
        'bar-padding' => [5, 30, 30, 75],
    ],
    'point-label' => [
        'show' => false,
    ],
    'axis-label' => [
        'margin' => [
            'left' => -10,
        ]
    ],
    'title' => [
        'text' => 'Monthly usage for www.example.com'
    ],
    'dataset' => [
        'labels' => ['Jan 2005', 'Feb 2005', 'Mar 2005', 'Apr 2005'],
        'data' => [273, 321, 442, 711]
    ]
]))->render();
