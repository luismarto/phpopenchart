<?php
    require_once '../common.php';
    
    header("Content-type: image/png");
    
    $chart = new \Libchart\View\Chart\PieChart(500, 250);
    
    $dataSet = new \Libchart\Data\XYDataSet();
    $dataSet->addPoint(new \Libchart\Data\Point("Mozilla Firefox (80)", 80));
    $dataSet->addPoint(new \Libchart\Data\Point("Konqueror (75)", 75));
    $dataSet->addPoint(new \Libchart\Data\Point("Other (50)", 50));
    $chart->setDataSet($dataSet);
    
    $chart->setTitle("User agents for www.example.com");
    $chart->render();
?>