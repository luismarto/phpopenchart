<?php namespace Libchart\Chart;

use Libchart\Color\ColorPalette;
use Libchart\Color\ColorHex;
use Libchart\Data\XYDataSet;
use Libchart\Data\XYSeriesDataSet;
use Libchart\Element\BasicPadding;
use Libchart\Element\BasicRectangle;
use Libchart\Element\Logo;
use Libchart\Element\Gd;
use Libchart\Element\Text;
use Libchart\Element\Title;
use Libchart\Exception\DatasetNotDefinedException;

use Noodlehaus\Config;

/**
 * Class AbstractChart
 * @package Libchart\Chart
 */
abstract class AbstractChart
{
    /**
     * The data set.
     * @var XYDataSet|XYSeriesDataSet
     */
    protected $dataSet;

    /**
     * GD image of the chart
     * @var resource|null
     */
    protected $img = null;

    /**
     * Var with GD methods to create lines and rectangles
     * @var Gd
     */
    protected $gd;

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
     * @var BasicRectangle
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
     * @var BasicRectangle
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
     * @var Config
     */
    protected $config;

    /**
     * @var bool
     */
    private $hasSeveralSeries;

    /**
     * Boots the chart dependencies
     * @param array $args
     * @param bool $hasSeveralSeries
     */
    protected function __construct($args, $hasSeveralSeries = true)
    {
        $width = !array_key_exists('width', $args) ? 600 : $args['width'];
        $height = !array_key_exists('height', $args) ? 600 : $args['height'];

        // Get config file
        // Initialize the configuration
        $configPath = __DIR__
            . DIRECTORY_SEPARATOR . '..'
            . DIRECTORY_SEPARATOR . '..'
            . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';
        $this->config = Config::load($configPath);

        // Create image
        $this->img = imagecreatetruecolor($width, $height);

        // Init graphical classes
        $this->gd = new Gd($this->img);
        $this->text = new Text($this->img, $this->config);
        $this->title = new Title($args, $this->text, $this->config);
        $this->outerPadding = new BasicPadding(5, 5, 5, 5);
        $this->logo = new Logo($this->gd, $this->outerPadding, $this->config);
        $this->palette = new ColorPalette();
        // Immediately draw the chart background
        $this->gd->rectangle(0, 0, $width - 1, $height - 1, new ColorHex('#ffffff'));

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
        $this->outputArea = new BasicRectangle(0, 0, $width - 1, $height - 1);
        $this->hasCaption = false;
        $this->graphCaptionRatio = 0.50;
        $this->graphPadding = new BasicPadding(50, 50, 50, 50);
        $this->captionPadding = new BasicPadding(15, 15, 15, 15);

        $this->hasSeveralSeries = $hasSeveralSeries;
    }


    /**
     * Checks the data model before rendering the graph.
     */
    protected function checkDataModel()
    {
        // Check if a dataset was defined
        if (!$this->dataSet) {
            throw new DatasetNotDefinedException();
        }

        // Maybe no points are defined, but that's ok. This will yield and empty graph with default boundaries.
    }

    /**
     * Sets the data set.
     *
     * @param XYDataSet|XYSeriesDataSet $dataSet The data set
     */
    public function setDataSet($dataSet)
    {
        $this->dataSet = $dataSet;
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
        $titleHeight = $this->title->getHeight();
        $titlePadding = $this->title->getPadding();

        // Compute graph area
        $titleUnpaddedBottom = $this->imageArea->y1 + $titleHeight + $titlePadding->top + $titlePadding->bottom;
        $graphArea = null;
        if ($this->hasCaption) {
            $graphUnpaddedRight = $this->imageArea->x1
                + ($this->imageArea->x2 - $this->imageArea->x1)
                * $this->graphCaptionRatio
                + $this->graphPadding->left
                + $this->graphPadding->right;
            $graphArea = new BasicRectangle(
                $this->imageArea->x1,
                $titleUnpaddedBottom,
                $graphUnpaddedRight - 1,
                $this->imageArea->y2
            );
        } else {
            $graphArea = new BasicRectangle(
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
            $captionArea = new BasicRectangle(
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
     * Returns the ColorPalette instance used on this chart
     * @return ColorPalette
     */
    public function getPalette()
    {
        return $this->palette;
    }
}
