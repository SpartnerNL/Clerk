<?php namespace Maatwebsite\Clerk;

interface Writer {

    /**
     * Export the workbook
     * @param null|string $filename
     * @return mixed|void
     * @throws \Exception
     */
    public function export($filename = null);
}