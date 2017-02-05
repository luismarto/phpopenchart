<?php
include_once 'common.php';
include "../vendor/autoload.php";

use Libchart\Chart\Column;
use Libchart\Chart\Bar;
use Libchart\Chart\Line;
use Libchart\Chart\Pie;


/**
 * COLUMN CHARTS
 */

(new Column([
    'title'  => [
        'text' => 'Monthly values',
    ],
    'dataset' => [
        'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        'data'   => [3296, 1564, 845, 4578, 2164, 3658, 1145],
    ]
]))->render('../docs/assets/images/examples/column-basic.png');

(new Column([
    'chart' => [
        'width'  => 1000,
        'height' => 400
    ],
    'title'  => [
        'text' => 'Monthly values',
    ],
    'dataset' => [
        'series' => ['Apartments', 'Houses', 'Hotels'],
        'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        'data'   => [
            [15480, 9048, 6541, 2354, 7415, 8745, 3154],
            [3296, 1564, 845, 4578, 2164, 3658, 1145],
            [152, 97, 154, 385, 80, 648, 54],
        ],
    ]
]))->render('../docs/assets/images/examples/column-multiple.png');

(new Column([
    'title'  => [
        'text' => 'Monthly values',
    ],
    'dataset' => [
        'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        'data'   => [-1645, 1564, 845, -20, -520, -2648, 1145],
    ]
]))->render('../docs/assets/images/examples/column-negative.png');


(new Column([
    'chart' => [
        'width'          => 350,
        'height'         => 200,
        'column-padding' => [0, 15, 70, 70],
    ],
    'title'  => [
        'text' => 'Monthly values',
    ],
    'dataset' => [
        'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        'data'   => [3296, 1564, 845, 4578, 2164, 3658, 1145],
    ]
]))->render('../docs/assets/images/examples/column-chart-options.png');


(new Column([
    'title'  => [
        'text'   => 'Monthly values',
        'font'   => 'SourceSansPro-Light.otf',
        'size'   => 13,
        'color'  => '#FF0000',
        'height' => 20,
        'padding' => [0]
    ],
    'dataset' => [
        'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        'data'   => [3296, 1564, 845, 4578, 2164, 3658, 1145],
    ]
]))->render('../docs/assets/images/examples/column-title-options.png');


(new Column([
    'title'  => [
        'text' => 'Monthly values',
    ],
    'axis-label'  => [
        'font'   => 'SourceSansPro-Light.otf',
        'size'   => 12,
        'color'  => '#FF0000',
        'angle'  => 35,
        'margin' => [
            'top'  => 15,
            'left' => 20
        ],
        'generator' => '\Libchart\Label\DefaultLabel',
    ],
    'dataset' => [
        'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        'data'   => [3296, 1564, 845, 4578, 2164, 3658, 1145],
    ]
]))->render('../docs/assets/images/examples/column-axis-label-options.png');


(new Column([
    'title'  => [
        'text' => 'Monthly values',
    ],
    'point-label'  => [
        'font'   => 'SourceSansPro-Light.otf',
        'size'   => 12,
        'color'  => '#FF0000',
        'angle'  => 35,
        'generator' => '\Libchart\Label\DefaultLabel',
    ],
    'dataset' => [
        'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        'data'   => [3296, 1564, 845, 4578, 2164, 3658, 1145],
    ]
]))->render('../docs/assets/images/examples/column-point-label-options.png');


(new Column([
    'title'  => [
        'text' => 'Monthly values',
    ],
    'point-label'  => [
        'show'   => false
    ],
    'dataset' => [
        'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        'data'   => [3296, 1564, 845, 4578, 2164, 3658, 1145],
    ]
]))->render('../docs/assets/images/examples/column-no-point-label.png');


(new Column([
    'chart' => [
        'width'          => 800,
        'height'         => 500,
        'column-padding' => [0, 15, 70, 70],
    ],
    'title'  => [
        'text'   => 'Monthly values',
        'font'   => 'SourceSansPro-Light.otf',
        'size'   => 13,
        'color'  => '#FF0000',
        'height' => 20,
        'padding' => [0]
    ],
    'axis-label'  => [
        'font'   => 'SourceSansPro-Light.otf',
        'size'   => 12,
        'color'  => '#00FF00',
        'angle'  => -35,
        'margin' => [
            'top'  => 15,
            'left' => 20
        ],
        'generator' => '\Libchart\Label\DefaultLabel',
    ],
    'point-label'  => [
        'font'   => 'SourceSansPro-Light.otf',
        'size'   => 12,
        'color'  => '#0000FF',
        'angle'  => 35,
        'generator' => '\Libchart\Label\DefaultLabel',
    ],
    'dataset' => [
        'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        'data'   => [3296, 1564, 845, 4578, 2164, 3658, 1145],
    ]
]))->render('../docs/assets/images/examples/column-all-options.png');


