<?php namespace Libchart\Chart;

/**
 * Class Bar
 * @package Libchart\Chart
 */
class Bar extends AbstractChartBar
{
    use PlotTrait;

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

        // Set the trait's properties
        $this->init($width, $height, $this->hasSeveralSerie);
        $this->setGraphPadding($this->primitive->getPadding(5, 30, 30, 50));
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
        $this->primitive->line($graphArea->x1 - 1, $graphArea->y2, $graphArea->x2, $graphArea->y2, $axisColor0);

        for ($value = $minValue; $value <= $maxValue; $value += $stepValue) {
            $x = $graphArea->x1
                + ($value - $minValue)
                * ($graphArea->x2 - $graphArea->x1)
                / ($this->axis->displayDelta);

            // Draw the guiding line and marker for each step value
            $this->primitive->line($x, $graphArea->y1, $x, $graphArea->y2, $this->palette->backgroundColor);

            // Draw the text for each step value (guiding marker)
            $label = $this->axisLabelGenerator->generateLabel($value);
            $this->text->printText(
                $x,
                $graphArea->y2 + 5,
                $this->text->getTextColor(),
                $label,
                $this->text->getTextFont(),
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
        $this->primitive->line($verticalOriginX, $graphArea->y1, $verticalOriginX, $graphArea->y2, $axisColor0);

        for ($i = 0; $i <= $pointCount; $i++) {
            $y = $graphArea->y2 - $i * $rowHeight;

            // Prints the small blue markers that separate each point / bar
            $this->primitive->line($verticalOriginX - 5, $y, $verticalOriginX, $y, $axisColor0);

            if ($i < $pointCount) {
                $point = current($pointList);
                next($pointList);

                $label = $point->getX();

                $this->text->printText(
                    $graphArea->x1 - 5,
                    $y - $rowHeight / 2,
                    $this->text->getTextColor(),
                    $label,
                    $this->text->getTextFont(),
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
            if (!$this->config->get('useMultipleColor')) {
                $bColor = $barColorSet->currentColor();
                $bShadowColor = $barColorSet->currentShadowColor();
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
                    $this->img,
                    $verticalOriginX + ($value >= 0 ? 1 : -1),
                    $y1,
                    $xmax,
                    $y2,
                    $shadowColor->getColor($this->img)
                );

                // Prevents drawing a small box when x = 0
                if ($value != 0) {
                    imagefilledrectangle(
                        $this->img,
                        $verticalOriginX + ($value >= 0 ? 2 : -2),
                        $y1 + 1,
                        $xmax + ($value >= 0 ? -4 : -0),
                        $y2,
                        $color->getColor($this->img)
                    );
                }

                // Draw caption text on bar
                if ($this->config->get('showPointCaption')) {
                    $label = $this->barLabelGenerator->generateLabel($value);
                    $textAlign = $this->text->VERTICAL_CENTER_ALIGN
                        | ($value > 0 ? $this->text->HORIZONTAL_LEFT_ALIGN : $this->text->HORIZONTAL_RIGHT_ALIGN);

                    $this->text->printText(
                        $xmax + ($value > 0 ? 5 : -10),
                        $y2 - $barWidth / 2,
                        $this->text->getTextColor(),
                        $label,
                        $this->text->getTextFont(),
                        $textAlign
                    );
                }
            }
        }
    }

    /**
     * Render the chart image.
     *
     * @param string $filename name of the file to render the image to (optional)
     */
    public function render($filename = null)
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

        $this->output($filename);
    }
}
