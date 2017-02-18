<?php
require_once '../../common.php';

(new Phpopenchart\Chart\Pie([
    'chart'   => [
        'width' => 500,
        'height' => 250,
        'sort-data-point' => false,
    ],
    'title' => [
        'text' => 'This example preserves item order'
    ],
    'dataset'         => [
        'labels' => ['Item 1 (20)', 'Item 2 (0)', 'Item 3 (30)', 'Item 4 (70)'],
        'data'   => [20, 0, 30, 70]
    ]
]))->render();
