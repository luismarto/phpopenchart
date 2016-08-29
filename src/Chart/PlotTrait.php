<?php namespace Libchart\Chart;

use Libchart\Color\ColorPalette;
use Libchart\Color\ColorHex;
use Libchart\Color\Color;
use Libchart\Element\BasicPadding;
use Libchart\Element\Logo;
use Libchart\Element\Primitive;
use Libchart\Element\PrimitiveRectangle;
use Libchart\Element\Text;
use Libchart\Element\Title;
use Noodlehaus\Config;

/**
 * Class PlotTrait
 *
 * The plot holds graphical attributes, and is responsible for computing the layout of the graph.
 * The layout is quite simple right now, with 4 areas laid out like that:
 * (of course this is subject to change in the future).
 *
 * output area------------------------------------------------|
 * |  (outer padding)                                         |
 * |  image area--------------------------------------------| |
 * |  | (title padding)                                     | |
 * |  | title area----------------------------------------| | |
 * |  | |-------------------------------------------------| | |
 * |  |                                                     | |
 * |  | (graph padding)              (caption padding)      | |
 * |  | graph area----------------|  caption area---------| | |
 * |  | |                         |  |                    | | |
 * |  | |                         |  |                    | | |
 * |  | |                         |  |                    | | |
 * |  | |                         |  |                    | | |
 * |  | |                         |  |                    | | |
 * |  | |-------------------------|  |--------------------| | |
 * |  |                                                     | |
 * |  |-----------------------------------------------------| |
 * |                                                          |
 * |----------------------------------------------------------|
 *
 * All area dimensions are known in advance, and the optional logo is drawn in absolute coordinates.
 *
 * @package Libchart\Chart
 */
trait PlotTrait
{
    /**
     * Width of the chart in pixels
     * @var int
     */
    protected $width;

    /**
     * Height of the chart in pixels
     * @var int
     */
    protected $height;

    /**
     * GD image of the chart
     * @var resource|null
     */
    protected $img = null;

    /**
     * Var with GD methods to create lines and rectangles
     * @var Primitive
     */
    protected $primitive;

    /**
     * Default color palette with methods to set other colors
     * @var ColorPalette
     */
    protected $palette;

    /**
     * Enables you to draw text
     * @var Text
     */
    protected $text;

    /**
     * The title instance of this chart
     * @var Title
     */
    protected $title;

    /**
     * @var Logo
     */
    protected $logo;


    /**
     * Outer area, whose dimension is the same as the PNG returned.
     * @var PrimitiveRectangle
     */
    protected $outputArea;

    /**
     * Coordinates of the area inside the outer padding.
     */
    protected $imageArea;









    /**
     * Outer padding surrounding the whole image, everything outside is blank.
     */
    protected $outerPadding;



    /**
     * True if the plot has a caption.
     */
    protected $hasCaption;

    /**
     * Ratio of graph/caption in width.
     */
    protected $graphCaptionRatio;

    /**
     * Padding of the graph area.
     */
    protected $graphPadding;

    /**
     * Coordinates of the graph area.
     * @var PrimitiveRectangle
     */
    protected $graphArea;

    /**
     * Padding of the caption area.
     */
    protected $captionPadding;

    /**
     * Coordinates of the caption area.
     */
    protected $captionArea;

    /**
     * Label generator for axis values
     * @var \Libchart\Label\DefaultLabel
     */
    protected $axisLabelGenerator;

    /**
     * Label generator for bar values
     * @var \Libchart\Label\DefaultLabel
     */
    protected $barLabelGenerator;

    /**
     * @var Color
     */
    protected $backGroundColor;

    /**
     * @var Config
     */
    protected $config;

    /**
     * @var bool
     */
    private $hasSeveralSeries;

    protected function init($width, $height, $hasSeveralSeries = true)
    {
        $this->width = $width;
        $this->height = $height;

        // Get config file
        // Initialize the configuration
        $configPath = __DIR__
            . DIRECTORY_SEPARATOR . '..'
            . DIRECTORY_SEPARATOR . '..'
            . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';
        $this->config = Config::load($configPath);

        // Create image
        $this->img = imagecreatetruecolor($this->width, $this->height);

        // Init graphical classes
        $this->primitive = new Primitive($this->img);
        $this->text = new Text($this->img, $this->config);
        $this->title = new Title($this->text, $this->config);
        $this->outerPadding = new BasicPadding(5, 5, 5, 5);
        $this->logo = new Logo($this->primitive, $this->outerPadding, $this->config);
        $this->palette = new ColorPalette();
        // Immediately draw the chart background
        $this->primitive->rectangle(0, 0, $this->width - 1, $this->height - 1, new ColorHex('#ffffff'));

        $axisLabelGeneratorClass = $this->config->get(
            'axisLabelGenerator',
            '\Libchart\Label\DefaultLabel'
        );
        $this->axisLabelGenerator = new $axisLabelGeneratorClass;
        $barLabelGeneratorClass = $this->config->get(
            'barLabelGenerator',
            '\Libchart\Label\DefaultLabel'
        );
        $this->barLabelGenerator = new $barLabelGeneratorClass;

        // Default layout
        $this->outputArea = new PrimitiveRectangle(0, 0, $this->width - 1, $this->height - 1);
        $this->hasCaption = false;
        $this->graphCaptionRatio = 0.50;
        $this->graphPadding = new BasicPadding(50, 50, 50, 50);
        $this->captionPadding = new BasicPadding(15, 15, 15, 15);

        $this->hasSeveralSeries = $hasSeveralSeries;
    }

