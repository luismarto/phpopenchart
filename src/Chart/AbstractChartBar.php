<?php namespace Libchart\Chart;

use Libchart\Exception\DatasetNotDefinedException;
use Libchart\Exception\InvalidDatasetException;
use Libchart\Exception\PointsInSeriesDontMatchException;
use Libchart\Exception\UnknownDatasetTypeException;
use Libchart\Data\XYDataSet;
use Libchart\Data\XYSeriesDataSet;

/**
 * Class AbstractChartBar
 * Base abstract class for rendering both horizontal, vertical and line bar charts.
 * @package Libchart\Chart
 */
abstract class AbstractChartBar extends AbstractChart
{
    protected $bound;

    /**
     * @var Axis
     */
    protected $axis;

    /**
     * @var bool
     */
    protected $hasSeveralSerie;

    /**
     * Indicates the type of chart to be rendered (either 'bar' (either for Column or Bar) or 'line')
     * @var string
     */
    private $type;

    /**
     * Creates a new bar chart.
     *
     * @param string $type
     */
    protected function __construct($type)
    {
        // Initialize the bounds
        $this->bound = new AxisBound();
        $this->bound->setLowerBound(0);
        $this->type = $type;
    }

    /**
     * Compute the axis.
     */
    protected function computeAxis()
    {
        $this->axis = new Axis($this->bound->getYMinValue(), $this->bound->getYMaxValue());
        $this->axis->computeBoundaries();
    }

    /**
     * Returns true if the data set has some data.
     * @param int $minNumberOfPoint Minimum number of points (1 for bars, 2 for lines).
     * @return bool true if data set empty
     * @throws UnknownDatasetTypeException
     */
    protected function isEmptyDataSet($minNumberOfPoint)
    {
        if ($this->dataSet instanceof XYDataSet) {
            $pointList = $this->dataSet->getPointList();
            $pointCount = count($pointList);

            return $pointCount < $minNumberOfPoint;
        } elseif ($this->dataSet instanceof XYSeriesDataSet) {
            $serieList = $this->dataSet->getSerieList();
            reset($serieList);
            if (count($serieList) > 0) {
                $serie = current($serieList);
                $pointList = $serie->getPointList();
                $pointCount = count($pointList);

                return $pointCount < $minNumberOfPoint;
            }
        } else {
            throw new UnknownDatasetTypeException();
        }

        return false;
    }

    /**
     * Checks the data model before rendering the graph.
     */
    protected function checkDataModel()
    {
        // Check if a dataset was defined
        if (!$this->dataSet) {
            throw new DatasetNotDefinedException();
        }

        // Bar charts accept both XYDataSet and XYSeriesDataSet
        if ($this->dataSet instanceof XYDataSet) {
            // The dataset contains only one serie
            $this->hasSeveralSerie = false;
        } elseif ($this->dataSet instanceof XYSeriesDataSet) {
            // Check if each series has the same number of points
            unset($lastPointCount);
            $serieList = $this->dataSet->getSerieList();
            for ($i = 0; $i < count($serieList); $i++) {
                /**
                 * @var $serie \Libchart\Data\XYDataSet
                 */
                $serie = $serieList[$i];
                $pointCount = count($serie->getPointList());
                if (isset($lastPointCount) && $pointCount != $lastPointCount) {
                    throw new PointsInSeriesDontMatchException($i, $pointCount, $lastPointCount);
                }
                $lastPointCount = $pointCount;
            }

            // The dataset contains several series
            $this->hasSeveralSerie = true;
        } else {
            throw new InvalidDatasetException();
        }
    }

    /**
     * Return the data as a series list (for consistency).
     *
     * @return array|\Libchart\Data\XYDataSet[] List of series
     */
    protected function getDataAsSerieList()
    {
        // Get the data as a series list
        $serieList = null;
        if ($this->dataSet instanceof XYSeriesDataSet) {
            $serieList = $this->dataSet->getSerieList();
        } elseif ($this->dataSet instanceof XYDataSet) {
            $serieList = array();
            array_push($serieList, $this->dataSet);
        }

        return $serieList;
    }

    /**
     * Return the first serie of the list, or the dataSet itself if there is no serie.
     *
     * @return XYDataSet[]|XYSeriesDataSet[]
     */
    protected function getFirstSerieOfList()
    {
        $pointList = null;
        if ($this->dataSet instanceof XYSeriesDataSet) {
            // For a series dataset, print the legend from the first serie
            $serieList = $this->dataSet->getSerieList();
            reset($serieList);
            $serie = current($serieList);
            $pointList = $serie->getPointList();
        } elseif ($this->dataSet instanceof XYDataSet) {
            $pointList = $this->dataSet->getPointList();
        }

        return $pointList;
    }

    /**
     * Renders the caption.
     */
    protected function printCaption()
    {
        // Get the list of labels
        $labelList = $this->dataSet->getTitleList();

        // Create the caption
        $caption = new Caption(
            $this->captionArea,
            $this->palette->barColorSet,
            $this->gd,
            $this->palette,
            $this->text
        );
        $caption->setLabelList($labelList);

        // Render the caption
        $caption->render();
    }

    /**
     * Render the chart image.
     *
     * @param string|null $filename name of the file to render the image to (optional)
     */
    public function render($filename = null)
    {
        // Check the data model
        $this->checkDataModel();

        $this->bound->computeBound($this->dataSet);
        $this->computeAxis();
        $this->computeLayout();
        $this->logo->draw();
        $this->title->draw();
        // @todo: Check the possibility of printing the chart line with only one point (it would look like a point)
        if (!$this->isEmptyDataSet($this->type === 'line' ? 2 : 1)) {
            $this->printAxis();
            $this->{'print' . strtoupper($this->type)}();
            if ($this->hasSeveralSerie) {
                $this->printCaption();
            }
        }

        $this->output($filename);
    }
}
