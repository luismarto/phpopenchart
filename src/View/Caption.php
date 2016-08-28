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
 * Caption.
 *
 * @author Jean-Marc Tr�meaux (jm.tremeaux at gmail.com)
 * Created on 30 july 2007
 */
class Caption
{
    /**
     * @var int
     */
    protected $labelBoxWidth;

    /**
     * @var int
     */
    protected $labelBoxHeight;

    /**
     * @var array
     */
    protected $labelList;

    /**
     * @var ColorSet
     */
    private $colorSet;

    private $captionArea;

    private $primitive;

    private $palette;

    private $text;
    private $textColor;

    /**
     * Constructor of Caption
     */
    public function __construct($captionArea, $colorSet, $primitive, $palette, $text, $textColor)
    {
        $this->labelBoxWidth = 15;
        $this->labelBoxHeight = 15;
        $this->captionArea = $captionArea;
        $this->colorSet = $colorSet;
        $this->primitive = $primitive;
        $this->palette = $palette;
        $this->text = $text;
        $this->textColor = $textColor;
    }

    /**
     * Render the caption.
     */
    public function render()
    {
        // Get the pie color set
        $colorSet = $this->colorSet;
        $colorSet->reset();

        $i = 0;
        foreach ($this->labelList as $label) {
            // Get the next color
            $color = $colorSet->currentColor();
            $colorSet->next();

            $boxX1 = $this->captionArea->x1;
            $boxX2 = $boxX1 + $this->labelBoxWidth;
            $boxY1 = $this->captionArea->y1 + 5 + $i * ($this->labelBoxHeight + 5);
            $boxY2 = $boxY1 + $this->labelBoxHeight;

            $this->primitive->outlinedBox($boxX1, $boxY1, $boxX2, $boxY2, $this->palette->axisColor[0], $this->palette->axisColor[1]);
            $this->primitive->rectangle($boxX1 + 2, $boxY1 + 2, $boxX2 - 2, $boxY2 - 2, $color);

            $this->text->printText(
                $boxX2 + 5,
                $boxY1 + $this->labelBoxHeight / 2,
                $this->textColor,
                $label,
                $this->text->getTextFont(),
                $this->text->VERTICAL_CENTER_ALIGN
            );

            $i++;
        }
    }

    /**
     * Sets the label list.
     *
     * @param array $labelList label list
     */
    public function setLabelList($labelList)
    {
        $this->labelList = $labelList;
    }
}
