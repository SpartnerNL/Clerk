<?php

use Maatwebsite\Clerk\DocumentFactory;

class DocumentFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function test_create_csv_file()
    {
        $this->assertInstanceOf('Maatwebsite\Clerk\Files\Csv', DocumentFactory::create('Csv', 'name'));
    }

    public function test_create_excel_file()
    {
        $this->assertInstanceOf('Maatwebsite\Clerk\Files\Excel', DocumentFactory::create('Excel', 'name'));
    }

    public function test_create_excel_2007_file()
    {
        $this->assertInstanceOf('Maatwebsite\Clerk\Files\Excel2007', DocumentFactory::create('Excel2007', 'name'));
    }

    public function test_create_word_file()
    {
        $this->assertInstanceOf('Maatwebsite\Clerk\Files\Word', DocumentFactory::create('Word', 'name'));
    }

    public function test_create_word_2007_file()
    {
        $this->assertInstanceOf('Maatwebsite\Clerk\Files\Word2007', DocumentFactory::create('Word2007', 'name'));
    }
}
