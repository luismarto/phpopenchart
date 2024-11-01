<?php namespace Phpopenchart\Label;

/**
 * Class PercentageFormatter
 *
 * Percentage formatter: Displays the labels with 2 decimals and the % symbol aat the end
 * @package Phpopenchart\Label
 */
class PercentageFormatter implements LabelInterface
{
    public function generateLabel($value)
    {
        return strval(number_format($value, 2, ',', ' ')) . ' %';
    }
}
