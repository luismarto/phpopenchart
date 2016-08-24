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
    | Label Generator Class for Axis
    |--------------------------------------------------------------------------
    |
    | Determines the class used to generate the labels for Axis
    | Feel free to implement your own LabelGenerator Class that implements
    | \Libchart\LabelGenerators\LabelGeneratorInterface and use that here
    |
    */
    'axisLabelGenerator' => '\Libchart\LabelGenerators\ShortLabelGenerator',

    /*
    |--------------------------------------------------------------------------
    | Label Generator Class for Bar values
    |--------------------------------------------------------------------------
    |
    | Determines the class used to generate the labels for bar values (that is, for each dataset point)
    | Feel free to implement your own LabelGenerator Class that implements
    | \Libchart\LabelGenerators\LabelGeneratorInterface and use that here
    |
    */
    'barLabelGenerator' => '\Libchart\LabelGenerators\NumberFormattedLabelGenerator'
];
