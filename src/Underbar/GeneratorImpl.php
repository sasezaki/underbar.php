<?php
/**
 * This file is part of the Underbar.php package.
 *
 * Copyright (C) 2013 Shota Nozaki <emonkak@gmail.com>
 *
 * Licensed under the MIT License
 */

namespace Underbar;

class GeneratorImpl extends AbstractImpl
{
    /**
     * @chainable
     * @see       ImplementorInterface
     * @category  Collections
     * @param     array     $xs
     * @param     callable  $f
     * @return    Generator
     */
    public static function map($xs, $f)
    {
        foreach ($xs as $i => $x) {
            yield $i => call_user_func($f, $x, $i, $xs);
        }
    }

    /**
     * @chainable
     * @see       ImplementorInterface
     * @category  Collections
     * @param     array            $xs
     * @param     callable|string  $f
     * @return    Generator
     */
    public static function sortBy($xs, $f)
    {
        return self::delay(function() use ($xs, $f) {
            return ArrayImpl::sortBy($xs, $f);
        });
    }

    /**
     * @chainable
     * @see       ImplementorInterface
     * @category  Collections
     * @param     array            $xs
     * @param     callable|string  $f
     * @return    Generator
     */
    public static function groupBy($xs, $f = null)
    {
        return self::delay(function() use ($xs, $f) {
            return ArrayImpl::groupBy($xs, $f);
        });
    }

    /**
     * @chainable
     * @see       ImplementorInterface
     * @category  Collections
     * @param     array            $xs
     * @param     callable|string  $x
     * @return    Generator
     */
    public static function countBy($xs, $f = null)
    {
        return self::delay(function() use ($xs, $f) {
            return ArrayImpl::countBy($xs, $f);
        });
    }

    /**
     * @chainable
     * @see       ImplementorInterface
     * @category  Collections
     * @param     array  $xs
     * @return    Generator
     */
    public static function shuffle($xs)
    {
        return self::delay(function() use ($xs) {
            return ArrayImpl::shuffle($xs);
        });
    }

    /**
     * @chainable
     * @see       ImplementorInterface
     * @category  Collections
     * @param     array  $xs
     * @return    IteratorImpl
     */
    public static function memoize($xs)
    {
        return IteratorImpl::memoize($xs);
    }

    /**
     * @chainable
     * @see       ImplementorInterface
     * @category  Collections
     * @param     array      $xs
     * @param     callable   $f
     * @return    Generator
     */
    public static function filter($xs, $f)
    {
        foreach ($xs as $i => $x) {
            if (call_user_func($f, $x, $i, $xs)) {
                yield $i => $x;
            }
        }
    }

    /**
     * @chainable
     * @see       ImplementorInterface
     * @category  Arrays
     * @param     array  $xs
     * @param     int    $n
     * @return    Generator
     */
    public static function firstN($xs, $n)
    {
        foreach ($xs as $i => $x) {
            if (--$n < 0) {
                break;
            }
            yield $i => $x;
        }
    }

    /**
     * @chainable
     * @see       ImplementorInterface
     * @category  Arrays
     * @param     array  $xs
     * @param     int    $n
     * @return    Iterator
     */
    public static function lastN($xs, $n)
    {
        return self::delay(function() use ($xs, $n) {
            return ArrayImpl::lastN($xs, $n);
        });
    }

    /**
     * @chainable
     * @see       ImplementorInterface
     * @category  Arrays
     * @param     array  $xs
     * @param     int    $n
     * @return    Generator
     */
    public static function initial($xs, $n = 1, $guard = null)
    {
        $queue = new \SplQueue();
        if ($guard !== null) {
            $n = 1;
        }
        foreach ($xs as $i => $x) {
            $queue->enqueue($x);
            if ($n > 0) {
                $n--;
            } else {
                yield $i => $queue->dequeue();
            }
        }
    }

    /**
     * @chainable
     * @see       ImplementorInterface
     * @category  Arrays
     * @param     array  $xs
     * @param     int    $n
     * @return    Generator
     */
    public static function rest($xs, $n = 1, $guard = null)
    {
        if ($guard !== null) {
            $n = 1;
        }
        foreach ($xs as $i => $x) {
            if ($n > 0) {
                $n--;
            } else {
                yield $i => $x;
            }
        }
    }

    /**
     * @chainable
     * @see       ImplementorInterface
     * @category  Arrays
     * @param     array     $xs
     * @param     callable  $f
     * @return    Generator
     */
    public static function takeWhile($xs, $f)
    {
        foreach ($xs as $i => $x) {
            if (!call_user_func($f, $x, $i, $xs)) {
                break;
            }
            yield $i => $x;
        }
    }

    /**
     * @chainable
     * @see       ImplementorInterface
     * @category  Arrays
     * @param     array     $xs
     * @param     callable  $f
     * @return    Generator
     */
    public static function dropWhile($xs, $f)
    {
        $accepted = false;
        foreach ($xs as $i => $x) {
            if ($accepted || ($accepted = !call_user_func($f, $x, $i, $xs))) {
                yield $i => $x;
            }
        }
    }

