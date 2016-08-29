<?php
require_once '../common.php';

class ThousandLabelGenerator implements \Libchart\Label\LabelInterface
{
    public function generateLabel($value)
    {
        return ((int)($value / 1000)) . "k";
    }
}

header("Content-type: image/png");

$chart = new Libchart\Chart\Bar([
    'width' => 500,
    'height' => 200,
    'title' => [
        'text' => 'Monthly usage for www.example.com'
    ],
    'dataset' => [
        ["Jan 2005", 27300],
        ["Feb 2005", 32100],
        ["March 2005", 44200],
        ["April 2005", 71100],
    ]
]);

$chart->setBarLabelGenerator(new ThousandLabelGenerator());
$chart->setGraphPadding(new \Libchart\Element\BasicPadding(5, 30, 20, 100));
$chart->render();
