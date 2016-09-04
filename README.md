## PHP library to draw charts

This library allows you to create images of charts using PHP. It's specially useful when you need to create charts on the server-side 
and so you can't use a front-end library such as Highcharts.

<img src="https://geekalicious.pt/github/libchart/libchart-sample.png"/>


This library is is based on the original work of [Jean-Marc Trémeaux](http://naku.dohcrew.com/) (check the [original website](https://naku.dohcrew.com/libchart/pages/introduction/)).
Also used the fork from [Alexander Stehlik](https://github.com/astehlik).

---
````php
use Libchart\Chart\Column;

header("Content-type: image/png");

$chart = new Column([
    'width' => 600,
    'height' => 300,
    'title' => [
        'text' => 'Values'
    ],
    'dataset' => [
        ["Feb", 3296],
        ["Mar", -1816],
        ["Apr", 687],
        ["May", 10987],
        ["Jun", 8014],
        ["Jul", 7695],
    ]
]);

$chart->render();

````

# Installation

Require the package in your `composer.json` file and update composer, using the following data:

```php
"luismarto/libchart": "2.*"
```

# Documentation & examples

Visit [https://github.com/luismarto/libchart/docs/index.html](https://github.com/luismarto/libchart/docs/index.html) for a complete documentation. 
For examples, check [https://github.com/luismarto/libchart/docs/examples.html](https://github.com/luismarto/libchart/docs/examples.html)

# Roadmap

In a forseable future
- Minor fixes and improvements (add configurations, apply configurations to all chart types, optimize internal code, add the color specified on the point to the pie chart, ...)
- Fix tests
- Make this easily integrated with Laravel

## License

Libchart is distributed under the terms of the GNU GPL v3.
This includes everything in the source code distribution
except where otherwise stated.
A copy of the GNU GPL v3 can be found in doc/GNU_GPL_V3.

##### Third Party Content

The following third party software is distributed with Libchart and
is provided under other licenses and/or has source available from
other locations. 

Files in the fonts directory are distributed under their own licence, which is located unther the doc folder.