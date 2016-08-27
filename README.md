## PHP library to draw charts

This library allows you to create images of charts using PHP. It's specially useful when you need to create charts on the server-side 
and so you can't use a front-end library such as Highcharts.

***image here***

This library is is based on the original work of [Jean-Marc Trémeaux](http://naku.dohcrew.com/) (check the [original website](https://naku.dohcrew.com/libchart/pages/introduction/)).
Also used the fork from [Alexander Stehlik](https://github.com/astehlik).

---
````php
$chart = new ChartVerticalBar(600, 300);

$dataSet = new XYDataSet();
$dataSet->addPoint(new Point("Feb", 3296));
$dataSet->addPoint(new Point("Mar", -1816, '#44aa99'));

$chart->setDataSet($dataSet);
$chart->setTitle("Values");

header("Content-type: image/png");
$chart->render();

````

# Installation

Require the package in your `composer.json` file and update composer, using the following data:

```php
"luismarto/libchart": "1.*"
```

# Documentation

At this point documentation is scarce and the most you can get is by reading code.
It's my intention to fully document the package and it's options, but first I want to refactor a few things.

# Roadmap

In a forseable future (v 1.5).
- Make the package more "configurable"
- Fix bugs on Pie and Line charts
- Rename some classes and review the package's structure
- Refactor the bootstrap code, so you don't need to include so many classes

In a near future (v 2.0)
- Refactor the core (Plot and Chart) and remove duplicate code
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







 Libchart - Simple PHP chart drawing library
=============================================

Libchart is a free chart creation PHP library, that is easy to use.

--------------------------------------------------------------------------------


 Features
==========

    * Bar charts (horizontal or vertical).
    * Pie charts.
    * Line charts.
    * Compatibility with PHP 5.

--------------------------------------------------------------------------------


 Dependencies
==============

    * PHP 5, compiled with:
    * GD 2+
    * FreeType 2+

--------------------------------------------------------------------------------


 Installation
==============

In order to use Libchart, unpack the archive in you project directory and
include libchart.php. Please have a look at the demo files for more information.
You need to chmod 777 the "generated" directory in order to generate the demos.
There is also a tutorial available at the project homepage.


--------------------------------------------------------------------------------


 Contact info
==============

WWW: http://naku.dohcrew.com/libchart/
MAIL: jm.tremeaux at gmail dot com