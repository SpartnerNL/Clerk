<?php namespace Maatwebsite\Clerk\Word\Adapters\PHPWord\Writers;

use Maatwebsite\Clerk\Word\Document;
use Maatwebsite\Clerk\Writers\Writer as AbstractWriter;

class Writer extends AbstractWriter {

    /**
     * Export the workbook
     * @param null|string $filename
     * @return mixed|void
     * @throws \Exception
     */
    public function export($filename = null)
    {
        $filename = $this->getFilename($filename);
        $document = $this->convertToDriver(
            $this->getExportable()
        );

        return $document->save($filename . '.' . $this->getExtension(), $this->getType(), true);
    }

    /**
     * @param Document $document
     * @return PHPWord
     */
    protected function convertToDriver(Document $document)
    {
        return $document->getDriver();
    }
}