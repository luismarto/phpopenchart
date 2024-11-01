<?php namespace Phpopenchart\Color;

/**
 * Class ColorHex
 * @package Phpopenchart\Color
 */
class ColorHex extends Color
{
    /**
     * @param string $hexColor
     * @param int $alpha
     */
    public function __construct($hexColor, $alpha = 1)
    {
        list($red, $green, $blue) = sscanf($hexColor, "#%02x%02x%02x");

        parent::__construct($red, $green, $blue);
    }
}
