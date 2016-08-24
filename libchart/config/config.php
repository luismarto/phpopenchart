<?php

return [
    /*
     * Use several colors for a single data set chart (as if it was a multiple data set)
     */
    'useMultipleColor' => false,

    /*
     * Show caption on individual data points.
     */
    'showPointCaption' => true,

    /*
     * Sort data points (only pie charts)
     */
    'sortDataPoint' => true,


    /*
    |--------------------------------------------------------------------------
    | Label Generator Class
    |--------------------------------------------------------------------------
    |
    | Determines the class used to generate the labels for Axis and Caption
    | Feel free to implement your own LabelGenerator Class that implements \Libchart\View\LabelGeneratorInterface
    | and use that here
    |
    */
    'labelGeneratorClass' => '\Libchart\View\LabelGenerator'
];
