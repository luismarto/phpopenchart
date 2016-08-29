<?php

include_once 'common.php';

$chart = (new \Libchart\Chart\Column([
    'title' => [
        'text' => 'Monthly usage for www.example.com'
    ],
    'dataset' => [
        ["Jan 2005", 273],
        ["Feb 2005", 421],
        ["March 2005", 642],
        ["April 2005", 800],
        ["May 2005", 1200],
        ["June 2005", 1500],
        ["July 2005", 2600],
    ]
]))->render("generated/demo1.png");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Libchart vertical bars demonstration</title>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
</head>
<body>
<img alt="Vertical bars chart" src="generated/demo1.png" style="border: 1px solid gray;" />
</body>
</html>
