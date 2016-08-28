<?php
//ini_set('display_errors', 1);
error_reporting(-1);

include "../vendor/autoload.php";

use Libchart\Model\Point;
use Libchart\View\ChartVerticalBar;
use Libchart\Model\XYDataSet;

//$chart = new ChartVerticalBar(600, 300);
$chart = new \Libchart\View\ChartHorizontalBar(600, 300);
//$chart = new \Libchart\View\ChartLine(600, 300);
//$chart = new \Libchart\View\ChartPie(600, 300);
//$chart->getPlot()->setTitleColor(251, 128, 128);


//$chart = new VerticalBarChart(600, 300);

//$chart = new HorizontalBarChart(500, 300);

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

$chart->setTitle("Values");


header("Content-type: image/png");
$chart->render();
