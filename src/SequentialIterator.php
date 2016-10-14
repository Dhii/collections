<?php

namespace Dhii\Collection;

/**
 * A standards-compliant implementation similar to {@see \AppendIterator} that
 * does not promise to be writable.
 *
 * @since [*next-version*]
 */
class SequentialIterator extends AbstractGenericSequentialIterator implements SequentialIteratorInterface
{
    /**
     * @since [*next-version*]
     * 
     * @param \Traversable[]|\Traversable $iterators A list of iterators to add to this instance.
     */
    public function __construct($iterators = null)
    {
        $this->_construct();
        
        if (!is_null($iterators)) {
            $this->_addItems($iterators);
        }
    }
}
