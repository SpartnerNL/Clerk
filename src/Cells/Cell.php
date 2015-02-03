<?php namespace Maatwebsite\Clerk\Cells;

use Maatwebsite\Clerk\Traits\CallableTrait;
use Maatwebsite\Clerk\Cell as CellInterface;

class Cell implements CellInterface {

    /**
     * Traits
     */
    use CallableTrait;

    /**
     * @var string|null
     */
    protected $value;

    /**
     * @var array
     */
    protected $styles = [];

    /**
     * @var Coordinate
     */
    protected $coordinate;

    /**
     * @var string
     */
    protected $dataType = self::GENERAL;

    /* Pre-defined formats */
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
     * @param string|null $value
     * @param null        $coordinate
     */
    public function __construct($value = null, $coordinate = null)
    {
        if ( $value )
            $this->setValue($value);

        if ( $coordinate )
            $this->setCoordinate($coordinate);
    }

    /**
     * @return null|string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param null|string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @param $coordinate
     */
    public function setCoordinate($coordinate)
    {
        $this->coordinate = Coordinate::fromString($coordinate);
    }

    /**
     * @return Coordinate
     */
    public function getCoordinate()
    {
        return $this->coordinate;
    }

    /**
     * @param array $styles
     * @return $this
     */
    public function setStyles(array $styles)
    {
        $this->styles = $styles;

        return $this;
    }

    /**
     * @return array
     */
    public function getStyles()
    {
        return $this->styles;
    }

    /**
     * @return bool
     */
    public function hasStyles()
    {
        return empty($this->styles) ? false : true;
    }

    /**
     * @return string
     */
    public function getDataType()
    {
        return $this->dataType;
    }

    /**
     * @param string $dataType
     */
    public function setDataType($dataType)
    {
        $this->dataType = $dataType;
    }

    /**
     * Format as string
     * @param null $value
     * @return $this
     */
    public function asString($value = null)
    {
        if ( $value )
            $this->setValue($value);

        $this->setDataType(self::TEXT);

        return $this;
    }

    /**
     * @param $format
     * @return $this
     */
    public function format($format)
    {
        $this->setDataType($format);

        return $this;
    }

    /**
     * @param $method
     * @param $params
     */
    public function __call($method, $params)
    {
        if ( starts_with($method, 'as') )
        {
            $method = str_replace('as', '', $method);
            $method = strtoupper(snake_case($method));

            if ( defined("self::$method") )
            {
                $format = constant("self::$method");

                return $this->setDataType($format);
            }
        }
    }
}