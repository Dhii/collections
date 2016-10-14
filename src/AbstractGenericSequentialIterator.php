<?php

namespace Dhii\Collection;

/**
 * Common public functionality for append iterators.
 *
 * @since [*next-version*]
 */
class AbstractGenericSequentialIterator extends AbstractIteratorCollection implements SequentialIteratorInterface
{
    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function getIterators()
    {
        return $this->_getIterators();
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function getIteratorIndex()
    {
        return $this->_getIteratorIndex();
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function getInnerIterator()
    {
        return $this->_getInnerIterator();
    }
}
