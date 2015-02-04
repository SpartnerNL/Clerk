<?php namespace Maatwebsite\Clerk\Excel;

use Closure;
use Maatwebsite\Clerk\Excel\Cells\Coordinate;
use Maatwebsite\Clerk\Excel\Styles\Alignment;
use Maatwebsite\Clerk\Excel\Styles\Border;
use Maatwebsite\Clerk\Excel\Styles\Font;

interface Cell {

    /**
     * @return null|string
     */
    public function getValue();

    /**
     * @param null|string $value
     */
    public function setValue($value);

    /**
     * Format as string
     * @param null $value
     * @return $this
     */
    public function asString($value = null);

    /**
     * @param $coordinate
     */
    public function setCoordinate($coordinate);

    /**
     * @return Coordinate
     */
    public function getCoordinate();

    /**
     * @return string
     */
    public function getDataType();

    /**
     * @param string $dataType
     */
    public function setDataType($dataType);

    /**
     * @return mixed
     */
    public function getFormat();

    /**
     * @param $format
     * @return mixed
     */
    public function format($format);

    /**
     * @param callable $callback
     * @return Font
     */
    public function font(Closure $callback = null);

    /**
     * @param string|callable $callback
     * @param string|null     $type
     * @return Fill
     */
    public function fill($callback = null, $type = null);

    /**
     * @param string|callable $callback
     * @param string|null     $type
     * @return Fill
     */
    public function background($callback = null, $type = null);

    /**
     * @param string|callable|null $callback
     * @param string|null          $style
     * @return Border
     */
    public function border($callback = null, $style = null);

    /**
     * @param callable|null $callback
     * @return Border
     */
    public function borders(Closure $callback = null);

    /**
     * @param string|callable|null $callback
     * @param string|null          $vertical
     * @return Alignment
     */
    public function align($callback = null, $vertical = null);

    /**
     * @param $vertical
     * @return mixed
     */
    public function valign($vertical);
}