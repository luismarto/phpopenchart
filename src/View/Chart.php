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
