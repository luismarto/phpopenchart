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
    | Properties for the title chart
    |--------------------------------------------------------------------------
    */
    'title' => [
        /*
        |--------------------------------------------------------------------------
        | Title font
        |--------------------------------------------------------------------------
        |
        | Determines the font to be used on the chart title
        |
        */
        'font' => __DIR__. DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR
            . 'fonts' . DIRECTORY_SEPARATOR . 'SourceSansPro-Semibold.otf',

        /*
        |--------------------------------------------------------------------------
        | Title text
        |--------------------------------------------------------------------------
        |
        | Default text to be displayed as the title.
        | Can (and probably should) be overridden when constructing the chart
        |
        */
        'text' => 'Chart default title',

        /*
        |--------------------------------------------------------------------------
        | Title color
        |--------------------------------------------------------------------------
        |
        | Default color for the title's text. Set this in hex format
        |
        */
        'color' => '#999999',

        /*
        |--------------------------------------------------------------------------
        | Title height
        |--------------------------------------------------------------------------
        |
        | Default height, in pixels, for the title area.
        |
        */
        'height' => '26',

        /*
        |--------------------------------------------------------------------------
        | Title padding
        |--------------------------------------------------------------------------
        |
        | Default title padding to be added to title. Must be an array with the values
        | [«top-padding», «right-padding», «bottom-padding», «left-padding»].
        | You need to define at least the top-padding. The other values, if not set,
        | will assume 0
        |
        */
        'padding' => [15, 0, 15, 0],
    ],

    /*
    |--------------------------------------------------------------------------
    | Font properties used on the chart
    |--------------------------------------------------------------------------
    */
    'fonts' => [
        /*
        |--------------------------------------------------------------------------
        | Fonts path
        |--------------------------------------------------------------------------
        |
        | Determines where the fonts are located. By default, we use the fonts located on libchart/fonts
        | directory. If you like to use different fonts, you should change this property.
        | Be sure to point to a directory that has .oft of .ttf fonts
        |
        */
        'path' => __DIR__. DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'fonts' . DIRECTORY_SEPARATOR,

        /*
        |--------------------------------------------------------------------------
        | Default font for chart text
        |--------------------------------------------------------------------------
        |
        | Determines the font to be used across all the text printed on the chart (except the Title,
        | that uses the titleFont)
        | Can be overridden at runtime through Text->setTextFont('otherfont.ttf')
        |
        */
        'text' => 'SourceSansPro-Regular.otf',

        'title' => 'SourceSansPro-Semibold.otf',

    ],

    /*
    |--------------------------------------------------------------------------
    | Label properties (label used on each Point)
    |--------------------------------------------------------------------------
    */
    'label' => [
        /*
        |--------------------------------------------------------------------------
        | Font size used on the Labels (point label)
        |--------------------------------------------------------------------------
        |
        | Determines the font size used on the label
        |
        */
        'size' => 11,

        /*
        |--------------------------------------------------------------------------
        | Angle to display the point label
        |--------------------------------------------------------------------------
        |
        | Defaults to 0. If you want the label to be diagonal, set the angle here (ex: 45)
        | Can also be overridden at runtime through Text->setAngle(«value»);
        |
        */
        'angle' => 0,

        /*
        |--------------------------------------------------------------------------
        | "Margin-top" to be applied to the labels
        |--------------------------------------------------------------------------
        |
        | Set the value you want to "distance" the label from the axis.
        | Mind a larger number might result on the label not being displayed, in case this margin
        | exceeds the chart area.
        |
        */
        'margin-top' => 15,
    ],


    /*
    |--------------------------------------------------------------------------
    | Label Generator Class for Axis
    |--------------------------------------------------------------------------
    |
    | Determines the class used to generate the labels for Axis
    | Feel free to implement your own LabelGenerator Class that implements
    | \Libchart\Label\LabelInterface and use that here
    |
    */
    'axisLabelGenerator' => '\Libchart\Label\Short',

    /*
    |--------------------------------------------------------------------------
    | Label Generator Class for Bar values
    |--------------------------------------------------------------------------
    |
    | Determines the class used to generate the labels for bar values (that is, for each dataset point)
    | Feel free to implement your own LabelGenerator Class that implements
    | \Libchart\Label\LabelInterface and use that here
    |
    */
    'barLabelGenerator' => '\Libchart\Label\NumberFormatter'
];
