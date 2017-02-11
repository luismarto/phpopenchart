<?php namespace Phpopenchart\Color;

/**
 * Class ColorPalette
 * Color palette shared by all chart types.
 * @package Phpopenchart\Color
 */
class ColorPalette
{
    /**
     * @var Color[]
     */
    private $axisColor;

    /**
     * @var Color
     */
    private $backgroundColor;

    /**
     * @var ColorSet
     */
    private $barColorSet;

    /**
     * @var ColorSet
     */
    private $lineColorSet;

    /**
     * @var ColorSet
     */
    private $pieColorSet;

    /**
     * Palette constructor.
     */
    public function __construct()
    {
        // Set the colors for the horizontal and vertical axis
        $this->axisColor = [
            new ColorHex('#8BC5E0'),
            new ColorHex('#E5E5E5')
        ];

        // Set the colors for the background
        $this->backgroundColor = new ColorHex('#E4E4E4');

        // Set the colors for the bars
        $colors = [
            new ColorHex('#7CB5EC'),
            new ColorHex('#F7A35C'),
            new ColorHex('#2C5D63'),
            new ColorHex('#13829B'),
            new ColorHex('#29D2E4'),
            new ColorHex('#F38181'),
            new ColorHex('#95E1D3'),
            new ColorHex('#EAFFD0'),
            new ColorHex('#E9F679'),
            new ColorHex('#25A55F'),
            new ColorHex('#346473'),
            new ColorHex('#2D767F'),
            new ColorHex('#D9AF5D'),
            new ColorHex('#8DC6FF')
        ];
        $this->barColorSet = new ColorSet($colors, 1);

        // Set the colors for the bars
        $colors = [
            new ColorHex('#1B67B4'),
            new ColorHex('#F37914'),
            new ColorHex('#2C5D63'),
            new ColorHex('#13829B'),
            new ColorHex('#29D2E4'),
            new ColorHex('#F38181'),
            new ColorHex('#95E1D3'),
            new ColorHex('#25A55F'),
            new ColorHex('#346473'),
            new ColorHex('#2D767F'),
            new ColorHex('#D9AF5D'),
            new ColorHex('#8DC6FF')
        ];
        $this->lineColorSet = new ColorSet($colors, 1);

        // Set the colors for the pie
        $this->pieColorSet = new ColorSet($colors, 0.7);
    }

    /**
     * Getter for pie color set
     * @return ColorSet
     */
    public function getPieColorSet()
    {
        return $this->pieColorSet;
    }

    /**
     * Getter for line color set
     * @return ColorSet
     */
    public function getLineColorSet()
    {
        return $this->lineColorSet;
    }

    /**
     * Getter for bar color set
     * @return ColorSet
     */
    public function getBarColorSet()
    {
        return $this->barColorSet;
    }

    /**
     * Returns the background color
     * @return Color|ColorHex
     */
    public function getBackgroundColor()
    {
        return $this->backgroundColor;
    }

    /**
     * Returns the colors for the axis.
     *
     * @return Color[]
     */
    public function getAxisColor()
    {
        return $this->axisColor;
    }
}
