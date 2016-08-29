<?php
require_once '../common.php';

header("Content-type: image/png");

// @todo: Maybe we should probably render the chart without points...
$chart = new Libchart\Chart\Column([
    'width' => 500,
    'height' => 250,
    'title' => [
        'text' => 'User agents for www.example.com'
    ],
    'dataset' => [
        [],
    ]
]);
$chart->render();
