<?php namespace Maatwebsite\Clerk\Adapters\PHPExcel\Html;

use DOMNode;
use Maatwebsite\Clerk\Sheet;

class ReferenceTable {

    /**
     * @var int
     */
    protected $row = 0;

    /**
     * @var string
     */
    protected $column = 'A';

    /**
     * @var string
     */
    protected $content = '';

    /**
     * @var int
     */
    protected $level = 0;

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var
     */
    protected $nested = [];

    /**
     * @return mixed
     */
    public function getRow()
    {
        return $this->row;
    }

    /**
     * @param mixed $row
     */
    public function setRow($row)
    {
        $this->row = $row;
    }

    /**
     * Increment the row
     */
    public function nextRow()
    {
        $this->row++;
    }

    /**
     * Increment the row
     */
    public function previousRow()
    {
        $this->row--;
    }


    /**
     * @return mixed
     */
    public function getColumn()
    {
        return $this->column;
    }

    /**
     * @param mixed $column
     */
    public function setColumn($column)
    {
        $this->column = $column;
    }

    /**
     * Increment the column
     */
    public function nextColumn()
    {
        $this->column++;
    }

    /**
     * Increment the column
     */
    public function previousColumn()
    {
        $this->column--;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @param $content
     */
    public function appendContent($content)
    {
        $this->content .= $content;
    }

    /**
     * Reset the content
     */
    public function resetContent()
    {
        $this->content = '';
    }

    /**
     * @return mixed
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param mixed $level
     */
    public function setLevel($level)
    {
        $this->level = $level;
    }

    /**
     * Increment the table level
     */
    public function incrementLevel()
    {
        $this->level++;
    }

    /**
     * Increment the table level
     */
    public function decrementLevel()
    {
        $this->level--;
    }

    /**
     * @param $content
     */
    public function rememberData($content)
    {
        $this->data[$this->getRow()][$this->getColumn()] = $content;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return mixed
     */
    public function setStartColumn()
    {
        $column = $this->getLevel() == 0
            ? 'A'
            : $this->getColumn();

        // Increment the table level
        $this->incrementLevel();

        // Set the column to the table level
        $this->nested[$this->getLevel()] = $column;

        return $this->getStartColumn();
    }

    /**
     * @return mixed
     */
    public function getStartColumn()
    {
        return $this->nested[$this->getLevel()];
    }

    /**
     * Release the start column
     * @return mixed
     */
    public function releaseStartColumn()
    {
        $this->decrementLevel();

        return array_pop($this->nested);
    }

    /**
     * @param DOMNode $node
     */
    public function appendContentByNode(DOMNode $node)
    {
        $value = preg_replace('/\s+/', ' ', trim($node->nodeValue));

        $this->appendContent($value);
    }

    /**
     * @return mixed
     */
    public function getNested()
    {
        return $this->nested;
    }
}