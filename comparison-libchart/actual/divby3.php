<?php
require_once '../../common.php';

$chart = new Phpopenchart\Chart\Line([
    'title' => [
        'text' => 'Sales for 2006'
    ],
    'dataset' => [
        'labels' => ['06-01', '06-02'],
        'data' => [0, 0]
    ]
]);

$chart->render();
