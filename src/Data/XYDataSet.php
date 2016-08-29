<?php namespace Libchart\Data;

use ReflectionClass;

/**
 * Set of data in the form of (x, y) items.
 */
class XYDataSet extends DataSet
{
    /**
     * @var array
     */
    private $pointList = [];

    /**
     * Constructor of XYDataSet.
     * @param array $points
     */
    public function __construct(array $points)
    {
        foreach ($points as $point) {
            $pointReflection = new ReflectionClass('\Libchart\\Data\\Point');
            $this->addPoint($pointReflection->newInstanceArgs($point));
        }
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
