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
     * @var int
     */
    public $right;

    /**
     * @var int
     */
    public $bottom;

    /**
     * @var int
     */
    public $left;

    public function __construct($top = 0, $right = 0, $bottom = 0, $left = 0)
    {
        $this->top = (int)$top;
        $this->right = (int)$right;
        $this->bottom = (int)$bottom;
        $this->left = (int)$left;
    }
}