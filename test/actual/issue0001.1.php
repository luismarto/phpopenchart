<?php
require_once '../common.php';

header("Content-type: image/png");

(new Libchart\Chart\Pie([
    'width' => 500,
    'height' => 250,
    'title' => [
        'text' => 'Sales for 2006'
    ],
    'dataset' => [
        ["a (4872)", 4872],
        ["b (4774)", 4774],
        ["c (288)", 288],
        ["d (18)", 18],
        ["e (9)", 9],
        ["f (0)", 0],
        ["g (0)", 0],
    ]
]))->render();
