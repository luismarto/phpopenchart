<?php namespace Libchart\Element;

use Libchart\Color\ColorHex;
use ReflectionClass;

/**
 * Class Title
 *
 * Sets the properties and methods specific for the chart's title
 *
 * @package Libchart\Element
 */
class Title extends AbstractElement
{
    /**
     * The title (text) for the chart
     * @var string
     */
    private $text = null;

    /**
     * Fixed title height in pixels.
     * @var int
     */
    private $height = null;

    /**
     * Padding of the title area.
     * @var BasicPadding
     */
    private $padding = null;

    /**
     *  Coordinates of the title area.
     */
    private $area;

    /**
     * The title color
     * @var ColorHex
     */
    private $color = null;

    /**
     * @var string
     */
    private $font = null;

    /**
     * @var int
     */
    private $fontSize = null;

    /**
     * The text instance of the chart
     * @var Text
     */
    private $textInstance;

    /**
     * @param Text $textInstance
     * @param array $args
     * @param \Noodlehaus\Config $config
     */
    public function __construct($args, $textInstance, $config)
    {
        $this->textInstance = $textInstance;
        $this->config = $config;
        $paddingReflect = new ReflectionClass('\Libchart\\Element\\BasicPadding');

        // Check if the options were defined on the chart's constructor
        if (array_key_exists('title', $args) && is_array($args['title'])) {
            if (array_key_exists('font', $args['title'])) {
                $this->font = $this->setFont($args['title']['font']);
            }
            if (array_key_exists('size', $args['title'])) {
                $this->fontSize = (int)$args['title']['size'];
            }
            if (array_key_exists('text', $args['title'])) {
                $this->text = $args['title']['text'];
            }
            if (array_key_exists('color', $args['title'])) {
                $this->color = new ColorHex($args['title']['color']);
            }
            if (array_key_exists('height', $args['title'])) {
                $this->height = (int)$args['title']['height'];
            }
            if (array_key_exists('padding', $args['title']) && is_array($args['title']['padding'])) {
                $this->padding = $paddingReflect->newInstanceArgs($args['title']['padding']);
            }
        }

        // If any option is null, get the config value or set a default value if the config doesn't exist
        if (is_null($this->font)) {
            $this->font = $this->setFont(
                $this->config->get(
                    'title.fonts',
                    __DIR__ . DIRECTORY_SEPARATOR. '..' . DIRECTORY_SEPARATOR . '..'
                    . DIRECTORY_SEPARATOR . 'fonts' . DIRECTORY_SEPARATOR . 'SourceSansPro-Regular.otf'
                )
            );
        }
        if (is_null($this->text)) {
            $this->text = $this->config->get('title.text', 'Undefined title');
        }
        if (is_null($this->fontSize)) {
            $this->fontSize = (int)$this->config->get('title.size', 14);
        }
        if (is_null($this->color)) {
            $this->color = new ColorHex($this->config->get('title.color', '#444444'));
        }
        if (is_null($this->height)) {
            $this->height = (int)$this->config->get('title.height', 26);
        }
        if (is_null($this->padding)) {
            $this->padding = $paddingReflect->newInstanceArgs(
                $this->config->get('title.padding', [15, 0, 15])
            );
        }
    }

    /**
     * Processes the image area and created an area, on the chart, for the title
     * @param BasicRectangle $imageArea
     */
    public function computeTitleArea($imageArea)
    {
        $titleUnpaddedBottom = $imageArea->y1
            + $this->height
            + $this->padding->top
            + $this->padding->bottom;

        $area = new BasicRectangle(
            $imageArea->x1,
            $imageArea->y1,
            $imageArea->x2,
            $titleUnpaddedBottom - 1
        );

        $this->area = $area->getPaddedRectangle($this->padding);
    }

    /**
     * Print the title to the image.
     */
    public function draw()
    {
        $this->textInstance->printCentered(
            $this->area->y1 + ($this->area->y2 - $this->area->y1) / 2,
            $this->color,
            $this->text,
            $this->font,
            $this->fontSize
        );
    }

    /**
     * Returns the title height
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Returns the title padding
     * @return BasicPadding
     */
    public function getPadding()
    {
        return $this->padding;
    }
}
