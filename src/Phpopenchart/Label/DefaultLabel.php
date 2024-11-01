<?php namespace Phpopenchart\Label;

/**
 * Class DefaultLabel
 * The default label generator simply uses strval() to convert the value.
 * @package Phpopenchart\Label
 */
class DefaultLabel implements LabelInterface
{
    public function generateLabel($value)
    {
        return strval($value);
    }
}
