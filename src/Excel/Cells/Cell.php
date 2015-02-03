<?php namespace Maatwebsite\Clerk\Excel\Cells;

use Maatwebsite\Clerk\Excel\Styles\Styleable;
use Maatwebsite\Clerk\Excel\Styles\StyleableTrait;
use Maatwebsite\Clerk\Traits\CallableTrait;
use Maatwebsite\Clerk\Excel\Cell as CellInterface;

class Cell implements CellInterface, Styleable {

    /**
     * Traits
     */
    use CallableTrait, StyleableTrait;

    /**
     * @var string|null
     */
    protected $value;

    /**
     * @var Coordinate
     */
    protected $coordinate;

    /**
     * @var DataType
     */
    protected $dataType;

    /**
     * @var Format
     */
    protected $format;

    /**
     * @param string|null $value
     * @param null        $coordinate
     */
    public function __construct($value = null, $coordinate = null)
    {
        if ( $value )
            $this->setValue($value);

        if ( $coordinate )
            $this->setCoordinate($coordinate);
    }

    /**
     * @return null|string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param null|string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @param $coordinate
     */
    public function setCoordinate($coordinate)
    {
        $this->coordinate = Coordinate::fromString($coordinate);
    }

    /**
     * @return Coordinate
     */
    public function getCoordinate()
    {
        return $this->coordinate;
    }

    /**
     * @return string
     */
    public function getDataType()
    {
        return $this->dataType;
    }

    /**
     * @param string $dataType
     */
    public function setDataType($dataType)
    {
        $this->dataType = new DataType($dataType);
    }

    /**
     * @param $format
     * @return $this
     */
    public function format($format)
    {
        $this->format = new Format($format);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * Format as string
     * @param null $value
     * @return $this
     */
    public function asString($value = null)
    {
        if ( $value )
            $this->setValue($value);

        $this->setDataType(DataType::STRING);
        $this->setFormat(Format::TEXT);

        return $this;
    }
}