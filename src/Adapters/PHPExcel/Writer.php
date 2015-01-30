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
     * @var string
     */
    protected $extension;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var WorkbookInterface
     */
    protected $workbook;

    /**
     * @param                   $type
     * @param                   $extension
     * @param WorkbookInterface $workbook
     */
    public function __construct($type, $extension, WorkbookInterface $workbook)
    {
        $this->extension = $extension;
        $this->type = $type;
        $this->workbook = $workbook;
    }

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
            'Content-Type'        => $this->getContentType($this->type),
            'Content-Disposition' => 'attachment; filename="' . $filename . '.' . $this->extension . '"',
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

        if ( $this->type == 'CSV' )
        {
            $writer->setDelimiter($this->workbook->getDelimiter());
            $writer->setEnclosure($this->workbook->getEnclosure());
            $writer->setLineEnding($this->workbook->getLineEnding());
        }

        return $writer;
    }
}