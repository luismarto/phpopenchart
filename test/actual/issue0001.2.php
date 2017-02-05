<?php
require_once '../common.php';

(new Libchart\Chart\Pie([
    'dataset' => [
        'labels' => [
            'Windows XP',
            'Windows Vista',
            'Linux',
            'Mac OS X',
            'Windows 2003',
            'Windows 2000',
            'Windows Server 2008',
            'Windows 7',
            'SunOS'
        ],
        'data' => [
            '751',
            '342',
            '277',
            '267',
            '65',
            '9',
            '8',
            '4',
            '3'
        ]
    ]
]))->render();
