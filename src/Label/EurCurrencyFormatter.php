<?php namespace Phpopenchart\Label;

/**
 * Class EurCurrencyFormatter
 * @package Phpopenchart\Label
 */
class EurCurrencyFormatter extends NumberFormatter implements LabelInterface
{
    public function generateLabel($value)
    {
        return parent::generateLabel($value) . ' €';
    }
}
