<?php
require_once '../common.php';

header("Content-type: image/png");

(new Libchart\Chart\Column([
    'title' => [
        'text' => 'Monthly usage for www.example.com'
    ],
    'dataset' => [
        ["Jan 2005", 1],
        ["Feb 2005", 1],
        ["March 2005", 1],
        ["April 2005", 2.25],
        ["May 2005", 3.14156265],
        ["June 2005", 2.4],
        ["July 2005", 1],
    ]
]))->render();
