<?php namespace Libchart\Data;

/**
 * This dataset comprises several series of points and is used to plot multiple lines charts.
 * Each serie is a XYDataSet.
 */
class XYSeriesDataSet extends DataSet
{
    /**
     * List of titles
     * @var array
     */
    private $titleList = [];

    /**
     * List of XYDataSet.
     * @var array
     */
    private $serieList = [];

    /**
     * Constructor of XYSeriesDataSet.
     * $points is an array with the following format:
     * [
            'series' => ['First series', 'Second Series'],
            'labels' => ['Jan', 'Feb', 'Mar'],
            'data' => [
                [
                    3296, 0, 5015
                ],
                [
                    [564, '#cccccc'], 1564, 3215
                ],
            ],
        ]
     * @param array $dataset
     */
    public function __construct(array $dataset)
    {
        // Each dataset 'data' contains the points for the `$i` series
        for ($i = 0; $i < count($dataset['data']); $i++) {
            $this->titleList[] = array_key_exists($i, $dataset['series']) ? $dataset['series'][$i] : 'Serie ' . $i;
            $this->serieList[] = new XYDataSet([
                'labels' => $dataset['labels'],
                'data'   => $dataset['data'][$i]
            ]);
        }
    }

    /**
     * Getter of titleList.
     *
     * @return array List of titles.
     */
    public function getTitleList()
    {
        return $this->titleList;
    }

    /**
     * Getter of serieList.
     *
     * @return \Libchart\Data\XYDataSet[] List of series.
     */
    public function getSerieList()
    {
        return $this->serieList;
    }
}
