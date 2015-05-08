<?php

namespace Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Writers;

use Carbon\Carbon;
use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Identifiers\FormatIdentifier;
use Maatwebsite\Clerk\Excel\Workbook as WorkbookInterface;
use Maatwebsite\Clerk\Excel\Writer as WriterInterface;
use Maatwebsite\Clerk\Writers\Writer as AbstractWriter;
use PHPExcel_IOFactory;
use PHPExcel_Writer_IWriter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * Class Writer.
 */
class Writer extends AbstractWriter implements WriterInterface
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
        $writer = $this->createWriter();
        $filename = $this->getFilename($filename);

        ob_start();
        $writer->save('php://output');
        $output = ob_get_contents();
        ob_end_clean();

        $response = new Response($output, 200, [
            'Content-Type'        => $this->getContentType($this->getType()),
            'Content-Disposition' => 'attachment; filename="' . $filename . '.' . $this->getExtension() . '"',
            'Expires'             => 'Mon, 26 Jul 1997 05:00:00 GMT', // Date in the past
            'Last-Modified'       => Carbon::now()->format('D, d M Y H:i:s'),
            'Cache-Control'       => 'cache, must-revalidate',
            'Pragma'              => 'public',
        ]);

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
        // TODO: Implement store() method.
    }

    /**
     * @param WorkbookInterface $workbook
     *
     * @return \PHPExcel
     */
    protected function convertToDriver(WorkbookInterface $workbook)
    {
        $styleWriter = new StyleWriter();

        /*
         * FIND DRIVER
         */
        $driver = $workbook->getDriver();

        /*
         * WORKBOOK STYLES
         */
        if ($workbook->hasStyles()) {
            $styles = $styleWriter->convert(
                $workbook->getStyles()
            );

            $driver->getDefaultStyle()->applyFromArray($styles);
        }

        /*
         * WORKBOOK SHEETS
         */
        foreach ($workbook->getSheets() as $sheet) {
            $driverWorksheet = $sheet->getDriver();

            /*
             * WORKSHEET STYLES
             */
            if ($sheet->hasStyles()) {
                $styles = $styleWriter->convert(
                    $sheet->getStyles()
                );

                $driverWorksheet->getDefaultStyle()->applyFromArray($styles);
            }

            /*
             * CELLS
             */
            $cellWriter = new CellWriter($driverWorksheet);

            // Add sheet to workbook
            $driver->addSheet($driverWorksheet);

            // Add cells
            foreach ($sheet->getCells() as $cell) {
                $cellWriter->write($cell);
            }

            // Merge given cells
            foreach ($sheet->getMergeCells() as $range) {
                $driverWorksheet->mergeCells($range);
            }
        }

        // Rewind
        $driver->setActiveSheetIndex(0);

        return $driver;
    }

    /**
     * @return PHPExcel_Writer_IWriter
     */
    protected function createWriter()
    {
        return PHPExcel_IOFactory::createWriter(
            $this->convertToDriver($this->getExportable()),
            $this->type
        );
    }

    /**
     * @param string $format
     *
     * @return string
     */
    public function getContentType($format)
    {
        return (new FormatIdentifier())->getContentTypeByFormat($format);
    }
}
