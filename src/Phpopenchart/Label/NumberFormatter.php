<?php namespace Phpopenchart\Label;

/**
 * Class NumberFormatter
 * Returns the value formatted as a number. That means:
 *  1829    turns into  1 829
 *  192048  turns into  192 048
 *  7521962 turns into  7 521 962
 * @package Phpopenchart\Label
 */
class NumberFormatter implements LabelInterface
{
    public function generateLabel($value)
    {
        return strval(number_format($value, 0, '', ' '));
    }
}
