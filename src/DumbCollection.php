<?php

namespace Dhii\Collection;

/**
 * A collection that cannot do anything, except determine whether it contains an item.
 *
 * @since [*next-version*]
 */
class DumbCollection extends AbstractGenericCollection implements CollectionInterface
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
}
