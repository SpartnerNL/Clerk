<?php namespace Maatwebsite\Clerk;

interface Sheet {

    /**
     * Get the sheet title
     * @return string
     */
    public function getTitle();

    /**
     * Set the sheet title
     * @param string $title
     * @return string
     */
    public function setTitle($title);

    /**
     * @param null   $source
     * @param null   $nullValue
     * @param string $startCell
     * @param bool   $strictNullComparison
     * @return $this
     */
    public function fromArray($source = null, $nullValue = null, $startCell = 'A1', $strictNullComparison = false);
}