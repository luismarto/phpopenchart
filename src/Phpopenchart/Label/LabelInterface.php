<?php namespace Phpopenchart\Label;

/**
 * Interface LabelInterface
 * An interface to generate labels from numeric values.
 * @package Phpopenchart\Label
 */
interface LabelInterface
{
    /**
     * Generate the label.
     *
     * @param double $value The value to generate the label from
     * @return string Text label
     */
    public function generateLabel($value);
}
