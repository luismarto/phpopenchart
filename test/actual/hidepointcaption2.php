<?php
    require_once '../common.php';
    
    header("Content-type: image/png");
    
    $chart = new \Libchart\Chart\Bar(500, 250);
    
    $chart->getConfig()->setShowPointCaption(false);
    
    $dataSet = new \Libchart\Data\XYDataSet();
    $dataSet->addPoint(new \Libchart\Data\Point("Jan 2005", 273));
    $dataSet->addPoint(new \Libchart\Data\Point("Feb 2005", 321));
    $dataSet->addPoint(new \Libchart\Data\Point("Mar 2005", 442));
    $dataSet->addPoint(new \Libchart\Data\Point("Apr 2005", 711));
    $chart->setDataSet($dataSet);
    
    $chart->setTitle("Monthly usage for www.example.com");
    $chart->render();
?>
