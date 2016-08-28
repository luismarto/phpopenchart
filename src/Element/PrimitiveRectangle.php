<?php namespace Libchart\Element;

/**
 * A rectangle identified by the top-left and the bottom-right corners.
 */
class PrimitiveRectangle
{
    /**
     * Top left X.
     * @var int
     */
    public $x1;

    /**
     * Top left Y.
     * @var int
     */
    public $y1;

    /**
     * Bottom right X.
     * @var int
     */
    public $x2;

    /**
     * Bottom right Y.
     * @var int
     */
    public $y2;

    /**
     * Constructor of Rectangle.
     *
     * @param int $x1 Left edge coordinate
     * @param int $y1 Upper edge coordinate
     * @param int $x2 Right edge coordinate
     * @param int $y2 Bottom edge coordinate
     */
    public function __construct($x1, $y1, $x2, $y2)
    {
        $this->x1 = $x1;
        $this->y1 = $y1;
        $this->x2 = $x2;
        $this->y2 = $y2;
    }

    /**
     * Apply a padding and returns the resulting rectangle.
     * The result is an enlarged rectangle.
     *
     * @param \stdClass $padding
     * @return PrimitiveRectangle $padding Padded rectangle
     */
    public function getPaddedRectangle($padding)
    {
        $rectangle = new PrimitiveRectangle(
            $this->x1 + $padding->left,
            $this->y1 + $padding->top,
            $this->x2 - $padding->right,
            $this->y2 - $padding->bottom
        );

        //echo "(" . $this->x1 . "," . $this->y1 . ") (" . $this->x2 . "," . $this->y2 . ")<br>";
        return $rectangle;
    }
}
