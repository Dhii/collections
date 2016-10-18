<?php

namespace Dhii\Collection;

/**
 * Common functionality for general purpose collections.
 *
 * @since [*next-version*]
 */
abstract class AbstractGenericCollection extends AbstractSearchableCollection implements CollectionInterface
{
    /**
     * @since [*next-version*]
     *
     * @param mixed[]|\Traversable $items The items to populate this collection with.
     */
    public function __construct($items = null)
    {
        $this->_construct();

        if (!is_null($items)) {
            $this->_addItems($items);
        }
    }

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
