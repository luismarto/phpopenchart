<?php namespace Phpopenchart\Data;

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
     * Receives an array with a format similar to:
     * [
        'labels' => ['Jan', 'Feb', 'Mar'],
        'data' => [
            [3296],
            [3296, '#cccccc'],
            [3296],
        ]
     * @param array $points
     */
    public function __construct(array $points)
    {
        if (!is_array($points) || !array_key_exists('data', $points)) {
            return [];
        }

        for ($i = 0; $i < count($points['data']); $i++) {
            $label = array_key_exists($i, $points['labels']) ? $points['labels'][$i] : 'undefined';
            if (is_array($points['data'][$i])) {
                $value = $points['data'][$i][0];
                $color = array_key_exists(1, $points['data'][$i]) ? $points['data'][$i][1] : null;
            } else {
                $value = $points['data'][$i];
                $color = null;
            }
            $this->pointList[] = new Point($label, $value, $color);
        }
    }

    /**
     * Getter of pointList.
     *
     * @return \Phpopenchart\Data\Point[] List of points.
     */
    public function getPointList()
    {
        return $this->pointList;
    }
}
