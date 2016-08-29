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
        ["Mozilla Firefox (80)", 80],
        ["Konqueror (75)", 75],
        ["Other (50)", 50],
    ]
]))->render();
