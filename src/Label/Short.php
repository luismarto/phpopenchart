<?php namespace Libchart\Label;

/**
 * Class Short
 * @package Libchart\Label
 */
class Short implements LabelInterface
{
    /**
     * Returns a shorten value.
     * Instead of 2000, displays 2k. Instead of 7 000 000, displays 7M, and so on
     * @param float $value
     * @return string
     */
    public function generateLabel($value)
    {
        return strval($this->shortenNumber($value));
    }

    /**
     * Based on the http://stackoverflow.com/a/35329932/908174
     * @param int $number
     * @param int $precision
     * @param null $divisors
     * @return string
     */
    private function shortenNumber($number, $precision = 0, $divisors = null)
    {
        $divisor = pow(1000, 0);
        $shorthand = '';

        // Setup default $divisors if not provided
        if (!isset($divisors)) {
            $divisors = array(
                pow(1000, 0) => '', // 1000^0 == 1
                pow(1000, 1) => 'k', // Thousand
                pow(1000, 2) => 'M', // Million
                pow(1000, 3) => 'B', // Billion
                pow(1000, 4) => 'T', // Trillion
                pow(1000, 5) => 'Qa', // Quadrillion
                pow(1000, 6) => 'Qi', // Quintillion
            );
        }

        // Loop through each $divisor and find the
        // lowest amount that matches
        foreach ($divisors as $divisor => $shorthand) {
            if (abs($number) < ($divisor * 1000)) {
                // We found a match!
                break;
            }
        }

        // We found our match, or there were no matches.
        // Either way, use the last defined value for $divisor.

        // If the value is 0, don't display precision
        if ($number / $divisor == 0) {
            return 0;
        }

        return number_format($number / $divisor, $precision) . $shorthand;
    }
}
