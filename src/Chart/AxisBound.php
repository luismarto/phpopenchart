<?php namespace Libchart\Chart;

use Libchart\Exception\UnknownDatasetTypeException;
use Libchart\Data\XYDataSet;
use Libchart\Data\XYSeriesDataSet;

/**
 * Class AxisBound
 * Object representing the bounds of a dataset (its minimal and maximal values) on its vertical axis.
 * The bounds are automatically calculated from a XYDataSet or XYSeriesDataSet.
 * Default (calculated) bounds can be overridden using the setLowerBound() and setUpperBound() methods.
 *
 * @package Libchart\Chart
 */
class AxisBound
{
    /**
     * Manually set lower bound, overrides the value calculated by computeBound().
     */
    private $lowerBound = null;

    /**
     * Manually set upper bound, overrides the value calculated by computeBound().
     */
    private $upperBound = null;

    /**
     * Computed min bound.
     */
    private $yMinValue = null;

    /**
     * Computed max bound.
     */
    private $yMaxValue = null;

    /**
     * Compute the boundaries on the axis.
     *
     * @param \Libchart\Data\XYDataSet|\Libchart\Data\XYSeriesDataSet $dataSet The data set
     * @throws UnknownDatasetTypeException
     */
    public function computeBound($dataSet)
    {
        // Check if the data set is empty
        $dataSetEmpty = true;
        $serieList = null;
        if ($dataSet instanceof XYDataSet) {
            $pointList = $dataSet->getPointList();
            $dataSetEmpty = count($pointList) == 0;

            if (!$dataSetEmpty) {
                // Process it as a serie
                $serieList = array();
                array_push($serieList, $dataSet);
            }
        } elseif ($dataSet instanceof XYSeriesDataSet) {
            $serieList = $dataSet->getSerieList();
            if (count($serieList) > 0) {
                $serie = current($serieList);
                $dataSetEmpty = count($serie) == 0;
            }
        } else {
            throw new UnknownDatasetTypeException();
        }

        // If the dataset is empty, default some bounds
        $yMin = 0;
        $yMax = 1;
        if (!$dataSetEmpty) {
            // Compute lower and upper bound on the value axis
            unset($yMin);
            unset($yMax);

            foreach ($serieList as $serie) {
                foreach ($serie->getPointList() as $point) {
                    $y = $point->getValue();

                    if (!isset($yMin)) {
                        $yMin = $y;
                        $yMax = $y;
                    } else {
                        if ($y < $yMin) {
                            $yMin = $y;
                        }

                        if ($y > $yMax) {
                            $yMax = $y;
                        }
                    }
                }
            }
        }

        // If user specified bounds and they are actually greater than computer bounds, override computed bounds
        if (isset($this->lowerBound) && $this->lowerBound < $yMin) {
            $this->yMinValue = $this->lowerBound;
        } else {
            $this->yMinValue = $yMin;
        }

        if (isset($this->upperBound) && $this->upperBound > $yMax) {
            $this->yMaxValue = $this->upperBound;
        } else {
            $this->yMaxValue = $yMax;
        }
    }

    /**
     * Getter of yMinValue.
     *
     * @return int Min bound
     */
    public function getYMinValue()
    {
        return $this->yMinValue;
    }

    /**
     * Getter of yMaxValue.
     *
     * @return int Max bound
     */
    public function getYMaxValue()
    {
        return $this->yMaxValue;
    }

    /**
     * Set manually the lower boundary value (overrides the automatic formatting).
     * Typical usage is to set the bars starting from zero.
     *
     * @param double $lowerBound Lower boundary value
     */
    public function setLowerBound($lowerBound)
    {
        $this->lowerBound = $lowerBound;
    }

    /**
     * Set manually the upper boundary value (overrides the automatic formatting).
     *
     * @param double $upperBound Upper boundary value
     */
    public function setUpperBound($upperBound)
    {
        $this->upperBound = $upperBound;
    }
}
