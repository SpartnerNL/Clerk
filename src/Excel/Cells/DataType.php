<?php

namespace Maatwebsite\Clerk\Excel\Cells;

use Maatwebsite\Clerk\Exceptions\InvalidArgumentException;

class DataType
{
    /**
     * @var string
     */
    protected $type = self::STRING;

    const STRING2    = 'str';

    const STRING     = 's';

    const FORMULA    = 'f';

    const NUMERIC    = 'n';

    const NUMERIC_00 = 'nd';

    const BOOL       = 'b';

    const NULL       = 'null';

    const INLINE     = 'inlineStr';

    const ERROR      = 'e';

    const PERCENT    = 'p';

    const PERCENT_00 = 'pd';

    const DATETIME   = 'dt';

    const DATE       = 'd';

    /**
     * @param string|null $type
     */
    public function __construct($type = null)
    {
        if ($type) {
            $this->setType($type);
        }
    }

    /**
     * @param string $type
     *
     * @throws InvalidArgumentException
     *
     * @return $this
     */
    public function setType($type)
    {
        if (!in_array($type, $this->getDataTypes())) {
            throw new InvalidArgumentException('The parameter must belong to the Data Type parameter list');
        }

        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Return the types parameter list.
     *
     * @return array
     */
    public function getDataTypes()
    {
        return [
            self::STRING2,
            self::STRING,
            self::FORMULA,
            self::NUMERIC,
            self::NUMERIC_00,
            self::BOOL,
            self::NULL,
            self::INLINE,
            self::ERROR,
            self::PERCENT,
            self::DATETIME,
            self::DATE,
            self::PERCENT_00,
        ];
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getType();
    }
}
