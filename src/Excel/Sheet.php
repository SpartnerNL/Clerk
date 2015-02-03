<?php namespace Maatwebsite\Clerk\Excel;

use Closure;

/**
 * Interface Sheet
 * @package Maatwebsite\Clerk
 */
interface Sheet {

    /**
     * Get the sheet title
     * @return string
     */
    public function getTitle();

    /**
     * Set the sheet title
     * @param string $title
     * @return $this
     */
    public function setTitle($title);

    /**
     * New cell
     * @param array|string        $cell
     * @param Closure|string|null $callback
     * @return mixed
     */
    public function cell($cell, $callback = null);

    /**
     * Add a cell
     * @param Cell $cell
     * @return mixed
     */
    public function addCell(Cell $cell);

    /**
     * @return Cell[]
     */
    public function getCells();

    /**
     * @param array  $source
     * @param null   $nullValue
     * @param string $startCell
     * @param bool   $strictNullComparison
     * @return $this
     */
    public function fromArray(array $source, $nullValue = null, $startCell = 'A1', $strictNullComparison = false);

    /**
     * Load from template
     * @param       $template
     * @param array $data
     * @param null  $engine
     * @return mixed
     */
    public function loadTemplate($template, array $data = array(), $engine = null);

    /**
     * Set height for a certain row
     * @param $row
     * @param $height
     * @return $this
     */
    public function setRowHeight($row, $height);

    /**
     * Set the column width
     * @param $column
     * @param $width
     * @return mixed
     */
    public function setColumnWidth($column, $width);

    /**
     * @param string $range
     * @param bool   $alignment
     * @return $this
     */
    public function mergeCells($range = 'A1:A1', $alignment = false);

    /**
     * @return array
     */
    public function getMergeCells();
}