<?php namespace Libchart\View;

use Libchart\Color\ColorPalette;
use Libchart\Color\ColorHex;
use Libchart\Color\Color;
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
 * @package Libchart\View
 */
trait PlotTrait
{
    /**
     * Width of the chart in pixels
     * @var int
     */
    private $width;

    /**
     * Height of the chart in pixels
     * @var int
     */
    private $height;

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
     * Outer area, whose dimension is the same as the PNG returned.
     * @var PrimitiveRectangle
     */
    protected $outputArea;

    /**
     * Coordinates of the area inside the outer padding.
     */
    protected $imageArea;



    protected $title;
    /**
     * Fixed title height in pixels.
     */
    protected $titleHeight;

    /**
     * Padding of the title area.
     */
    protected $titlePadding;

    /**
     *  Coordinates of the title area.
     */
    protected $titleArea;
    /**
     * @var Color
     */
    public $titleColor;





    /**
     * Location of the logo. Can be overridden to your personalized logo.
     */
    protected $logoFileName;


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
     * @var bool
     */
    protected $hasLogo;

    /**
     * @var Config
     */
    private $config;

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
        $this->outerPadding = new PrimitivePadding(5);
        $this->titleHeight = 26;
        $this->titlePadding = new PrimitivePadding(5);
        $this->hasCaption = false;
        $this->graphCaptionRatio = 0.50;
        $this->graphPadding = new PrimitivePadding(50);
        $this->captionPadding = new PrimitivePadding(15);

        $this->titleColor = new ColorHex('000000');

        // By default, don't display the logo
        // @todo: make this configurable
        $this->hasLogo = false;
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
        $titleUnpaddedBottom = $this->imageArea->y1
            + $this->titleHeight
            + $this->titlePadding->top
            + $this->titlePadding->bottom;
        $titleArea = new PrimitiveRectangle(
            $this->imageArea->x1,
            $this->imageArea->y1,
            $this->imageArea->x2,
            $titleUnpaddedBottom - 1
        );
        $this->titleArea = $titleArea->getPaddedRectangle($this->titlePadding);

        // Compute graph area
        $titleUnpaddedBottom = $this->imageArea->y1
            + $this->titleHeight
            + $this->titlePadding->top
            + $this->titlePadding->bottom;
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
                + $this->titleHeight
                + $this->titlePadding->top
                + $this->titlePadding->bottom;
            $captionArea = new PrimitiveRectangle(
                $graphUnpaddedRight,
                $titleUnpaddedBottom,
                $this->imageArea->x2,
                $this->imageArea->y2
            );
            $this->captionArea = $captionArea->getPaddedRectangle($this->captionPadding);
        }
    }

    /**
     * Print the title to the image.
     */
    public function printTitle()
    {
        $yCenter = $this->titleArea->y1 + ($this->titleArea->y2 - $this->titleArea->y1) / 2;
        $this->text->printCentered(
            $yCenter,
            $this->titleColor,
            $this->title,
            $this->text->getTitleFont()
        );
    }

    /**
     * Print the logo image to the image.
     */
    public function printLogo()
    {
        @$logoImage = imagecreatefrompng($this->logoFileName);

        if ($logoImage) {
            imagecopymerge(
                $this->img,
                $logoImage,
                2 * $this->outerPadding->left,
                $this->outerPadding->top,
                0,
                0,
                imagesx($logoImage),
                imagesy($logoImage),
                100
            );
        }
    }

    /**
     * Sets the title.
     *
     * @param string $title New title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Change the color used for the title
     * @param string $hexColor
     * @param int $alpha
     */
    public function setTitleColorHex($hexColor, $alpha = 0)
    {
        $this->titleColor = new ColorHex($hexColor, $alpha);
    }

    /**
     * @param int $red
     * @param int $green
     * @param int $blue
     * @param int|float $alpha
     */
    public function setTitleColor($red, $green, $blue, $alpha = 0)
    {
        $this->titleColor = new Color($red, $green, $blue, $alpha);
    }

    /**
     * Sets the logo image file name.
     *
     * @param string $logoFileName New logo image file name
     */
    public function setLogoFileName($logoFileName)
    {
        $this->logoFileName = $logoFileName;
    }

    public function setHasLogo($hasLogo)
    {
        $this->hasLogo = $hasLogo;
    }

    public function hasLogo()
    {
        return $this->hasLogo;
    }


    /**
     * Set the outer padding.
     *
     * @param PrimitivePadding $outerPadding Outer padding value in pixels
     */
    public function setOuterPadding($outerPadding)
    {
        $this->outerPadding = $outerPadding;
    }

    /**
     * Return the title height.
     *
     * @param integer $titleHeight title height
     */
    public function setTitleHeight($titleHeight)
    {
        $this->titleHeight = $titleHeight;
    }

    /**
     * Return the title padding.
     *
     * @param integer $titlePadding title padding
     */
    public function setTitlePadding($titlePadding)
    {
        $this->titlePadding = $titlePadding;
    }

    /**
     * Return the graph padding.
     *
     * @param PrimitivePadding $graphPadding graph padding
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
     * Sets a new text color for the chart
     * @param string $hexColor
     */
    public function setTextColorHex($hexColor)
    {
        $this->text->setTextColorHex(new ColorHex($hexColor));
    }
}
