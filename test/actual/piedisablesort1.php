<?php
    require_once '../common.php';
    
    header("Content-type: image/png");
    
    $chart = new \Libchart\View\Chart\PieChart(500, 250);

    $chart->getConfig()->setSortDataPoint(false);
    
    $dataSet = new \Libchart\Data\XYDataSet();
    $dataSet->addPoint(new \Libchart\Data\Point("Item 1 (20)", 20));
    $dataSet->addPoint(new \Libchart\Data\Point("Item 2 (50)", 50));
    $dataSet->addPoint(new \Libchart\Data\Point("Item 3 (30)", 30));
    $dataSet->addPoint(new \Libchart\Data\Point("Item 4 (70)", 70));
    $chart->setDataSet($dataSet);
    
    $chart->setTitle("This example preserves item order");
    $chart->render();
?>