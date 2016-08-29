<?php
//ini_set('display_errors', 1);
error_reporting(-1);

include "../vendor/autoload.php";

use Libchart\Chart\Column;
use Libchart\Chart\Bar;
use Libchart\Chart\Line;
use Libchart\Chart\Pie;
use Libchart\Data\XYDataSet;

header("Content-type: image/png");

$chart = new Column([
    'width'  => 600,
    'height' => 300,
    'title'  => [
        'text' => 'Values',
        'size' => 14,
        'color' => '#666666',
        'height' => 26,
        'padding' => [15, 0, 15, 0]
    ]
]);

//$chart = new VerticalBarChart(600, 300);

//$chart = new Bar(500, 300);

//$dataSet->addPoint(new Point("Fev", 79902));
//$dataSet->addPoint(new Point("Fev", 102543));
$dataSet = new XYDataSet([
    ['Feb', 3296],
    ['asd', 0],
    ['Feb', 5015],
]);
//$dataSet->addPoint(new Point("Mar", -1816, '#44aa99'));
//$dataSet->addPoint(new Point("2015", 4637120));
//$dataSet->addPoint(new Point("2016", 7282117));
//$chart->getPlot()->setBarLabelGenerator(new \Libchart\Label\EurCurrencyFormatter());
$chart->setDataSet($dataSet);

$chart->render();
