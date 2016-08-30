<?php namespace Libchart\Element;

use Libchart\Color\ColorHex;

class AxisLabel extends AbstractElement
{
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
     * @var int
     */
    private $angle = null;

    /**
     * @var int
     */
    private $marginTop = null;

    /**
     * @var int
     */
    private $marginLeft = null;

    /**
     * Label generator for axis values
     * @var \Libchart\Label\DefaultLabel
     */
    protected $labelGenerator = null;

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
        $this->config = $config;
        $this->textInstance = $textInstance;

        // Check if the options were defined on the chart's constructor
        if (array_key_exists('axis-label', $args) && is_array($args['axis-label'])) {
            if (array_key_exists('font', $args['axis-label'])) {
                $this->font = $this->setFont($args['axis-label']['font']);
            }
            if (array_key_exists('size', $args['axis-label'])) {
                $this->fontSize = (int)$args['axis-label']['size'];
            }
            if (array_key_exists('color', $args['axis-label'])) {
                $this->color = new ColorHex($args['axis-label']['color']);
            }
            if (array_key_exists('angle', $args['axis-label'])) {
                $this->angle = (int)$args['axis-label']['angle'];
            }
            if (array_key_exists('margin-top', $args['axis-label'])) {
                $this->marginTop = (int)$args['axis-label']['margin-top'];
            }
            if (array_key_exists('margin-left', $args['axis-label'])) {
                $this->marginLeft = (int)$args['axis-label']['margin-left'];
            }
            if (array_key_exists('genereator', $args['axis-label'])) {
                $this->labelGenerator = new $args['axis-label']['genereator'];
            }
        }

        // If any option is null, get the config value or set a default value if the config doesn't exist
        if (is_null($this->font)) {
            $this->font = $this->setFont(
                $this->config->get(
                    'axis-label.fonts',
                    __DIR__ . DIRECTORY_SEPARATOR. '..' . DIRECTORY_SEPARATOR . '..'
                    . DIRECTORY_SEPARATOR . 'fonts' . DIRECTORY_SEPARATOR . 'SourceSansPro-Regular.otf'
                )
            );
        }
        if (is_null($this->fontSize)) {
            $this->fontSize = (int)$this->config->get('axis-label.size', 14);
        }
        if (is_null($this->color)) {
            $this->color = new ColorHex($this->config->get('axis-label.color', '#444444'));
        }
        if (is_null($this->angle)) {
            $this->angle = (int)$this->config->get('axis-label.angle', 0);
        }
        if (is_null($this->marginTop)) {
            $this->marginTop = (int)$this->config->get('axis-label.margin.top', 15);
        }
        if (is_null($this->marginLeft)) {
            $this->marginLeft = (int)$this->config->get('axis-label.margin.left', 0);
        }
        if (is_null($this->labelGenerator)) {
            $labelGeneratorClass = $this->config->get(
                'axis-label.generator',
                '\Libchart\Label\DefaultLabel'
            );
            $this->labelGenerator = new $labelGeneratorClass;
        }
    }

    /**
     * Draws the axis label with the configured properties
     * @param int $x
     * @param int $y
     * @param string $label
     * @param int $align
     */
    public function draw($x, $y, $label, $align)
    {
        $y += $this->marginTop;
        $x += $this->marginLeft;

        $this->textInstance->draw(
            $x,
            $y,
            $this->color,
            $label,
            $this->font,
            $align,
            $this->fontSize,
            $this->angle
        );
    }

    /**
     * Returns the formatted label
     * @param string $value
     * @return string
     */
    public function generateLabel($value)
    {
        return $this->labelGenerator->generateLabel($value);
    }
}