/**
 * BAR CHARTS
 */


(new Bar([
    'title'  => [
        'text' => 'Monthly values',
    ],
    'dataset' => [
        'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        'data'   => [3296, 1564, 845, 4578, 2164, 3658, 1145],
    ]
]))->render('../docs/assets/images/examples/bar-basic.png');

(new Bar([
    'chart' => [
        'width'  => 1000,
        'height' => 400
    ],
    'title'  => [
        'text' => 'Monthly values',
    ],
    'dataset' => [
        'series' => ['Apartments', 'Houses', 'Hotels'],
        'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        'data'   => [
            [15480, 9048, 6541, 2354, 7415, 8745, 3154],
            [3296, 1564, 845, 4578, 2164, 3658, 1145],
            [152, 97, 154, 385, 80, 648, 54],
        ],
    ]
]))->render('../docs/assets/images/examples/bar-multiple.png');

(new Bar([
    'title'  => [
        'text' => 'Monthly values',
    ],
    'dataset' => [
        'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        'data'   => [-1645, 1564, 845, -20, -520, -2648, 1145],
    ]
]))->render('../docs/assets/images/examples/bar-negative.png');



(new Bar([
    'chart' => [
        'width'       => 350,
        'height'      => 200,
        'bar-padding' => [0, 15, 25, 30],
    ],
    'title'  => [
        'text' => 'Monthly values',
    ],
    'dataset' => [
        'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        'data'   => [3296, 1564, 845, 4578, 2164, 3658, 1145],
    ]
]))->render('../docs/assets/images/examples/bar-chart-options.png');


(new Bar([
    'title'  => [
        'text'   => 'Monthly values',
        'font'   => 'SourceSansPro-Light.otf',
        'size'   => 13,
        'color'  => '#FF0000',
        'height' => 20,
        'padding' => [0]
    ],
    'dataset' => [
        'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        'data'   => [3296, 1564, 845, 4578, 2164, 3658, 1145],
    ]
]))->render('../docs/assets/images/examples/bar-title-options.png');


(new Bar([
    'title'  => [
        'text' => 'Monthly values',
    ],
    'axis-label'  => [
        'font'   => 'SourceSansPro-Light.otf',
        'size'   => 12,
        'color'  => '#FF0000',
        'angle'  => 35,
        'margin' => [
            'top'  => 15,
            'left' => 20
        ],
        'generator' => '\Libchart\Label\DefaultLabel',
    ],
    'dataset' => [
        'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        'data'   => [3296, 1564, 845, 4578, 2164, 3658, 1145],
    ]
]))->render('../docs/assets/images/examples/bar-axis-label-options.png');


(new Bar([
    'title'  => [
        'text' => 'Monthly values',
    ],
    'point-label'  => [
        'font'   => 'SourceSansPro-Light.otf',
        'size'   => 12,
        'color'  => '#FF0000',
        'angle'  => 35,
        'generator' => '\Libchart\Label\DefaultLabel',
    ],
    'dataset' => [
        'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        'data'   => [3296, 1564, 845, 4578, 2164, 3658, 1145],
    ]
]))->render('../docs/assets/images/examples/bar-point-label-options.png');


(new Bar([
    'title'  => [
        'text' => 'Monthly values',
    ],
    'point-label'  => [
        'show'   => false
    ],
    'dataset' => [
        'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        'data'   => [3296, 1564, 845, 4578, 2164, 3658, 1145],
    ]
]))->render('../docs/assets/images/examples/bar-no-point-label.png');


