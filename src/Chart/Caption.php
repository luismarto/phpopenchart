<?php namespace Phpopenchart\Chart;

use Phpopenchart\Data\XYSeriesDataSet;
use Phpopenchart\Data\XYDataSet;
use Phpopenchart\Data\Point;

/**
 * Class Caption
 * @package Phpopenchart\Chart
 */
class Caption
{
    /**
     * @var int
     */
    protected $labelBoxWidth;

    /**
     * @var int
     */
    protected $labelBoxHeight;

    /**
     * @var \Phpopenchart\Color\ColorSet
     */
    private $colorSet;

    /**
     * @var \Phpopenchart\Element\BasicRectangle
     */
    private $captionArea;

    /**
     * @var \Phpopenchart\Element\Gd
     */
    private $gd;

    /**
     * @var \Phpopenchart\Color\ColorPalette
     */
    private $palette;

    /**
     * @var \Phpopenchart\Element\Text
     */
    private $text;

    /**
     * @var null|XYDataSet|XYSeriesDataSet
     */
    private $dataset;

    /**
     * @param $captionArea
     * @param \Phpopenchart\Color\ColorSet $colorSet
     * @param \Phpopenchart\Element\Gd $gd
     * @param \Phpopenchart\Color\ColorPalette $palette
     * @param \Phpopenchart\Element\Text $text
     * @param XYDataSet|XYSeriesDataSet|null $dataset
     */
    public function __construct($captionArea, $colorSet, $gd, $palette, $text, $dataset)
    {
        $this->labelBoxWidth = 15;
        $this->labelBoxHeight = 15;
        $this->captionArea = $captionArea;
        $this->colorSet = $colorSet;
        $this->gd = $gd;
        $this->palette = $palette;
        $this->text = $text;
        $this->dataset = $dataset;
    }

    /**
     * Render the caption.
     */
    public function render()
    {
        // Get the pie color set
        $colorSet = $this->colorSet;
        $colorSet->reset();

        $i = 0;
        $captionList = [];
        if ($this->dataset instanceof XYSeriesDataSet) {
            // For a series dataset, print the legend from the first serie
            $captionList = $this->dataset->getTitleList();
        } elseif ($this->dataset instanceof XYDataSet) {
            $captionList = $this->dataset->getPointList();
        }

        /**
         * @var \Phpopenchart\Data\Point $point|string
         */
        foreach ($captionList as $point) {
            $color = null;
             // Get the next color
            if ($point instanceof Point) {
                $label = $point->getLabel();
                if (!is_null($point->getColor())) {
                    $color = $point->getColor();
                }
            } else {
                $label = $point;
            }

            if (is_null($color)) {
                $color = $colorSet->currentColor();
                $colorSet->next();
            }

            $boxX1 = $this->captionArea->x1;
            $boxX2 = $boxX1 + $this->labelBoxWidth;
            $boxY1 = $this->captionArea->y1 + 5 + $i * ($this->labelBoxHeight + 5);
            $boxY2 = $boxY1 + $this->labelBoxHeight;

            // Print the outline of the square color for the serie
            $this->gd->rectangle($boxX1, $boxY1, $boxX2, $boxY2, $this->palette->getAxisColor()[1]);
            // Print the square color for the serie
            $this->gd->rectangle($boxX1 + 1, $boxY1 + 1, $boxX2 - 1, $boxY2 - 1, $color);

            $this->text->draw(
                $boxX1 + 22,
                $boxY1 + $this->labelBoxHeight / 2,
                $this->text->getColor(),
                $label,
                $this->text->getFont(),
                $this->text->getAlignment('horizontal', 'right') | $this->text->getAlignment('vertical', 'middle')
            );

            $i++;
        }
    }
}
