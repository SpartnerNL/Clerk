<?php

namespace Maatwebsite\Clerk\Excel;

/**
 * Interface Writer.
 */
interface Writer
{
    /**
     * Export the workbook.
     *
     * @param null|string $filename
     *
     * @throws \Exception
     * @return mixed|void
     */
    public function export($filename = null);
}
