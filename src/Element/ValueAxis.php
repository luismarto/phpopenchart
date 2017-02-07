<?php namespace Phpopenchart\Element;

class ValueAxis extends AbstractAxis
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
     */
    public function draw($x, $y, $label)
    {
        parent::drawAxis($x, $y, $label, 'value-axis');
    }
}
