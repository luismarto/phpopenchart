<?php
require_once '../common.php';

header("Content-type: image/png");

(new Libchart\Chart\Column([
    'title' => [
        'text' => 'Net migration'
    ],
    'dataset' => [
        ["2000", 780],
        ["2001", 200],
        ["2002", -100],
        ["2003", 0],
        ["2004", -550],
        ["2005", -300],
    ]
]))->render();
