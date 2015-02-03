<?php namespace Maatwebsite\Clerk\Excel\Collections;

/**
 * Class CellCollection
 * @package Maatwebsite\Clerk\Collections
 */
class CellCollection extends ExcelCollection {

    /**
     * Create a new collection.
     * @param  array $items
     */
    public function __construct(array $items = array())
    {
        $this->setItems($items);
    }

    /**
     * Set the items
     * @param array $items
     * @return void
     */
    public function setItems($items)
    {
        foreach ($items as $name => $value)
        {
            $value = !empty($value) || is_numeric($value) ? $value : null;
            if ( $name && !is_numeric($name) )
            {
                $this->put($name, $value);
            }
            else
            {
                $this->push($value);
            }
        }
    }

    /**
     * Dynamically get values
     * @param  string $key
     * @return string
     */
    public function __get($key)
    {
        if ( $this->has($key) )
            return $this->get($key);
    }

    /**
     * Determine if an attribute exists on the model.
     *
     * @param  string $key
     * @return bool
     */
    public function __isset($key)
    {
        return $this->has($key);
    }
}