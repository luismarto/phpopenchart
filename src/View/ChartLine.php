<?php namespace Libchart\View;

/**
 * Line chart.
 *
 */
class ChartLine extends ChartBar
{
    use PlotTrait;

    /**
     * Creates a new line chart.
     * Line charts allow for XYDataSet and XYSeriesDataSet in order to plot several lines.
     *
     * @param integer $width of the image
     * @param integer $height of the image
     */
    public function __construct($width = 600, $height = 250)
    {
        parent::__construct($width, $height);
        $this->init($width, $height, $this->hasSeveralSerie);
        $this->setGraphPadding(new PrimitivePadding(5, 30, 50, 50));
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
        $this->primitive->rectangle($graphArea->x1 - 1, $graphArea->y1, $graphArea->x1, $graphArea->y2, $axisColor0);

        for ($value = $minValue; $value <= $maxValue; $value += $stepValue) {
            $y = $graphArea->y2
                - ($value - $minValue)
                * ($graphArea->y2 - $graphArea->y1)
                / ($this->axis->displayDelta);

            $this->primitive->rectangle($graphArea->x1 - 3, $y, $graphArea->x1 - 2, $y +1, $axisColor0);
            $this->primitive->rectangle($graphArea->x1 -1, $y, $graphArea->x1, $y + 1, $axisColor0);

            $this->text->printText(
                $graphArea->x1 - 5,
                $y,
                $this->text->getTextColor(),
                $this->axisLabelGenerator->generateLabel($value),
                $this->text->getTextFont(),
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

        $this->primitive->rectangle($graphArea->x1 -1, $horizOriginY, $graphArea->x2, $horizOriginY + 1, $axisColor0);

        for ($i = 0; $i < $pointCount; $i++) {
            $x = $graphArea->x1 + $i * $columnWidth;

            $this->primitive->rectangle($x - 1, $graphArea->y2 + 2, $x, $graphArea->y2 + 3, $axisColor0);
            $this->primitive->rectangle($x -1, $graphArea->y2, $x, $graphArea->y2 + 1, $axisColor0);

            $point = current($pointList);
            next($pointList);

            $label = $point->getX();

            $this->text->printDiagonal($x - 5, $graphArea->y2 + 10, $this->text->getTextColor(), $label);
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
            $lineColorShadow = $lineColorSet->currentShadowColor();
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
                if ($x1) {
                    $this->primitive->line($x1, $y1, $x2, $y2, $lineColor, 4);
                    $this->primitive->line($x1, $y1 - 1, $x2, $y2 - 1, $lineColorShadow, 2);
                }

                $x1 = $x2;
                $y1 = $y2;
            }
        }
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
        if ($this->hasLogo()) {
            $this->printLogo();
        }
        $this->printTitle();
        if (!$this->isEmptyDataSet(2)) {
            $this->printAxis();
            $this->printLine();
            if ($this->hasSeveralSerie) {
                $this->printCaption();
            }
        }

        if (isset($fileName)) {
            imagepng($this->img, $fileName);
        } else {
            imagepng($this->img);
        }
    }
}
