# Change Log
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/) 
and this project adheres to [Semantic Versioning](http://semver.org/).

## [Unreleased]
### Added
- Added settings for label axis (font, font size, angle, color and margin) and a `AxisLabel` element with all the properties and methods for the axis (such as printing)
- Added settings for the default chart padding by chart type
- 

### Changed
- When setting the font for the title, if you simply pass the font name, the package will look for that font on the fonts.path configuration. If you pass a full path with the name, that's what the package uses.
 This works for any element with a font
- Refactored `Point` to have a `$label` and `$value` instead of a `$x` and `$y`
- Moved the `$axisLabelGenerator` to `AxisLabel`
- Removed `setAxisLabelGenerator`. Either you set it in `config.php` or on the chart's constructor
- Added a `AbstractElement` with the common properties and methods for the Elements
- Removed `setAngle()` on `Text`. Either you set it in `config.php` or on the chart's constructor
- Removed the axis line for the numbers (it's "cleaner" this way)

## [2.0.0] - 2016-08-29
### Added
- Added specific classes for Title and Logo
- Added configurations for all possible Title attributes
- Added ability to configure the font size for the Title
- Added PHP and extension requirements on `composer.json`

### Changed
- Refactor the chart's constructor, which now receives an array with all the options
- The XYDataSet constructor now receives an array with points
- Refactored package structure
- Refactored class names
- Removed the Trait and added that code to the AbstractChartBar
- The step markers no longer have a "small marker"
- The point markers have an increased size
- Updated the colors for the axis and guides
- Reused shared code between Line, Column and Bar
- If the logo is requested and the file does not exist, an exception is now throwed
- The default for the BasicPadding properties are now 0, instead of the `$top` value
- Fixed the and tests
- Fixed bug displaying the Caption on Pie charts (wrong position) 

## [1.5.0] - 2016-08-28
### Added
- Exceptions instead of `die`, so you can handle exceptions in your own code
- Added config file (which replaced the `Config` class) that enables you to set the default fonts and label settings
- Added `Short` (Label) so the axis legends get "shorter" when the chart has greater values (thousands or millions)
- Added `NumberFormatter` to display points with separators
- Added ability to use different formatters for Axis and Points (that can be setted through the config file)
- Added `EurCurrencyFormatter` and `PercentageFormatter` to display values in euros and percentages
- When you create a new `Point`, you can now define a specific color for that point

### Changed
- Refactored the Plot class, which is now a Trait to avoid too much dependency between classes
- Removed duplicated code shared across the Chart classes (part of it)
- Changed the way the "guides" were being created. The guides are now aligned with the axis values instead of "randomly" on the background.
- Added white as default color for Pie chart background
- The chart title default color is now `#444444`
- Chart Axis, guides and markers are defined as lines instead of rectangles.
- Fixed PSR-2
- Minor fixes and optimizations
- Updated package structure

## [1.4.1] - 2016-08-12
### Added
- Gitignore file
- SourceSans fonts are used by default
- Ability to set the font family to be used (configurable)
- Ability to change the title color
- New class to define colors in hex (`ColorHex`)

### Changed
- Added PSR-2
- Greatly improved phpdocs
- Logo is disabled by default
- Changed the lines below the chart bars and leaved only the "guides"
- The "guides" are now lines instead of rectangles
- `ColorPallete` colors
- Fontsize and overall aspect.

## [1.4.0] - 2013-10-20
### Changed
- Library is now available as PHP Composer package
- Class names and namespaces are PSR-0 compatible

### Fixed
- Fix Markdown links to tag comparison URL with footnote-style links.

## [1.3] - 2011-07-27
### Changed
- Customized palette on Horizontal and Vertical Bar charts.
- Add an option to turn off text caption on individual data points.
- Add an option to disable sorting (preserve data points order).
- Issue #2: DejaVu Fonts don't include license

## [1.2.2] - 2010-10-12
### Changed
- Ability to change colors
- Fix #1 : Pie chart filled with solid color when percentage < 1.

## [1.2.1] - 2008-04-10
### Changed
- Ability to set the upper/lower bounds (regression).
- HorizontalBarChart: a small box is shown when x = 0 (regression).
- Multiple series charts: when we go over the maximum series count, loop over color.
- Multiple series bar chart: brown color is shown twice.
- Pie chart : if some relative percentage is null, the whole diagram is filled in by one color.
- Ability to use negative values in bar chart.
    
## [1.2] - 2007-08-13
### Changed
- Multiple line charts
- Multiple vertical and horizontal bar charts
- Customizable layout (plot)
- Support for PHP4 is deprecated, as PHP 4 has reached its end of life.
- Use of PHP5 OO constructs
- Use of `<?php` tags for better server compatibility
- Better separation of data and presentation objects, introduction of dataset objects
- Change of license to GPL v3

## [1.1] - 2006-04-02
### Changed
- Added Line Charts
- Bar Chart: default lower bound set to value 0 (seems more intuitive).
    Use `$chart->setLowerBound(null)` if you want to revert to the old behaviour.
    
### Bugfixes
- Removed undefined IMG_ARC_FILL constant
- Added missing default parameter in HorizontalChart::render()
- Fixed decimal values in Bar Charts
- Typo in default logo
- Crashed when no point was defined
- Crashed when all values were set to 0

## 1.0 - 2005-09-30
### Added
- Initial release