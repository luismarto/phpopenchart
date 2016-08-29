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
    private $titleList;

    /**
     * List of XYDataSet.
     * @var array
     */
    private $serieList;

    /**
     * Constructor of XYSeriesDataSet.
     *
     */
    public function __construct()
    {
        $this->titleList = [];
        $this->serieList = [];
    }

    /**
     * Add a new serie to the dataset.
     *
     * @param string $title (label) of the serie.
     * @param \Libchart\Data\XYDataSet|array Serie of points to add
     */
    public function addSerie($title, $serie)
    {
        $this->titleList[] = $title;
        // If the serie is an array, create the XY dataset
        if (is_array($serie)) {
            $serie = new XYDataSet($serie);
        }

        $this->serieList[] = $serie;
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
