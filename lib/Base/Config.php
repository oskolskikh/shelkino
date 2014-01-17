<?php

namespace Base;
use ArrayAccess;
use Countable;
use Iterator;

Class Config implements Countable, Iterator, ArrayAccess
{

    protected $count;
    protected $data = array();
    protected $skipNextIteration;
    
    public function __construct(array $array) {


        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $this->data[$key] = new static($value);
            } else {
                $this->data[$key] = $value;
            }
            $this->count++;
        }
        return $this;
    }

    public function get($name, $default = null) {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }

        return $default;
    }

    public function __get($name) {
        return $this->get($name);
    }

    public function __set($name, $value) {

        if (is_array($value)) {
            $value = new static($value, true);
        }

        if (null === $name) {
            $this->data[] = $value;
        } else {
            $this->data[$name] = $value;
        }

        $this->count++;
    }
    
    public function __isset($name)
    {
        return isset($this->data[$name]);
    }
    
    public function __clone()
    {
        $array = array();

        foreach ($this->data as $key => $value) {
            if ($value instanceof self) {
                $array[$key] = clone $value;
            } else {
                $array[$key] = $value;
            }
        }

        $this->data = $array;
    }
    
    public function toArray()
    {
        $array = array();
        $data  = $this->data;

        /** @var self $value */
        foreach ($data as $key => $value) {
            if ($value instanceof self) {
                $array[$key] = $value->toArray();
            } else {
                $array[$key] = $value;
            }
        }

        return $array;
    }
    public function __unset($name)
    {
        unset($this->data[$name]);
        $this->count--;
        $this->skipNextIteration = true;
    }
    
    public function count()
    {
        return $this->count;
    }
    
    public function current()
    {
        $this->skipNextIteration = false;
        return current($this->data);
    }
    
    public function key()
    {
        return key($this->data);
    }
    
    public function next()
    {
        if ($this->skipNextIteration) {
            $this->skipNextIteration = false;
            return;
        }

        next($this->data);
    }
    
    public function rewind()
    {
        $this->skipNextIteration = false;
        reset($this->data);
    }
    
    public function valid()
    {
        return ($this->key() !== null);
    }

    public function offsetExists($offset)
    {
        return $this->__isset($offset);
    }
    
    public function offsetGet($offset)
    {
        return $this->__get($offset);
    }
    
    public function offsetSet($offset, $value)
    {
        $this->__set($offset, $value);
    }
    
    public function offsetUnset($offset)
    {
        $this->__unset($offset);
    }
}
