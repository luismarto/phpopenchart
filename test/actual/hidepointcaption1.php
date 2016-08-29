<?php
require_once '../common.php';

header("Content-type: image/png");

(new Libchart\Chart\Pie([
    'title' => [
        'text' => 'This is a pie'
    ],
    'show-point-caption' => false,
    'dataset' => [
        ["Some part", 20],
        ["Another part", 35],
        ["Biggest part", 70],
    ]
]))->render();
