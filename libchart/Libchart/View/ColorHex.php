<?php namespace Libchart\View;

/**
 * Class ColorHex
 * @package Libchart\View
 */
class ColorHex extends Color
{
    public function __construct($hexColor, $alpha = 1)
    {
        list($red, $green, $blue) = sscanf($hexColor, "#%02x%02x%02x");

        parent::__construct($red, $green, $blue);
    }
}