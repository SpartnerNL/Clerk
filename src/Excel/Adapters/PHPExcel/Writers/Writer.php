<?php namespace Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Writers;

use Carbon\Carbon;
use PHPExcel_IOFactory;
use PHPExcel_Writer_IWriter;
use Maatwebsite\Clerk\Excel\Writer as WriterInterface;
use Maatwebsite\Clerk\Excel\Workbooks as WorkbookInterface;
use Maatwebsite\Clerk\Excel\Writers\Writer as AbstractWriter;
use Maatwebsite\Clerk\Excel\Adapters\PHPExcel\Identifiers\FormatIdentifier;

/**
 * Class Writer
 * @package Maatwebsite\Clerk\Adapters\PHPExcel
 */
class Writer extends AbstractWriter implements WriterInterface {

    /**
     * Export the workbook
     * @param null|string $filename
     * @return mixed|void
     * @throws \Exception
     */
    public function export($filename = null)
    {
        $writer = $this->createWriter();
        $filename = $this->getFilename($filename);

        $this->sendHeaders(array(
            'Content-Type'        => $this->getContentType($this->getType()),
            'Content-Disposition' => 'attachment; filename="' . $filename . '.' . $this->getExtension() . '"',
            'Expires'             => 'Mon, 26 Jul 1997 05:00:00 GMT', // Date in the past
            'Last-Modified'       => Carbon::now()->format('D, d M Y H:i:s'),
            'Cache-Control'       => 'cache, must-revalidate',
            'Pragma'              => 'public'
        ));

        $writer->save('php://output');

        // End the script to prevent corrupted xlsx files
        exit;
    }

    /**
     * @param WorkbookInterface $workbook
     * @return \PHPExcel
     */
    protected function convertToDriver(WorkbookInterface $workbook)
    {
        $driver = $workbook->getDriver();

        $styleWriter = new StyleWriter();

        // Apply default workbook styles
        if ( $workbook->hasStyles() )
        {
            $styles = $styleWriter->convert(
                $workbook->getStyles()
            );

            $driver->getDefaultStyle()->applyFromArray($styles);
        }

        foreach ($workbook->getSheets() as $sheet)
        {
            $driverWorksheet = $sheet->getDriver();

            // Init cell writer for the current sheet
            $cellWriter = new CellWriter($driverWorksheet);

            // Add sheet to workbook
            $driver->addSheet($driverWorksheet);

            // Add cells
            foreach ($sheet->getCells() as $cell)
            {
                $cellWriter->write($cell);
            }

            // Merge given cells
            foreach ($sheet->getMergeCells() as $range)
            {
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
            $this->convertToDriver($this->workbook),
            $this->type
        );
    }

    /**
     * @param string $format
     * @return string
     */
    public function getContentType($format)
    {
        return (new FormatIdentifier())->getContentTypeByFormat($format);
    }
}