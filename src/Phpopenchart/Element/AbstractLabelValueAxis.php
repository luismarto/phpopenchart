<?php namespace Phpopenchart\Element;

use Phpopenchart\Color\ColorHex;

class AbstractLabelValueAxis extends AbstractElement
{
    /**
     * The color of the label
     * @var ColorHex
     */
    protected $color = null;

    /**
     * @var string
     */
    protected $font = null;

    /**
     * @var int
     */
    protected $fontSize = null;

    /**
     * @var int
     */
    protected $angle = null;

    /**
     * @var int
     */
    protected $marginTop = null;

    /**
     * @var int
     */
    protected $marginLeft = null;

    /**
     * @var string
     */
    protected $horizontalAlign = null;

    /**
     * @var string
     */
    protected $verticalAlign = null;

    /**
     * The text instance of the chart
     * @var Text
     */
    protected $textInstance;

    /**
     * Label generator for axis values
     * @var \Phpopenchart\Label\DefaultLabel
     */
    protected $labelGenerator = null;

    /**
     * @param array $args
     * @param Text $textInstance
     * @param \Noodlehaus\Config $config
     * @param string $key Either 'label-axis' or 'value-axis'
     */
    public function __construct($args, $textInstance, $config, $key)
    {
        $this->config = $config;
        $this->textInstance = $textInstance;

        // Check if the options were defined on the chart's constructor
        if (array_key_exists($key, $args) && is_array($args[$key])) {
            if (array_key_exists('font', $args[$key])) {
                $this->font = $this->setFont($args[$key]['font']);
            }

            if (array_key_exists('size', $args[$key])) {
                $this->fontSize = (int)$args[$key]['size'];
            }

            if (array_key_exists('color', $args[$key])) {
                $this->color = new ColorHex($args[$key]['color']);
            }

            if (array_key_exists('angle', $args[$key])) {
                $this->angle = (int)$args[$key]['angle'];
            }

            if (array_key_exists('margin', $args[$key]) && is_array($args[$key]['margin'])
                && array_key_exists('top', $args[$key]['margin'])
            ) {
                $this->marginTop = (int)$args[$key]['margin']['top'];
            }
            if (array_key_exists('margin', $args[$key]) && is_array($args[$key]['margin'])
                && array_key_exists('left', $args[$key]['margin'])
            ) {
                $this->marginLeft = (int)$args[$key]['margin']['left'];
            }

            if (array_key_exists('align', $args[$key]) && is_array($args[$key]['align'])
                && array_key_exists('horizontal', $args[$key]['align'])
            ) {
                $this->horizontalAlign = $args[$key]['align']['horizontal'];
            }
            if (array_key_exists('align', $args[$key]) && is_array($args[$key]['align'])
                && array_key_exists('vertical', $args[$key]['align'])
            ) {
                $this->verticalAlign = $args[$key]['align']['vertical'];
            }

            if ($key === 'value-axis' && array_key_exists('generator', $args[$key])) {
                $this->labelGenerator = new $args[$key]['generator'];
            }
        }

        // If any option is null, get the config value or set a default value if the config doesn't exist
        if (is_null($this->font)) {
            $this->font = $this->setFont(
                $this->config->get(
                    'label-axis.font',
                    __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..'
                    . DIRECTORY_SEPARATOR . 'fonts' . DIRECTORY_SEPARATOR . 'SourceSansPro-Regular.otf'
                )
            );
        }
        if (is_null($this->fontSize)) {
            $this->fontSize = (int)$this->config->get($key . '.size', 14);
        }
        if (is_null($this->color)) {
            $this->color = new ColorHex($this->config->get($key . '.color', '#444444'));
        }
        if (is_null($this->angle)) {
            $this->angle = (int)$this->config->get($key . '.angle', 0);
        }
        if (is_null($this->marginTop)) {
            $this->marginTop = (int)$this->config->get($key . '.margin.top', 15);
        }
        if (is_null($this->marginLeft)) {
            $this->marginLeft = (int)$this->config->get($key . '.margin.left', 0);
        }
        if (is_null($this->horizontalAlign)) {
            $this->horizontalAlign = $this->config->get($key . '.align.horizontal', 'center');
        }
        if (is_null($this->verticalAlign)) {
            $this->verticalAlign = $this->config->get($key . '.align.vertical', 'middle');
        }

        if ($key === 'value-axis' && is_null($this->labelGenerator)) {
            $labelGeneratorClass = $this->config->get(
                'value-axis.generator',
                '\Phpopenchart\Label\DefaultLabel'
            );
            $this->labelGenerator = new $labelGeneratorClass;
        }
    }

    /**
     * Draws the axis label (either it's Label or the Value)
     * @param float|int $x
     * @param float|int $y
     * @param string $label
     * @param int|bool $maxTextHeight
     * @param string $key
     */
    protected function drawAxis($x, $y, $label, $maxTextHeight, $key)
    {
        switch ($key) {
            case 'value-axis':
                $label = $this->labelGenerator->generateLabel($label);
                break;
            case 'label-axis':
            default:
                $x += $this->marginLeft;
                break;
        }

        $y += $this->marginTop;

        $align = $this->textInstance->getAlignment('horizontal', $this->horizontalAlign)
            | $this->textInstance->getAlignment('vertical', $this->verticalAlign);

        $this->textInstance->draw(
            $x,
            $y,
            $this->color,
            $label,
            $this->font,
            $align,
            $this->fontSize,
            $this->angle,
            $maxTextHeight
        );
    }

    /**
     * Returns the font file defined for this axis
     * Used to calculate the max text height on the Column, Bar and Line classes
     * @return string
     */
    public function getFont()
    {
        return $this->font;
    }

    /**
     * Returns the font size defined for this axis
     * Used to calculate the max text height on the Column, Bar and Line classes
     * @return int
     */
    public function getFontSize()
    {
        return $this->fontSize;
    }

    /**
     * Returns the text angle defined for this axis' text
     * Used to calculate the max text height on the Column, Bar and Line classes
     * @return int
     */
    public function getTextAngle()
    {
        return $this->angle;
    }
}
