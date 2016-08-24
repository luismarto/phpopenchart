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

namespace Libchart\Color;

/**
 * Color.
 *
 * @author Jean-Marc Tr�meaux (jm.tremeaux at gmail.com)
 */
class Color
{
    protected $red;
    protected $green;
    protected $blue;
    protected $alpha;
    protected $gdColor;

    /**
     * Creates a new color
     *
     * @param integer $red [0..255]
     * @param integer $green [0..255]
     * @param integer $blue [0..255]
     * @param integer $alpha [0..255]
     */
    public function __construct($red, $green, $blue, $alpha = 0)
    {
        $this->red = (int)$red;
        $this->green = (int)$green;
        $this->blue = (int)$blue;
        $this->alpha = (int)round($alpha * 127.0 / 255);

        $this->gdColor = null;
    }

    /**
     * Get GD color.
     * @param resource $img GD image resource
     * @return int
     */
    public function getColor($img)
    {
        // Checks if color has already been allocated
        if (!$this->gdColor) {
            if ($this->alpha == 0 || !function_exists('imagecolorallocatealpha')) {
                $this->gdColor = imagecolorallocate($img, $this->red, $this->green, $this->blue);
            } else {
                $this->gdColor = imagecolorallocatealpha($img, $this->red, $this->green, $this->blue, $this->alpha);
            }
        }

        // Returns GD color
        return $this->gdColor;
    }

    /**
     * Clip a color component in the interval [0..255]
     *
     * @param int $component
     * @return int $component Clipped component
     */
    public function clip($component)
    {
        if ($component < 0) {
            $component = 0;
        } elseif ($component > 255) {
            $component = 255;
        }

        return $component;
    }

    /**
     * Return a new color, which is a shadow of this one.
     *
     * @param double $shadowFactor Multiplication factor
     * @return Color Shadow color
     */
    public function getShadowColor($shadowFactor)
    {
        $red = $this->clip($this->red * $shadowFactor);
        $green = $this->clip($this->green * $shadowFactor);
        $blue = $this->clip($this->blue * $shadowFactor);
        $shadowColor = new Color($red, $green, $blue);

        return $shadowColor;
    }
}
