<?php

namespace Maatwebsite\Clerk\Excel\Sheets;

use Closure;
use Maatwebsite\Clerk\Adapter;
use Maatwebsite\Clerk\Excel\Cell as CellInterface;
use Maatwebsite\Clerk\Excel\Cells\Cell as AbstractCell;
use Maatwebsite\Clerk\Excel\Cells\Coordinate;
use Maatwebsite\Clerk\Excel\Html\HtmlToSheetConverter;
use Maatwebsite\Clerk\Excel\Styles\Styleable;
use Maatwebsite\Clerk\Excel\Styles\StyleableTrait;
use Maatwebsite\Clerk\Templates\TemplateFactory;
use Maatwebsite\Clerk\Traits\CallableTrait;

abstract class Sheet extends Adapter implements Styleable
{
    /*
     * Traits
     */
    use CallableTrait, StyleableTrait;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var mixed
     */
    protected $driver;

    /**
     * @param string  $title
     * @param Closure $callback
     */
    public function __construct($title, Closure $callback = null)
    {
        // Set the title
        $this->setTitle($title);

        // Preform callback on the sheet
        $this->call($callback);
    }

    /**
     * @param array  $source
     * @param null   $nullValue
     * @param string $startCell
     * @param bool   $strictNullComparison
     *
     * @return SheetInterface
     */
    public function fromArray(array $source, $nullValue = null, $startCell = 'A1', $strictNullComparison = false)
    {
        list($columnCount, $rowCount) = self::coordinateFromString($startCell);

        foreach ($source as $row) {
            if (is_array($row)) {
                foreach ($row as $value) {
                    $cell = $this->cell(new Coordinate($columnCount, $rowCount));

                    if ($strictNullComparison) {
                        if ($value !== $nullValue) {
                            $cell->setValue($value);
                        }
                    } else {
                        if ($value != $nullValue) {
                            $cell->setValue($value);
                        }
                    }
                    $columnCount++;
                }
            } else {
                $cell = $this->cell(new Coordinate($columnCount, $rowCount));

                if ($strictNullComparison) {
                    if ($row !== $nullValue) {
                        $cell->setValue($row);
                    }
                } else {
                    if ($row != $nullValue) {
                        $cell->setValue($row);
                    }
                }
            }

            $columnCount = 'A';
            $rowCount++;
        }

        return $this;
    }

    /**
     * Coordinate from string
     *
     * @param string $pCoordinateString
     *
     * @throws \Exception
     * @return array      Array containing column and row (indexes 0 and 1)
     */
    public static function coordinateFromString($pCoordinateString = 'A1')
    {
        if (preg_match("/^([$]?[A-Z]{1,3})([$]?\d{1,7})$/", $pCoordinateString, $matches)) {
            return [$matches[1], $matches[2]];
        } elseif ((strpos($pCoordinateString, ':') !== false) || (strpos($pCoordinateString, ',') !== false)) {
            throw new \Exception('Cell coordinate string can not be a range of cells');
        } elseif ($pCoordinateString == '') {
            throw new \Exception('Cell coordinate can not be zero-length string');
        }

        throw new \Exception('Invalid cell coordinate ' . $pCoordinateString);
    }

    /**
     * Load from template.
     *
     * @param       $template
     * @param array $data
     * @param null  $engine
     *
     * @return mixed
     */
    public function loadTemplate($template, array $data = [], $engine = null)
    {
        // Init factory based on given engine, based on extension or use of default engine
        $factory = TemplateFactory::create($template, $engine);

        // Render the template
        $html = $factory->make($template, $data)->render();

        // Convert the html to a sheet
        (new HtmlToSheetConverter())->convert(
            $html,
            $this
        );

        return $this;
    }

    /**
     * Set the sheet title.
     *
     * @param string $title
     *
     * @return $this
     */
    abstract public function setTitle($title);

    /**
     * New cell.
     *
     * @param array|string        $coordinate
     * @param Closure|string|null $callback
     *
     * @return AbstractCell
     */
    public function cell($coordinate, $callback = null)
    {
        if ($this->cellExists($coordinate)) {
            $cell = $this->getCellByCoordinate($coordinate);
        } else {
            $cell = new AbstractCell();
        }

        // Set coordinates
        $cell->setCoordinate($coordinate);

        if (is_callable($callback)) {
            $cell->call($callback);
        } elseif (!is_null($callback)) {
            $cell->setValue($callback);
        }

        $this->addCell($cell);

        return $cell;
    }

    /**
     * Add a cell.
     *
     * @param CellInterface $cell
     *
     * @return mixed
     */
    public function addCell(CellInterface $cell)
    {
        $this->cells[$cell->getCoordinate()->get()] = $cell;
    }

    /**
     * @return CellInterface[]
     */
    public function getCells()
    {
        return $this->cells;
    }

    /**
     * @param $coordinate
     *
     * @return bool
     */
    public function cellExists($coordinate)
    {
        return in_array($coordinate, array_keys($this->getCells()));
    }

    /**
     * @param $coordinate
     *
     * @return mixed
     */
    public function getCellByCoordinate($coordinate)
    {
        if ($this->cellExists($coordinate)) {
            return $this->cells[$coordinate];
        }
    }
}
