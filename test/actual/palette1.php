<?php
require_once '../common.php';

header("Content-type: image/png");

$chart = new Libchart\Chart\Pie([
    'width' => 500,
    'height' => 250,
    'title' => [
        'text' => 'Deadly mushrooms'
    ],
    'dataset' => [
        ["Amanita abrupta", 80],
        ["Amanita arocheae", 75],
        ["Clitocybe dealbata", 50],
        ["Cortinarius rubellus", 70],
        ["Gyromitra esculenta", 37],
        ["Lepiota castanea", 37],
    ]
]);

$chart->getPalette()->setPieColor(array(
    new Libchart\Color\Color(255, 0, 0),
    new Libchart\Color\Color(255, 255, 255)
));

$chart->render();
