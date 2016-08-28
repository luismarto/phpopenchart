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

/**
 * Graphic primitives, extends GD with chart related primitives.
 *
 * @author Jean-Marc Tr�meaux (jm.tremeaux at gmail.com)
 */
class Primitive
{
    private $img;

    /**
     * Creates a new primitive object
     *
     * @param resource $img GD image resource
     */
    public function __construct($img)
    {
        $this->img = $img;
    }

    /**
     * Draws a straight line.
     *
     * @param int $x1 line start (X)
     * @param int $y1 line start (Y)
     * @param int $x2 line end (X)
     * @param int $y2 line end (Y)
     * @param \Libchart\Color\Color $color
     * @param int $width line color
     */
    public function line($x1, $y1, $x2, $y2, $color, $width = 1)
    {
        imageline($this->img, $x1, $y1, $x2, $y2, $color->getColor($this->img));
    }

    /**
     * @param int $x1
     * @param int $y1
     * @param int $x2
     * @param int $y2
     * @param \Libchart\Color\Color $color
     */
    public function rectangle($x1, $y1, $x2, $y2, $color)
    {
        imagefilledrectangle($this->img, $x1, $y1, $x2, $y2, $color->getColor($this->img));
    }

    /**
     * Draw a filled gray box with thick borders and darker corners.
     *
     * @param int $x1 top left coordinate (x)
     * @param int $y1 top left coordinate (y)
     * @param int $x2 bottom right coordinate (x)
     * @param int $y2 bottom right coordinate (y)
     * @param \Libchart\Color\Color $color0 edge color
     * @param \Libchart\Color\Color $color1 corner color
     */
    public function outlinedBox($x1, $y1, $x2, $y2, $color0, $color1)
    {
        imagefilledrectangle($this->img, $x1, $y1, $x2, $y2, $color0->getColor($this->img));
        imagerectangle($this->img, $x1, $y1, $x1 + 1, $y1 + 1, $color1->getColor($this->img));
        imagerectangle($this->img, $x2 - 1, $y1, $x2, $y1 + 1, $color1->getColor($this->img));
        imagerectangle($this->img, $x1, $y2 - 1, $x1 + 1, $y2, $color1->getColor($this->img));
        imagerectangle($this->img, $x2 - 1, $y2 - 1, $x2, $y2, $color1->getColor($this->img));
    }
}
