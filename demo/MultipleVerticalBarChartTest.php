<?php
/* Libchart - PHP chart library
 * Copyright (C) 2005-2011 Jean-Marc Tr�meaux (jm.tremeaux at gmail.com)
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

/**
 * Multiple horizontal bar chart demonstration.
 *
 */

include "../vendor/autoload.php";

$chart = new \Libchart\Chart\Column([
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
    <title>Libchart line demonstration</title>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
</head>
<body>
<img alt="Line chart" src="generated/demo7.png" style="border: 1px solid gray;" />
</body>
</html>
