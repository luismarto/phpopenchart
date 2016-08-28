<?php
    require_once '../common.php';

    header("Content-type: image/png");

    $chart = new \Libchart\View\Chart\PieChart();

    $chart->getConfig()->setShowPointCaption(false);

    $dataSet = new \Libchart\Data\XYDataSet();
    $dataSet->addPoint(new \Libchart\Data\Point("Some part", 20));
    $dataSet->addPoint(new \Libchart\Data\Point("Another part", 35));
    $dataSet->addPoint(new \Libchart\Data\Point("Biggest part", 70));
    $chart->setDataSet($dataSet);

    $chart->setTitle("This is a pie");
    $chart->render();
?>