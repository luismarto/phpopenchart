<?php
/* Libchart - PHP chart library
 * Copyright (C) 2005-2011 Jean-Marc Tr�meaux (jm.tremeaux at gmail.com)
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

/*! \mainpage Libchart
 *
 * This is the reference API, automatically compiled by <a href="http://www.stack.nl/~dimitri/doxygen/">Doxygen</a>.
 * You can find here information that is not covered by the <a href="../samplecode/">tutorial</a>.
 *
 */

namespace Libchart\View;

use Libchart\Exceptions\DatasetNotDefinedException;
use Libchart\Model\ChartConfig;
use Libchart\Model\XYDataSet;
use Libchart\Model\XYSeriesDataSet;

/**
 * Base chart class.
 *
 * @author Jean-Marc Tr�meaux (jm.tremeaux at gmail.com)
 */
abstract class Chart
{
    /**
     * The chart configuration.
     * @var ChartConfig
     */
    protected $config;

    /**
     * The data set.
     * @var XYDataSet|XYSeriesDataSet
     */
    protected $dataSet;

    /**
     * Plot (holds graphical attributes).
     * @var \Libchart\View\Plot
     */
    protected $plot;

    /**
     * Abstract constructor of Chart.
     *
     * @param integer $width Width of the image
     * @param integer $height Height of the image
     */
    protected function __construct($width, $height)
    {
        // Initialize the configuration
        $this->config = new ChartConfig();

        // Creates the plot
        $this->plot = new Plot($width, $height);
        $this->plot->setTitle("Untitled chart");
        $this->plot->setLogoFileName(dirname(__FILE__) . "/../../images/PoweredBy.png");
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

        // Maybe no points are defined, but that's ok. This will yield and empty graph with default boundaries.
    }

    /**
     * Create the image.
     */
    protected function createImage()
    {
        $this->plot->createImage();
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

    /**
     * Return the chart configuration.
     *
     * @return ChartConfig configuration : ChartConfig
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Return the plot.
     *
     * @return plot
     */
    public function getPlot()
    {
        return $this->plot;
    }

    /**
     * Sets the title.
     *
     * @param string $title New title
     */
    public function setTitle($title)
    {
        $this->plot->setTitle($title);
    }

    /**
     * Specifies a color for the chart title
     * @author Luis Cruz
     * @date 20160812
     * @param int $red
     * @param int $green
     * @param int $blue
     * @param float|int $alpha
     */
    public function setTitleColor($red, $green, $blue, $alpha = 0)
    {
        $this->plot->setTitleColor($red, $green, $blue, $alpha);
    }

    /**
     * Specifies a color for the chart title
     * @author Luis Cruz
     * @date 20160812
     * @param string $hexColor
     * @param float|int $alpha
     */
    public function setTitleColorHex($hexColor, $alpha = 0)
    {
        $this->plot->setTitleColorHex($hexColor, $alpha);
    }
}