(new Bar([
    'chart' => [
        'width'       => 800,
        'height'      => 500,
        'bar-padding' => [0, 15, 70, 70],
    ],
    'title'  => [
        'text'   => 'Monthly values',
        'font'   => 'SourceSansPro-Light.otf',
        'size'   => 13,
        'color'  => '#FF0000',
        'height' => 20,
        'padding' => [0]
    ],
    'axis-label'  => [
        'font'   => 'SourceSansPro-Light.otf',
        'size'   => 12,
        'color'  => '#00FF00',
        'angle'  => -35,
        'margin' => [
            'top'  => 15,
            'left' => 20
        ],
        'generator' => '\Libchart\Label\DefaultLabel',
    ],
    'point-label'  => [
        'font'   => 'SourceSansPro-Light.otf',
        'size'   => 12,
        'color'  => '#0000FF',
        'angle'  => 35,
        'generator' => '\Libchart\Label\DefaultLabel',
    ],
    'dataset' => [
        'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        'data'   => [3296, 1564, 845, 4578, 2164, 3658, 1145],
    ]
]))->render('../docs/assets/images/examples/bar-all-options.png');





/**
 * LINE CHARTS
 */

(new Line([
    'title'  => [
        'text' => 'Monthly values',
    ],
    'dataset' => [
        'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        'data'   => [3296, 1564, 845, 4578, 2164, 3658, 1145],
    ]
]))->render('../docs/assets/images/examples/line-basic.png');

(new Line([
    'chart' => [
        'width'  => 1000,
        'height' => 400
    ],
    'title'  => [
        'text' => 'Monthly values',
    ],
    'dataset' => [
        'series' => ['Apartments', 'Houses', 'Hotels'],
        'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        'data'   => [
            [15480, 9048, 6541, 2354, 7415, 8745, 3154],
            [3296, 1564, 845, 4578, 2164, 3658, 1145],
            [152, 97, 154, 385, 80, 648, 54],
        ],
    ]
]))->render('../docs/assets/images/examples/line-multiple.png');

(new Line([
    'title'  => [
        'text' => 'Monthly values',
    ],
    'dataset' => [
        'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        'data'   => [-1645, 1564, 845, -20, -520, -2648, 1145],
    ]
]))->render('../docs/assets/images/examples/line-negative.png');



(new Line([
    'chart' => [
        'width'       => 350,
        'height'      => 200,
        'line-padding' => [0, 15, 25, 30],
    ],
    'title'  => [
        'text' => 'Monthly values',
    ],
    'dataset' => [
        'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        'data'   => [3296, 1564, 845, 4578, 2164, 3658, 1145],
    ]
]))->render('../docs/assets/images/examples/line-chart-options.png');


(new Line([
    'title'  => [
        'text'   => 'Monthly values',
        'font'   => 'SourceSansPro-Light.otf',
        'size'   => 13,
        'color'  => '#FF0000',
        'height' => 20,
        'padding' => [0]
    ],
    'dataset' => [
        'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        'data'   => [3296, 1564, 845, 4578, 2164, 3658, 1145],
    ]
]))->render('../docs/assets/images/examples/line-title-options.png');


(new Line([
    'title'  => [
        'text' => 'Monthly values',
    ],
    'axis-label'  => [
        'font'   => 'SourceSansPro-Light.otf',
        'size'   => 12,
        'color'  => '#FF0000',
        'angle'  => 35,
        'margin' => [
            'top'  => 15,
            'left' => 20
        ],
        'generator' => '\Libchart\Label\DefaultLabel',
    ],
    'dataset' => [
        'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        'data'   => [3296, 1564, 845, 4578, 2164, 3658, 1145],
    ]
]))->render('../docs/assets/images/examples/line-axis-label-options.png');


(new Line([
    'title'  => [
        'text' => 'Monthly values',
    ],
    'point-label'  => [
        'font'   => 'SourceSansPro-Light.otf',
        'size'   => 12,
        'color'  => '#FF0000',
        'angle'  => 35,
        'generator' => '\Libchart\Label\DefaultLabel',
    ],
    'dataset' => [
        'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        'data'   => [3296, 1564, 845, 4578, 2164, 3658, 1145],
    ]
]))->render('../docs/assets/images/examples/line-point-label-options.png');


(new Line([
    'title'  => [
        'text' => 'Monthly values',
    ],
    'point-label'  => [
        'show'   => false
    ],
    'dataset' => [
        'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        'data'   => [3296, 1564, 845, 4578, 2164, 3658, 1145],
    ]
]))->render('../docs/assets/images/examples/line-no-point-label.png');


