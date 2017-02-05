<?php namespace Phpopenchart\Chart;

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
     * @var array
     */
    protected $labelList;

    /**
     * @var \Phpopenchart\Color\ColorSet
     */
    private $colorSet;

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
     * @param $captionArea
     * @param \Phpopenchart\Color\ColorSet $colorSet
     * @param \Phpopenchart\Element\Gd $gd
     * @param \Phpopenchart\Color\ColorPalette $palette
     * @param \Phpopenchart\Element\Text $text
     */
    public function __construct($captionArea, $colorSet, $gd, $palette, $text)
    {
        $this->labelBoxWidth = 15;
        $this->labelBoxHeight = 15;
        $this->captionArea = $captionArea;
        $this->colorSet = $colorSet;
        $this->gd = $gd;
        $this->palette = $palette;
        $this->text = $text;
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
        foreach ($this->labelList as $label) {
            // Get the next color
            $color = $colorSet->currentColor();
            $colorSet->next();

            $boxX1 = $this->captionArea->x1;
            $boxX2 = $boxX1 + $this->labelBoxWidth;
            $boxY1 = $this->captionArea->y1 + 5 + $i * ($this->labelBoxHeight + 5);
            $boxY2 = $boxY1 + $this->labelBoxHeight;

            // Print the outline of the square color for the serie
            $this->gd->rectangle($boxX1, $boxY1, $boxX2, $boxY2, $this->palette->axisColor[1]);
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

    /**
     * Sets the label list.
     *
     * @param array $labelList label list
     */
    public function setLabelList($labelList)
    {
        $this->labelList = $labelList;
    }
}
