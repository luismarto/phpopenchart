<?php
require_once '../../common.php';

$chart = new Phpopenchart\Chart\Line([
    'title' => [
        'text' => 'Sales for 2006'
    ],
    'dataset' => [
        [],
    ]
]);
$chart->render();
