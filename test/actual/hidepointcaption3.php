<?php
require_once '../common.php';

header("Content-type: image/png");

$chart = new Libchart\Chart\Column([
    'width' => 500,
    'height' => 250,
    'show-point-caption' => false,
    'title' => [
        'text' => 'Monthly usage for www.example.com'
    ],
    'dataset' => [
        ["Jan 2005", 273],
        ["Feb 2005", 321],
        ["Mar 2005", 442],
        ["Apr 2005", 711],
    ]
]);
$chart->render();
