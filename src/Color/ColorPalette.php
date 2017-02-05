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
    public $axisColor;

    /**
     * @var Color
     */
    public $backgroundColor;

    /**
     * @var ColorSet
     */
    public $barColorSet;

    /**
     * @var ColorSet
     */
    public $lineColorSet;

    /**
     * @var ColorSet
     */
    public $pieColorSet;

    /**
     * Palette constructor.
     */
    public function __construct()
    {
        // Set the colors for the horizontal and vertical axis
        $this->setAxisColor([
            new ColorHex('#8BC5E0'),
            new ColorHex('#E5E5E5')
        ]);

        // Set the colors for the background
        $this->setBackgroundColor(new ColorHex('#E4E4E4'));

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
        $this->setBarColor($colors);

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
        $this->setLineColor($colors);

        // Set the colors for the pie
        $this->setPieColor($colors);
    }

    /**
     * Set the colors for the axis.
     *
     * @param array $colors array of Color
     */
    public function setAxisColor($colors)
    {
        $this->axisColor = $colors;
    }

    /**
     * Set the colors for the background.
     *
     * @param Color $color array of Color
     */
    public function setBackgroundColor($color)
    {
        $this->backgroundColor = $color;
    }

    /**
     * Set the colors for the bar charts.
     *
     * @param array $colors array of Color
     */
    public function setBarColor($colors)
    {
        $this->barColorSet = new ColorSet($colors, 1);
    }

    /**
     * Set the colors for the line chart.
     *
     * @param array $colors array of Color
     */
    public function setLineColor($colors)
    {
        $this->lineColorSet = new ColorSet($colors, 1);
    }

    /**
     * Set the colors for the pie charts.
     *
     * @param array $colors array of Color
     */
    public function setPieColor($colors)
    {
        $this->pieColorSet = new ColorSet($colors, 0.7);
    }
}
