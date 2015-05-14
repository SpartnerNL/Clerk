<?php

namespace Maatwebsite\Clerk\Drivers;

interface DriverInterface
{
    /**
     * @return string
     */
    public function getName();

    /**
     * Indicate which reader and writer formats are supported by this driver
     * @return array
     *               Example:
     *               return [
     *               'reader' => [
     *               'excel2003' => true,
     *               ],
     *               'writer' => [
     *               'excel2003' => true,
     *               ]
     *               ];
     */
    public function supports();

    /**
     * @param $format
     *
     * @return string
     */
    public function getWorkbookClass($format);

    /**
     * @param $format
     *
     * @return string
     */
    public function getReaderClass($format);

    /**
     * @param $format
     * @param $type
     *
     * @return string
     */
    public function getReaderClassByType($format, $type);

    /**
     * @param $format
     *
     * @return string
     */
    public function getWriterClass($format);

    /**
     * @param $format
     * @param $type
     *
     * @return string
     */
    public function getWriterClassByType($format, $type);

    /**
     * @param $format
     *
     * @return mixed
     */
    public function getDocumentClass($format);
}
