<?php namespace Libchart\Element;

use Libchart\Color\ColorHex;

/**
 * Class Text
 * @package Libchart\Element
 */
class Text extends AbstractElement
{
    public $HORIZONTAL_LEFT_ALIGN = 1;
    public $HORIZONTAL_CENTER_ALIGN = 2;
    public $HORIZONTAL_RIGHT_ALIGN = 4;
    public $VERTICAL_TOP_ALIGN = 8;
    public $VERTICAL_CENTER_ALIGN = 16;
    public $VERTICAL_BOTTOM_ALIGN = 32;

    /**
     * @var string
     */
    private $fontsDirectory;

    /**
     * @var string
     */
    private $font;

    /**
     * @var resource
     */
    private $img;

    /**
     * @var ColorHex
     */
    private $color;

    /**
     * Creates a new text drawing helper.
     */
    public function __construct($img, $config)
    {
        $this->img = $img;
        $this->config = $config;

        // @todo: make this configurable
        $this->fontsDirectory = $this->config->get(
            'fonts.path',
            dirname(__FILE__)
            . DIRECTORY_SEPARATOR. '..'
            . DIRECTORY_SEPARATOR . '..'
            . DIRECTORY_SEPARATOR . 'fonts' . DIRECTORY_SEPARATOR
        );

        $this->font = $this->fontsDirectory
            . $this->config->get('fonts.text', 'SourceSansPro-Light.otf');

        $this->color = new ColorHex('#555555');
    }

    /**
     * Print text.
     * The $px always points to the "center" of the text. Based on the $align, we add or subtract
     * the correct value to position the text
     *
     * @param integer $px text coordinate (x)
     * @param integer $py text coordinate (y)
     * @param \Libchart\Color\Color $color text color
     * @param string $text text value
     * @param string $fontFileName font file name
     * @param int $align text alignment
     * @param int $fontSize
     * @param int $angle
     */
    public function draw($px, $py, $color, $text, $fontFileName, $align = 0, $fontSize = 12, $angle = 0)
    {
        if (!($align & $this->HORIZONTAL_CENTER_ALIGN) && !($align & $this->HORIZONTAL_RIGHT_ALIGN)) {
            $align |= $this->HORIZONTAL_LEFT_ALIGN;
        }

        if (!($align & $this->VERTICAL_CENTER_ALIGN) && !($align & $this->VERTICAL_BOTTOM_ALIGN)) {
            $align |= $this->VERTICAL_TOP_ALIGN;
        }

        $lineSpacing = 1;

        list ($llx, $lly, $lrx, $lry, $urx, $ury, $ulx, $uly) = imageftbbox(
            $fontSize,
            $angle,
            $fontFileName,
            $text,
            ["linespacing" => $lineSpacing]
        );

        $textWidth = $lrx - $llx;
        $textHeight = $lry - $ury;

        if ($align & $this->HORIZONTAL_CENTER_ALIGN) {
            $px -= $textWidth / 2;
        }

        if ($align & $this->HORIZONTAL_LEFT_ALIGN) {
            $px -= $textWidth;
        }

        if ($align & $this->HORIZONTAL_RIGHT_ALIGN) {
            $px += $textWidth;
        }

        if ($align & $this->VERTICAL_CENTER_ALIGN) {
            $py += $textHeight / 2;
        }

        if ($align & $this->VERTICAL_TOP_ALIGN) {
            $py += $textHeight;
        }

        imagettftext($this->img, $fontSize, $angle, $px, $py, $color->getColor($this->img), $fontFileName, $text);
    }

    /**
     * Print text centered horizontally on the image.
     *
     * @param integer $py text coordinate (y)
     * @param \Libchart\Color\Color $color text color
     * @param string $text text value
     * @param string $fontFileName font file name
     * @param int $fontSize
     */
    public function printCentered($py, $color, $text, $fontFileName, $fontSize)
    {
        $this->draw(
            imagesx($this->img) / 2,
            $py,
            $color,
            $text,
            $fontFileName,
            $this->HORIZONTAL_CENTER_ALIGN | $this->VERTICAL_CENTER_ALIGN,
            $fontSize
        );
    }

    /**
     * Returns the font used for the chart texts
     * @return string
     */
    public function getFont()
    {
        return $this->font;
    }

    /**
     * Defines the color
     * @param string $hexColor
     * @return $this
     */
    public function setColorHex($hexColor)
    {
        $this->color = new ColorHex($hexColor);
    }

    /**
     * Returns the text color
     * @return ColorHex
     */
    public function getColor()
    {
        return $this->color;
    }
}
