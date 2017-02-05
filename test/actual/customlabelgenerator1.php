<?php
require_once '../common.php';

class ThousandLabelGenerator implements \Libchart\Label\LabelInterface
{
    public function generateLabel($value)
    {
        return ((int)($value / 1000)) . "k";
    }
}

$chart = new Libchart\Chart\Column([
    'chart' => [
        'width' => 500,
        'height' => 250,
    ],
    'title' => [
        'text' => 'Monthly usage for www.example.com'
    ],
    'point-label' => [
        'generator' => 'ThousandLabelGenerator'
    ],
    'dataset' => [
        'labels' => ['Jan 2005', 'Feb 2005', 'March 2005', 'April 2005'],
        'data' => [27300, 32100, 44200, 71100]
    ]
]);

$chart->render();
