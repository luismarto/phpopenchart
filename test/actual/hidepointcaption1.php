<?php
require_once '../common.php';

(new Libchart\Chart\Pie([
    'title' => [
        'text' => 'This is a pie'
    ],
    'point-label' => [
        'show' => false,
    ],
    'dataset' => [
        'labels' => ['Some part', 'Another part', 'Biggest part'],
        'data' => [20, 35, 70]
    ]
]))->render();
