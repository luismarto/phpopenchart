<?php namespace Phpopenchart\Chart;

/**
 * Class Column
 * @package Phpopenchart\Chart
 */
class Column extends AbstractChartBar
{
    /**
     * Ratio of empty space beside the bars.
     * @var float
     *
     */
    private $emptyToFullRatio;

    /**
     * Creates a new vertical bar chart (Column)
     *
     * @param array $args arguments to define the properties for this chart
     */
    public function __construct(array $args)
    {
        $this->emptyToFullRatio = 1 / 5;
        parent::__construct($args, 'column');
    }

    /**
     * Print the horizontal and vertical axis.
     */
    protected function printAxis()
    {
        $minValue = $this->axis->getLowerBoundary();
        $maxValue = $this->axis->getUpperBoundary();
        $stepValue = $this->axis->getTics();

        // Get the graph area
        $graphArea = $this->graphArea;
        $axisColor0 = $this->palette->getAxisColor()[0];
        /**
         * Deal with the Vertical Axis
         */
        for ($value = $minValue; $value <= $maxValue; $value += $stepValue) {
            $y = $graphArea->y2
                - ($value - $minValue)
                * ($graphArea->y2 - $graphArea->y1)
                / ($this->axis->displayDelta);

            // For each marker, create the "guiding line"
            $this->gd->line($graphArea->x1, $y, $graphArea->x2, $y, $this->palette->getBackgroundColor());

            // Now print the label for the y axis
            $this->valueAxis->draw(
                $graphArea->x1 - 25,
                $y - 15,
                $value
            );
        }

        // Get first serie of a list
        $pointList = $this->getFirstSerieOfList();

        /**
         * Deal with the Horizontal Axis
         */
        $pointCount = count($pointList);
        reset($pointList);
        $columnWidth = $pointCount > 0
            ? ($graphArea->x2 - $graphArea->x1) / $pointCount
            : 0;
        $horizOriginY = $graphArea->y2 + $minValue * ($graphArea->y2 - $graphArea->y1) / $this->axis->displayDelta;

        $this->gd->line($graphArea->x1, $horizOriginY, $graphArea->x2, $horizOriginY, $axisColor0);

        // Get the max height for the text of all the labels.
        // This way all the labels will get aligned
        $maxTextHeight = false;
        if (!$this->hasSeveralSeries) {
            $maxTextHeight = $this->getDataSet()->getMaxLabelHeight(
                $this->labelAxis->getFontSize(),
                $this->labelAxis->getTextAngle(),
                $this->labelAxis->getFont()
            );
        }

        for ($i = 0; $i <= $pointCount; $i++) {
            // The starting X for this point is the sum of the $x1 of the chart (minding the padding)
            // + the position of the point * the width of each column
            // This is used for printing the marker and the label
            $x = $graphArea->x1 + $i * $columnWidth;

            // Draw the bar separator marker
            $this->gd->line($x, $horizOriginY, $x, $horizOriginY + 5, $axisColor0);

            if ($i < $pointCount) {
                /**
                 * @var \Phpopenchart\Data\Point $point
                 */
                $point = current($pointList);
                next($pointList);

                // The $x points to the center of the column.
                // Then, based on the alignment, the label is correctly positioned
                $this->labelAxis->draw(
                    $x + ($columnWidth / 2),
                    $graphArea->y2,
                    $point->getLabel(),
                    $maxTextHeight
                );
            }
        }
    }

    /**
     * Print the bars.
     */
    protected function printColumn()
    {
        // Get the data as a list of series for consistency
        $serieList = $this->getDataAsSerieList();

        // Get the graph area
        $graphArea = $this->graphArea;

        // Start from the first color for the first serie
        $barColorSet = $this->palette->getBarColorSet();
        $barColorSet->reset();

        $minValue = $this->axis->getLowerBoundary();

        $horizOriginY = $graphArea->y2 + $minValue * ($graphArea->y2 - $graphArea->y1) / ($this->axis->displayDelta);

        $serieCount = count($serieList);
        for ($j = 0; $j < $serieCount; $j++) {
            $serie = $serieList[$j];
            $pointList = $serie->getPointList();
            $pointCount = count($pointList);
            reset($pointList);

            // Select the next color for the next serie
            $bColor = '';
            if (!$this->useMultipleColor) {
                $bColor = $barColorSet->currentColor();
                $barColorSet->next();
            }

            $columnWidth = $pointCount > 0
                ? ($graphArea->x2 - $graphArea->x1) / $pointCount
                : 0;
            for ($i = 0; $i < $pointCount; $i++) {
                $x = $graphArea->x1 + $i * $columnWidth;

                /**
                 * @var \Phpopenchart\Data\Point $point
                 */
                $point = current($pointList);
                next($pointList);

                $value = $point->getValue();

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
                } elseif ($this->useMultipleColor) {
                    $color = $barColorSet->currentColor();
                    $barColorSet->next();
                } else {
                    $color = $bColor;
                }

                // Draw the vertical bar
                // Prevents drawing a small box when y = 0
                if ($value != 0) {
                    $this->gd->rectangle(
                        $x1 + 1,
                        $ymin + ($value > 0 ? 1 : 0),
                        $x2 - 4,
                        $horizOriginY + ($value >= 0 ? -1 : 1),
                        $color
                    );
                }

                // Draw caption text on bar
                if ($this->pointLabel->show()) {
                    $align = $this->text->getAlignment('horizontal', 'center')
                        | $this->text->getAlignment('vertical', 'top');
                    $this->pointLabel->draw(
                        $x1 + $barWidth / 2,
                        ($value >= 0 ? $ymin - 5 : $ymin + 18),
                        $value,
                        $align
                    );
                }
            }
        }
    }
}
