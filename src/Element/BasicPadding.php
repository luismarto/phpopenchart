<?php namespace Libchart\Element;

/**
 * Class BasicPadding
 * @package Libchart\Element
 */
class BasicPadding
{
    /**
     * @var int
     */
    public $top;

    /**
     * @var int|null
     */
    public $right;

    /**
     * @var int|null
     */
    public $bottom;

    /**
     * @var int|null
     */
    public $left;

    public function __construct($top, $right = null, $bottom = null, $left = null)
    {
        $this->top = $top;
        $this->right = $right;
        $this->bottom = $bottom;
        $this->left = $left;
    }
}