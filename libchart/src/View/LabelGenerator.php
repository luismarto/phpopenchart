<?php namespace Libchart\View;

class LabelGenerator implements LabelGeneratorInterface
{
    public function generateLabel($value)
    {
        if ($value < 1000000) {
            // Anything less than a million
            $formatedValue = number_format($value);
        } elseif ($value < 1000000000) {
            // Anything less than a billion
            $formatedValue = number_format($value / 1000000, 3) . 'M';
        } else {
            // At least a billion
            $formatedValue = number_format($value / 1000000000, 3) . 'B';
        }
        return strval($formatedValue);
    }
}
