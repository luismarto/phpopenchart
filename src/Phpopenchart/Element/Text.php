<?php namespace Phpopenchart\Element;

/**
 * Class Text
 * @package Phpopenchart\Element
 */
class Text extends AbstractElement
{
    /**
     * @var resource
     */
    private $img;

    /**
     * Creates a new text drawing helper.
     */
    public function __construct($img, $config)
    {
        $this->img = $img;
        $this->config = $config;
    }

    /**
     * Print text.
     * The $px always points to the "center" of the text. Based on the $align, we add or subtract
     * the correct value to position the text
     *
     * @param integer $px text coordinate (x)
     * @param integer $py text coordinate (y)
     * @param \Phpopenchart\Color\Color $color text color
     * @param string $text text value
     * @param string $fontFileName font file name
     * @param int $align text alignment
     * @param int $fontSize
     * @param int $angle
     * @param int|bool $maxTextHeight
     */
    public function draw(
        $px,
        $py,
        $color,
        $text,
        $fontFileName,
        $align = 0,
        $fontSize = 12,
        $angle = 0,
        $maxTextHeight = false
    ) {
        if (!($align & $this->getAlignment('horizontal', 'center'))
            && !($align & $this->getAlignment('horizontal', 'right'))
        ) {
            $align |= $this->getAlignment('horizontal', 'left');
        }

        if (!($align & $this->getAlignment('vertical', 'middle'))
            && !($align & $this->getAlignment('vertical', 'bottom'))
        ) {
            $align |= $this->getAlignment('vertical', 'top');
        }

        list ($llx, , $lrx, $lry, , $ury, , ) = imageftbbox(
            $fontSize,
            $angle,
            $fontFileName,
            $text,
            ["linespacing" => 1]
        );
        // @todo: improve horizontal alignment. left, center and right are a bit screwed
        // We should problably do as we did with the maxTextHeight and the the minimum $lrx
        // and get the difference to the current $lrx
        $textWidth = $lrx - $llx;
//        $h = fopen('temp.log', 'a+');
//        fwrite($h, 'lrx: ' . $lrx . '; llx: ' . $llx . "\r\n");
//        fclose($h);

        // If we receive the maxTextHeight, use it. Otherwise, calculate it based on the imgftbbox above
        if (!is_bool($maxTextHeight) && $maxTextHeight !== false) {
            $textHeight = $maxTextHeight;
        } else {
            $textHeight = $lry - $ury;
        }

        if ($align & $this->getAlignment('horizontal', 'center')) {
            $px -= $textWidth - ($textWidth / 2);
        }
        if ($align & $this->getAlignment('horizontal', 'left')) {
            $px -= $textWidth;
        }

        if ($align & $this->getAlignment('vertical', 'top')) {
            $py -= $textHeight / 4;
        }
        if ($align & $this->getAlignment('vertical', 'middle')) {
            $py += $textHeight / 2;
        }
        if ($align & $this->getAlignment('vertical', 'bottom')) {
            $py += $textHeight;
        }

        imagettftext($this->img, $fontSize, $angle, $px, $py, $color->getColor($this->img), $fontFileName, $text);
    }

    /**
     * Print text centered horizontally on the image.
     *
     * @param integer $py text coordinate (y)
     * @param \Phpopenchart\Color\Color $color text color
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
            $this->getAlignment('horizontal', 'center') | $this->getAlignment('vertical', 'middle'),
            $fontSize
        );
    }

    /**
     * @param string $type (either 'vertical' or 'horizontal'
     * @param string $property Depends on the $type, but can have the values
     * 'left', 'center' or 'right' (for type = 'horizontal')
     * 'top', 'middle' or 'bottom' (for type = 'vertical')
     * @return int
     */
    public function getAlignment($type, $property)
    {
//        public $HORIZONTAL_LEFT_ALIGN = 1;
//        public $HORIZONTAL_CENTER_ALIGN = 2;
//        public $HORIZONTAL_RIGHT_ALIGN = 4;
//        public $VERTICAL_TOP_ALIGN = 8;
//        public $VERTICAL_CENTER_ALIGN = 16;
//        public $VERTICAL_BOTTOM_ALIGN = 32;
        if ($type == 'horizontal') {
            switch ($property) {
                case 'left':
                    return 1;
                case 'center':
                default:
                    return 2;
                case 'right':
                    return 4;
            }
        } else {
            switch ($property) {
                case 'top':
                    return 8;
                case 'middle':
                default:
                    return 16;
                case 'bottom':
                    return 32;
            }
        }
    }
}
