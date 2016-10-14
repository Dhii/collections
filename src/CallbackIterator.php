<?php

namespace Dhii\Collection;

/**
 * A default implementation of a callback iterator.
 *
 * Can have values of any type, and of different types.
 *
 * @since [*next-version*]
 */
class CallbackIterator extends AbstractGenericCallbackIterator
{
    /**
     * @since [*next-version*]
     *
     * @param mixed[]|\Traversable $items    A list of items to iterate over.
     * @param callable             $callback
     */
    public function __construct($items, $callback)
    {
        $this->_setItems($items);
        $this->_setCallback($callback);
    }
}
