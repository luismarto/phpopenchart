<?php namespace Libchart\Element;

class Logo
{
    /**
     * Location of the logo. Can be overridden to your personalized logo.
     */
    private $filename;

    /**
     * @var bool
     */
    private $hasLogo;

    /**
     * @var \Noodlehaus\Config
     */
    private $config;

    /**
     * @var Gd resource
     */
    private $gd;

    /**
     * @var \stdClass
     */
    private $outerPadding;

    /**
     * @param Gd $gd
     * @param BasicPadding $outerPadding
     * @param \Noodlehaus\Config $config
     */
    public function __construct($gd, $outerPadding, $config)
    {
        $this->config = $config;
        $this->gd = $gd;
        $this->outerPadding = $outerPadding;

        // By default, don't display the logo
        // @todo: make this configurable
        $this->filename = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'images\PoweredBy.png';
        $this->hasLogo = false;
    }

    /**
     * Print the logo image to the image.
     */
    public function draw()
    {
        if (!$this->hasLogo) {
            return false;
        }

        $this->gd->copyMergeImage(
            $this->filename,
            2 * $this->outerPadding->left,
            $this->outerPadding->top,
            0,
            0
        );

        return true;
    }

    /**
     * Sets the logo image file name.
     *
     * @param string $filename New logo image file name
     */
    public function setLogoFilename($filename)
    {
        $this->filename = $filename;
    }

    /**
     * Ability to define if the chart should display the logo or not
     * @param bool $hasLogo
     */
    public function setHasLogo($hasLogo)
    {
        $this->hasLogo = $hasLogo;
    }
}