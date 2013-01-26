<?php

namespace Understrike;

abstract class Strict
{
    /**
     * Iterates over a list of elements, yielding each in turn to an iterator
     * function.
     *
     * @param   array|Traversable  $list
     * @param   callable           $iterator
     * @return  void
     */
    public static function each($list, $iterator)
    {
        foreach ($list as $index => $value)
            call_user_func($iterator, $value, $index, $list);
    }

    /**
     * Produces a new array of values by mapping each value in list through a
     * transformation function (iterator).
     *
     * Alias: collect
     *
     * @param   array|Traversable  $list
     * @param   callable           $iterator
     * @return  Iterator
     */
    public static function map($list, $iterator)
    {
        $result = array();

        foreach ($list as $index => $value)
            $result[$index] = call_user_func($iterator, $value, $index, $list);

        return $result;
    }

    public static function collect($list, $iterator)
    {
        return static::map($list, $iterator);
    }

    /**
     * @param   array|Traversable  $list
     * @param   callable           $iterator
     * @return  Iterator
     */
    public static function mapWithKey($list, $iterator)
    {
        $result = array();

        foreach ($list as $index => $value) {
            list ($key, $val) = call_user_func($iterator, $value, $index, $list);
            $result[$key] = $val;
        }

        return $result;
    }

    /**
     * Also known as inject and foldl, reduce boils down a list of values into a
     * single value.
     *
     * Alias: inject, foldl
     *
     * @param   array|Traversable  $list
     * @param   callable           $iterator
     * @param   mixed              $memo
     * @return  mixed
     */
    public static function reduce($list, $iterator, $memo)
    {
        foreach ($list as $index => $value)
            $memo = call_user_func($iterator, $memo, $value, $index, $list);

        return $memo;
    }

    public static function inject($list, $iterator, $memo)
    {
        return static::reduce($list, $iterator, $memo);
    }

    public static function foldl($list, $iterator, $memo)
    {
        return static::reduce($list, $iterator, $memo);
    }

    /**
     * The right-associative version of reduce.
     *
     * Alias: foldr
     *
     * @param   array|Traversable  $list
     * @param   callable           $iterator
     * @param   mixed              $memo
     * @return  mixed
     */
    public static function reduceRight($list, $iterator, $memo)
    {
        foreach (static::reverse($list) as $index => $value)
            $memo = call_user_func($iterator, $memo, $value, $index, $list);

        return $memo;
    }

    public static function foldr($list, $iterator, $memo)
    {
        return static::reduceRight($list, $iterator, $memo);
    }

    /**
     * Looks through each value in the list, returning the first one that passes
     * a truth test (iterator).
     *
     * Alias: detect
     *
     * @param   array|Traversable  $list
     * @param   callable           $iterator
     * @return  mixed
     */
    public static function find($list, $iterator)
    {
        foreach ($list as $index => $value) {
            if (call_user_func($iterator, $value, $index, $list))
                return $value;
        }
    }

    public static function findSafe($list, $iterator)
    {
        return Option::fromValue(static::find($list, $iterator));
    }

    public static function detect($list, $iterator)
    {
        return static::find($list, $iterator);
    }

    public static function detectSafe($list, $iterator)
    {
        return Option::fromValue(static::find($list, $iterator));
    }

    /**
     * Looks through each value in the list, returning an array of all the
     * values that pass a truth test (iterator).
     *
     * Alias: select
     *
     * @param   array|Traversable  $list
     * @param   callable           $iterator
     * @return  Iterator
     */
    public static function filter($list, $iterator)
    {
        $result = array();

        foreach ($list as $index => $value) {
            if (call_user_func($iterator, $value, $index, $list))
                $result[$index] = $value;
        }

        return $result;
    }

    public static function select($list, $iterator)
    {
        return static::filter($list, $iterator);
    }

