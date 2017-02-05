<?php
require_once '../common.php';

(new Libchart\Chart\Pie([
    'chart'   => [
        'width'           => 600,
        'height'          => 250,
        'sort-data-point' => false,
    ],
    'title'   => [
        'text' => 'This example preserves item order'
    ],
    'dataset' => [
        'labels' => ['Item 1 (20)', 'Item 2 (50)', 'Item 3 (30)', 'Item 4 (70)'],
        'data'   => [20, 50, 30, 70]
    ]
]))->render();
