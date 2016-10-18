<?php

namespace Dhii\Collection;

/**
 * Common functionality for general purpose collections.
 *
 * Implements {@see CollectionInterface}.
 *
 * @since [*next-version*]
 */
abstract class AbstractGenericCollection extends AbstractSearchableCollection
{
    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function contains($item)
    {
        return $this->_hasItem($item);
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    protected function _validateItem($item)
    {
        // Nothing thrown means valid
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    protected function _createCallbackIterator($callback, $items)
    {
        return new CallbackIterator($items, $callback);
    }
}
