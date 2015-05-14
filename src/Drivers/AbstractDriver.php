<?php namespace Maatwebsite\Clerk\Drivers;

use Maatwebsite\Clerk\Exceptions\FormatNotSupportedByDriver;

class AbstractDriver
{

    /**
     * @param $format
     *
     * @throws FormatNotSupportedByDriver
     */
    public function __construct($format)
    {
        $format = str_replace('drivers.', '', $format);
        list($type, $format) = explode('.', $format);

        if (!isset($this->supports[$type][$format])) {
            throw new FormatNotSupportedByDriver("{$this->getName()} does not support {$format} {$type}");
        }
    }

    /**
     * @return string
     */
    public function getName()
    {
        return class_basename($this);
    }

    /**
     * @param $format
     *
     * @return string
     */
    public function getWorkbookClass($format)
    {
        return 'Maatwebsite\\Clerk\\' . $format . '\\Adapters\\' . $this->getName() . '\\Workbook';
    }

    /**
     * @param $format
     *
     * @return string
     */
    public function getDocumentClass($format)
    {
        return 'Maatwebsite\\Clerk\\' . $format . '\\Adapters\\' . $this->getName() . '\\Document';
    }

    /**
     * @param $format
     *
     * @return string
     */
    public function getReaderClass($format)
    {
        return 'Maatwebsite\\Clerk\\' . $format . '\\Adapters\\' . $this->getName() . '\\Readers\Reader';
    }

    /**
     * @param $format
     * @param $type
     *
     * @return string
     */
    public function getReaderClassByType($format, $type)
    {
        return 'Maatwebsite\\Clerk\\' . $format . '\\Adapters\\' . $this->getName() . '\\Readers\\' . studly_case($type) . 'Reader';
    }

    /**
     * @param $format
     *
     * @return string
     */
    public function getWriterClass($format)
    {
        return 'Maatwebsite\\Clerk\\' . $format . '\\Adapters\\' . $this->getName() . '\\Writers\\Writer';
    }

    /**
     * @param $format
     * @param $type
     *
     * @return string
     */
    public function getWriterClassByType($format, $type)
    {
        return 'Maatwebsite\\Clerk\\' . $format . '\\Adapters\\' . $this->getName() . '\\Writers\\' . studly_case($type) . 'Writer';
    }
}
