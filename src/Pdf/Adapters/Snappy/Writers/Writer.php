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
        $output = $this->getExportable()->getDriver()->getOutputFromHtml(
            $this->convertToHtml($this->getExportable())
        );

        $response = new Response($output, 200, array(
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

        $output = $this->getExportable()->getDriver()->getOutputFromHtml(
            $this->convertToHtml($this->getExportable())
        );;

        $response = new StreamedResponse(function () use ($output) {
            echo $output;
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
        $filename = $this->getFilename($filename);

        $file = $path . '/' . $filename . '.' . $this->getExtension();

        $this->getExportable()->getDriver()->generateFromHtml(
            $this->convertToHtml($this->getExportable()),
            $file
        );
    }

    /**
     * @param Document $document
     *
     * @return \Knp\Snappy\Pdf;
     */
    protected function convertToHtml(Document $document)
    {
        $html = '';
        foreach ($document->getPages() as $page) {
            foreach ($page->getText() as $text) {
                $html .= $text->getText();
            }
        }

        return $html;
    }
}
