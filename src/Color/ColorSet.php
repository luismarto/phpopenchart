<?php namespace Phpopenchart\Color;

/**
 * Class ColorSet
 * A set of colors, used for drawing series of data.
 * @package Phpopenchart\Color
 */
class ColorSet
{
    public $colorList;
    public $shadowColorList;

    /**
     * ColorSet constructor.
     *
     * @param array $colorList Colors as an array
     * @param int|float $shadowFactor Shadow factor
     */
    public function __construct($colorList, $shadowFactor)
    {
        $this->colorList = $colorList;
        $this->shadowColorList = array();

        // Generate the shadow color set
        foreach ($colorList as $color) {
            /**
             * @var Color $color
             */
            $shadowColor = $color->getShadowColor($shadowFactor);

            array_push($this->shadowColorList, $shadowColor);
        }
    }

    /**
     * Reset the iterator over the collections of colors.
     */
    public function reset()
    {
        reset($this->colorList);
        reset($this->shadowColorList);
    }

    /**
     * Iterate over the colors and shadow colors. When we go after the last one, loop over.
     *
     */
    public function next()
    {
        $value = next($this->colorList);
        next($this->shadowColorList);

        // When we go after the last value, loop over.
        if ($value == false) {
            $this->reset();
        }
    }

    /**
     * Returns the current color.
     *
     * @return Color color
     */
    public function currentColor()
    {
        return current($this->colorList);
    }

    /**
     * Returns the current shadow color.
     *
     * @return Color shadow color
     */
    public function currentShadowColor()
    {
        return current($this->shadowColorList);
    }
}
