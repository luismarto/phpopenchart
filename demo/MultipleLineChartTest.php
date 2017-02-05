<?php

include_once 'common.php';

$chart = new \Phpopenchart\Chart\Line([
    'title' => [
        'text' => "Sales for 2006"
    ],
    'dataset' => [
        [
            'name' => 'Product 1',
            'points' => [
                ["06-01", 273],
                ["06-02", 421],
                ["06-03", 642],
                ["06-04", 799],
                ["06-05", 1009],
                ["06-06", 1106],
            ],
        ],
        [
            'name' => 'Product 2',
            'points' => [
                ["06-01", 280],
                ["06-02", 300],
                ["06-03", 212],
                ["06-04", 542],
                ["06-05", 600],
                ["06-06", 850],
            ],
        ],
        [
            'name' => 'Product 3',
            'points' => [
                ["06-01", 180],
                ["06-02", 400],
                ["06-03", 512],
                ["06-04", 642],
                ["06-05", 700],
                ["06-06", 900],
            ],
        ],
        [
            'name' => 'Product 4',
            'points' => [
                ["06-01", 280],
                ["06-02", 500],
                ["06-03", 612],
                ["06-04", 742],
                ["06-05", 800],
                ["06-06", 1000],
            ],
        ],
        [
            'name' => 'Product 5',
            'points' => [
                ["06-01", 380],
                ["06-02", 600],
                ["06-03", 712],
                ["06-04", 842],
                ["06-05", 900],
                ["06-06", 1200],
            ],
        ],
    ]
]);

$chart->setGraphCaptionRatio(0.62);
$chart->render("generated/demo6.png");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Phpopenchart line demonstration</title>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
</head>
<body>
<img alt="Line chart" src="generated/demo6.png" style="border: 1px solid gray;" />
</body>
</html>
