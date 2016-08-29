<?php namespace Libchart\Element;

use Libchart\Color\ColorHex;
use Libchart\Color\Color;

class Title
{
    /**
     * The title (text) for the chart
     * @var string
     */
    private $text;

    /**
     * Fixed title height in pixels.
     * @var int
     */
    private $height;

    /**
     * Padding of the title area.
     * @var BasicPadding
     */
    private $padding;

    /**
     *  Coordinates of the title area.
     */
    private $area;

    /**
     * The title color
     * @var Color|ColorHex
     */
    private $color;

    /**
     * @var string
     */
    private $font;

    /**
     * The text instance of the chart
     * @var Text
     */
    private $textInstance;

    /**
     * @var \Noodlehaus\Config
     */
    private $config;

    /**
     * @param Text $textInstance
     * @param \Noodlehaus\Config $config
     */
    public function __construct($textInstance, $config)
    {
        $this->textInstance = $textInstance;
        $this->config = $config;

        // @todo: make this configurable
        $this->height = 26;
        $this->padding = new BasicPadding(5, null, 15);
        $this->color = new ColorHex('000000');

        $this->fontsDirectory = $this->config->get(
            'fonts.path',
            dirname(__FILE__)
            . DIRECTORY_SEPARATOR. '..'
            . DIRECTORY_SEPARATOR . '..'
            . DIRECTORY_SEPARATOR . 'fonts' . DIRECTORY_SEPARATOR
        );

        $this->font = $this->fontsDirectory
            . $this->config->get('fonts.title', 'SourceSansPro-Regular.otf');
    }

    /**
     * Processes the image area and created an area, on the chart, for the title
     * @param PrimitiveRectangle $imageArea
     */
    public function computeTitleArea($imageArea)
    {
        $titleUnpaddedBottom = $imageArea->y1
            + $this->height
            + $this->padding->top
            + $this->padding->bottom;

        $area = new PrimitiveRectangle(
            $imageArea->x1,
            $imageArea->y1,
            $imageArea->x2,
            $titleUnpaddedBottom - 1
        );

        $this->area = $area->getPaddedRectangle($this->padding);
    }

    /**
     * Print the title to the image.
     */
    public function draw()
    {
        $this->textInstance->printCentered(
            $this->area->y1 + ($this->area->y2 - $this->area->y1) / 2,
            $this->color,
            $this->text,
            $this->font
        );
    }

    /**
     * Sets the text.
     * @param string $text New text
     * @return $this
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Change the color used for the title
     * @param string $hexColor
     * @param int $alpha
     */
    public function setColorHex($hexColor, $alpha = 0)
    {
        $this->color = new ColorHex($hexColor, $alpha);
    }

    /**
     * @param int $red
     * @param int $green
     * @param int $blue
     * @param int|float $alpha
     * @return $this
     */
    public function setColor($red, $green, $blue, $alpha = 0)
    {
        $this->color = new Color($red, $green, $blue, $alpha);

        return $this;
    }

    /**
     * Return the title height.
     * @param integer $height title height
     * @return $this
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Returns the title height
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Return the title padding.
     * @param BasicPadding $padding title padding
     * @return $this
     */
    public function setPadding($padding)
    {
        $this->padding = $padding;

        return $this;
    }

    /**
     * Returns the title padding
     * @return BasicPadding
     */
    public function getPadding()
    {
        return $this->padding;
    }

    /**
     * Sets a new font to be used for the chart title
     * @param string $fontName
     * @return $this
     */
    public function setFont($fontName)
    {
        if (strpos($fontName, DIRECTORY_SEPARATOR) === false) {
            $this->font = $this->fontsDirectory . $fontName;
        } else {
            $this->font = $fontName;
        }

        return $this;
    }

    /**
     * Returns the font used for the chart's title
     * @return string
     */
    public function getFont()
    {
        return $this->font;
    }
}