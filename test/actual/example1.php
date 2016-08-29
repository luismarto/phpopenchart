<?php
require_once '../common.php';

header("Content-type: image/png");

(new Libchart\Chart\Column([
    'width' => 500,
    'height' => 250,
    'title' => [
        'text' => 'Monthly usage for www.example.com'
    ],
    'dataset' => [
        ["Jan 2005", 273],
        ["Feb 2005", 321],
        ["March 2005", 442],
        ["April 2005", 711],
    ]
]))->render();
