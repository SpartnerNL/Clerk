<?php namespace Maatwebsite\Clerk;

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
     * Set value for a cell for given coordinate
     * @param string $coordinate
     * @param null   $value
     * @param bool   $returnCell
     * @return mixed
     */
    public function setCellValue($coordinate = 'A1', $value = null, $returnCell = false);
}