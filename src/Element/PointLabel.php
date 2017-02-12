<?php namespace Phpopenchart\Element;

use Phpopenchart\Color\ColorHex;

/**
 * Class PointLabel
 * @package Phpopenchart\Element
 */
class PointLabel extends AbstractElement
{
    /**
     * Determines if the label should be displayed
     * @var bool
     */
    private $show = null;

    /**
     * The color of the label
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
     * @var int
     */
    private $angle = null;

    /**
     * Label generator for point values
     * @var \Phpopenchart\Label\NumberFormatter
     */
    private $labelGenerator = null;

    /**
     * The text instance of the chart
     * @var Text
     */
    private $textInstance;

    /**
     * @param Text $textInstance
     * @param array $args
     * @param \Noodlehaus\Config $config
     * @param string $type Type of the chart
     */
    public function __construct($args, $textInstance, $config, $type)
    {
        $this->config = $config;
        $this->textInstance = $textInstance;

        // Check if the options were defined on the chart's constructor
        if (array_key_exists('point-label', $args) && is_array($args['point-label'])) {
            if (array_key_exists('show', $args['point-label'])) {
                $this->show = $args['point-label']['show'];
            }
            if (array_key_exists('font', $args['point-label'])) {
                $this->font = $this->setFont($args['point-label']['font']);
            }
            if (array_key_exists('size', $args['point-label'])) {
                $this->fontSize = (int)$args['point-label']['size'];
            }
            if (array_key_exists('color', $args['point-label'])) {
                $this->color = new ColorHex($args['point-label']['color']);
            }
            if (array_key_exists('angle', $args['point-label'])) {
                $this->angle = (int)$args['point-label']['angle'];
            }
            if (array_key_exists('generator', $args['point-label'])) {
                $this->labelGenerator = new $args['point-label']['generator'];
            }
        }

        // If any option is null, get the config value or set a default value if the config doesn't exist
        if (is_null($this->font)) {
            $this->font = $this->setFont(
                $this->config->get(
                    'point-label.font',
                    __DIR__ . DIRECTORY_SEPARATOR. '..' . DIRECTORY_SEPARATOR . '..'
                    . DIRECTORY_SEPARATOR . 'fonts' . DIRECTORY_SEPARATOR . 'SourceSansPro-Regular.otf'
                )
            );
        }
        if (is_null($this->show)) {
            $this->show = (bool)$this->config->get('point-label.show', true);
        }
        if (is_null($this->fontSize)) {
            $this->fontSize = (int)$this->config->get('point-label.size', 14);
        }
        if (is_null($this->color)) {
            $this->color = new ColorHex($this->config->get('point-label.color', '#444444'));
        }
        if (is_null($this->angle)) {
            $this->angle = (int)$this->config->get('point-label.angle', 0);
        }
        if (is_null($this->labelGenerator)) {
            if ($type !== 'pie') {
                // If the chart is any other than pie, use the default
                $labelGeneratorClass = $this->config->get(
                    'point-label.generator',
                    '\Phpopenchart\Label\NumberFormatter'
                );
            } else {
                // Otherwise, use the settings from config or the PercentageFormatter by default
                $labelGeneratorClass = $this->config->get(
                    'point-label.pie-generator',
                    '\Phpopenchart\Label\PercentageFormatter'
                );
            }
            $this->labelGenerator = new $labelGeneratorClass;
        }
    }

    /**
     * Draws the axis label with the configured properties
     * @param int $x
     * @param int $y
     * @param int $value
     * @param int $align
     */
    public function draw($x, $y, $value, $align)
    {
        $this->textInstance->draw(
            $x,
            $y,
            $this->color,
            $this->labelGenerator->generateLabel($value),
            $this->font,
            $align,
            $this->fontSize,
            $this->angle
        );
    }

    /**
     * Returns if the point label should be displayed
     * @return bool
     */
    public function show()
    {
        return $this->show;
    }
}
