<?php

namespace Underbar\Internal;

class Wrapper implements \ArrayAccess, \Countable, \IteratorAggregate
{
    private $value;

    private $class;

    public function __construct($value, $class)
    {
        $this->value = $value;
        $this->class = $class;
    }

    public function __call($name, $aruguments)
    {
        array_unshift($aruguments, $this->value);
        $value = call_user_func_array($this->class.'::'.$name, $aruguments);
        return new static($value, $this->class);
    }

    public function value()
    {
        return $this->value;
    }

    public function strict()
    {
        $this->class = 'Underbar\\Strict';
        return $this;
    }

    public function lazy()
    {
        $this->class = 'Underbar\\Lazy';
        return $this;
    }

    public function count()
    {
        return call_user_func($this->class.'::size', $this->value);
    }

    public function getIterator()
    {
        if ($this->value instanceof \Traversable) {
            return $this->value;
        } else {
            return new \ArrayIterator((array) $this->value);
        }
    }

    public function offsetExists($offset)
    {
        return call_user_func(
            $this->class.'::get',
            $this->value,
            $offset
        ) !== null;
    }

    public function offsetGet($offset)
    {
        return call_user_func(
            $this->class.'::get',
            $this->value,
            $offset
        );
    }

    public function offsetSet($offset, $value)
    {
        throw new \BadMethodCallException('Not implemented');
    }

    public function offsetUnset($offset)
    {
        throw new \BadMethodCallException('Not implemented');
    }
}

// __END__
// vim: expandtab softtabstop=4 shiftwidth=4
