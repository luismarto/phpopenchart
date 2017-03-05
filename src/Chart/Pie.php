<?php namespace Phpopenchart\Chart;

/**
 * Class Pie
 * @package Phpopenchart\Chart
 */
class Pie extends AbstractChart
{
    /**
     * @var float
     */
    private $pieCenterX;

    /**
     * @var float
     */
    private $pieCenterY;

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
        parent::__construct($args, 'pie');
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
     * Compute pie values in percentage and sort them.
     */
    private function computePercent()
    {
        $this->total = 0;
        $this->percent = [];

        $pointList = $this->getDataSet()->getPointList();
        foreach ($pointList as $point) {
            $this->total += $point->getValue() < 0 ? 0 : $point->getValue();
        }

        foreach ($pointList as $point) {
            $percent = $this->total == 0
                ? 0
                : 100 * $point->getValue() / $this->total;

            $this->percent[] = [$percent, $point];
        }
    }

    /**
     * Draw a 2D disc.
     *
     * @param integer $cy Center coordinate (y)
     * @param array $colorArray Colors for each portion
     * @param int $mode Drawing mode
     */
    private function drawDisc($cy, $colorArray, $mode)
    {
        $i = 0;
        $oldAngle = 0;
        $percentTotal = 0;
        foreach ($this->percent as $a) {
            /**
             * @var \Phpopenchart\Data\Point $point
             */
            list ($percent, $point) = $a;

            // If value is null, don't draw this arc
            if ($percent <= 0) {
                $i++;
                continue;
            }

            $color = $colorArray[$i % count($colorArray)];

            // Check if the point has a specific color. If so, this overrides anything else
            if (!is_null($point->getColor())) {
                $color = $point->getColor();
                // IF we're printing the shadow, add the shadow color factor
                if ($mode === IMG_ARC_EDGED) {
                    $color = $color->getShadowColor(0.7);
                }
            }

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
    private function drawPercent()
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

            $x = cos($angle) * ($this->pieWidth + 35) / 2 + $this->pieCenterX;
            $y = sin($angle) * ($this->pieHeight + 35) / 2 + $this->pieCenterY;
            $this->pointLabel->draw(
                $x,
                $y,
                $percent,
                $this->text->getAlignment('horizontal', 'center') | $this->text->getAlignment('vertical', 'middle')
            );

            $angle1 = $angle2;
        }
    }

    /**
     * Print the pie chart.
     */
    private function printPie()
    {
        // Get the pie color set
        $pieColorSet = $this->palette->getPieColorSet();
        $pieColorSet->reset();

        // Silhouette
        for ($cy = $this->pieCenterY + $this->pieDepth / 2; $cy >= $this->pieCenterY - $this->pieDepth / 2; $cy--) {
            $this->drawDisc($cy, $this->palette->getPieColorSet()->shadowColorList, IMG_ARC_EDGED);
        }

        // Top
        $this->drawDisc(
            $this->pieCenterY - $this->pieDepth / 2,
            $this->palette->getPieColorSet()->colorList,
            IMG_ARC_PIE
        );

        // Top Outline
        if ($this->pointLabel->show()) {
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
        $captionArea = $this->computeLayout();
        $this->computePieLayout();
        $this->logo->draw();
        $this->title->draw();
        $this->printPie();
        $this->caption->render(
            $captionArea,
            $this->palette
        );

        // If there's no filename, then render the chart as an image
        if (is_null($filename)) {
            header("Content-type: image/png");
        }

        $this->output($filename);
    }
}
