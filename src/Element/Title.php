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
    private $titleHeight;

    /**
     * Padding of the title area.
     * @var BasicPadding
     */
    private $titlePadding;

    /**
     *  Coordinates of the title area.
     */
    private $titleArea;

    /**
     * The title color
     * @var Color|ColorHex
     */
    private $titleColor;

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
        $this->titleHeight = 26;
        $this->titlePadding = new BasicPadding(5, null, 15);
        $this->titleColor = new ColorHex('000000');

    }

    /**
     * Processes the image area and created an area, on the chart, for the title
     * @param PrimitiveRectangle $imageArea
     */
    public function computeTitleArea($imageArea)
    {
        $titleUnpaddedBottom = $imageArea->y1
            + $this->titleHeight
            + $this->titlePadding->top
            + $this->titlePadding->bottom;

        $titleArea = new PrimitiveRectangle(
            $imageArea->x1,
            $imageArea->y1,
            $imageArea->x2,
            $titleUnpaddedBottom - 1
        );

        $this->titleArea = $titleArea->getPaddedRectangle($this->titlePadding);
    }

    /**
     * Print the title to the image.
     */
    public function draw()
    {
        $this->textInstance->printCentered(
            $this->titleArea->y1 + ($this->titleArea->y2 - $this->titleArea->y1) / 2,
            $this->titleColor,
            $this->text,
            $this->textInstance->getTitleFont()
        );
    }

    /**
     * Sets the text.
     * @param string $text New text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * Change the color used for the title
     * @param string $hexColor
     * @param int $alpha
     */
    public function setTitleColorHex($hexColor, $alpha = 0)
    {
        $this->titleColor = new ColorHex($hexColor, $alpha);
    }

    /**
     * @param int $red
     * @param int $green
     * @param int $blue
     * @param int|float $alpha
     */
    public function setTitleColor($red, $green, $blue, $alpha = 0)
    {
        $this->titleColor = new Color($red, $green, $blue, $alpha);
    }

    /**
     * Return the title height.
     *
     * @param integer $titleHeight title height
     */
    public function setTitleHeight($titleHeight)
    {
        $this->titleHeight = $titleHeight;
    }

    /**
     * Returns the title height
     * @return int
     */
    public function getTitleHeight()
    {
        return $this->titleHeight;
    }

    /**
     * Return the title padding.
     *
     * @param integer $titlePadding title padding
     */
    public function setTitlePadding($titlePadding)
    {
        $this->titlePadding = $titlePadding;
    }

    /**
     * Returns the title padding
     * @return \stdClass
     */
    public function getTitlePadding()
    {
        return $this->titlePadding;
    }
}