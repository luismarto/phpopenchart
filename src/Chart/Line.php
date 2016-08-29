<?php namespace Libchart\Chart;

use Libchart\Element\BasicPadding;

/**
 * Class Line
 * @package Libchart\Chart
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

        $this->setGraphPadding(new BasicPadding(5, 30, 50, 50));
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

        // Vertical axis
        $this->gd->line($graphArea->x1, $graphArea->y1, $graphArea->x1, $graphArea->y2, $axisColor0);

        for ($value = $minValue; $value <= $maxValue; $value += $stepValue) {
            $y = $graphArea->y2
                - ($value - $minValue)
                * ($graphArea->y2 - $graphArea->y1)
                / ($this->axis->displayDelta);

            $this->gd->line($graphArea->x1, $y, $graphArea->x2, $y, $this->palette->backgroundColor);

            $this->text->draw(
                $graphArea->x1 - 5,
                $y,
                $this->text->getColor(),
                $this->axisLabelGenerator->generateLabel($value),
                $this->text->getFont(),
                $this->text->HORIZONTAL_RIGHT_ALIGN | $this->text->VERTICAL_CENTER_ALIGN
            );
        }

        // Get first serie of a list
        $pointList = $this->getFirstSerieOfList();

        // Horizontal Axis
        $pointCount = count($pointList);
        reset($pointList);
        $columnWidth = ($graphArea->x2 - $graphArea->x1) / ($pointCount - 1);
        $horizOriginY = $graphArea->y2 + $minValue * ($graphArea->y2 - $graphArea->y1) / ($this->axis->displayDelta);

        $this->gd->line($graphArea->x1, $horizOriginY, $graphArea->x2, $horizOriginY, $axisColor0);

        for ($i = 0; $i < $pointCount; $i++) {
            $x = $graphArea->x1 + $i * $columnWidth;

            // Markers for each serie point
            $this->gd->line($x, $graphArea->y2, $x, $graphArea->y2 + 5, $axisColor0);

            $point = current($pointList);
            next($pointList);

            $label = $point->getX();

            $this->text->printDiagonal($x - 5, $graphArea->y2 + 10, $this->text->getColor(), $label);
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

        $lineColorSet = $this->palette->barColorSet;
        $lineColorSet->reset();
        for ($j = 0; $j < count($serieList); $j++) {
            $serie = $serieList[$j];
            $pointList = $serie->getPointList();
            $pointCount = count($pointList);
            reset($pointList);

            $columnWidth = ($graphArea->x2 - $graphArea->x1) / ($pointCount - 1);

            $lineColor = $lineColorSet->currentColor();
            $lineColorSet->next();
            $x1 = null;
            $y1 = null;
            for ($i = 0; $i < $pointCount; $i++) {
                $x2 = $graphArea->x1 + $i * $columnWidth;

                $point = current($pointList);
                next($pointList);

                $value = $point->getY();

                $y2 = $graphArea->y2
                    - ($value - $minValue)
                    * ($graphArea->y2 - $graphArea->y1)
                    / ($this->axis->displayDelta);

                // Draw line
                if (!is_null($x1)) {
                    $this->gd->line($x1, $y1, $x2, $y2, $lineColor);
                    $this->text->draw(
                        $x2,
                        $y2 - 15,
                        $this->text->getColor(),
                        $this->barLabelGenerator->generateLabel($value),
                        $this->text->getFont(),
                        $this->text->HORIZONTAL_RIGHT_ALIGN | $this->text->VERTICAL_CENTER_ALIGN
                    );
                }

                $x1 = $x2;
                $y1 = $y2;
            }
        }
    }
}