    /**
     * Looks through each value in the list, returning an array of all the
     * values that contain all of the key-value pairs listed in properties.
     *
     * @param   array|Traversable  $list
     * @param   array              $properties
     * @return  boolean
     */
    public static function where($list, array $properties)
    {
        return static::filter($list, function($value) use ($properties) {
            foreach ($properties as $propKey => $propValue) {
                if (!((isset($value->$propKey) && $value->$propKey === $propValue)
                      || (isset($value[$propKey]) && $value[$propKey] === $propValue)))
                    return false;
            }
            return true;
        });
    }

    /**
     * Returns the values in list without the elements that the truth test
     * (iterator) passes. The opposite of filter.
     *
     * @param   array|Traversable  $list
     * @param   callable           $iterator
     * @return  Iterator
     */
    public static function reject($list, $iterator)
    {
        return static::filter($list, function($value, $index, $list) use ($iterator) {
            return !call_user_func($iterator, $value, $index, $list);
        });
    }

    /**
     * Returns true if all of the values in the list pass the iterator truth
     * test.
     *
     * Alias: all
     *
     * @param   array|Traversable  $list
     * @param   callable           $iterator
     * @return  boolean
     */
    public static function every($list, $iterator = null)
    {
        $result = true;
        if (!is_callable($iterator))
            $iterator = get_called_class().'::identity';

        foreach ($list as $index => $value) {
            if (!($result = call_user_func($iterator, $value, $index, $list)))
                break;
        }

        return !!$result;
    }

    public static function all($list, $iterator = null)
    {
        return static::every($list, $iterator);
    }

    /**
     * Returns true if any of the values in the list pass the iterator truth test.
     *
     * Alias: any
     *
     * @param   array|Traversable  $list
     * @param   callable           $iterator
     * @return  boolean
     */
    public static function some($list, $iterator = null)
    {
        $result = false;
        if (!is_callable($iterator))
            $iterator = get_called_class().'::identity';

        foreach ($list as $index => $value) {
            if ($result = call_user_func($iterator, $value, $index, $list))
                break;
        }

        return !!$result;
    }

    public static function any($list, $iterator = null)
    {
        return static::some($list, $iterator);
    }

    /**
     * Returns true if the value is present in the list.
     *
     * @param   array|Traversable  $list
     * @param   mixed              $target
     * @return  boolean
     */
    public static function contains($list, $target)
    {
        foreach ($list as $value) {
            if ($value === $target) return true;
        }

        return false;
    }

    /**
     * Calls the method named by methodName on each value in the list.
     *
     * @param   array|Traversable  $list
     * @param   string             $methodName
     * @param   miexed             *$arguments
     * @return  Iterator
     */
    public static function invoke($list, $methodName)
    {
        $args = array_slice(func_get_args(), 2);

        return static::map($list, function($value) use ($methodName, $args) {
            return call_user_func_array(array($value, $methodName), $args);
        });
    }

    /**
     * A convenient version of what is perhaps the most common use-case for map:
     * extracting a list of property values.
     *
     * @param   array|Traversable  $list
     * @param   string             $propertyName
     * @return  Iterator
     */
    public static function pluck($list, $propertyName)
    {
        return static::map($list, function($value) use ($propertyName) {
            if (is_array($value) && isset($value[$propertyName]))
                return $value[$propertyName];
            elseif (is_object($value) && isset($value->$propertyName))
                return $value->$propertyName;
            else
                return null;
        });
    }

    /**
     * Returns the maximum value in list. If iterator is passed, it will be used
     * on each value to generate the criterion by which the value is ranked.
     *
     * @param   array|Traversable  $list
     * @param   callable           $iterator
     * @return  mixed
     */
    public static function max($list, $iterator = null)
    {
        if (!$iterator) {
            $array = static::toArray($list);
            return empty($array) ? -INF : max($array);
        }

        $result = array('computed' => -INF, 'value' => -INF);

        foreach ($list as $index => $value) {
            $computed = call_user_func($iterator, $value, $index, $list);
            if ($computed > $result['computed']) {
                $result['computed'] = $computed;
                $result['value'] = $value;
            }
        }

        return $result['value'];
    }

