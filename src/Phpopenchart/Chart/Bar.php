<?php namespace Phpopenchart\Chart;

/**
 * Class Bar
 * @package Phpopenchart\Chart
 */
class Bar extends AbstractChartBar
{
    /**
     * Ratio of empty space beside the bars.
     * @var float
     */
    private $emptyToFullRatio;

    /**
     * Creates a new horizontal bar chart.
     *
     * @param array $args
     */
    public function __construct($args)
    {
        $this->emptyToFullRatio = 1 / 5;
        parent::__construct($args, 'bar');
    }

    /**
     * Print the axis.
     */
    protected function printAxis()
    {
        list($minValue, $maxValue, $stepValue) = $this->axis->getValues();

        // Get the graph area
        $graphArea = $this->graphArea;
        $axisColor0 = $this->palette->getAxisColor()[0];

        /**
         * Deal with the Horizontal (X) Axis
         */

        for ($value = $minValue; $value <= $maxValue; $value += $stepValue) {
            $x = $graphArea->x1
                + ($value - $minValue)
                * ($graphArea->x2 - $graphArea->x1)
                / ($this->axis->getDisplayDelta());

            // Draw the guiding line and marker for each step value
            $this->gd->line($x, $graphArea->y1, $x, $graphArea->y2, $this->palette->getBackgroundColor());

            // Draw the text for each step value (guiding marker)
            $this->valueAxis->draw(
                $x,
                $graphArea->y2,
                $value
            );
        }

        // Get first serie of a list
        $pointList = $this->getDataSet()->getFirstSerieOfList();

        /**
         * Deal with the Vertical (Y) Axis
         */
        $pointCount = count($pointList);
        reset($pointList);
        $rowHeight = $pointCount > 0
            ? ($graphArea->y2 - $graphArea->y1) / $pointCount
            : 0;
        reset($pointList);

        $verticalOriginX = $graphArea->x1 - $minValue * ($graphArea->x2 - $graphArea->x1)
            / ($this->axis->getDisplayDelta());

        // Draw the Y axis
        $this->gd->line($verticalOriginX, $graphArea->y1, $verticalOriginX, $graphArea->y2, $axisColor0);

        for ($i = 0; $i <= $pointCount; $i++) {
            $y = $graphArea->y2 - $i * $rowHeight;

            // Prints the small blue markers that separate each point / bar
            $this->gd->line($verticalOriginX - 5, $y, $verticalOriginX, $y, $axisColor0);

            if ($i < $pointCount) {
                $point = current($pointList);
                next($pointList);

                $this->labelAxis->draw(
                    $graphArea->x1 - 25,
                    $y - $rowHeight / 2 - 15,
                    $point->getLabel()
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
        $serieList = $this->getDataSet()->asSerieList();

        // Get the graph area
        $graphArea = $this->graphArea;

        $minValue = $this->axis->getLowerBoundary();

        $verticalOriginX = $graphArea->x1 - $minValue * ($graphArea->x2 - $graphArea->x1)
            / ($this->axis->getDisplayDelta());

        // Start from the first color for the first serie
        $barColorSet = $this->palette->getBarColorSet();
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

            $rowHeight = $pointCount > 0
                ? ($graphArea->y2 - $graphArea->y1) / $pointCount
                : 0;
            for ($i = 0; $i < $pointCount; $i++) {
                $y = $graphArea->y2 - $i * $rowHeight;

                /**
                 * @var \Phpopenchart\Data\Point $point
                 */
                $point = current($pointList);
                next($pointList);

                $value = $point->getValue();

                $xmax = $graphArea->x1
                    + ($value - $minValue)
                    * ($graphArea->x2 - $graphArea->x1)
                    / ($this->axis->getDisplayDelta());

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
                if ($this->pointLabel->show()) {
                    $textAlign = $this->text->getAlignment('vertical', 'middle')
                        | $this->text->getAlignment('horizontal', 'left');

                    $this->pointLabel->draw(
                        $xmax + ($value > 0 ? 30 : ($value == 0 ? 10 : -10)),
                        $y2 - $barWidth / 2,
                        $value,
                        $textAlign
                    );
                }
            }
        }
    }
}
