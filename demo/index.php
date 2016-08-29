<?php
//ini_set('display_errors', 1);
error_reporting(-1);

include "../vendor/autoload.php";

use Libchart\Data\Point;
use Libchart\Data\XYDataSet;

header("Content-type: image/png");

$chart = new \Libchart\Chart\Column(600, 300);
//$chart = new \Libchart\Chart\Bar(600, 300);
//$chart = new \Libchart\Chart\Line(600, 300);
//$chart = new \Libchart\Chart\Pie(600, 300);
//$chart->getPlot()->setTitleColor(251, 128, 128);


//$chart = new VerticalBarChart(600, 300);

//$chart = new Bar(500, 300);

//$dataSet->addPoint(new Point("Fev", 79902));
//$dataSet->addPoint(new Point("Fev", 102543));
$dataSet = new XYDataSet();
$dataSet->addPoint(new Point("Feb", 3296));
$dataSet->addPoint(new Point("Feb", 5015));
//$dataSet->addPoint(new Point("Mar", -1816, '#44aa99'));
//$dataSet->addPoint(new Point("2015", 4637120));
//$dataSet->addPoint(new Point("2016", 7282117));
//$chart->getPlot()->setBarLabelGenerator(new \Libchart\Label\EurCurrencyFormatter());
$chart->setDataSet($dataSet);


//$chart->setTitleColor(51, 51, 156);
//$chart->setTitleColorHex('#333333');

$chart->getTitle()->setText("Values");
$chart->getText()->setColorHex('#33333');
$chart->render();

$chart = new \Libchart\Chart\Bar(600, 300);
$dataSet = new XYDataSet();
$dataSet->addPoint(new Point("Feb", 3296));
$dataSet->addPoint(new Point("Feb", 5015));
$chart->setDataSet($dataSet);


$chart->getTitle()->setText("Values");

$chart->render();