<?php

include_once 'common.php';

$chart = new \Phpopenchart\Chart\Column([
    'title' => [
        'text' => "Average family income (k$)"
    ],
    'dataset' => [
        [
            'name' => '1990',
            'points' => [
                ["YT", 64],
                ["NT", 63],
                ["BC", 58],
                ["AB", 58],
                ["SK", 46],
            ]
        ],
        [
            'name' => '1995',
            'points' => [
                ["YT", 61],
                ["NT", 60],
                ["BC", 56],
                ["AB", 57],
                ["SK", 52],
            ]
        ],
    ]
]);
$chart->setGraphCaptionRatio(0.65);

$chart->render("generated/demo7.png");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Phpopenchart line demonstration</title>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
</head>
<body>
<img alt="Line chart" src="generated/demo7.png" style="border: 1px solid gray;" />
</body>
</html>