    /**
     * @chainable
     * @see       ImplementorInterface
     * @category  Arrays
     * @param     array    $xss
     * @param     boolean  $shallow
     * @return    Generator
     */
    public static function flatten($xss, $shallow = false)
    {
        foreach ($xss as $i => $xs) {
            if (self::isTraversable($xs)) {
                if ($shallow) {
                    foreach ($xs as $j => $x) {
                        yield $j => $x;
                    }
                } else {
                    foreach (self::flatten($xs, $shallow) as $j => $x) {
                        yield $j => $x;
                    }
                }
            } else {
                yield $i => $xs;
            }
        }
    }

    /**
     * @chainable
     * @varargs
     * @see       ImplementorInterface
     * @category  Arrays
     * @param     array  $xs
     * @param     array  *$others
     * @return    Generator
     */
    final public static function intersection($xs)
    {
        $others = [];
        foreach (array_slice(func_get_args(), 1) as $ys) {
            $others[] = self::extractIterator($ys);
        }

        $size = count($others);
        if ($size === 1) {
            $others = $others[0];
        } elseif ($size > 1) {
            $others = call_user_func_array('array_intersect', $others);
        }

        $set = new Internal\Set();
        foreach ($others as $other) {
            $set->add($other);
        }

        foreach ($xs as $k => $x) {
            if ($set->remove($x)) {
                yield $k => $x;
            }
        }
    }

    /**
     * @chainable
     * @see       ImplementorInterface
     * @category  Arrays
     * @param     array            $xs
     * @param     callable|string  $f
     * @return    Generator
     */
    public static function uniq($xs, $f = null)
    {
        $f = static::createCallback($f);
        $set = new Internal\Set();

        foreach ($xs as $k => $x) {
            if ($set->add(call_user_func($f, $x, $k, $xs))) {
                yield $k => $x;
            }
        }
    }

    /**
     * @chainable
     * @varargs
     * @see       ImplementorInterface
     * @category  Arrays
     * @param     array  $xss
     * @return    Generator
     */
    public static function unzip($xss)
    {
        $yss = $zss = array();
        $loop = true;

        foreach ($xss as $xs) {
            $yss[] = $ys = self::wrapIterator($xs);
            $ys->rewind();
            $loop = $loop && $ys->valid();
            $zss[] = $ys->current();
        }

        if (!empty($zss)) while ($loop) {
            yield $zss;
            $zss = array();
            $loop = true;
            foreach ($yss as $ys) {
                $ys->next();
                $zss[] = $ys->current();
                $loop = $loop && $ys->valid();
            }
        }
    }

    /**
     * @chainable
     * @see       ImplementorInterface
     * @category  Arrays
     * @param     array  $xs
     * @param     int    $n
     * @return    Generator
     */
    public static function cycle($xs, $n = -1)
    {
        $xs = self::memoize($xs);
        while ($n--) {
            foreach ($xs as $i => $x) {
                yield $i => $x;
            }
        }
    }

    /**
     * @chainable
     * @see       ImplementorInterface
     * @category  Arrays
     * @param     mixed  $value
     * @param     int    $n
     * @return    Generator
     */
    public static function repeat($value, $n = -1)
    {
        while ($n--) {
            yield $value;
        }
    }

    /**
     * @chainable
     * @see       ImplementorInterface
     * @category  Arrays
     * @param     mixed     $acc
     * @param     callable  $f
     * @return    Generator
     */
    public static function iterate($acc, $f)
    {
        while (true) {
            yield $acc;
            $acc = call_user_func($f, $acc);
        }
    }

    /**
     * @chainable
     * @see       ImplementorInterface
     * @category  Arrays
     * @category  Arrays
     * @param     array  $xs
     * @return    Generator
     */
    public static function reverse($xs)
    {
        return self::delay(function() use ($xs) {
            return ArrayImpl::reverse($xs);
        });
    }

    /**
     * @chainable
     * @see       ImplementorInterface
     * @category  Arrays
     * @category  Arrays
     * @param     array     $xs
     * @param     callable  $compare
     * @return    Generator
     */
    public static function sort($xs, $compare = null)
    {
        return self::delay(function() use ($xs, $compare) {
            return ArrayImpl::sort($xs, $compare);
        });
    }

    /**
     * @chainable
     * @varargs
     * @see       ImplementorInterface
     * @category  Arrays
     * @param     array  *$xss
     * @return    Generator
     */
    public static function concat()
    {
        foreach (func_get_args() as $xs) {
            foreach ($xs as $i => $x) {
                yield $i => $x;
            }
        }
    }

    /**
     * @chainable
     * @see       ImplementorInterface
     * @category  Utility
     * @param     int  $start
     * @param     int  $stop
     * @param     int  $step
     * @return    Generator
     */
    public static function range($start, $stop = null, $step = 1)
    {
        if ($stop === null) {
            $stop = $start;
            $start = 0;
        }

        $len = max(ceil(($stop - $start) / $step), 0);
        for ($i = 0; $i < $len; $i++) {
            yield $i => $start;
            $start += $step;
        }
    }

    /**
     * @param   callable  $f
     * @return  Generator
     */
    private static function delay($f)
    {
        foreach ($f() as $k => $x) {
            yield $k => $x;
        }
    }
}
