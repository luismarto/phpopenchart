<?php
require_once '../common.php';

header("Content-type: image/png");

$chart = new Libchart\Chart\Line([
    'title' => [
        'text' => 'Sales for 2006'
    ],
    'dataset' => [
        ["06-01", 0],
        ["06-02", 0],
    ]
]);

$chart->render();
