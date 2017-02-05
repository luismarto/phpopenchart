<?php namespace Phpopenchart\Exception;

use Exception;

/**
 * Class PointsInSeriesDontMatchException
 * @package Phpopenchart\Exception
 */
class PointsInSeriesDontMatchException extends Exception
{
    public function __construct($currentSerieNr, $currentSerieTotalPoints, $previousSerieTotalPoints)
    {
        $message = 'Error: serie <'
        . $currentSerieNr
        . '> doesn\'t have the same number of points as last serie (last one: <'
        . $previousSerieTotalPoints
        . '>, this one: <'
        . $currentSerieTotalPoints . '>).';

        parent::__construct($message);
    }
}
