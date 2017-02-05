<?php
require_once '../common.php';

$chart = new Libchart\Chart\Line([
    'title' => [
        'text' => 'Sales for 2006'
    ],
    'dataset' => [
        [],
    ]
]);
$chart->render();