    /**
     * Compute the layout of all areas of the graph.
     */
    public function computeLayout()
    {
        if ($this->hasSeveralSeries) {
            $this->hasCaption = true;
        }

        $this->imageArea = $this->outputArea->getPaddedRectangle($this->outerPadding);

        // Compute Title Area
        $this->title->computeTitleArea($this->imageArea);
        $titleHeight = $this->title->getTitleHeight();
        $titlePadding = $this->title->getTitlePadding();

        // Compute graph area
        $titleUnpaddedBottom = $this->imageArea->y1 + $titleHeight + $titlePadding->top + $titlePadding->bottom;
        $graphArea = null;
        if ($this->hasCaption) {
            $graphUnpaddedRight = $this->imageArea->x1
                + ($this->imageArea->x2 - $this->imageArea->x1)
                * $this->graphCaptionRatio
                + $this->graphPadding->left
                + $this->graphPadding->right;
            $graphArea = new PrimitiveRectangle(
                $this->imageArea->x1,
                $titleUnpaddedBottom,
                $graphUnpaddedRight - 1,
                $this->imageArea->y2
            );
        } else {
            $graphArea = new PrimitiveRectangle(
                $this->imageArea->x1,
                $titleUnpaddedBottom,
                $this->imageArea->x2,
                $this->imageArea->y2
            );
        }
        $this->graphArea = $graphArea->getPaddedRectangle($this->graphPadding);


        if ($this->hasCaption) {
            // compute caption area
            $graphUnpaddedRight = $this->imageArea->x1
                + ($this->imageArea->x2 - $this->imageArea->x1)
                * $this->graphCaptionRatio
                + $this->graphPadding->left
                + $this->graphPadding->right;
            $titleUnpaddedBottom = $this->imageArea->y1
                + $titleHeight
                + $titlePadding->top
                + $titlePadding->bottom;
            $captionArea = new PrimitiveRectangle(
                $graphUnpaddedRight,
                $titleUnpaddedBottom,
                $this->imageArea->x2,
                $this->imageArea->y2
            );
            $this->captionArea = $captionArea->getPaddedRectangle($this->captionPadding);
        }
    }

    public function output($filename = null)
    {
        if (isset($filename)) {
            imagepng($this->img, $filename);
        } else {
            imagepng($this->img);
        }
    }


    /**
     * Set the outer padding.
     *
     * @param \stdClass $outerPadding Outer padding value in pixels
     */
    public function setOuterPadding($outerPadding)
    {
        $this->outerPadding = $outerPadding;
    }

    /**
     * Return the graph padding.
     *
     * @param BasicPadding $graphPadding graph padding
     */
    public function setGraphPadding($graphPadding)
    {
        $this->graphPadding = $graphPadding;
    }

    /**
     * Set if the graph has a caption.
     *
     * @param boolean $hasCaption graph has a caption
     */
    public function setHasCaption($hasCaption)
    {
        $this->hasCaption = $hasCaption;
    }

    /**
     * Set the caption padding.
     *
     * @param integer caption padding
     */
    public function setCaptionPadding($captionPadding)
    {
        $this->captionPadding = $captionPadding;
    }

    /**
     * Set the graph/caption ratio.
     *
     * @param integer caption padding
     */
    public function setGraphCaptionRatio($graphCaptionRatio)
    {
        $this->graphCaptionRatio = $graphCaptionRatio;
    }

    /**
     * Set the label generator for the Axis.
     *
     * @param \Libchart\Label\DefaultLabel $labelGenerator Label generator
     */
    public function setAxisLabelGenerator($labelGenerator)
    {
        $this->axisLabelGenerator = $labelGenerator;
    }

    /**
     * Set the label generator for the Bar.
     *
     * @param \Libchart\Label\DefaultLabel $labelGenerator Label generator
     */
    public function setBarLabelGenerator($labelGenerator)
    {
        $this->barLabelGenerator = $labelGenerator;
    }

    /**
     * Returns the Text instance used on this chart
     * @return Text
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Returns the Title instance used on this chart
     * @return Title
     */
    public function getTitle()
    {
        return $this->title;
    }
}
