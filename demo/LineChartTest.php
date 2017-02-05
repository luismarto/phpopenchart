<?php

include_once 'common.php';

$chart = new \Phpopenchart\Chart\Line([
    'title' => [
        'text' => "Sales for 2006"
    ],
    'dataset' => [
        ["06-01", 273],
        ["06-02", 421],
        ["06-03", 642],
        ["06-04", 799],
        ["06-05", 1009],
        ["06-06", 1406],
        ["06-07", 1820],
        ["06-08", 2511],
        ["06-09", 2832],
        ["06-10", 3550],
        ["06-11", 4143],
        ["06-12", 4715],
    ]
]);

$chart->render("generated/demo5.png");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Phpopenchart line demonstration</title>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
</head>
<body>
<img alt="Line chart" src="generated/demo5.png" style="border: 1px solid gray;" />
</body>
</html>
