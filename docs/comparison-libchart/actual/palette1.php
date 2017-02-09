<?php
require_once '../common.php';

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
            'Clitocybe dealbata',
            'Cortinarius rubellus',
            'Gyromitra esculenta',
            'Lepiota castanea'
        ],
        'data'   => [80, 75, 50, 70, 37, 37]
    ]
]);

// @todo: Beware, this might be removed later on amd colors will be setted directly on the points
// as in palette2.php or pal
$chart->getPalette()->setPieColor(array(
    new Phpopenchart\Color\Color(255, 0, 0),
    new Phpopenchart\Color\Color(255, 255, 255)
));

$chart->render();
