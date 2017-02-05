<?php

include_once 'common.php';

$chart = new \Phpopenchart\Chart\Pie([
    'title' => [
        'text' => 'Deadly mushrooms'
    ],
    'dataset' => [
        ["Amanita abrupta", 80],
        ["Amanita arocheae", 75],
        ["Clitocybe dealbata", 50],
        ["Cortinarius rubellus", 70],
        ["Gyromitra esculenta", 37],
        ["Lepiota castanea", 37],
    ]
]);

$chart->getPalette()->setPieColor(array(
    new \Phpopenchart\Color\Color(255, 0, 0),
    new \Phpopenchart\Color\Color(255, 255, 255)
));

$chart->render("generated/pie_chart_color.png");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Phpopenchart pie chart color demonstration</title>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
</head>
<body>
<img alt="Pie chart color test" src="generated/pie_chart_color.png" style="border: 1px solid gray;" />
</body>
</html>
