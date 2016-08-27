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
 * Horizontal bar chart
 *
 * @author Jean-Marc Tremeaux (jm.tremeaux at gmail.com)
 */
class ChartHorizontalBar extends ChartBar
{
    /**
     * Ratio of empty space beside the bars.
     */
    private $emptyToFullRatio;

    /**
     * Creates a new horizontal bar chart.
     *
     * @param integer $width width of the image
     * @param integer $height height of the image
     */
    public function __construct($width = 600, $height = 250)
    {
        parent::__construct($width, $height);

        $this->emptyToFullRatio = 1 / 5;
        $this->plot->setGraphPadding(new PrimitivePadding(5, 30, 30, 50));
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
     * Print the axis.
     */
    protected function printAxis()
    {
        $minValue = $this->axis->getLowerBoundary();
        $maxValue = $this->axis->getUpperBoundary();
        $stepValue = $this->axis->getTics();

        // Get graphical obects
        $img = $this->plot->getImg();
        $palette = $this->plot->getPalette();
        $text = $this->plot->getText();

        // Get the graph area
        $graphArea = $this->plot->getGraphArea();

        $labelGenerator = $this->plot->getAxisLabelGenerator();

        /**
         * Deal with the Horizontal Axis
         */
        imageline(
            $img,
            $graphArea->x1 - 1,
            $graphArea->y2,
            $graphArea->x2,
            $graphArea->y2,
            $palette->axisColor[0]->getColor($img)
        );

        for ($value = $minValue; $value <= $maxValue; $value += $stepValue) {
            $x = $graphArea->x1
                + ($value - $minValue)
                * ($graphArea->x2 - $graphArea->x1)
                / ($this->axis->displayDelta);

            imageline(
                $img,
                $x,
                $graphArea->y2,
                $x,
                $graphArea->y2 + 2,
                $palette->axisColor[0]->getColor($img)
            );

            // Add the horizontal guide lines for each marker
            $color = $palette->backgroundColor[0];
            $this->plot->getPrimitive()->line($x, $graphArea->y1, $x, $graphArea->y2, $color);

            $label = $labelGenerator->generateLabel($value);
            $text->printText(
                $img,
                $x,
                $graphArea->y2 + 5,
                $this->plot->getTextColor(),
                $label,
                $text->getTextFont(),
                $text->HORIZONTAL_CENTER_ALIGN
            );
        }

        // Get first serie of a list
        $pointList = $this->getFirstSerieOfList();

        /**
         * Deal with the Vertical Axis
         */
        $pointCount = count($pointList);
        reset($pointList);
        $rowHeight = ($graphArea->y2 - $graphArea->y1) / $pointCount;
        reset($pointList);

        $verticalOriginX = $graphArea->x1 - $minValue * ($graphArea->x2 - $graphArea->x1) / ($this->axis->displayDelta);

        imageline(
            $img,
            $verticalOriginX,
            $graphArea->y1,
            $verticalOriginX,
            $graphArea->y2,
            $palette->axisColor[0]->getColor($img)
        );

        for ($i = 0; $i <= $pointCount; $i++) {
            $y = $graphArea->y2 - $i * $rowHeight;

            // Prints the small blue markers that separate each point
            imageline(
                $img,
                $verticalOriginX - 3,
                $y,
                $verticalOriginX,
                $y,
                $palette->axisColor[0]->getColor($img)
            );

            if ($i < $pointCount) {
                $point = current($pointList);
                next($pointList);

                $label = $point->getX();

                $text->printText(
                    $img,
                    $graphArea->x1 - 5,
                    $y - $rowHeight / 2,
                    $this->plot->getTextColor(),
                    $label,
                    $text->getTextFont(),
                    $text->HORIZONTAL_RIGHT_ALIGN | $text->VERTICAL_CENTER_ALIGN
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

        $minValue = $this->axis->getLowerBoundary();
        // @todo: check this unused variables...
        $maxValue = $this->axis->getUpperBoundary();
        $stepValue = $this->axis->getTics();

        $verticalOriginX = $graphArea->x1 - $minValue * ($graphArea->x2 - $graphArea->x1) / ($this->axis->displayDelta);

        // Start from the first color for the first serie
        $barColorSet = $palette->barColorSet;
        $barColorSet->reset();

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

            $rowHeight = ($graphArea->y2 - $graphArea->y1) / $pointCount;
            for ($i = 0; $i < $pointCount; $i++) {
                $y = $graphArea->y2 - $i * $rowHeight;

                /**
                 * @var \Libchart\Model\Point $point
                 */
                $point = current($pointList);
                next($pointList);

                $value = $point->getY();

                $xmax = $graphArea->x1
                    + ($value - $minValue)
                    * ($graphArea->x2 - $graphArea->x1)
                    / ($this->axis->displayDelta);

                // Bar dimensions
                $yWithMargin = $y - $rowHeight * $this->emptyToFullRatio;
                $rowWidthWithMargin = $rowHeight * (1 - $this->emptyToFullRatio * 2);
                $barWidth = $rowWidthWithMargin / $serieCount;
                $barOffset = $barWidth * $j;
                $y1 = $yWithMargin - $barWidth - $barOffset;
                $y2 = $yWithMargin - $barOffset - 1;

                // Select the next color for the next item in the serie
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

                // Draw the horizontal bar
                imagefilledrectangle(
                    $img,
                    $verticalOriginX + ($value >= 0 ? 1 : -1),
                    $y1,
                    $xmax,
                    $y2,
                    $shadowColor->getColor($img)
                );

                // Prevents drawing a small box when x = 0
                if ($value != 0) {
                    imagefilledrectangle(
                        $img,
                        $verticalOriginX + ($value >= 0 ? 2 : -2),
                        $y1 + 1,
                        $xmax + ($value >= 0 ? -4 : -0),
                        $y2,
                        $color->getColor($img)
                    );
                }

                // Draw caption text on bar
                if ($this->config->get('showPointCaption')) {
                    $label = $labelGenerator->generateLabel($value);
                    $textAlign = $text->VERTICAL_CENTER_ALIGN
                        | ($value > 0 ? $text->HORIZONTAL_LEFT_ALIGN : $text->HORIZONTAL_RIGHT_ALIGN);
                    $text->printText(
                        $img,
                        $xmax + ($value > 0 ? 5 : -10),
                        $y2 - $barWidth / 2,
                        $this->plot->getTextColor(),
                        $label,
                        $text->getTextFont(),
                        $textAlign
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