(new Line([
    'chart' => [
        'width'       => 800,
        'height'      => 500,
        'line-padding' => [0, 15, 70, 70],
    ],
    'title'  => [
        'text'   => 'Monthly values',
        'font'   => 'SourceSansPro-Light.otf',
        'size'   => 13,
        'color'  => '#FF0000',
        'height' => 20,
        'padding' => [0]
    ],
    'axis-label'  => [
        'font'   => 'SourceSansPro-Light.otf',
        'size'   => 12,
        'color'  => '#00FF00',
        'angle'  => -35,
        'margin' => [
            'top'  => 15,
            'left' => 20
        ],
        'generator' => '\Libchart\Label\DefaultLabel',
    ],
    'point-label'  => [
        'font'   => 'SourceSansPro-Light.otf',
        'size'   => 12,
        'color'  => '#0000FF',
        'angle'  => 35,
        'generator' => '\Libchart\Label\DefaultLabel',
    ],
    'dataset' => [
        'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        'data'   => [3296, 1564, 845, 4578, 2164, 3658, 1145],
    ]
]))->render('../docs/assets/images/examples/line-all-options.png');





/**
 * PIE CHARTS
 */










(new Pie([
    'title'  => [
        'text' => 'Monthly values',
    ],
    'dataset' => [
        'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        'data'   => [3296, 1564, 845, 4578, 2164, 3658, 1145],
    ]
]))->render('../docs/assets/images/examples/pie-basic.png');

(new Pie([
    'title'  => [
        'text' => 'Monthly values',
    ],
    'dataset' => [
        'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        'data'   => [-1645, 1564, 845, -20, -520, -2648, 1145],
    ]
]))->render('../docs/assets/images/examples/pie-negative.png');



(new Pie([
    'title'  => [
        'text' => 'Monthly values',
    ],
    'dataset' => [
        'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        'data'   => [-1645, 1564, 845, -20, -520, -2648, 1145],
    ]
]))->render('../docs/assets/images/examples/pie-negative.png');



(new Pie([
    'chart' => [
        'width'       => 350,
        'height'      => 200,
        'pie-padding' => [0, 15, 25, 30],
    ],
    'title'  => [
        'text' => 'Monthly values',
    ],
    'dataset' => [
        'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        'data'   => [3296, 1564, 845, 4578, 2164, 3658, 1145],
    ]
]))->render('../docs/assets/images/examples/pie-chart-options.png');


(new Pie([
    'title'  => [
        'text'   => 'Monthly values',
        'font'   => 'SourceSansPro-Light.otf',
        'size'   => 13,
        'color'  => '#FF0000',
        'height' => 20,
        'padding' => [0]
    ],
    'dataset' => [
        'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        'data'   => [3296, 1564, 845, 4578, 2164, 3658, 1145],
    ]
]))->render('../docs/assets/images/examples/pie-title-options.png');


// @todo fix this:
//(new Pie([
//    'title'  => [
//        'text' => 'Monthly values',
//    ],
//    'point-label'  => [
//        'font'   => 'SourceSansPro-Light.otf',
//        'size'   => 12,
//        'color'  => '#FF0000',
//        'angle'  => 35,
//        'generator' => '\Libchart\Label\DefaultLabel',
//    ],
//    'dataset' => [
//        'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
//        'data'   => [3296, 1564, 845, 4578, 2164, 3658, 1145],
//    ]
//]))->render('../docs/assets/images/examples/pie-point-label-options.png');


(new Pie([
    'title'  => [
        'text' => 'Monthly values',
    ],
    'point-label'  => [
        'show'   => false
    ],
    'dataset' => [
        'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        'data'   => [3296, 1564, 845, 4578, 2164, 3658, 1145],
    ]
]))->render('../docs/assets/images/examples/pie-no-point-label.png');


(new Pie([
    'chart' => [
        'width'       => 800,
        'height'      => 500,
        'pie-padding' => [0, 15, 70, 70],
    ],
    'title'  => [
        'text'   => 'Monthly values',
        'font'   => 'SourceSansPro-Light.otf',
        'size'   => 13,
        'color'  => '#FF0000',
        'height' => 20,
        'padding' => [0]
    ],
    'dataset' => [
        'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        'data'   => [3296, 1564, 845, 4578, 2164, 3658, 1145],
    ]
]))->render('../docs/assets/images/examples/pie-all-options.png');





