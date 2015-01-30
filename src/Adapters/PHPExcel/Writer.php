<?php namespace Maatwebsite\Clerk\Adapters\PHPExcel;

use Carbon\Carbon;
use Maatwebsite\Clerk\Adapters\Writer as AbstractWriter;
use Maatwebsite\Clerk\Writer as WriterInterface;
use PHPExcel_IOFactory;
use Maatwebsite\Clerk\Workbook as WorkbookInterface;
use PHPExcel_Writer_IWriter;

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
     * @return mixed
     */
    protected function convertToDriver(WorkbookInterface $workbook)
    {
        $driver = $workbook->getDriver();

        foreach ($workbook->getSheets() as $sheet)
        {
            $driverWorksheet = $sheet->getDriver();

            $driver->addSheet($driverWorksheet);
        }

        $driver->setActiveSheetIndex(0);

        return $driver;
    }

    /**
     * @return PHPExcel_Writer_IWriter
     */
    protected function createWriter()
    {
        $writer = PHPExcel_IOFactory::createWriter(
            $this->convertToDriver($this->workbook),
            $this->type
        );

        if ( $this->getType() == 'CSV' )
        {
            $writer->setDelimiter($this->workbook->getDelimiter());
            $writer->setEnclosure($this->workbook->getEnclosure());
            $writer->setLineEnding($this->workbook->getLineEnding());
        }

        return $writer;
    }
}