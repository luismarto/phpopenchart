<?php
require_once '../common.php';

header("Content-type: image/png");

// @todo: Maybe we should probably render the chart without points...
$chart = new Libchart\Chart\Line([
    'title' => [
        'text' => 'Sales for 2006'
    ],
    'dataset' => [
        [],
    ]
]);
$chart->render();
