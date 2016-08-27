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
 * Chart composed of vertical bars.
 *
 * @author Jean-Marc Tr�meaux (jm.tremeaux at gmail.com)
 */
class ChartVerticalBar extends ChartBar
{
    /**
     * Ratio of empty space beside the bars.
     */
    private $emptyToFullRatio;

    /**
     * Creates a new vertical bar chart
     *
     * @param integer $width of the image
     * @param integer $height of the image
     */
    public function __construct($width = 600, $height = 250)
    {
        parent::__construct($width, $height);

        $this->emptyToFullRatio = 1 / 5;
        $this->plot->setGraphPadding(new PrimitivePadding(5, 30, 50, 50));
    }

    /**
     * Computes the layout.
     */
    protected function computeLayout()
    {
        if ($this->hasSeveralSerie) {
            $this->plot->setHasCaption(true);
        }
        $this->plot->computeLayout();
    }

    /**
     * Print the horizontal and vertical axis.
     */
    protected function printAxis()
    {
        $minValue = $this->axis->getLowerBoundary();
        $maxValue = $this->axis->getUpperBoundary();
        $stepValue = $this->axis->getTics();

        // Get graphical objects
        $img = $this->plot->getImg();
        $palette = $this->plot->getPalette();
        $text = $this->plot->getText();

        // Get the graph area
        $graphArea = $this->plot->getGraphArea();

        /**
         * Deal with the Vertical Axis
         */
        imageline(
            $img,
            $graphArea->x1-1,
            $graphArea->y1,
            $graphArea->x1-1,
            $graphArea->y2,
            $palette->axisColor[0]->getColor($img)
        );

        for ($value = $minValue; $value <= $maxValue; $value += $stepValue) {
            $y = $graphArea->y2
                - ($value - $minValue)
                * ($graphArea->y2 - $graphArea->y1)
                / ($this->axis->displayDelta);

            // This creates a little blue marker, next to the label of the Y axis, that match
            // each chart step.
            imageline(
                $img,
                $graphArea->x1 - 2,
                $y,
                $graphArea->x1,
                $y,
                $palette->axisColor[0]->getColor($img)
            );

            // For each marker, create the "guiding line"
            $color = $palette->backgroundColor[0];
            $this->plot->getPrimitive()->line($graphArea->x1, $y, $graphArea->x2, $y, $color);

            // Now print the label for the y axis
            $label = $this->plot->getAxisLabelGenerator()->generateLabel($value);

            $text->printText(
                $img,
                $graphArea->x1 - 10,
                $y,
                $this->plot->getTextColor(),
                $label,
                $text->getTextFont(),
                $text->HORIZONTAL_RIGHT_ALIGN | $text->VERTICAL_CENTER_ALIGN
            );
        }

        // Get first serie of a list
        $pointList = $this->getFirstSerieOfList();

        /**
         * Deal with the Horizontal Axis
         */
        $pointCount = count($pointList);
        reset($pointList);
        $columnWidth = ($graphArea->x2 - $graphArea->x1) / $pointCount;
        $horizOriginY = $graphArea->y2 + $minValue * ($graphArea->y2 - $graphArea->y1) / ($this->axis->displayDelta);

        imageline(
            $img,
            $graphArea->x1-1,
            $horizOriginY,
            $graphArea->x2,
            $horizOriginY,
            $palette->axisColor[0]->getColor($img)
        );

        for ($i = 0; $i <= $pointCount; $i++) {
            $x = $graphArea->x1 + $i * $columnWidth;

            imageline(
                $img,
                $x,
                $horizOriginY,
                $x,
                $horizOriginY + 3,
                $palette->axisColor[0]->getColor($img)
            );

            if ($i < $pointCount) {
                $point = current($pointList);
                next($pointList);

                $label = $point->getX();

                $text->printDiagonal(
                    $img,
                    $x + $columnWidth * 1 / 3,
                    $graphArea->y2 + 10,
                    $this->plot->getTextColor(),
                    $label
                );
            }
        }
    }

