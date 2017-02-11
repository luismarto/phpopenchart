<?php namespace Phpopenchart\Chart;

use Phpopenchart\Color\ColorPalette;
use Phpopenchart\Color\ColorHex;
use Phpopenchart\Data\XYDataSet;
use Phpopenchart\Data\XYSeriesDataSet;
use Phpopenchart\Element\LabelAxis;
use Phpopenchart\Element\BasicPadding;
use Phpopenchart\Element\BasicRectangle;
use Phpopenchart\Element\Caption;
use Phpopenchart\Element\Gd;
use Phpopenchart\Element\Logo;
use Phpopenchart\Element\PointLabel;
use Phpopenchart\Element\Text;
use Phpopenchart\Element\Title;
use Phpopenchart\Element\ValueAxis;
use Phpopenchart\Exception\ChartRatioOutOfBoundariesException;
use Phpopenchart\Exception\DatasetNotDefinedException;

use Noodlehaus\Config;
use ReflectionClass;

/**
 * Class AbstractChart
 *
 * This holds graphical attributes and is responsible for computing the layout of the graph.
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
 * @package Phpopenchart\Chart
 */
abstract class AbstractChart
{
    /**
     * The data set.
     * @var XYDataSet|XYSeriesDataSet
     */
    private $dataSet;

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
     * @var LabelAxis
     */
    protected $labelAxis;

    /**
     * @var ValueAxis
     */
    protected $valueAxis;

    /**
     * @var PointLabel
     */
    protected $pointLabel;

    /**
     * @var Caption
     */
    protected $caption;


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
     * @var float
     */
    protected $chartRatio;

    /**
     * Padding of the graph area.
     * @var BasicPadding
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
    private $captionPadding;

    /**
     * @var Config
     */
    protected $config;

    /**
     * Determines if the current chart has multiple series
     * @var bool
     */
    protected $hasSeveralSeries;

    /**
     * @var bool
     */
    protected $useMultipleColor;

    /**
     * @var bool
     */
    protected $sortDataPoint;

    /**
     * Indicates the type of chart to be rendered (either 'bar' (either for Column or Bar), 'line' or 'pie')
     * @var string
     */
    protected $type;

