<?php namespace Maatwebsite\Clerk;

use Closure;

interface Workbook {

    /**
     * @return mixed
     */
    public function getTitle();

    /**
     * @param mixed $title
     */
    public function setTitle($title);

    /**
     * @param $description
     * @return $this
     */
    public function setDescription($description);

    /**
     * @return string
     */
    public function getDescription();

    /**
     * @param $company
     * @return $this
     */
    public function setCompany($company);

    /**
     * @return string
     */
    public function getCompany();

    /**
     * @param $subject
     * @return $this
     */
    public function setSubject($subject);

    /**
     * @return string
     */
    public function getSubject();

    /**
     * Init a new sheet
     * @param          $title
     * @param callable $callback
     * @return Sheet
     */
    public function sheet($title, Closure $callback = null);

    /**
     * Add a sheet to the sheets collection
     * @param Sheet $sheet
     * @return $this
     */
    public function addSheet(Sheet $sheet);

    /**
     * Get the sheet collection
     * @return array
     */
    public function getSheets();

    /**
     * Get the sheet count
     * @return int
     */
    public function getSheetCount();

    /**
     * Check if the sheet exists in the collection
     * @param $index
     * @return bool
     */
    public function sheetExists($index);

    /**
     * Check is the given index is valid
     * @param $index
     * @return bool
     */
    public function isValidIndex($index);

    /**
     * @param $index
     * @return Sheet
     * @throws SheetNotFoundException
     */
    public function getSheetByIndex($index = 0);

    /**
     * Remove the sheet by index
     * @param $index
     * @return $this
     */
    public function removeSheetByIndex($index = 0);
}