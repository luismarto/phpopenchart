<?php namespace Phpopenchart\Element;

use Noodlehaus\Config;
use Phpopenchart\Data\XYSeriesDataSet;
use Phpopenchart\Data\XYDataSet;
use Phpopenchart\Data\Point;
use Phpopenchart\Color\ColorHex;

/**
 * Class Caption
 * @package Phpopenchart\Element
 */
class Caption extends AbstractElement
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
     * @var string
     */
    private $type;

    /**
     * @var \Phpopenchart\Element\Gd
     */
    private $gd;

    /**
     * @var \Phpopenchart\Element\Text
     */
    private $text;

    /**
     * @var null|XYDataSet|XYSeriesDataSet
     */
    private $dataset;

    /**
     * @var string
     */
    private $font;

    /**
     * @var int
     */
    private $fontSize;

    /**
     * @var ColorHex
     */
    private $color;

    /**
     * @param string $type
     * @param \Phpopenchart\Element\Gd $gd
     * @param \Phpopenchart\Element\Text $text
     * @param XYDataSet|XYSeriesDataSet|null $dataset
     * @param Config $config
     * @param array $args
     */
    public function __construct($type, $gd, $text, $dataset, $config, $args)
    {
        $this->labelBoxWidth = 15;
        $this->labelBoxHeight = 15;
        $this->type = $type;
        $this->gd = $gd;
        $this->text = $text;
        $this->dataset = $dataset;

        if (array_key_exists('caption-label', $args) && is_array($args['caption-label'])) {
            if (array_key_exists('font', $args['caption-label'])) {
                $this->font = $this->setFont($args['caption-label']['font']);
            }
            if (array_key_exists('size', $args['caption-label'])) {
                $this->fontSize = (int)$args['caption-label']['size'];
            }
            if (array_key_exists('color', $args['caption-label'])) {
                $this->color = new ColorHex($args['caption-label']['color']);
            }
        }

        if (is_null($this->font)) {
            $this->font = $this->setFont(
                $config->get(
                    'caption-label.font',
                    __DIR__ . DIRECTORY_SEPARATOR. '..' . DIRECTORY_SEPARATOR . '..'
                    . DIRECTORY_SEPARATOR . 'fonts' . DIRECTORY_SEPARATOR . 'SourceSansPro-Regular.otf'
                )
            );
        }
        if (is_null($this->fontSize)) {
            $this->fontSize = (int)$config->get('caption-label.size', 10);
        }
        if (is_null($this->color)) {
            $this->color = new ColorHex($config->get('caption-label.color', '#666666'));
        }
    }

    /**
     * Render the caption.
     * @var \Phpopenchart\Element\BasicRectangle $captionArea
     * @param \Phpopenchart\Color\ColorPalette $palette
     */
    public function render($captionArea, $palette)
    {
        // Get the pie color set
        $colorSet = $this->type === 'pie' ? $palette->getPieColorSet() : $palette->getBarColorSet();
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

            $boxX1 = $captionArea->x1;
            $boxX2 = $boxX1 + $this->labelBoxWidth;
            $boxY1 = $captionArea->y1 + 5 + $i * ($this->labelBoxHeight + 5);
            $boxY2 = $boxY1 + $this->labelBoxHeight;

            // Print the outline of the square color for the serie
            $this->gd->rectangle($boxX1, $boxY1, $boxX2, $boxY2, $palette->getAxisColor()[1]);
            // Print the square color for the serie
            $this->gd->rectangle($boxX1 + 1, $boxY1 + 1, $boxX2 - 1, $boxY2 - 1, $color);

            $this->text->draw(
                $boxX1 + 22,
                $boxY1 + $this->labelBoxHeight / 2,
                $this->color,
                $label,
                $this->font,
                $this->text->getAlignment('horizontal', 'right') | $this->text->getAlignment('vertical', 'middle'),
                $this->fontSize
            );

            $i++;
        }
    }
}
