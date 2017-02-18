<?php
require_once '../../common.php';

(new Phpopenchart\Chart\Line([
    'title' => [
        'text' => 'Net migration'
    ],
    'dataset' => [
        'labels' => ['2000', '2001', '2002', '2003', '2004', '2005'],
        'data' => [780, 200, -100, 0, -550, -300]
    ]
]))->render();
