<?php namespace Phpopenchart\Chart;

use Phpopenchart\Element\Axis;

/**
 * Class AbstractChartBar
 * Base abstract class for rendering both horizontal, vertical and line bar charts.
 * @package Phpopenchart\Chart
 */
abstract class AbstractChartBar extends AbstractChart
{
    /**
     * @var Axis
     */
    protected $axis;

    /**
     * Creates a new Column, Bar or Line chart
     *
     * @param array $args
     * @param string $type
     */
    protected function __construct($args, $type)
    {
        parent::__construct($args, $type);
    }

    /**
     * Render the chart image.
     *
     * @param string|null $filename name of the file to render the image to (optional)
     */
    public function render($filename = null)
    {
        // Check the data model
        $this->getDataSet()->validate();

        $this->axis = new Axis();
        $this->axis->computeBoundaries($this->getDataSet());
        $captionArea = $this->computeLayout();
        $this->logo->draw();
        $this->title->draw();
        // @todo: Check the possibility of printing the chart line with only one point (it would look like a point)
        if (!$this->getDataSet()->isEmpty($this->type === 'line' ? 2 : 1)) {
            $this->printAxis();
            $this->{'print' . strtoupper($this->type)}();
            if ($this->hasSeveralSeries) {
                $this->caption->render(
                    $captionArea,
                    $this->palette
                );
            }
        }

        // If there's no filename, then render the chart as an image
        if (is_null($filename)) {
            header("Content-type: image/png");
        }

        $this->output($filename);
    }
}
