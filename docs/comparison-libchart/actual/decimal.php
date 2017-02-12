<?php
require_once '../common.php';

(new Phpopenchart\Chart\Column([
    'title' => [
        'text' => 'Monthly usage for www.example.com'
    ],
    'value-axis' => [
        'generator' => '\Phpopenchart\Label\DefaultLabel',
        'align' => [
            'horizontal' => 'left'
        ]
    ],
    'point-label' => [
        'generator' => '\Phpopenchart\Label\DefaultLabel',
    ],
    'dataset' => [
        'labels' => ['Jan 2005', 'Feb 2005', 'March 2005', 'April 2005', 'May 2005', 'June 2005', 'July 2005'],
        'data' => [1, 1, 1, 2.25, 3.14156265, 2.4, 1 ],
    ]
]))->render();
