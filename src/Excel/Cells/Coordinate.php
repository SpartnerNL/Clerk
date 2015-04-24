<?php

namespace Maatwebsite\Clerk\Excel\Cells;

class Coordinate
{
    /**
     * @var string|null
     */
    protected $column;

    /**
     * @var int|null
     */
    protected $row;

    /**
     * @var string
     */
    protected static $regex = '/^([$]?[A-Z]{1,3})([$]?\d{1,7})$/';

    /**
     * @param string|null $column
     * @param int|null    $row
     */
    public function __construct($column = null, $row = null)
    {
        $this->setColumn($column);
        $this->setRow($row);
    }

    /**
     * @param $coordinate
     *
     * @return static
     */
    public static function fromString($coordinate)
    {
        $instance = new static();

        if ($coordinate) {
            preg_match(self::$regex, $coordinate, $matches);
            array_shift($matches);
            list($column, $row) = $matches;

            $instance->setColumn($column);
            $instance->setRow($row);
        }

        return $instance;
    }

    /**
     * @return null|string
     */
    public function getColumn()
    {
        return $this->column;
    }

    /**
     * @param null|string $column
     */
    public function setColumn($column)
    {
        $this->column = strtoupper($column);
    }

    /**
     * @return int|null
     */
    public function getRow()
    {
        return $this->row;
    }

    /**
     * @param int|null $row
     */
    public function setRow($row)
    {
        $this->row = $row;
    }

    /**
     * Get the coordinate.
     *
     * @return string
     */
    public function get()
    {
        return (string) $this->getColumn() . $this->getRow();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->get();
    }
}
