<?php

include_once 'common.php';

header("Content-type: image/png");

$chart = new \Libchart\Chart\Pie([
    'width' => 500,
    'height' => 300,
    'title' => [
        'text' => 'Preferred Cheese'
    ],
    'dataset' => [
        ["Bleu d'Auvergne", 50],
        ["Tomme de Savoie", 75],
        ["Crottin de Chavignol", 30],
    ]
]);

$chart->render();