    /**
     * Print the bars.
     */
    protected function printBar()
    {
        // Get the data as a list of series for consistency
        $serieList = $this->getDataAsSerieList();

        // Get graphical obects
        $img = $this->plot->getImg();
        $palette = $this->plot->getPalette();
        $text = $this->plot->getText();

        // Get the graph area
        $graphArea = $this->plot->getGraphArea();

        $labelGenerator = $this->plot->getBarLabelGenerator();

        // Start from the first color for the first serie
        $barColorSet = $palette->barColorSet;
        $barColorSet->reset();

        $minValue = $this->axis->getLowerBoundary();
        $maxValue = $this->axis->getUpperBoundary();
        $stepValue = $this->axis->getTics();

        $horizOriginY = $graphArea->y2 + $minValue * ($graphArea->y2 - $graphArea->y1) / ($this->axis->displayDelta);

        $serieCount = count($serieList);
        for ($j = 0; $j < $serieCount; $j++) {
            $serie = $serieList[$j];
            $pointList = $serie->getPointList();
            $pointCount = count($pointList);
            reset($pointList);

            // Select the next color for the next serie
            $bColor = $bShadowColor = '';
            if (!$this->config->get('useMultipleColor')) {
                $bColor = $barColorSet->currentColor();
                $bShadowColor = $barColorSet->currentShadowColor();
                $barColorSet->next();
            }

            $columnWidth = ($graphArea->x2 - $graphArea->x1) / $pointCount;
            for ($i = 0; $i < $pointCount; $i++) {
                $x = $graphArea->x1 + $i * $columnWidth;

                /**
                 * @var \Libchart\Model\Point $point
                 */
                $point = current($pointList);
                next($pointList);

                $value = $point->getY();

                $ymin = $graphArea->y2
                    - ($value - $minValue)
                    * ($graphArea->y2 - $graphArea->y1)
                    / ($this->axis->displayDelta);

                // Bar dimensions
                $xWithMargin = $x + $columnWidth * $this->emptyToFullRatio;
                $columnWidthWithMargin = $columnWidth * (1 - $this->emptyToFullRatio * 2);
                $barWidth = $columnWidthWithMargin / $serieCount;
                $barOffset = $barWidth * $j;
                $x1 = $xWithMargin + $barOffset;
                $x2 = $xWithMargin + $barWidth + $barOffset - 1;

                // Select the next color for the next item in the serie

                // Check if the point has a specific color. If so, this overrides anything else
                if (!is_null($point->getColor())) {
                    $color = $point->getColor();
                    $shadowColor = $color->getShadowColor(1);
                } elseif ($this->config->get('useMultipleColor')) {
                    $color = $barColorSet->currentColor();
                    $shadowColor = $barColorSet->currentShadowColor();
                    $barColorSet->next();
                } else {
                    $color = $bColor;
                    $shadowColor = $bShadowColor;
                }

                // Draw the vertical bar
                imagefilledrectangle(
                    $img,
                    $x1,
                    $ymin,
                    $x2,
                    $horizOriginY + ($value >= 0 ? -1 : 1),
                    $shadowColor->getColor($img)
                );

                // Prevents drawing a small box when y = 0
                if ($value != 0) {
                    imagefilledrectangle(
                        $img,
                        $x1 + 1,
                        $ymin + ($value > 0 ? 1 : 0),
                        $x2 - 4,
                        $horizOriginY + ($value >= 0 ? -1 : 2),
                        $color->getColor($img)
                    );
                }

                // Draw caption text on bar
                if ($this->config->get('showPointCaption')) {
                    $label = $labelGenerator->generateLabel($value);
                    $text->printText(
                        $img,
                        $x1 + $barWidth / 2,
                        ($value > 0 ? $ymin - 5 : $ymin + 15),
                        $this->plot->getTextColor(),
                        $label,
                        $text->getTextFont(),
                        $text->HORIZONTAL_CENTER_ALIGN | $text->VERTICAL_BOTTOM_ALIGN
                    );
                }
            }
        }
    }

    /**
     * Renders the caption.
     */
    protected function printCaption()
    {
        // Get the list of labels
        $labelList = $this->dataSet->getTitleList();

        // Create the caption
        $caption = new Caption();
        $caption->setPlot($this->plot);
        $caption->setLabelList($labelList);

        $palette = $this->plot->getPalette();
        $barColorSet = $palette->barColorSet;
        $caption->setColorSet($barColorSet);

        // Render the caption
        $caption->render();
    }

    /**
     * Render the chart image.
     *
     * @param string $fileName name of the file to render the image to (optional)
     */
    public function render($fileName = null)
    {
        // Check the data model
        $this->checkDataModel();

        $this->bound->computeBound($this->dataSet);
        $this->computeAxis();
        $this->computeLayout();
        $this->createImage();
        if ($this->plot->hasLogo()) {
            $this->plot->printLogo();
        }
        $this->plot->printTitle();
        if (!$this->isEmptyDataSet(1)) {
            $this->printAxis();
            $this->printBar();
            if ($this->hasSeveralSerie) {
                $this->printCaption();
            }
        }

        $this->plot->render($fileName);
    }
}
