<?php

include_once 'common.php';

$chart = new Libchart\Chart\Bar([
    'width' => 450,
    'height' => 250,
    'title' => [
        'text' => "Firefox vs IE users: Age"
    ],
    'dataset' => [
        [
            'name' => 'Male',
            'points' => [
                ["18-24", 22],
                ["25-34", 17],
                ["35-44", 20],
                ["45-54", 25],
            ]
        ],
        [
            'name' => 'Female',
            'points' => [
                ["18-24", 13],
                ["25-34", 18],
                ["35-44", 23],
                ["45-54", 22],
            ]
        ],
    ]
]);
$chart->render("generated/demo8.png");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Libchart line demonstration</title>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
</head>
<body>
<img alt="Line chart" src="generated/demo8.png" style="border: 1px solid gray;" />
</body>
</html>