    /**
     * Returns the minimum value in list. If iterator is passed, it will be used
     * on each value to generate the criterion by which the value is ranked.
     *
     * @param   array|Traversable  $list
     * @param   callable           $iterator
     * @return  mixed
     */
    public static function min($list, $iterator = null)
    {
        if (!$iterator) {
            $array = static::toArray($list);
            return empty($array) ? INF : min($array);
        }

        $result = array('computed' => INF, 'value' => INF);
        foreach ($list as $index => $value) {
            $computed = call_user_func($iterator, $value, $index, $list);
            if ($computed < $result['computed']) {
                $result['computed'] = $computed;
                $result['value'] = $value;
            }
        }

        return $result['value'];
    }

    /**
     * Returns a sorted copy of list, ranked in ascending order by the results
     * of running each value through iterator.
     *
     * @param   array|Traversable  $list
     * @param   callable|string    $value
     * @return  Iterator
     */
    public static function sortBy($list, $value)
    {
        $iterator = static::_lookupIterator($value);
        $result = array();

        foreach ($list as $index => $value) {
            $result[] = array(
                'value' => $value,
                'index' => $index,
                'criteria' => call_user_func($iterator, $value, $index, $list),
            );
        }

        usort($result, function($left, $right) {
            $a = $left['criteria'];
            $b = $right['criteria'];
            if ($a !== $b)
                return ($a < $b) ? -1 : 1;
            else
                return $left['index'] < $right['index'] ? -1 : 1;
        });

        return static::pluck($result, 'value');
    }

    /**
     * Returns a sorted copy of list, ranked in ascending order by the results of
     * running each value through iterator.
     *
     * @param   array|Traversable  $list
     * @param   callable|string    $value
     * @return  array
     */
    public static function groupBy($list, $value)
    {
        $iterator = static::_lookupIterator($value);
        $result = array();

        foreach ($list as $index => $value) {
            $key = call_user_func($iterator, $value, $index, $list);
            $result[$key][] = $value;
        }

        return $result;
    }

    /**
     * Sorts a list into groups and returns a count for the number of objects in
     * each group. Similar to groupBy, but instead of returning a list of values,
     * returns a count for the number of values in that group.
     *
     * @param   array|Traversable  $list
     * @param   callable|string    $value
     * @return  int
     */
    public static function countBy($list, $value)
    {
        $iterator = static::_lookupIterator($value);
        $result = array();

        foreach ($list as $index => $value) {
            $key = call_user_func($iterator, $value, $index, $list);
            if (!isset($result[$key])) $result[$key] = 0;
            $result[$key]++;
        }

        return $result;
    }

    /**
     * Returns a shuffled copy of the list.
     *
     * @param   array|Traversable  $list
     * @return  array
     */
    public static function shuffle($list)
    {
        $result = static::toArray($list);
        shuffle($result);
        return $result;
    }

    /**
     * Converts the list (anything that can be iterated over), into a real
     * Array.
     *
     * @param   array|Traversable  $list
     * @param   boolean            $useKeys
     * @return  array
     */
    public static function toArray($list, $useKeys = false)
    {
        if (is_array($list))
            return $useKeys ? $list : array_values($list);
        elseif ($list instanceof \Generator)
            return iterator_to_array(clone $list, $useKeys);
        elseif ($list instanceof \Traversable)
            return iterator_to_array($list, $useKeys);
        else
            return array();
    }

    /**
     * Return the number of values in the list.
     *
     * @param   array|Countable|Traversable  $list
     * @return  int
     */
    public static function size($list)
    {
        if ($list instanceof \Countable) return count($list);
        if ($list instanceof \Traversable) return iterator_count($list);
        return count($list);
    }

