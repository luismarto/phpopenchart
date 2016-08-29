<?php namespace Libchart\Chart;

use Libchart\Color\ColorHex;
use Libchart\Element\BasicPadding;

/**
 * Class Pie
 * @package Libchart\Chart
 */
class Pie extends AbstractChart
{
    /**
     * @var float
     */
    protected $pieCenterX;

    /**
     * @var float
     */
    protected $pieCenterY;

    /**
     * @var int
     */
    private $pieWidth;

    /**
     * @var int
     */
    private $pieHeight;

    /**
     * @var int
     */
    private $pieDepth;

    /**
     * @var int
     */
    private $total;

    /**
     * @var array
     */
    private $percent;

    /**
     * Constructor of a pie chart.
     *
     * @param array $args
     */
    public function __construct($args)
    {
        parent::__construct($args);
        $this->setGraphPadding(new BasicPadding(15, 10, 30, 30));
    }

    /**
     * Computes the layout.
     */
    protected function computePieLayout()
    {
        // Get the graph area
        $graphArea = $this->graphArea;

        // Compute the coordinates of the pie
        $this->pieCenterX = $graphArea->x1 + ($graphArea->x2 - $graphArea->x1) / 2;
        $this->pieCenterY = $graphArea->y1 + ($graphArea->y2 - $graphArea->y1) / 2;

        $this->pieWidth = round(($graphArea->x2 - $graphArea->x1) * 4 / 5);
        $this->pieHeight = round(($graphArea->y2 - $graphArea->y1) * 3.7 / 5);
        $this->pieDepth = round($this->pieWidth * 0.05);
    }

    /**
     * Compare two sampling point values, order from biggest to lowest value.
     *
     * @param double $v1 first value
     * @param double $v2 second value
     * @return integer result of the comparison
     */
    protected function sortPie($v1, $v2)
    {
        return $v1[0] == $v2[0]
            ? 0
            : ($v1[0] > $v2[0]
                ? -1
                : 1
            );
    }

    /**
     * Compute pie values in percentage and sort them.
     */
    protected function computePercent()
    {
        $this->total = 0;
        $this->percent = array();

        $pointList = $this->dataSet->getPointList();
        foreach ($pointList as $point) {
            $this->total += $point->getY();
        }

        foreach ($pointList as $point) {
            $percent = $this->total == 0
                ? 0
                : 100 * $point->getY() / $this->total;

            array_push($this->percent, array($percent, $point));
        }

        // Sort data points
        if ($this->sortDataPoint) {
            usort($this->percent, array("\\Libchart\\Chart\\Pie", "sortPie"));
        }
    }

    /**
     * Creates the pie chart image.
     */
    protected function createImage()
    {
        // Get the graph area
        $graphArea = $this->graphArea;

        // Legend box
        $this->gd->outlinedBox(
            $graphArea->x1,
            $graphArea->y1,
            $graphArea->x2,
            $graphArea->y2,
            $this->palette->axisColor[0],
            $this->palette->axisColor[1]
        );

        // Aqua-like background
        for ($i = $graphArea->y1 + 2; $i < $graphArea->y2 - 1; $i++) {
            $this->gd->line($graphArea->x1 + 2, $i, $graphArea->x2 - 2, $i, new ColorHex('#ffffff'));
        }
    }

    /**
     * Renders the caption.
     */
    protected function printCaption()
    {
        // Create a list of labels
        $labelList = array();
        foreach ($this->percent as $percent) {
            /**
             * @var \Libchart\Data\Point $point
             */
            list(, $point) = $percent;
            $label = $point->getX();

            array_push($labelList, $label);
        }

        // Create the caption
        $caption = new Caption(
            $this->captionArea,
            $this->palette->pieColorSet,
            $this->gd,
            $this->palette,
            $this->text
        );
        $caption->setLabelList($labelList);

        // Render the caption
        $caption->render();
    }

    /**
     * Draw a 2D disc.
     *
     * @param integer $cy Center coordinate (y)
     * @param array $colorArray Colors for each portion
     * @param int $mode Drawing mode
     */
    protected function drawDisc($cy, $colorArray, $mode)
    {
        $i = 0;
        $oldAngle = 0;
        $percentTotal = 0;

        foreach ($this->percent as $a) {
            list ($percent, ) = $a;

            // If value is null, don't draw this arc
            if ($percent <= 0) {
                $i++;
                continue;
            }

            $color = $colorArray[$i % count($colorArray)];

            $percentTotal += $percent;
            $newAngle = $percentTotal * 360 / 100;

            // imagefilledarc doesn't like null values (#1)
            if ($newAngle - $oldAngle >= 1) {
                imagefilledarc(
                    $this->img,
                    $this->pieCenterX,
                    $cy,
                    $this->pieWidth,
                    $this->pieHeight,
                    $oldAngle,
                    $newAngle,
                    $color->getColor($this->img),
                    $mode
                );
            }

            $oldAngle = $newAngle;

            $i++;
        }
    }

    /**
     * Print the percentage text.
     */
    protected function drawPercent()
    {
        $angle1 = 0;
        $percentTotal = 0;

        foreach ($this->percent as $a) {
            list ($percent,) = $a;

            // If value is null, the arc isn't drawn, no need to display percent
            if ($percent <= 0) {
                continue;
            }

            $percentTotal += $percent;
            $angle2 = $percentTotal * 2 * M_PI / 100;

            $angle = $angle1 + ($angle2 - $angle1) / 2;
            $label = number_format($percent) . "%";

            $x = cos($angle) * ($this->pieWidth + 35) / 2 + $this->pieCenterX;
            $y = sin($angle) * ($this->pieHeight + 35) / 2 + $this->pieCenterY;

            $this->text->draw(
                $x,
                $y,
                $this->text->getColor(),
                $label,
                $this->text->getFont(),
                $this->text->HORIZONTAL_CENTER_ALIGN | $this->text->VERTICAL_CENTER_ALIGN
            );

            $angle1 = $angle2;
        }
    }

    /**
     * Print the pie chart.
     */
    protected function printPie()
    {
        // Get the pie color set
        $pieColorSet = $this->palette->pieColorSet;
        $pieColorSet->reset();

        // Silhouette
        for ($cy = $this->pieCenterY + $this->pieDepth / 2; $cy >= $this->pieCenterY - $this->pieDepth / 2; $cy--) {
            $this->drawDisc($cy, $this->palette->pieColorSet->shadowColorList, IMG_ARC_EDGED);
        }

        // Top
        $this->drawDisc($this->pieCenterY - $this->pieDepth / 2, $this->palette->pieColorSet->colorList, IMG_ARC_PIE);

        // Top Outline
        if ($this->showPointCaption) {
            $this->drawPercent();
        }
    }

    /**
     * Render the chart image.
     *
     * @param string $filename name of the file to render the image to (optional)
     */
    public function render($filename = null)
    {
        $this->computePercent();
        $this->computeLayout();
        $this->computePieLayout();
        $this->createImage();
        $this->logo->draw();
        $this->title->draw();
        $this->printPie();
        $this->printCaption();

        $this->output($filename);
    }
}
