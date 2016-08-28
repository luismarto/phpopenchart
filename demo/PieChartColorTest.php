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
	 * Pie chart demonstration
	 *
	 */

	include "../vendor/autoload.php";

	$chart = new \Libchart\Chart\Pie();
	
	$chart->getPlot()->getPalette()->setPieColor(array(
		new \Libchart\Color\Color(255, 0, 0),
		new \Libchart\Color\Color(255, 255, 255)
	));

	$dataSet = new \Libchart\Data\XYDataSet();
	$dataSet->addPoint(new \Libchart\Data\Point("Amanita abrupta", 80));
	$dataSet->addPoint(new \Libchart\Data\Point("Amanita arocheae", 75));
	$dataSet->addPoint(new \Libchart\Data\Point("Clitocybe dealbata", 50));
	$dataSet->addPoint(new \Libchart\Data\Point("Cortinarius rubellus", 70));
	$dataSet->addPoint(new \Libchart\Data\Point("Gyromitra esculenta", 37));
	$dataSet->addPoint(new \Libchart\Data\Point("Lepiota castanea", 37));
	$chart->setDataSet($dataSet);

	$chart->setTitle("Deadly mushrooms");
	$chart->render("generated/pie_chart_color.png");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Libchart pie chart color demonstration</title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
</head>
<body>
	<img alt="Pie chart color test"  src="generated/pie_chart_color.png" style="border: 1px solid gray;"/>
</body>
</html>