    /**
     * Returns the first element of an array.
     * Passing n will return the first n elements of the array.
     *
     * Alias: head, take
     *
     * @param   array|Traversable  $array
     * @param   int                $n
     * @return  mixed|Iterator
     */
    public static function first($array, $n = null, $guard = null)
    {
        if (is_int($n) && $guard === null)
            return $n > 0 ? array_slice(static::toArray($array), 0, $n) : array();
        else
            foreach ($array as $value) return $value;
    }

    public static function firstSafe($array, $n = null, $guard = null)
    {
        return Option::fromValue(static::first($array, $n, $guard));
    }

    public static function head($array, $n = null, $guard = null)
    {
        return static::first($array, $n, $guard);
    }

    public static function headSafe($array, $n = null, $guard)
    {
        return Option::fromValue(static::first($array, $n, $guard));
    }

    public static function take($array, $n = null, $guard = null)
    {
        return static::first($array, $n, $guard);
    }

    public static function takeSafe($array, $n = null, $guard)
    {
        return Option::fromValue(static::first($array, $n, $guard));
    }

    /**
     * Returns everything but the last entry of the array.
     *
     * @param   array|Traversable  $array
     * @param   int                $n
     * @return  array
     */
    public static function initial($array, $n = 1, $guard = null)
    {
        if ($guard !== null) $n = 1;
        return $n > 0
            ? array_slice(static::toArray($array), 0, -$n)
            : array();
    }

    /**
     * Returns the last element of an array.
     *
     * @param   array|Traversable  $array
     * @param   int                $n
     * @return  array|mixed
     */
    public static function last($array, $n = null, $guard = null)
    {
        $array = static::toArray($array);
        if (is_int($n) && $guard === null)
            return $n > 0 ? array_slice($array, -$n) : array();
        else
            return empty($array) ? null : end($array);
    }

    public static function lastSafe($array, $n = null, $guard)
    {
        return Option::fromValue(static::last($array, $n, $guard));
    }

    /**
     * Returns the rest of the elements in an array.
     *
     * Alias: tail, drop
     *
     * @param   array|Traversable  $array
     * @param   int                $index
     * @return  Iterator
     */
    public static function rest($array, $index = 1, $guard = null)
    {
        return array_slice(static::toArray($array), ($guard === null ? $index : 1));
    }

    public static function tail($array, $index = 1, $guard = null)
    {
        return self::rest($array, $index, $guard);
    }

    public static function drop($array, $index = 1, $guard = null)
    {
        return self::rest($array, $index, $guard);
    }

    /**
     * Returns a copy of the array with all falsy values removed.
     *
     * @param   array|Traversable  $array
     * @return  Iterator
     */
    public static function compact($array)
    {
        return static::filter($array, get_called_class().'::identity');
    }

    /**
     * Flattens a nested array (the nesting can be to any depth).
     *
     * @param   array|Traversable  $array
     * @param   boolean            $shallow
     * @return  Iterator
     */
    public static function flatten($array, $shallow = false)
    {
        return static::_flatten($array, $shallow);
    }

    private static function _flatten($array, $shallow, &$output = array())
    {
        foreach ($array as $key => $value) {
            if (is_array($value) || $value instanceof \Traversable) {
                if ($shallow)
                    foreach ($value as $childValue) $output[] = $childValue;
                else
                    static::_flatten($value, $shallow, $output);
            } else {
                $output[] = $value;
            }
        }
        return $output;
    }

    /**
     * Returns a copy of the array with all instances of the values removed.
     *
     * @param   array|Traversable  $array
     * @param   mixed              *$values
     * @return  Iterator
     */
    public static function without($array)
    {
        return static::difference($array, array_slice(func_get_args(), 1));
    }

    /**
     * Computes the union of the passed-in arrays: the list of unique items,
     * in order, that are present in one or more of the arrays.
     *
     * @param   array|Traversable  *$arrays
     * @return  Iterator
     */
    public static function union()
    {
        return static::uniq(call_user_func_array(
            get_called_class().'::concat',
            func_get_args())
        );
    }

