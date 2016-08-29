<?php namespace Libchart\Chart;

use Libchart\Exception\DatasetNotDefinedException;
use Libchart\Data\XYDataSet;
use Libchart\Data\XYSeriesDataSet;

/**
 * Class AbstractChart
 * @package Libchart\Chart
 */
abstract class AbstractChart
{
    use ChartTrait;

    /**
     * The data set.
     * @var XYDataSet|XYSeriesDataSet
     */
    protected $dataSet;

    /**
     * Checks the data model before rendering the graph.
     */
    protected function checkDataModel()
    {
        // Check if a dataset was defined
        if (!$this->dataSet) {
            throw new DatasetNotDefinedException();
        }

        // Maybe no points are defined, but that's ok. This will yield and empty graph with default boundaries.
    }

    /**
     * Sets the data set.
     *
     * @param XYDataSet|XYSeriesDataSet $dataSet The data set
     */
    public function setDataSet($dataSet)
    {
        $this->dataSet = $dataSet;
    }
}
