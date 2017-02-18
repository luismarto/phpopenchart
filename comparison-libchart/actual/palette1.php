<?php
require_once '../../common.php';

$chart = new Phpopenchart\Chart\Pie([
    'chart'   => [
        'width' => 500,
        'height' => 250,
        'ratio' => 0.5
    ],
    'title'   => [
        'text' => 'Deadly mushrooms'
    ],
    'dataset' => [
        'labels' => [
            'Amanita abrupta',
            'Amanita arocheae',
            'Cortinarius rubellus',
            'Clitocybe dealbata',
            'Gyromitra esculenta',
            'Lepiota castanea'
        ],
        'data'   => [
            [80, '#FF0000'],
            [75, '#ffffff'],
            [70, '#FF0000'],
            [50, '#ffffff'],
            [37, '#FF0000'],
            [36, '#ffffff']
        ],
    ]
]);

$chart->render();
