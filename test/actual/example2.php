<?php
require_once '../common.php';

header("Content-type: image/png");

$chart = new Libchart\Chart\Bar([
    'width' => 500,
    'height' => 170,
    'title' => [
        'text' => 'Most visited pages for www.example.com'
    ],
    'dataset' => [
        ["/wiki/Instant_messenger", 50],
        ["/wiki/Web_Browser", 83],
        ["/wiki/World_Wide_Web", 142],
    ]
]);

$chart->setGraphPadding(new \Libchart\Element\BasicPadding(5, 30, 20, 200));
$chart->render();
