<?php

use Maatwebsite\Clerk\DocumentFactory;

class DocumentFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function test_create_csv_file()
    {
        $this->assertInstanceOf('Maatwebsite\Clerk\Files\Csv', DocumentFactory::create('csv', 'name'));
    }

    public function test_create_excel_file()
    {
        $this->assertInstanceOf('Maatwebsite\Clerk\Files\Excel', DocumentFactory::create('excel', 'name'));
    }

    public function test_create_excel_2007_file()
    {
        $this->assertInstanceOf('Maatwebsite\Clerk\Files\Excel2007', DocumentFactory::create('excel2007', 'name'));
    }

    public function test_create_word_file()
    {
        $this->assertInstanceOf('Maatwebsite\Clerk\Files\Word', DocumentFactory::create('word', 'name'));
    }

    public function test_create_word_2007_file()
    {
        $this->assertInstanceOf('Maatwebsite\Clerk\Files\Word2007', DocumentFactory::create('word2007', 'name'));
    }
}
