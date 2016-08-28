<?php namespace Libchart\Data;

/**
 * Set of data in the form of (x, y) items.
 */
class XYDataSet extends DataSet
{
    /**
     * @var array
     */
    private $pointList;

    /**
     * Constructor of XYDataSet.
     *
     */
    public function __construct()
    {
        $this->pointList = array();
    }

    /**
     * Add a new point to the dataset.
     *
     * @param \Libchart\Data\Point Point to add to the dataset
     */

    public function addPoint($point)
    {
        array_push($this->pointList, $point);
    }

    /**
     * Getter of pointList.
     *
     * @return \Libchart\Data\Point[] List of points.
     */
    public function getPointList()
    {
        return $this->pointList;
    }
}
