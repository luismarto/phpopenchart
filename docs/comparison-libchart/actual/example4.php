<?php
require_once '../common.php';

$chart = new Phpopenchart\Chart\Line([
    'title' => [
        'text' => 'Sales for 2006'
    ],
    'dataset' => [
        'series' => ['Product 1', 'Product 2', 'Product 3', 'Product 4', 'Product 5'],
        'labels' => ['06-01', '06-02', '06-03', '06-04', '06-05', '06-06'],
        'data' => [
            [273, 421, 642, 799, 1009, 1106],
            [280, 300, 212, 542, 600, 850],
            [180, 400, 512, 642, 700, 900],
            [280, 500, 612, 742, 800, 1000],
            [380, 600, 712, 842, 900, 1200]
        ],
    ]
]);

$chart->render();