    /**
     * Computes the list of values that are the intersection of all the arrays.
     *
     * @param   array|Traversable  $array
     * @param   array|Traversable  *$rest
     * @return  array
     */
    public static function intersection()
    {
        $arrays = array_map(get_called_class().'::toArray', func_get_args());
        return call_user_func_array('array_intersect', $arrays);
    }

    /**
     * Similar to without, but returns the values from array that are not present
     * in the other arrays.
     *
     * @param   array|Traversable  $array
     * @param   array              *$others
     * @return  Iterator
     */
    public static function difference($array)
    {
        $rest = array_slice(func_get_args(), 1);
        return static::filter($array, function($value) use ($rest) {
            foreach ($rest as $others) {
                if (in_array($value, $others, true))
                    return false;
            }
            return true;
        });
    }

    /**
     * Produce a duplicate-free version of the array.
     *
     * Alias: unique
     *
     * @param   array|Traversable  $array
     * @param   callable           $iterator
     * @return  Iterator
     */
    public static function uniq($array, $iterator = null)
    {
        $seenScalar = $seenOthers = array();
        $seenObjects = new \SplObjectStorage();
        return static::filter($array, function($value, $index, $list) use (
            $iterator,
            &$seenScalar,
            &$seenObjects,
            &$seenOthers
        ) {
            $value = $iterator ? call_user_func($iterator, $value, $index, $list) : $value;
            if ($result = is_scalar($value) && array_key_exists($value, $seenScalar))
                $seenScalar[$value] = 0;
            elseif ($result = is_object($value) && !$seenObjects->contains($value))
                $seenOthers->attach($value);
            elseif ($result = !in_array($value, $seenOthers, true))
                $seenOthers[] = $value;
            return $result;
        });
    }

    public static function unique($array, $iterator = null)
    {
        return static::uniq($array);
    }

    /**
     * Merges together the values of each of the arrays with the values at the
     * corresponding position.
     *
     * @param   array|Traversable  *$arrays
     * @return  Iterator
     */
    public static function zip()
    {
        $arrays = array_map(get_called_class().'::_wrapIterator', func_get_args());
        $result = array();
        $available = false;

        foreach ($arrays as $array) {
            $array->rewind();
            $available = $available || $array->valid();
        }

        while ($available) {
            $available = false;
            foreach ($arrays as $array) {
                $result[] = $array->current();
                $array->next();
                $available = $available || $array->valid();
            }
        }

        return $result;
    }

    /**
     * Converts arrays into objects.
     *
     * @param   array|Traversable  $list
     * @param   array|Traversable  $values
     * @return  Iterator
     */
    public static function object($list, $values = null)
    {
        $values = static::_wrapIterator($values);
        return static::mapWithKey($list, function($value) use ($values) {
            if ($values) {
                if ($values->valid()) {
                    $val = $values->current();
                    $values->next();
                } else {
                    $val = null;
                };
                return array($value, $val);
            } else {
                return $value;
            }
        });
    }

    /**
     * Returns the index at which value can be found in the array, or -1 if
     * value is not present in the array.
     *
     * @param   array|Traversable  $array
     * @param   mixed              $value
     * @param   boolean|int        $isSorted
     * @return  int
     */
    public static function indexOf($array, $value, $isSorted = 0)
    {
        $array = static::toArray($array);
        $i = 0;
        $l = count($array);

        if ($isSorted) {
            if (is_int($isSorted)) {
                $i = ($isSorted < 0) ? max(0, $l + $isSorted) : $isSorted;
            } else {
                $i = static::sortedIndex($array, $value);
                return (isset($array[$i]) && $array[$i] === $value) ? $i : -1;
            }
        }

        for (; $i < $l; $i++) {
            if (isset($array[$i]) && $array[$i] === $value)
                return $i;
        }

        return -1;
    }

