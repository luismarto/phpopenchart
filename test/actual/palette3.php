<?php
require_once '../common.php';

header("Content-type: image/png");

$chart = new Libchart\Chart\Column([
    'width' => 500,
    'height' => 250,
    'use-multiple-color' => true,
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

$chart->getPalette()->setBarColor(array(
    new \Libchart\Color\Color(255, 0, 0),
    new \Libchart\Color\Color(44, 70, 181),
    new \Libchart\Color\Color(126, 209, 59),
    new \Libchart\Color\Color(247, 150, 71)
));

$chart->render();
