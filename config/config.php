<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Properties for the chart
    |--------------------------------------------------------------------------
    */
    'chart' => [
        /*
        |--------------------------------------------------------------------------
        | Output width
        |--------------------------------------------------------------------------
        | Defined the total nr of pixels for the width of the output image
        */
        'width' => 600,

        /*
        |--------------------------------------------------------------------------
        | Output height
        |--------------------------------------------------------------------------
        | Defined the total nr of pixels for the height of the output image
        */
        'height' => 300,

        /*
        |--------------------------------------------------------------------------
        | Logo filepath
        |--------------------------------------------------------------------------
        | By default, no logo is used on the chart.
        | If you want to display a logo, simple set this config as the path to the logo
        | and it will be displayed. Otherwise, leave it as false.
        */
        'logo' => false,

        /*
        |--------------------------------------------------------------------------
        | Use multiple color
        |--------------------------------------------------------------------------
        | By default, a single series will have the same color (so, the default value is false)
        | If you want to set a different color (automatically) to each point, set this
        | to true.
        | You can always set the color of the point an it will be taken into account
        */
        'use-multiple-color' => false,

        /*
        |--------------------------------------------------------------------------
        | Sort points (Pie charts only)
        |--------------------------------------------------------------------------
        | By default, the discs of pie charts are drawn in a descending order
        | by it's values.
        | If you want to display them in the order defined on the dataset, set this to false
        */
        'sort-data-point' => true,

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

        /*
        |--------------------------------------------------------------------------
        | Graphic area ratio in relation to caption. Used whenever the chart has a
        | caption, such as all Pie Charts (default) and multi series Column / Bar / Line
        |--------------------------------------------------------------------------
        | This value is used to calculate the available width to place the chart
        | and the available space for the caption.
        | You need to set a value greater and 0 and lower than 0. The greater the value
        | is, the more space to the graphic (and smaller width for the caption).
        | If your chart has larger caption labels, it would be best to set this to a
        | smaller value
        */
        'ratio' => 0.7
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
        'height' => 26,

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
    | Properties for the Label Axis
    |--------------------------------------------------------------------------
    */
    'label-axis' => [
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

        'align' => [
            'vertical' => 'middle',
            'horizontal' => 'center'
        ]
    ],

    'value-axis' => [
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
        | \Phpopenchart\Label\LabelInterface and use that here
        */
        'generator' => '\Phpopenchart\Label\Short',

        'align' => [
            'vertical' => 'middle',
            'horizontal' => 'center'
        ]
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
        | Label Generator Class for Point values (for Bar, Column and Line)
        |--------------------------------------------------------------------------
        | Determines the class used to generate the labels for the points
        | Feel free to implement your own LabelGenerator Class that implements
        | \Phpopenchart\Label\LabelInterface and use that here
        */
        'generator' => '\Phpopenchart\Label\NumberFormatter',

        /*
        |--------------------------------------------------------------------------
        | Label Generator Class for Point values on Pie charts
        |--------------------------------------------------------------------------
        | Determines the class used to generate the labels for points on pie charts
        | Feel free to implement your own LabelGenerator Class that implements
        | \Phpopenchart\Label\LabelInterface and use that here
        */
        'pie-generator' => '\Phpopenchart\Label\PercentageFormatter',
    ],

    /*
    |--------------------------------------------------------------------------
    | Properties for the Caption text (when creating a Pie chart or having
    | multiple series on Bar, Column or Line charts)
    |--------------------------------------------------------------------------
    */
    'caption-label' => [
        /*
        |--------------------------------------------------------------------------
        | Font
        |--------------------------------------------------------------------------
        | Determines the font to be used on the caption text
        */
        'font' => __DIR__. DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR
            . 'fonts' . DIRECTORY_SEPARATOR . 'SourceSansPro-Regular.otf',

        /*
        |--------------------------------------------------------------------------
        | Font size
        |--------------------------------------------------------------------------
        | Default font size to be used when printing the caption text
        */
        'size' => 10,

        /*
        |--------------------------------------------------------------------------
        | Color
        |--------------------------------------------------------------------------
        | Default color for the caption text. Set this in hex format
        */
        'color' => '#666666',
    ],
];
