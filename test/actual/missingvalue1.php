<?php
require_once '../common.php';

header("Content-type: image/png");

(new Libchart\Chart\Pie([
    'width' => 500,
    'height' => 250,
    'title' => [
        'text' => 'User agents for www.example.com'
    ],
    'dataset' => [
        ["One (80)", 80],
        ["Null", 0],
        ["Two (50)", 50],
        ["Three (70)", 70],
    ]
]))->render();