    /**
     * Main chart constructor
     * @param array $args
     * @param string $type
     * @throws DatasetNotDefinedException
     * @throws ChartRatioOutOfBoundariesException
     */
    protected function __construct($args, $type)
    {
        // Get config file
        // Initialize the configuration
        $configPath = __DIR__
            . DIRECTORY_SEPARATOR . '..'
            . DIRECTORY_SEPARATOR . '..'
            . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';
        $this->config = Config::load($configPath);

        // Check if dataset exists on the arguments and validate it's an array otherwise throw an error
        if (!array_key_exists('dataset', $args) || !is_array($args['dataset'])) {
            throw new DatasetNotDefinedException();
        }

        if (count($args['dataset']) > 1 && array_key_exists('series', $args['dataset'])) {
            $this->dataSet = new XYSeriesDataSet($args['dataset']);
            $this->hasSeveralSeries = true;
        } else {
            $this->dataSet = new XYDataSet($args['dataset']);
            $this->hasSeveralSeries = false;
        }

        // Set basic chart properties to create the chart background
        $width = $this->config->get('chart.width', 600);
        $height = $this->config->get('chart.height', 300);
        if (array_key_exists('chart', $args) && is_array($args['chart'])) {
            $width = array_key_exists('width', $args['chart']) ? $args['chart']['width'] : $width;
            $height = array_key_exists('height', $args['chart']) ? $args['chart']['height'] : $height;
        }

        // Create image
        $this->img = imagecreatetruecolor($width, $height);

        // Init Elements
        $this->gd = new Gd($this->img);
        $this->text = new Text($this->img, $this->config);
        $this->title = new Title($args, $this->text, $this->config);
        $this->labelAxis = new LabelAxis($args, $this->text, $this->config);
        $this->valueAxis = new ValueAxis($args, $this->text, $this->config);
        $this->pointLabel = new PointLabel($args, $this->text, $this->config, $type);
        $this->outerPadding = new BasicPadding(5, 5, 5, 5);
        $this->logo = new Logo($args, $this->gd, $this->outerPadding, $this->config);
        $this->palette = new ColorPalette();
        $this->caption = new Caption($type, $this->gd, $this->text, $this->dataSet, $this->config, $args);

        // Immediately draw the chart background
        $this->gd->rectangle(0, 0, $width - 1, $height - 1, new ColorHex('#ffffff'));

        // Set chart properties
        $this->useMultipleColor = $this->config->get('chart.use-multiple-color', false);
        if (array_key_exists('chart', $args) && is_array($args['chart'])
            && array_key_exists('use-multiple-color', $args['chart'])
        ) {
            $this->useMultipleColor = (bool)$args['chart']['use-multiple-color'];
        }
        $this->sortDataPoint = $this->config->get('chart.sort-data-point', true);
        if (array_key_exists('chart', $args) && is_array($args['chart'])
            && array_key_exists('sort-data-point', $args['chart'])
        ) {
            $this->sortDataPoint = (bool)$args['chart']['sort-data-point'];
        }

        $paddingReflect = new ReflectionClass('\Phpopenchart\\Element\\BasicPadding');
        if (array_key_exists('chart', $args) && is_array($args['chart'])
            && array_key_exists($type . '-padding', $args['chart']) && is_array($args['chart'][ $type . '-padding'])
        ) {
            $this->graphPadding = $paddingReflect->newInstanceArgs($args['chart'][ $type . '-padding']);
        } else {
            $this->graphPadding = $paddingReflect->newInstanceArgs(
                $this->config->get('chart.' . $type . '-padding', [0, 0, 0, 0])
            );
        }

        $this->chartRatio = $this->config->get('chart.ratio', 0.7);
        if (array_key_exists('chart', $args) && is_array($args['chart'])
            && array_key_exists('ratio', $args['chart'])
        ) {
            $this->chartRatio = (float)$args['chart']['ratio'];
        }

        if (!is_numeric($this->chartRatio) || $this->chartRatio < 0 || $this->chartRatio > 1) {
            throw new ChartRatioOutOfBoundariesException;
        }

        // Default layout
        $this->outputArea = new BasicRectangle(0, 0, $width - 1, $height - 1);
        $this->captionPadding = new BasicPadding(15, 15, 15, 15);

        // Display the caption if the chart has multiple series of if the
        // chart is of $type pie
        $this->hasCaption = $this->hasSeveralSeries || $type == 'pie';
        $this->type = $type;
    }

    /**
     * Compute the layout of all areas of the graph.
     */
    protected function computeLayout()
    {
        $captionArea = null;
        $this->imageArea = $this->outputArea->getPaddedRectangle($this->outerPadding);

        // Compute Title Area
        $this->title->computeTitleArea($this->imageArea);
        $titleHeight = $this->title->getHeight();
        $titlePadding = $this->title->getPadding();

        // Compute graph area
        $titleUnpaddedBottom = $this->imageArea->y1 + $titleHeight + $titlePadding->top + $titlePadding->bottom;
        $graphArea = null;

        // If the chart has caption, we can't use the entire width and height defined because
        // we'll need to leave some room to the caption. If you need to tweak the chart/caption size
        // be sure to change `chart.ratio` config value
        if ($this->hasCaption) {
            // Calculate the available chart area
            $graphUnpaddedRight = $this->imageArea->x1
                + ($this->imageArea->x2 - $this->imageArea->x1)
                * $this->chartRatio
                + $this->graphPadding->left
                + $this->graphPadding->right;

            $graphArea = new BasicRectangle(
                $this->imageArea->x1,
                $titleUnpaddedBottom,
                $graphUnpaddedRight - 1,
                $this->imageArea->y2
            );

            // Calculate the available caption area
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
            $captionArea = $captionArea->getPaddedRectangle($this->captionPadding);
        } else {
            $graphArea = new BasicRectangle(
                $this->imageArea->x1,
                $titleUnpaddedBottom,
                $this->imageArea->x2,
                $this->imageArea->y2
            );
        }

        $this->graphArea = $graphArea->getPaddedRectangle($this->graphPadding);

        return $captionArea;
    }

    /**
     * Either store the created image in the specified filepath or
     * output the image to stdout
     * @param null|string $filename
     */
    protected function output($filename = null)
    {
        if (isset($filename)) {
            imagepng($this->img, $filename);
        } else {
            imagepng($this->img);
        }
    }

    /**
     * Returns the dataset for this chart
     * @return XYDataSet|XYSeriesDataSet
     */
    protected function getDataSet()
    {
        return $this->dataSet;
    }
}
