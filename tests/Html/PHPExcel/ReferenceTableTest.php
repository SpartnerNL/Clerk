<?php namespace Maatwebsite\Clerk\Tests\Html\PHPExcel;

use Maatwebsite\Clerk\Adapters\PHPExcel\Html\ReferenceTable;

class ReferenceTableTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var ReferenceTable
     */
    protected $table;


    public function setUp()
    {
        $this->table = new ReferenceTable();
    }


    public function test_next_row()
    {
        $this->table->nextRow();
        $this->assertEquals(1, $this->table->getRow());

        $this->table->nextRow();
        $this->assertEquals(2, $this->table->getRow());
    }


    public function test_next_column()
    {
        $this->table->nextColumn();
        $this->assertEquals('B', $this->table->getColumn());

        $this->table->nextColumn();
        $this->assertEquals('C', $this->table->getColumn());
    }


    public function test_increment_level()
    {
        $this->table->incrementLevel();
        $this->assertEquals(1, $this->table->getLevel());

        $this->table->incrementLevel();
        $this->assertEquals(2, $this->table->getLevel());
    }


    public function test_remember_data()
    {
        $this->table->setContent('cell content');
        $this->table->rememberData($this->table->getContent());

        $data = $this->table->getData();
        $this->assertEquals('cell content', $data[$this->table->getRow()][$this->table->getColumn()]);
    }


    public function test_set_start_column()
    {
        $column = $this->table->setStartColumn();
        $this->assertEquals('A', $column);

        $this->table->incrementLevel();
        $this->table->nextColumn();
        $column = $this->table->setStartColumn();
        $this->assertEquals('B', $column);

        $this->assertCount(2, $this->table->getNested());
    }


    public function test_release_start_column()
    {
        $this->table->setStartColumn();
        $this->assertEquals(1, $this->table->getLevel());
        $this->assertCount(1, $this->table->getNested());

        $this->assertEquals('A', $this->table->releaseStartColumn());
        $this->assertEquals(0, $this->table->getLevel());
        $this->assertCount(0, $this->table->getNested());
    }


    public function test_append_content_by_node()
    {
        $node = new \DOMElement('name', 'value');

        $this->table->appendContentByNode($node);

        $this->assertEquals('value', $this->table->getContent());
    }
}