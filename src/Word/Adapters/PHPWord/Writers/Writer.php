<?php

namespace Maatwebsite\Clerk\Word\Adapters\PHPWord\Writers;

use Maatwebsite\Clerk\Word\Document;
use Maatwebsite\Clerk\Writers\Writer as AbstractWriter;

class Writer extends AbstractWriter
{
    /**
     * Export the workbook.
     *
     * @param null|string $filename
     *
     * @throws \Exception
     * @return mixed|void
     */
    public function export($filename = null)
    {
        $filename = $this->getFilename($filename);
        $document = $this->convertToDriver(
            $this->getExportable()
        );

        return $document->save(
            $filename . '.' . $this->getExtension(),
            $this->getType(),
            true
        );
    }

    /**
     * @param      $path
     * @param null $filename
     *
     * @return mixed
     */
    public function store($path, $filename = null)
    {
        $filename = $this->getFilename($filename);
        $document = $this->convertToDriver(
            $this->getExportable()
        );

        return $document->save(
            $path . '/' . $filename . '.' . $this->getExtension(),
            $this->getType(),
            false
        );
    }

    /**
     * @param Document $document
     *
     * @return \PhpOffice\PhpWord\PhpWord
     */
    protected function convertToDriver(Document $document)
    {
        $driver = $document->getDriver();

        foreach ($document->getPages() as $page) {
            $section = $document->getDriver()->addSection();
            (new PageWriter())->write($section, $page);
        }

        return $driver;
    }
}
