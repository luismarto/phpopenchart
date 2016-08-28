<?php
    require_once '../common.php';
    
    header("Content-type: image/png");
    
    $chart = new \Libchart\Chart\Bar(500, 170);
    
    $dataSet = new \Libchart\Data\XYDataSet();
    $dataSet->addPoint(new \Libchart\Data\Point("/wiki/Instant_messenger", 50));
    $dataSet->addPoint(new \Libchart\Data\Point("/wiki/Web_Browser", 83));
    $dataSet->addPoint(new \Libchart\Data\Point("/wiki/World_Wide_Web", 142));
    $chart->setDataSet($dataSet);
    
	$chart->getPlot()->setGraphPadding(new \Libchart\View\Primitive\Padding(5, 30, 20, 140));
	$chart->setTitle("Most visited pages for www.example.com");
    $chart->render();
?>