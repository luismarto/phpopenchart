<?php namespace Phpopenchart\Element;

class ValueAxis extends AbstractLabelValueAxis
{
    /**
     * @param Text $textInstance
     * @param array $args
     * @param \Noodlehaus\Config $config
     */
    public function __construct($args, $textInstance, $config)
    {
        parent::__construct($args, $textInstance, $config, 'value-axis');
    }

    /**
     * Draws the axis label with the configured properties
     * @param int $x
     * @param int $y
     * @param string $label
     * @param int|bool $maxTextHeight
     */
    public function draw($x, $y, $label, $maxTextHeight = false)
    {
        parent::drawAxis($x, $y, $label, $maxTextHeight, 'value-axis');
    }
}
