<?php
    require_once '../common.php';
    
    header("Content-type: image/png");
    
    $chart = new \Libchart\Chart\Column(500, 250);
    
    $dataSet = new \Libchart\Data\XYDataSet();
    $dataSet->addPoint(new \Libchart\Data\Point("Mozilla Firefox (0)", 0));
    $dataSet->addPoint(new \Libchart\Data\Point("Konqueror (0)", 0));
    $dataSet->addPoint(new \Libchart\Data\Point("Other (0)", 0));
    $chart->setDataSet($dataSet);
    
    $chart->setTitle("User agents for www.example.com");
    $chart->render();
?>