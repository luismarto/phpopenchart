<?php
require_once '../common.php';

$chart = new Libchart\Chart\Column([
    'chart' => [
        'width' => 500,
        'height' => 250,
    ],
    'point-label' => [
        'show' => false,
    ],
    'title' => [
        'text' => 'Monthly usage for www.example.com'
    ],
    'dataset' => [
        'labels' => ['Jan 2005', 'Feb 2005', 'Mar 2005', 'Apr 2005'],
        'data' => [273, 321, 442, 711]
    ]
]);
$chart->render();
