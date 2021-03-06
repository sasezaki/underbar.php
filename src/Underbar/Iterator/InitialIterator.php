<?php
/**
 * This file is part of the Underbar.php package.
 *
 * Copyright (C) 2013 Shota Nozaki <emonkak@gmail.com>
 *
 * Licensed under the MIT License
 */

namespace Underbar\Iterator;

class InitialIterator implements \Iterator
{
    private $it;
    private $n;
    private $queue;
    private $current;

    public function __construct(\Iterator $it, $n)
    {
        $this->it = $it;
        $this->n = $n;
        $this->queue = new \SplQueue();
    }

    public function current()
    {
        return $this->current;
    }

    public function key()
    {
        return $this->it->key();
    }

    public function next()
    {
        $this->it->next();
        $this->queue->enqueue($this->it->current());
        $this->current = $this->queue->dequeue();
    }

    public function rewind()
    {
        $this->it->rewind();

        $n = $this->n;
        while ($this->it->valid()) {
            $this->queue->enqueue($this->it->current());
            if (--$n < 0) {
                break;
            }
            $this->it->next();
        }

        if (!$this->queue->isEmpty()) {
            $this->current = $this->queue->dequeue();
        }
    }

    public function valid()
    {
        return $this->it->valid();
    }
}
