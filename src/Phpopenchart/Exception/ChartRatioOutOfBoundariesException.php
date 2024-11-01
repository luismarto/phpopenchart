<?php namespace Phpopenchart\Exception;

use Exception;

/**
 * Class ChartRatioOutOfBoundariesException
 * @package Phpopenchart\Exception
 */
class ChartRatioOutOfBoundariesException extends Exception
{
    protected $message = 'chart.ratio is not a float or is not between 0 and 1';
}
