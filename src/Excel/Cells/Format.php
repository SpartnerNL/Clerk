<?php namespace Maatwebsite\Clerk\Excel\Cells;

use Maatwebsite\Clerk\Exceptions\InvalidArgumentException;

class Format {

    /**
     * @var string
     */
    protected $format = self::GENERAL;

    const GENERAL                 = 'General';

    const TEXT                    = '@';

    const NUMBER                  = '0';

    const NUMBER_00               = '0.00';

    const NUMBER_COMMA_SEPARATED1 = '#,##0.00';

    const NUMBER_COMMA_SEPARATED2 = '#,##0.00_-';

    const PERCENTAGE              = '0%';

    const PERCENTAGE_00           = '0.00%';

    const DATE_YYYYMMDD2          = 'yyyy-mm-dd';

    const DATE_YYYYMMDD           = 'yy-mm-dd';

    const DATE_DDMMYYYY           = 'dd/mm/yy';

    const DATE_DMYSLASH           = 'd/m/y';

    const DATE_DMYMINUS           = 'd-m-y';

    const DATE_DMMINUS            = 'd-m';

    const DATE_MYMINUS            = 'm-y';

    const DATE_XLSX14             = 'mm-dd-yy';

    const DATE_XLSX15             = 'd-mmm-yy';

    const DATE_XLSX16             = 'd-mmm';

    const DATE_XLSX17             = 'mmm-yy';

    const DATE_XLSX22             = 'm/d/yy h:mm';

    const DATE_DATETIME           = 'd/m/y h:mm';

    const DATE_TIME1              = 'h:mm AM/PM';

    const DATE_TIME2              = 'h:mm:ss AM/PM';

    const DATE_TIME3              = 'h:mm';

    const DATE_TIME4              = 'h:mm:ss';

    const DATE_TIME5              = 'mm:ss';

    const DATE_TIME6              = 'h:mm:ss';

    const DATE_TIME7              = 'i:s.S';

    const DATE_TIME8              = 'h:mm:ss;@';

    const DATE_YYYYMMDDSLASH      = 'yy/mm/dd;@';

    const CURRENCY_USD_SIMPLE     = '"$"#,##0.00_-';

    const CURRENCY_USD            = '$#,##0_-';

    const CURRENCY_EUR_SIMPLE     = '[$EUR ]#,##0.00_-';

    /**
     * @param string|null $format
     */
    public function __construct($format = null)
    {
        if ( $format )
            $this->setFormat($format);
    }

    /**
     * Set format
     *
     * @param string $format
     *
     * @throws InvalidArgumentException If format doesn't belong the format parameter list
     *
     * @return Format
     */
    public function setFormat($format)
    {
        if ( !in_array($format, $this->getFormats()) )
            throw new InvalidArgumentException("The parameter must belong to the Format parameter list");

        $this->format = $format;

        return $this;
    }

    /**
     * Get format
     *
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * Return the formats parameter list
     *
     * @return array
     */
    public function getFormats()
    {
        return [
            self::GENERAL,
            self::TEXT,
            self::NUMBER,
            self::NUMBER_00,
            self::NUMBER_COMMA_SEPARATED1,
            self::NUMBER_COMMA_SEPARATED2,
            self::PERCENTAGE,
            self::PERCENTAGE_00,
            self::DATE_YYYYMMDD2,
            self::DATE_YYYYMMDD,
            self::DATE_DDMMYYYY,
            self::DATE_DMYSLASH,
            self::DATE_DMYMINUS,
            self::DATE_DMMINUS,
            self::DATE_MYMINUS,
            self::DATE_XLSX14,
            self::DATE_XLSX15,
            self::DATE_XLSX16,
            self::DATE_XLSX17,
            self::DATE_XLSX22,
            self::DATE_DATETIME,
            self::DATE_TIME1,
            self::DATE_TIME2,
            self::DATE_TIME3,
            self::DATE_TIME4,
            self::DATE_TIME5,
            self::DATE_TIME6,
            self::DATE_TIME7,
            self::DATE_TIME8,
            self::DATE_YYYYMMDDSLASH,
            self::CURRENCY_USD_SIMPLE,
            self::CURRENCY_USD,
            self::CURRENCY_EUR_SIMPLE,
        ];
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getFormat();
    }
}