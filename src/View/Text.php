<?php
/* Libchart - PHP chart library
 * Copyright (C) 2005-2011 Jean-Marc Tr�meaux (jm.tremeaux at gmail.com)
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

namespace Libchart\View;

use Noodlehaus\Config;

const DS = DIRECTORY_SEPARATOR;

/**
 * Text drawing helper
 *
 * @author Jean-Marc Tr�meaux (jm.tremeaux at gmail.com)
 */
class Text
{

    public $HORIZONTAL_LEFT_ALIGN = 1;
    public $HORIZONTAL_CENTER_ALIGN = 2;
    public $HORIZONTAL_RIGHT_ALIGN = 4;
    public $VERTICAL_TOP_ALIGN = 8;
    public $VERTICAL_CENTER_ALIGN = 16;
    public $VERTICAL_BOTTOM_ALIGN = 32;

    /**
     * @var Config
     */
    private $config;

    /**
     * @var string
     */
    private $fontsDirectory;

    /**
     * @var string
     */
    private $textFont;

    /**
     * @var string
     */
    private $titleFont;

    /**
     * @var int
     */
    private $angle;

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

        $this->fontsDirectory = $config->get(
            'fonts.path',
            dirname(__FILE__)
            . DIRECTORY_SEPARATOR. '..'
            . DIRECTORY_SEPARATOR . '..'
            . DIRECTORY_SEPARATOR . 'fonts' . DIRECTORY_SEPARATOR
        );

        $this->textFont = $this->fontsDirectory
            . $this->config->get('fonts.text', 'SourceSansPro-Light.otf');
        $this->titleFont = $this->fontsDirectory
            . $this->config->get('fonts.title', 'SourceSansPro-Regular.otf');

        $this->angle = $this->config->get('label.angle', 0);
    }

    /**
     * Print text.
     *
     * @param integer $px text coordinate (x)
     * @param integer $py text coordinate (y)
     * @param \Libchart\Color\Color $color text color
     * @param string $text text value
     * @param string $fontFileName font file name
     * @param int $align text alignment
     * @param int $fontSize
     */
    public function printText($px, $py, $color, $text, $fontFileName, $align = 0, $fontSize = 12)
    {
        if (!($align & $this->HORIZONTAL_CENTER_ALIGN) && !($align & $this->HORIZONTAL_RIGHT_ALIGN)) {
            $align |= $this->HORIZONTAL_LEFT_ALIGN;
        }

        if (!($align & $this->VERTICAL_CENTER_ALIGN) && !($align & $this->VERTICAL_BOTTOM_ALIGN)) {
            $align |= $this->VERTICAL_TOP_ALIGN;
        }

        $lineSpacing = 1;

        list ($llx, $lly, $lrx, $lry, $urx, $ury, $ulx, $uly)= imageftbbox(
            $fontSize,
            0,
            $fontFileName,
            $text,
            array("linespacing" => $lineSpacing)
        );

        $textWidth = $lrx - $llx;
        $textHeight = $lry - $ury;

        $angle = 0;

        if ($align & $this->HORIZONTAL_CENTER_ALIGN) {
            $px -= $textWidth / 2;
        }

        if ($align & $this->HORIZONTAL_RIGHT_ALIGN) {
            $px -= $textWidth;
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
     */
    public function printCentered($py, $color, $text, $fontFileName)
    {
        $this->printText(
            imagesx($this->img) / 2,
            $py,
            $color,
            $text,
            $fontFileName,
            $this->HORIZONTAL_CENTER_ALIGN | $this->VERTICAL_CENTER_ALIGN
        );
    }

    /**
     * Print text in diagonal.
     *
     * @param int $px text coordinate (x)
     * @param int $py text coordinate (y)
     * @param \Libchart\Color\Color $color text color
     * @param string $text value
     */
    public function printDiagonal($px, $py, $color, $text)
    {
        $fontSize = $this->config->get('label.size', 11);
        $fontFileName = $this->textFont;

        $py = $py + $this->config->get('label.margin-top', 15);
        imagettftext($this->img, $fontSize, $this->angle, $px, $py, $color->getColor($this->img), $fontFileName, $text);
    }

    /**
     * Sets a new font to be used for the text
     * @param string $fontName
     */
    public function setTextFont($fontName)
    {
        $this->textFont = $this->fontsDirectory . $fontName;
    }

    /**
     * Returns the font used for the chart texts
     * @return string
     */
    public function getTextFont()
    {
        return $this->textFont;
    }

    /**
     * Sets a new font to be used for the chart title
     * @param string $fontName
     */
    public function setTitleFont($fontName)
    {
        $this->titleFont = $this->fontsDirectory . $fontName;
    }

    /**
     * Returns the font used for the chart's title
     * @return string
     */
    public function getTitleFont()
    {
        return $this->titleFont;
    }

    /**
     * Allows you to change the point's label angle on runtime
     * @param int $angle
     */
    public function setAngle($angle)
    {
        $this->angle = $angle;
    }
}
