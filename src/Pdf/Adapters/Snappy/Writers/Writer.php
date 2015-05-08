<?php

namespace Maatwebsite\Clerk\Pdf\Adapters\Snappy\Writers;

use Maatwebsite\Clerk\Pdf\Document;
use Maatwebsite\Clerk\Writers\Writer as AbstractWriter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

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

        $response = new Response($document, 200, array(
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $filename . '.' . $this->getExtension() . '"'
        ));

        return $response->send();
    }

    /**
     * Export the workbook.
     *
     * @param null|string $filename
     *
     * @throws \Exception
     * @return mixed|void
     */
    public function stream($filename = null)
    {
        $filename = $this->getFilename($filename);
        $document = $this->convertToDriver(
            $this->getExportable()
        );

        $response = new StreamedResponse(function () use ($document) {
            echo $document;
        }, 200, array(
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $filename . '.' . $this->getExtension() . '"'
        ));

        return $response->send();
    }

    /**
     * @param      $path
     * @param null $filename
     *
     * @return mixed
     */
    public function store($path, $filename = null)
    {
    }

    /**
     * @param Document $document
     *
     * @return \Knp\Snappy\Pdf;
     */
    protected function convertToDriver(Document $document)
    {
        $driver = $document->getDriver();

        //foreach ($document->getPages() as $page) {
        //    $section = $document->getDriver()->addSection();
        //    (new PageWriter())->write($section, $page);
        //}

        return $driver->getOutputFromHtml('TEST');
    }
}