    /**
     * Returns the index of the last occurrence of value in the array, or -1 if
     * value is not present.
     *
     * @param   array|Traversable  $array
     * @param   mixed              $value
     * @param   int                $fromIndex
     * @return  int
     */
    public static function lastIndexOf($array, $value, $fromIndex = null)
    {
        $array = static::toArray($array);
        $l = count($array);
        $i = is_int($fromIndex) ? min($l, $fromIndex) : $l;

        while ($i-- > 0) {
            if (isset($array[$i]) && $array[$i] === $value) return $i;
        }

        return -1;
    }

    /**
     * Returns the index at which value can be found in the array, or -1 if
     * value is not present in the array.
     *
     * @param   array|Traversable  $list
     * @param   mixed              $values
     * @param   callable           $iterator
     * @return  int
     */
    public static function sortedIndex($list, $value, $iterator = null)
    {
        $array = static::toArray($list);
        $iterator = static::_lookupIterator($iterator);
        $value = call_user_func($iterator, $value);

        $low = 0;
        $high = count($array);

        while ($low < $high) {
            $mid = ($low + $high) >> 1;
            if (call_user_func($iterator, $array[$mid]) < $value)
                $low = $mid + 1;
            else
                $high = $mid;
        }

        return $low;
    }

    /**
     * A function to create flexibly-numbered lists of integers,
     * handy for each and map loops.
     *
     * @param   int       $start
     * @param   int       $stop
     * @param   int       $step
     * @return  Iterator
     */
    public static function range($start, $stop = null, $step = 1)
    {
        if ($stop === null) {
            $stop = $start;
            $start = 0;
        }

        $len = max(ceil(($stop - $start) / $step), 0);
        $range = array();

        for ($i = 0; $i < $len; $i++) {
            $range[] = $start;
            $start += $step;
        }

        return $range;
    }

    /**
     * Reverses the order of the elements of an array -- the first becomes the
     * last, and the last becomes the first.
     *
     * @param   array|Traversable  $array
     * @return  array
     */
    public static function reverse($array)
    {
        return array_reverse(static::toArray($array, true), true);
    }

    /**
     * Removes the last element from an array and returns that element.
     *
     * @param   array|Traversable  $array
     * @return  array
     */
    public static function sort($array)
    {
        $array = static::toArray($array);
        sort($array);
        return $array;
    }

    /**
     * Returns a new array comprised of this array joined with other array(s)
     * and/or value(s).
     *
     * @param   array|Traversable  *$arrays
     * @return  array
     */
    public static function concat()
    {
        return call_user_func_array(
            'array_merge',
            array_map(get_called_class().'::toArray', func_get_args())
        );
    }

    /**
     * Joins all elements of an array into a string.
     *
     * @param   array|Traversable  $array
     * @param   string             $separator
     * @return  string
     */
    public static function join($array, $separator = ',')
    {
        return implode($separator, static::toArray($array));
    }

    /**
     * Returns a shallow copy of a portion of an array.
     *
     * @param   array|Traversable  $array
     * @param   int                $begin
     * @param   int                $end
     * @return  Iterator
     */
    public static function slice($array, $begin, $end = -1)
    {
        return array_slice(static::toArray($array), $begin, $end);
    }

    /**
     * Retrieve all the names of the object's properties.
     *
     * @param   array|Traversable  $object
     * @return  Iterator
     */
    public static function keys($object)
    {
        $i = 0;
        return static::mapWithKey($object, function($value, $key) use (&$i) {
            return array($i++, $key);
        });
    }

    /**
     * Return all of the values of the object's properties.
     *
     * @param   array|Traversable  $object
     * @return  Iterator
     */
    public static function values($object)
    {
        $i = 0;
        return static::mapWithKey($object, function($value) use (&$i) {
            return array($i++, $value);
        });
    }

    /**
     * Convert an object into a list of [key, value] pairs.
     *
     * @param   array|Traversable  $object
     * @return  Iterator
     */
    public static function pairs($object)
    {
        return static::map($object, function($value, $key) {
            return array($key, $value);
        });
    }

