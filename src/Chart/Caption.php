<?php namespace Libchart\Chart;

/**
 * Class Caption
 * @package Libchart\Chart
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
     * @var \Libchart\Color\ColorSet
     */
    private $colorSet;

    private $captionArea;

    /**
     * @var \Libchart\Element\Primitive
     */
    private $primitive;

    /**
     * @var \Libchart\Color\ColorPalette
     */
    private $palette;

    /**
     * @var \Libchart\Element\Text
     */
    private $text;

    /**
     * @param $captionArea
     * @param \Libchart\Color\ColorSet $colorSet
     * @param \Libchart\Element\Primitive $primitive
     * @param \Libchart\Color\ColorPalette $palette
     * @param \Libchart\Element\Text $text
     */
    public function __construct($captionArea, $colorSet, $primitive, $palette, $text)
    {
        $this->labelBoxWidth = 15;
        $this->labelBoxHeight = 15;
        $this->captionArea = $captionArea;
        $this->colorSet = $colorSet;
        $this->primitive = $primitive;
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

            $this->primitive->outlinedBox($boxX1, $boxY1, $boxX2, $boxY2, $this->palette->axisColor[0], $this->palette->axisColor[1]);
            $this->primitive->rectangle($boxX1 + 2, $boxY1 + 2, $boxX2 - 2, $boxY2 - 2, $color);

            $this->text->printText(
                $boxX2 + 5,
                $boxY1 + $this->labelBoxHeight / 2,
                $this->text->getTextColor(),
                $label,
                $this->text->getTextFont(),
                $this->text->VERTICAL_CENTER_ALIGN
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
