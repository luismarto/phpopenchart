<?php namespace Libchart\Data;

use Libchart\Color\ColorHex;

/**
 * Point of coordinates (X,Y).
 * The value of X isn't really of interest, but X is used as a label to display on the horizontal axis.
 */
class Point
{
    /**
     * @var int
     */
    private $x;

    /**
     * @var int
     */
    private $y;

    /**
     * @var ColorHex|null
     */
    private $color = null;

    /**
     * Creates a new sampling point of coordinates (x, y)
     *
     * @param integer $x coordinate (label)
     * @param integer $y coordinate (value)
     * @param string|null $hexColor Specific color for this point
     */
    public function __construct($x, $y, $hexColor = null)
    {
        $this->x = $x;
        $this->y = $y;
        if (!is_null($hexColor)) {
            $this->color = new ColorHex($hexColor);
        }
    }

    /**
     * Gets the x coordinate (label).
     *
     * @return integer x coordinate (label)
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * Gets the y coordinate (value).
     *
     * @return integer y coordinate (value)
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * Returns the specific color for this point
     * @return ColorHex|null
     */
    public function getColor()
    {
        return $this->color;
    }
}
