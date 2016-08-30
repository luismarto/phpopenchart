<?php namespace Libchart\Chart;

use Libchart\Element\BasicPadding;

/**
 * Class Bar
 * @package Libchart\Chart
 */
class Bar extends AbstractChartBar
{
    /**
     * Ratio of empty space beside the bars.
     * @var float
     */
    private $emptyToFullRatio = 1 / 5;

    /**
     * Creates a new horizontal bar chart.
     *
     * @param array $args
     */
    public function __construct($args)
    {
        parent::__construct($args, 'bar');

        $this->setGraphPadding(new BasicPadding(5, 30, 30, 50));
    }

    /**
     * Print the axis.
     */
    protected function printAxis()
    {
        $minValue = $this->axis->getLowerBoundary();
        $maxValue = $this->axis->getUpperBoundary();
        $stepValue = $this->axis->getTics();

        // Get the graph area
        $graphArea = $this->graphArea;
        $axisColor0 = $this->palette->axisColor[0];

        /**
         * Deal with the Horizontal Axis
         */
        // Draw the line for the X axis
        $this->gd->line($graphArea->x1 - 1, $graphArea->y2, $graphArea->x2, $graphArea->y2, $axisColor0);

        for ($value = $minValue; $value <= $maxValue; $value += $stepValue) {
            $x = $graphArea->x1
                + ($value - $minValue)
                * ($graphArea->x2 - $graphArea->x1)
                / ($this->axis->displayDelta);

            // Draw the guiding line and marker for each step value
            $this->gd->line($x, $graphArea->y1, $x, $graphArea->y2, $this->palette->backgroundColor);

            // Draw the text for each step value (guiding marker)
            $this->axisLabel->draw(
                $x - 15,
                $graphArea->y2,
                $this->axisLabel->generateLabel($value),
                $this->text->HORIZONTAL_CENTER_ALIGN
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

        // Draw the Y axis
        $this->gd->line($verticalOriginX, $graphArea->y1, $verticalOriginX, $graphArea->y2, $axisColor0);

        for ($i = 0; $i <= $pointCount; $i++) {
            $y = $graphArea->y2 - $i * $rowHeight;

            // Prints the small blue markers that separate each point / bar
            $this->gd->line($verticalOriginX - 5, $y, $verticalOriginX, $y, $axisColor0);

            if ($i < $pointCount) {
                $point = current($pointList);
                next($pointList);

                $this->axisLabel->draw(
                    $graphArea->x1 - 25,
                    $y - $rowHeight / 2 - 15,
                    $point->getLabel(),
                    $this->text->HORIZONTAL_RIGHT_ALIGN | $this->text->VERTICAL_CENTER_ALIGN
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

        // Get the graph area
        $graphArea = $this->graphArea;

        $minValue = $this->axis->getLowerBoundary();
        // @todo: check this unused variables...
        $maxValue = $this->axis->getUpperBoundary();
        $stepValue = $this->axis->getTics();

        $verticalOriginX = $graphArea->x1 - $minValue * ($graphArea->x2 - $graphArea->x1) / ($this->axis->displayDelta);

        // Start from the first color for the first serie
        $barColorSet = $this->palette->barColorSet;
        $barColorSet->reset();

        $serieCount = count($serieList);
        for ($j = 0; $j < $serieCount; $j++) {
            $serie = $serieList[$j];
            $pointList = $serie->getPointList();
            $pointCount = count($pointList);
            reset($pointList);

            // Select the next color for the next serie
            $bColor = $bShadowColor = '';
            if (!$this->useMultipleColor) {
                $bColor = $barColorSet->currentColor();
                $barColorSet->next();
            }

            $rowHeight = ($graphArea->y2 - $graphArea->y1) / $pointCount;
            for ($i = 0; $i < $pointCount; $i++) {
                $y = $graphArea->y2 - $i * $rowHeight;

                /**
                 * @var \Libchart\Data\Point $point
                 */
                $point = current($pointList);
                next($pointList);

                $value = $point->getValue();

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
                } elseif ($this->useMultipleColor) {
                    $color = $barColorSet->currentColor();
                    $barColorSet->next();
                } else {
                    $color = $bColor;
                }

                // Draw the horizontal bar
                // Prevents drawing a small box when x = 0
                if ($value != 0) {
                    $this->gd->rectangle($verticalOriginX, $y1 + 1, $xmax + ($value >= 0 ? -4 : -0), $y2, $color);
                }

                // Draw caption text on bar
                if ($this->showPointCaption) {
                    $label = $this->barLabelGenerator->generateLabel($value);
                    $textAlign = $this->text->VERTICAL_CENTER_ALIGN
                        | ($value > 0 ? $this->text->HORIZONTAL_LEFT_ALIGN : $this->text->HORIZONTAL_RIGHT_ALIGN);

                    $this->text->draw(
                        $xmax + ($value > 0 ? 5 : -10),
                        $y2 - $barWidth / 2,
                        $this->text->getColor(),
                        $label,
                        $this->text->getFont(),
                        $textAlign
                    );
                }
            }
        }
    }
}
