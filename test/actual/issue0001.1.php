<?php
    require_once '../common.php';

    header("Content-type: image/png");
    
    $chart = new \Libchart\View\Chart\PieChart(500, 250);

    $dataSet = new \Libchart\Data\XYDataSet();
    $dataSet->addPoint(new \Libchart\Data\Point("a (4872)", 4872));
    $dataSet->addPoint(new \Libchart\Data\Point("b (4774)", 4774));
    $dataSet->addPoint(new \Libchart\Data\Point("c (288)", 288));
    $dataSet->addPoint(new \Libchart\Data\Point("d (18)", 18));
    $dataSet->addPoint(new \Libchart\Data\Point("e (9)", 9));
    $dataSet->addPoint(new \Libchart\Data\Point("f (0)", 0));
    $dataSet->addPoint(new \Libchart\Data\Point("g (0)", 0));
    
    $chart->setDataSet($dataSet);
    
    $chart->setTitle("Sales for 2006");
    $chart->render();
?>