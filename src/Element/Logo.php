<?php namespace Libchart\Element;

class Logo
{
    /**
     * Location of the logo. Can be overridden to your personalized logo.
     * @var string|false
     */
    private $filename;

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
    public function __construct($args, $gd, $outerPadding, $config)
    {
        $this->config = $config;
        $this->gd = $gd;
        $this->outerPadding = $outerPadding;
        $this->filename = false;

        if (array_key_exists('chart', $args) && is_array($args['chart'])) {
            if (array_key_exists('logo', $args['chart']) && is_file($args['chart']['logo'])) {
                $this->filename = $args['chart']['logo'];
            }
        }
    }

    /**
     * Print the logo image to the image.
     */
    public function draw()
    {
        if (!$this->filename) {
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
}