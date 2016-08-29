<?php

include_once 'common.php';

$chart = new Libchart\Chart\Bar([
    'width' => 600,
    'height' => 170,
    'title' => [
        'text' => "Most visited pages for www.example.com"
    ],
    'dataset' => [
        ["/wiki/Instant_messenger", 50],
        ["/wiki/Web_Browser", 75],
        ["/wiki/World_Wide_Web", 122],
    ]
]);

$chart->setGraphPadding(new \Libchart\Element\BasicPadding(5, 30, 20, 200));

$chart->render("generated/demo2.png");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Libchart horizontal bars demonstration</title>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
</head>
<body>
<img alt="Horizontal bars chart" src="generated/demo2.png" style="border: 1px solid gray;" />
</body>
</html>
