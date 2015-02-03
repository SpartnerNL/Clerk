<?php namespace Maatwebsite\Clerk\Excel;

use Maatwebsite\Clerk\Excel\Cells\Coordinate;

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
     * @param array $styles
     * @return $this
     */
    public function setStyles(array $styles);

    /**
     * @return array
     */
    public function getStyles();

    /**
     * @return bool
     */
    public function hasStyles();

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
     * @param $format
     * @return mixed
     */
    public function format($format);
}