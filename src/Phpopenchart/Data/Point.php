<?php namespace Phpopenchart\Data;

use Phpopenchart\Color\ColorHex;

/**
 * Class Point
 * @package Phpopenchart\Data
 */
class Point
{
    /**
     * @var string
     */
    private $label;

    /**
     * @var float|int|double
     */
    private $value;

    /**
     * @var ColorHex|null
     */
    private $color = null;

    /**
     * Creates a new sampling point of coordinates (x, y)
     *
     * @param integer $label coordinate (label)
     * @param integer $value coordinate (value)
     * @param string|null|\Phpopenchart\Color\Color $hexColor Specific color for this point
     */
    public function __construct($label, $value, $hexColor = null)
    {
        $this->label = $label;
        $this->value = $value;
        if (!is_null($hexColor)) {
            // In case the user passed a hex color or a color, set it
            if ($hexColor instanceof \Phpopenchart\Color\Color) {
                $this->color = $hexColor;
            } else {
                $this->color = new ColorHex($hexColor);
            }
        }
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @return float|int|double
     */
    public function getValue()
    {
        return $this->value;
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
