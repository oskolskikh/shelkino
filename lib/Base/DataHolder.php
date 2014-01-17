<?php

namespace Base;

/*
 * @package JTS
 */

class DataHolder
{
    /**
     * @var array
     */
    private $data = array();

    /**
     * Clears all data
     */
    public function clear()
    {
        $this->data = array();
    }

    public function set($name, $value)
    {
        $this->data[$name] = $value;
    }

    /**
     * Returns a value
     *
     * @param  string $name Data key
     * @param  mixed  $default Default data value
     * @return mixed Data value or default value
     */
    public function get($name, $default = NULL)
    {
        if (array_key_exists($name, $this->data))
        {
            $default = $this->data[$name];
        }

        return $default;
    }

    public function has($name)
    {
        return array_key_exists($name, $this->data);
    }

    /**
     * Adds new data
     *
     * @param array $data New data
     */
    public function add(Array $data)
    {
        foreach ($data as $key => $value)
        {
            $this->data[$key] = $value;
        }
    }

    public function remove($name)
    {
        if ($this->has($name))
        {
            unset($this->data[$name]);
        }
    }

    public function getAll()
    {
        return $this->data;
    }
}