<?php namespace Phpopenchart\Element;

/**
 * Class Axis
 * Automatic axis boundaries and ticks calibration
 *
 * @package Phpopenchart\Element
 */
class Axis
{
    /**
     * Manually set lower bound, overrides the value calculated by computeBound().
     */
    private $lowerBound = 0;

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
     * @var int
     */
    private $min;

    /**
     * @var int
     */
    private $max;

    /**
     * @var int
     */
    private $guide;

    /**
     * @var int
     */
    private $delta;

    /**
     * @var number
     */
    private $magnitude;
    private $displayMin;
    private $displayMax;
    private $tics;
    private $displayDelta;

    /**
     * Compute the boundaries on the axis.
     *
     * @param \Phpopenchart\Data\XYDataSet|\Phpopenchart\Data\XYSeriesDataSet $dataSet The data set
     */
    private function computeBound($dataSet)
    {
        // Check if the data set is empty
        $dataSetEmpty = $dataSet->isEmpty(1);
        $serieList = $dataSet->asSerieList();

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
     * Computes value between two ticks.
     */
    private function quantizeTics()
    {
        // Approximate number of decades, in [1..10[
        $norm = $this->delta / $this->magnitude;

        // Approximate number of tics per decade
        $posns = $this->guide / $norm;

        if ($posns > 20) {
            $tics = 0.05;        // e.g. 0, .05, .10, ...
        } elseif ($posns > 10) {
            $tics = 0.2;        // e.g.  0, .1, .2, ...
        } elseif ($posns > 5) {
            $tics = 0.4;        // e.g.  0, 0.2, 0.4, ...
        } elseif ($posns > 3) {
            $tics = 0.5;        // e.g. 0, 0.5, 1, ...
        } elseif ($posns > 2) {
            $tics = 1;        // e.g. 0, 1, 2, ...
        } elseif ($posns > 0.25) {
            $tics = 2;        // e.g. 0, 2, 4, 6
        } else {
            $tics = ceil($norm);
        }

        $this->tics = $tics * $this->magnitude;
    }

    /**
     * Computes automatic boundaries on the axis
     */
    public function computeBoundaries($dataset)
    {
        $this->computeBound($dataset);

        $this->min = $this->yMinValue;
        $this->max = $this->yMaxValue;
        $this->guide = 10;

        // Range
        $this->delta = abs($this->max - $this->min);

        // Check for null distribution
        if ($this->delta == 0) {
            $this->delta = 1;
        }

        // Order of magnitude of range
        $this->magnitude = pow(10, floor(log10($this->delta)));

        $this->quantizeTics();

        $this->displayMin = floor($this->min / $this->tics) * $this->tics;
        $this->displayMax = ceil($this->max / $this->tics) * $this->tics;
        $this->displayDelta = $this->displayMax - $this->displayMin;

        // Check for null distribution
        if ($this->displayDelta == 0) {
            $this->displayDelta = 1;
        }
    }

    /**
     * Get the lower boundary on the axis3
     *
     * @return integer lower boundary on the axis
     */
    public function getLowerBoundary()
    {
        return $this->displayMin;
    }

    /**
     * Get the value between two ticks3
     *
     * @return integer value between two ticks
     */
    public function getValues()
    {
        return [$this->displayMin, $this->displayMax, $this->tics];
    }

    public function getDisplayDelta()
    {
        return $this->displayDelta;
    }
}
