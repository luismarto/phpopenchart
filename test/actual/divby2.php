<?php
require_once '../common.php';

header("Content-type: image/png");

$chart = new Libchart\Chart\Bar([
    'width' => 500,
    'height' => 250,
    'title' => [
        'text' => 'User agents for www.example.com'
    ],
    'dataset' => [
        ["Mozilla Firefox (0)", 0],
        ["Konqueror (0)", 0],
        ["Other (0)", 0],
    ]
]);

$chart->render();
