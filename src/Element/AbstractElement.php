<?php namespace Libchart\Element;

use Noodlehaus\Config;

abstract class AbstractElement
{
    /**
     * @var Config
     */
    protected $config;

    /**
     * Private method to set the font for the title
     * @param string $fontName
     * @return $this
     */
    protected function setFont($fontName)
    {
        $fontsDirectory = $this->config->get(
            'fonts.path',
            dirname(__FILE__)
            . DIRECTORY_SEPARATOR. '..'
            . DIRECTORY_SEPARATOR . '..'
            . DIRECTORY_SEPARATOR . 'fonts' . DIRECTORY_SEPARATOR
        );

        // If a slash is on the filename, we assume the user setted the full path
        // otherwise, look for the font on the default directory
        if (strpos($fontName, DIRECTORY_SEPARATOR) === false) {
            $font = $fontsDirectory . $fontName;
        } else {
            $font = $fontName;
        }

        return $font;
    }
}