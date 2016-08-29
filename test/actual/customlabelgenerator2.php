<?php
    require_once '../common.php';
    
    class ThousandLabelGenerator implements \Libchart\Label\LabelInterface {
        function generateLabel($value) {
            return ((int) ($value / 1000)) . "k";
        }
    }
    
    header("Content-type: image/png");
    
    $chart = new \Libchart\Chart\Bar(500, 200);
     
    $dataSet = new \Libchart\Data\XYDataSet();
    $dataSet->addPoint(new \Libchart\Data\Point("Jan 2005", 27300));
    $dataSet->addPoint(new \Libchart\Data\Point("Feb 2005", 32100));
    $dataSet->addPoint(new \Libchart\Data\Point("March 2005", 44200));
    $dataSet->addPoint(new \Libchart\Data\Point("April 2005", 71100));
    $chart->setDataSet($dataSet);
    
    $chart->setTitle("Monthly usage for www.example.com");
    $chart->getPlot()->setLabelGenerator(new ThousandLabelGenerator());
	$chart->getPlot()->setGraphPadding(new \Libchart\Element\BasicPadding(5, 30, 20, 100));
    $chart->render();
?>