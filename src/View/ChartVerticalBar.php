<?php namespace Libchart\View;

/**
 * Chart composed of vertical bars.
 */
class ChartVerticalBar extends ChartBar
{
    use PlotTrait;

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

        $this->init($width, $height, $this->hasSeveralSerie);
        $this->setGraphPadding($this->primitive->getPadding(5, 30, 50, 50));
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
        $axisColor0 = $this->palette->axisColor[0];
        /**
         * Deal with the Vertical Axis
         */
        $this->primitive->line($graphArea->x1 - 1, $graphArea->y1, $graphArea->x1 - 1, $graphArea->y2, $axisColor0);

        for ($value = $minValue; $value <= $maxValue; $value += $stepValue) {
            $y = $graphArea->y2
                - ($value - $minValue)
                * ($graphArea->y2 - $graphArea->y1)
                / ($this->axis->displayDelta);

            // This creates a little blue marker, next to the label of the Y axis, that match
            // each chart step.
            $this->primitive->line($graphArea->x1 - 2, $y, $graphArea->x1, $y, $axisColor0);

            // For each marker, create the "guiding line"
            $color = $this->palette->backgroundColor;
            $this->primitive->line($graphArea->x1, $y, $graphArea->x2, $y, $color);

            // Now print the label for the y axis
            $this->text->printText(
                $graphArea->x1 - 10,
                $y,
                $this->text->getTextColor(),
                $this->axisLabelGenerator->generateLabel($value),
                $this->text->getTextFont(),
                $this->text->HORIZONTAL_RIGHT_ALIGN | $this->text->VERTICAL_CENTER_ALIGN
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

        $this->primitive->line($graphArea->x1 -1, $horizOriginY, $graphArea->x2, $horizOriginY, $axisColor0);

        for ($i = 0; $i <= $pointCount; $i++) {
            $x = $graphArea->x1 + $i * $columnWidth;

            $this->primitive->line($x, $horizOriginY, $x, $horizOriginY + 3, $axisColor0);

            if ($i < $pointCount) {
                $point = current($pointList);
                next($pointList);

                $label = $point->getX();

                $this->text->printDiagonal(
                    $x + $columnWidth * 1 / 3,
                    $graphArea->y2 + 10,
                    $this->text->getTextColor(),
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

        // Get the graph area
        $graphArea = $this->graphArea;

        // Start from the first color for the first serie
        $barColorSet = $this->palette->barColorSet;
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
                $this->primitive->line($x1, $ymin, $x2, $horizOriginY + ($value >= 0 ? -1 : 1), $shadowColor);

                // Prevents drawing a small box when y = 0
                if ($value != 0) {
                    $this->primitive->rectangle(
                        $x1 + 1,
                        $ymin + ($value > 0 ? 1 : 0),
                        $x2 - 4,
                        $horizOriginY + ($value >= 0 ? -1 : 2),
                        $color
                    );
                }

                // Draw caption text on bar
                if ($this->config->get('showPointCaption')) {
                    $this->text->printText(
                        $x1 + $barWidth / 2,
                        ($value > 0 ? $ymin - 5 : $ymin + 15),
                        $this->text->getTextColor(),
                        $this->barLabelGenerator->generateLabel($value),
                        $this->text->getTextFont(),
                        $this->text->HORIZONTAL_CENTER_ALIGN | $this->text->VERTICAL_BOTTOM_ALIGN
                    );
                }
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
        if (!$this->isEmptyDataSet(1)) {
            $this->printAxis();
            $this->printBar();
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
