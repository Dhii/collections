<?php

namespace Dhii\Collection;

/**
 * Common public functionality for callback iterators.
 * 
 * @since [*next-version*]
 */
abstract class AbstractGenericCallbackIterator extends AbstractCallbackIterator implements CallbackIteratorInterface
{
    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function getCallback()
    {
        return $this->_getCallback();
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    protected function _validateItem($item)
    {
        // No exception means valid
    }
}
