<?php
require_once '../common.php';

header("Content-type: image/png");

(new Libchart\Chart\Pie([
    'width' => 500,
    'height' => 250,
    'sort-data-point' => false,
    'title' => [
        'text' => 'This example preserves item order'
    ],
    'dataset' => [
        ["Item 1 (20)", 20],
        ["Item 2 (0)", 0],
        ["Item 3 (30)", 30],
        ["Item 4 (70)", 70],
    ]
]))->render();
