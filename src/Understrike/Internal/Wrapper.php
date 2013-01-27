<?php

namespace Understrike\Internal;

final class Wrapper implements \Countable, \IteratorAggregate
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
        $result = call_user_func_array($this->class.'::'.$name, $aruguments);
        if ($result instanceof \Traversable || is_array($result)) {
            $this->value = $result;
            return $this;
        } else {
            return $result;
        }
    }

    public function value()
    {
        return $this->value;
    }

    public function count()
    {
        return call_user_func($this->class.'::size', $this->value);
    }

    public function toArray($preserveKeys = false)
    {
        return call_user_func($this->class.'::toArray', $this->value, $preserveKeys);
    }

    public function getIterator()
    {
        if ($this->value instanceof \Traversable)
            return $this->value;
        else
            return new \ArrayIterator((array) $this->value);
    }
}

// __END__
// vim: expandtab softtabstop=4 shiftwidth=4
