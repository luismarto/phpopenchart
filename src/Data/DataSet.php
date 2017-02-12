<?php namespace Phpopenchart\Data;

use Phpopenchart\Exception\DatasetNotDefinedException;
use Phpopenchart\Exception\PointsInSeriesDontMatchException;

/**
 * Class DataSet
 * @package Phpopenchart\Data
 */
abstract class DataSet
{
    /**
     * Checks the data model before rendering the graph.
     * Checks if the dataset is defined and, in case of multiseries, all series
     * have the same amount of values
     */
    public function validate()
    {
        // Check if a dataset was defined
        if (!$this) {
            throw new DatasetNotDefinedException();
        }

        if ($this instanceof XYSeriesDataSet) {
            // Check if each series has the same number of points
            unset($lastPointCount);
            $serieList = $this->getSerieList();
            for ($i = 0; $i < count($serieList); $i++) {
                $serie = $serieList[$i];
                $pointCount = count($serie->getPointList());
                if (isset($lastPointCount) && $pointCount != $lastPointCount) {
                    throw new PointsInSeriesDontMatchException($i, $pointCount, $lastPointCount);
                }
                $lastPointCount = $pointCount;
            }
        }
    }

    /**
     * Return the first serie of the list, or the dataSet itself if there is no serie.
     *
     * @return XYDataSet[]|XYSeriesDataSet[]
     */
    public function getFirstSerieOfList()
    {
        $pointList = null;
        if ($this instanceof XYSeriesDataSet) {
            // For a series dataset, print the legend from the first serie
            $serieList = $this->getSerieList();
            reset($serieList);
            $serie = current($serieList);
            $pointList = $serie->getPointList();
        } elseif ($this instanceof XYDataSet) {
            $pointList = $this->getPointList();
        }

        return $pointList;
    }

    /**
     * Returns true if the data set has some data.
     * @param int $minNumberOfPoint Minimum number of points (1 for bars, 2 for lines).
     * @return bool true if data set empty
     */
    public function isEmpty($minNumberOfPoint)
    {
        $test = $this->asSerieList();
        if (is_array($test)) {
            $test = $test[0];
        }

        if ($test instanceof XYDataSet) {
            $pointList = $test->getPointList();
            $pointCount = count($pointList);
            return $pointCount < $minNumberOfPoint;
        } elseif ($test instanceof XYSeriesDataSet) {
            $serieList = $test->getSerieList();
            reset($serieList);
            if (count($serieList) > 0) {
                $serie = current($serieList);
                $pointList = $serie->getPointList();
                $pointCount = count($pointList);

                return $pointCount < $minNumberOfPoint;
            }
        }

        return false;
    }

    /**
     * Return the data as a series list (for consistency).
     *
     * @return array|\Phpopenchart\Data\XYDataSet[] List of series
     */
    public function asSerieList()
    {
        // Get the data as a series list
        $serieList = null;
        if ($this instanceof XYSeriesDataSet) {
            $serieList = $this->getSerieList();
        } elseif ($this instanceof XYDataSet) {
            $serieList = [];
            array_push($serieList, $this);
        }

        return $serieList;
    }
}
