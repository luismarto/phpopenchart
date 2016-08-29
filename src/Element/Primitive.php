<?php namespace Libchart\Element;

use Libchart\Exception\LogoFileNotFoundException;

/**
 * Graphic primitives, extends GD with chart related primitives.
 */
class Primitive
{
    private $img;

    /**
     * Creates a new primitive object
     * Make sure the instance gets the $img, if you intend to use line(), rectangle() or any
     * methods that depend on $img. For padding, you don't need the $img
     *
     * @param resource|null $img GD image resource
     */
    public function __construct($img)
    {
        $this->img = $img;
    }

    /**
     * Draws a straight line.
     *
     * @param int $x1 line start (X)
     * @param int $y1 line start (Y)
     * @param int $x2 line end (X)
     * @param int $y2 line end (Y)
     * @param \Libchart\Color\Color $color
     */
    public function line($x1, $y1, $x2, $y2, $color)
    {
        imageline($this->img, $x1, $y1, $x2, $y2, $color->getColor($this->img));
    }

    /**
     * @param int $x1
     * @param int $y1
     * @param int $x2
     * @param int $y2
     * @param \Libchart\Color\Color $color
     */
    public function rectangle($x1, $y1, $x2, $y2, $color)
    {
        imagefilledrectangle($this->img, $x1, $y1, $x2, $y2, $color->getColor($this->img));
    }

    /**
     * Draw a filled gray box with thick borders and darker corners.
     *
     * @param int $x1 top left coordinate (x)
     * @param int $y1 top left coordinate (y)
     * @param int $x2 bottom right coordinate (x)
     * @param int $y2 bottom right coordinate (y)
     * @param \Libchart\Color\Color $color0 edge color
     * @param \Libchart\Color\Color $color1 corner color
     */
    public function outlinedBox($x1, $y1, $x2, $y2, $color0, $color1)
    {
        imagefilledrectangle($this->img, $x1, $y1, $x2, $y2, $color0->getColor($this->img));
        imagerectangle($this->img, $x1, $y1, $x1 + 1, $y1 + 1, $color1->getColor($this->img));
        imagerectangle($this->img, $x2 - 1, $y1, $x2, $y1 + 1, $color1->getColor($this->img));
        imagerectangle($this->img, $x1, $y2 - 1, $x1 + 1, $y2, $color1->getColor($this->img));
        imagerectangle($this->img, $x2 - 1, $y2 - 1, $x2, $y2, $color1->getColor($this->img));
    }

    /**
     * Merges a image onto the $this->img
     * @param string $imgPath
     * @param int $dstX
     * @param int $dstY
     * @param int $srcX
     * @param int $srcY
     * @param null|int $srcW
     * @param null|int $srcH
     * @param int $pct
     * @throws LogoFileNotFoundException
     */
    public function copyMergeImage($imgPath, $dstX, $dstY, $srcX, $srcY, $srcW = null, $srcH = null, $pct = 100)
    {
        $logoImage = @imagecreatefrompng($imgPath);

        if (!$logoImage) {
            throw new LogoFileNotFoundException;
        }

        if ($logoImage) {
            imagecopymerge(
                $this->img,
                $logoImage,
                $dstX,
                $dstY,
                $srcX,
                $srcY,
                is_null($srcW) ? imagesx($logoImage) : $srcW,
                is_null($srcH) ? imagesy($logoImage) : $srcH,
                $pct
            );
        }
    }
}
