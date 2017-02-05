<?php namespace Phpopenchart\Chart;

/**
 * Class Line
 * @package Phpopenchart\Chart
 */
class Line extends AbstractChartBar
{
    /**
     * Creates a new line chart.
     * Line charts allow for XYDataSet and XYSeriesDataSet in order to plot several lines.
     *
     * @param array $args
     */
    public function __construct($args)
    {
        parent::__construct($args, 'line');
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
         * Deal with the Vertical Axis
         */
        //        $this->gd->line($graphArea->x1, $graphArea->y1, $graphArea->x1, $graphArea->y2, $axisColor0);
        for ($value = $minValue; $value <= $maxValue; $value += $stepValue) {
            $y = $graphArea->y2
                - ($value - $minValue)
                * ($graphArea->y2 - $graphArea->y1)
                / ($this->axis->displayDelta);

            $this->gd->line($graphArea->x1, $y, $graphArea->x2, $y, $this->palette->backgroundColor);

            $this->axisLabel->draw(
                $graphArea->x1 - 25,
                $y - 15,
                $this->axisLabel->generateLabel($value),
                $this->text->HORIZONTAL_CENTER_ALIGN | $this->text->VERTICAL_CENTER_ALIGN
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
        $horizOriginY = $graphArea->y2 + $minValue * ($graphArea->y2 - $graphArea->y1) / $this->axis->displayDelta;

        $this->gd->line($graphArea->x1, $horizOriginY, $graphArea->x2, $horizOriginY, $axisColor0);

        for ($i = 0; $i < $pointCount; $i++) {
            $x = $graphArea->x1 + $i * $columnWidth;

            // Markers for each serie point
            $this->gd->line($x, $graphArea->y2, $x, $graphArea->y2 + 5, $axisColor0);

            $point = current($pointList);
            next($pointList);

            $this->axisLabel->draw(
                $x + ($columnWidth / 2),
                $graphArea->y2 + 5,
                $point->getLabel(),
                $this->text->HORIZONTAL_CENTER_ALIGN
            );
        }
    }

    /**
     * Print the lines.
     */
    protected function printLine()
    {
        // @todo: check unused variables...
        $minValue = $this->axis->getLowerBoundary();
        $maxValue = $this->axis->getUpperBoundary();

        // Get the data as a list of series for consistency
        $serieList = $this->getDataAsSerieList();

        // Get the graph area
        $graphArea = $this->graphArea;

        $lineColorSet = $this->palette->lineColorSet;
        $lineColorSet->reset();
        for ($j = 0; $j < count($serieList); $j++) {
            $serie = $serieList[$j];
            $pointList = $serie->getPointList();
            $pointCount = count($pointList);
            reset($pointList);

            $columnWidth = ($graphArea->x2 - $graphArea->x1) / $pointCount;

            $lineColor = $lineColorSet->currentColor();
            $lineColorSet->next();
            $x1 = null;
            $y1 = null;
            for ($i = 0; $i < $pointCount; $i++) {
                $x2 = ($graphArea->x1 + $columnWidth / 2) + $i * $columnWidth;

                $point = current($pointList);
                next($pointList);

                $value = $point->getValue();

                $y2 = $graphArea->y2
                    - ($value - $minValue)
                    * ($graphArea->y2 - $graphArea->y1)
                    / ($this->axis->displayDelta);

                // Don't draw the "start" line, because the first point has $x1 = null
                // and that would create a line from the top left corner of the image
                // to the first point
                if (!is_null($x1)) {
                    $this->gd->line($x1, $y1, $x2, $y2, $lineColor);
                    // Print the rectangle to mark the point
                    $this->gd->rectangle($x1 - 2, $y1 - 2, $x1 + 2, $y1 + 2, $lineColor);
                }

                if ($this->pointLabel->show()) {
                    $this->pointLabel->draw(
                        $x2,
                        $value >= 0 ? $y2 - 15 : $y2 + 15,
                        $value,
                        $this->text->HORIZONTAL_CENTER_ALIGN | $this->text->VERTICAL_CENTER_ALIGN
                    );
                }

                $x1 = $x2;
                $y1 = $y2;
            }

            // Print the rectangle for the last point
            if (!is_null($x1) && !is_null($y1)) {
                $this->gd->rectangle($x1 - 2, $y1 - 2, $x1 + 2, $y1 + 2, $lineColor);
            }
        }
    }
}
