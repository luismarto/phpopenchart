<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Properties for the chart
    |--------------------------------------------------------------------------
    */
    'chart' => [
        //@todo: doc this
        'width' => 600,
        'height' => 300,
        /*
        |--------------------------------------------------------------------------
        | Customized paddings for each chart type
        |--------------------------------------------------------------------------
        | Default padding to be added to the chart. Must be an array with the values
        | [«top-padding», «right-padding», «bottom-padding», «left-padding»].
        | You need to define at least the top-padding. The other values, if not set,
        | will assume 0
        */
        'bar-padding'    => [5, 30, 30, 50],
        'column-padding' => [5, 30, 50, 50],
        'line-padding'   => [5, 30, 50, 50],
        'pie-padding'    => [15, 10, 30, 30],

    ],

    /*
    |--------------------------------------------------------------------------
    | Properties for the title chart
    |--------------------------------------------------------------------------
    */
    'title' => [
        /*
        |--------------------------------------------------------------------------
        | Title text
        |--------------------------------------------------------------------------
        | Default text to be displayed as the title.
        | Can (and probably should) be overridden when constructing the chart
        */
        'text' => 'Chart default title',

        /*
        |--------------------------------------------------------------------------
        | Title font
        |--------------------------------------------------------------------------
        | Determines the font to be used on the chart title
        */
        'font' => __DIR__. DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR
            . 'fonts' . DIRECTORY_SEPARATOR . 'SourceSansPro-Semibold.otf',

        /*
        |--------------------------------------------------------------------------
        | Font size
        |--------------------------------------------------------------------------
        | Default font size to be used when printing the title
        */
        'size' => 12,

        /*
        |--------------------------------------------------------------------------
        | Title color
        |--------------------------------------------------------------------------
        | Default color for the title's text. Set this in hex format
        */
        'color' => '#999999',

        /*
        |--------------------------------------------------------------------------
        | Title height
        |--------------------------------------------------------------------------
        | Default height, in pixels, for the title area.
        */
        'height' => '26',

        /*
        |--------------------------------------------------------------------------
        | Title padding
        |--------------------------------------------------------------------------
        | Default title padding to be added to title. Must be an array with the values
        | [«top-padding», «right-padding», «bottom-padding», «left-padding»].
        | You need to define at least the top-padding. The other values, if not set,
        | will assume 0
        */
        'padding' => [15, 0, 15, 0],
    ],

    /*
    |--------------------------------------------------------------------------
    | Properties for the labels on both axis
    |--------------------------------------------------------------------------
    */
    'axis-label' => [
        /*
        |--------------------------------------------------------------------------
        | Font
        |--------------------------------------------------------------------------
        | Determines the font to be used on the axis labels
        */
        'font' => __DIR__. DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR
            . 'fonts' . DIRECTORY_SEPARATOR . 'SourceSansPro-Regular.otf',

        /*
        |--------------------------------------------------------------------------
        | Font size
        |--------------------------------------------------------------------------
        | Default font size to be used when printing the labels
        */
        'size' => 10,

        /*
        |--------------------------------------------------------------------------
        | Color
        |--------------------------------------------------------------------------
        | Default color for the axis' label. Set this in hex format
        */
        'color' => '#666666',

        /*
        |--------------------------------------------------------------------------
        | Angle to display the axis label
        |--------------------------------------------------------------------------
        | Defaults to 0, you can set this to the angle in which the label should
        | be displayed (ex: 45)
        */
        'angle' => 0,

        /*
        |--------------------------------------------------------------------------
        | Margins to be applied to the labels
        |--------------------------------------------------------------------------
        | Set the value you want to "distance" the label from the axis (both top and left).
        | Mind a larger number might result on the label not being displayed, in case this margin
        | exceeds the chart area.
        */
        'margin' => [
            'top'  => 15,
            'left' => 0,
        ],

        /*
        |--------------------------------------------------------------------------
        | Label Generator Class for Axis
        |--------------------------------------------------------------------------
        | Determines the class used to generate the labels for Axis
        | Feel free to implement your own LabelGenerator Class that implements
        | \Libchart\Label\LabelInterface and use that here
        */
        'generator' => '\Libchart\Label\Short',
    ],

    /*
    |--------------------------------------------------------------------------
    | Properties for the Point label
    |--------------------------------------------------------------------------
    */
    'point-label' => [
        /*
        |--------------------------------------------------------------------------
        | Display the label
        |--------------------------------------------------------------------------
        | Determines if the point label should be displayed. If set to false, all the
        | remaining properties are discarded
        */
        'show' => true,

        /*
        |--------------------------------------------------------------------------
        | Font
        |--------------------------------------------------------------------------
        | Determines the font to be used on the label
        */
        'font' => __DIR__. DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR
            . 'fonts' . DIRECTORY_SEPARATOR . 'SourceSansPro-Semibold.otf',

        /*
        |--------------------------------------------------------------------------
        | Font size
        |--------------------------------------------------------------------------
        | Default font size to be used when printing the label
        */
        'size' => 10,

        /*
        |--------------------------------------------------------------------------
        | Color
        |--------------------------------------------------------------------------
        | Default color for the point label. Set this in hex format
        */
        'color' => '#333333',

        /*
        |--------------------------------------------------------------------------
        | Angle to display the point label
        |--------------------------------------------------------------------------
        | Defaults to 0, you can set this to the angle in which the label should
        | be displayed (ex: 45)
        */
        'angle' => 0,

        /*
        |--------------------------------------------------------------------------
        | Label Generator Class for Point values
        |--------------------------------------------------------------------------
        | Determines the class used to generate the labels for Axis
        | Feel free to implement your own LabelGenerator Class that implements
        | \Libchart\Label\LabelInterface and use that here
        */
        'generator' => '\Libchart\Label\NumberFormatter',
    ],















    // @todo: add configs for logo


    // @todo: to be documented
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
    ],



    /*
     * Use several colors for a single data set chart (as if it was a multiple data set)
     */
    'use-multiple-color' => false,

    /*
     * Sort data points (only pie charts)
     */
    'sort-data-point' => false,

];