    /**
     * Returns a copy of the object where the keys have become the values and the
     * values the keys.
     *
     * @param   array|Traversable  $object
     * @return  Iterator
     */
    public static function invert($object)
    {
        return static::mapWithKey($object, function($value, $key) {
            return array($value, $key);
        });
    }

    /**
     * Copy all of the properties in the source objects over to the destination
     * object, and return the destination object.
     *
     * @param   array|Traversable  $destination
     * @param   array|Traversable  *$sources
     * @return  Iterator
     */
    public static function extend()
    {
        $objects = array();

        foreach (func_get_args() as $object)
            $objects[] = static::toArray($object, true);

        return call_user_func_array('array_merge', $objects);
    }

    /**
     * Return a copy of the object, filtered to only have values for the
     * whitelisted keys (or array of valid keys).
     *
     * @param   array|Traversable  $object
     * @param   string             *$keys
     * @return  array
     */
    public static function pick($object)
    {
        $array = static::toArray($object, true);
        $keys = array_slice(func_get_args(), 1);
        $result = array();
        foreach ($keys as $key) $result[$key] = $array[$key];
        return $result;
    }

    /**
     * Return a copy of the object, filtered to omit the blacklisted keys
     * (or array of keys).
     *
     * @param   array|Traversable  $object
     * @param   string             *$keys
     * @return  array
     */
    public static function omit($object)
    {
        $array = static::toArray($object, true);
        $keys = array_slice(func_get_args(), 1);
        foreach ($keys as $key) unset($array[$key]);
        return $array;
    }

    /**
     * Copy all of the properties in the source objects over to the destination
     * object, and return the destination object.
     *
     * @param   array|Traversable  $object
     * @param   array|Traversable  *$defaults
     * @return  array
     */
    public static function defaults($object)
    {
        foreach (array_slice(func_get_args(), 1) as $default)
            $objects[] = static::toArray($default, true);

        $objects[] = static::toArray($object, true);

        return call_user_func_array('array_merge', $objects);
    }

    /**
     * Invokes interceptor with the object, and then returns object.
     *
     * @param   array|Traversable  $object
     * @param   callable           $interceptor
     * @return  array|object
     */
    public static function tap($object, $interceptor)
    {
        call_user_func($interceptor, $object);
        return $object;
    }

    /**
     * Create a shallow-copied clone of the object. Any nested objects or arrays
     * will be copied by reference, not duplicated.
     *
     * @param    mixed  $object
     * @return   mixed
     */
    public static function duplicate($object)
    {
        return is_object($object) ? clone $object : $object;
    }

    /**
     * Does the object contain the given key?
     *
     * @param   array|Traversable  $object
     * @param   int|string         $key
     * @return  boolean
     */
    public static function has($object, $key)
    {
        return array_key_exists(static::toArray($object, true), $key);
    }

    /**
     * Returns the same value that is used as the argument.
     *
     * @param   mixed  $value
     * @return  mixed
     */
    public static function identity($value)
    {
        return $value;
    }

    /**
     * Returns a wrapped object. Calling methods on this object will continue to
     * return wrapped objects until value is used.
     *
     * @param   mixed  $value
     * @return  Internal\Chain
     */
    public static function chain($value)
    {
        return new Internal\Chain($value, get_called_class());
    }

    /**
     * @param   mixed  $value
     * @return  Internal\Wrapper
     */
    public static function wrap($value)
    {
        return new Internal\Wrapper($value, get_called_class());
    }

    protected static function _lookupIterator($value)
    {
        if (is_callable($value))
            return $value;
        elseif (is_scalar($value))
            return function($obj) use ($value) {
                return is_array($obj) ? $obj[$value] : $obj->$value;
            };
        else
            return get_called_class().'::identity';
    }

    protected static function _wrapIterator($list)
    {
        if (is_array($list))
            return new \ArrayIterator($list);
        elseif ($list instanceof \Iterator)
            return new \IteratorIterator($list);
        else
            return $list;
    }
}

// __END__
// vim: expandtab softtabstop=4 shiftwidth=4