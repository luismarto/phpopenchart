<?php

include_once 'common.php';

$chart = new \Phpopenchart\Chart\Pie([
    'title' => [
        'text' => 'User agents for www.example.com'
    ],
    'dataset' => [
        ["Mozilla Firefox (80)", 80],
        ["Konqueror (75)", 75],
        ["Opera (50)", 50],
        ["Safari (37)", 37],
        ["Dillo (37)", 37],
        ["Other (72)", 70],
    ]
]);

$chart->render("generated/demo3.png");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Phpopenchart pie chart demonstration</title>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
</head>
<body>
<img alt="Pie chart" src="generated/demo3.png" style="border: 1px solid gray;" />
</body>
</html>
