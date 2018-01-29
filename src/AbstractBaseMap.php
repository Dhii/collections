<?php

namespace Dhii\Collection;

use Dhii\Exception\CreateOutOfRangeExceptionCapableTrait;
use Dhii\Iterator\CreateIterationCapableTrait;
use Dhii\Iterator\CreateIteratorExceptionCapableTrait;
use Dhii\Iterator\IterationAwareTrait;
use Dhii\Iterator\IteratorInterface;
use Dhii\Iterator\IteratorTrait;
use Dhii\Iterator\ResolveIteratorCapableTrait;
use Dhii\Util\Normalization\NormalizeIntCapableTrait;
use Exception as RootException;

abstract class AbstractBaseMap extends AbstractBaseContainer implements
    IteratorInterface,
    MapInterface
{
    /* Basic Dhii iterator functionality.
     *
     * @since [*next-version*]
     */
    use IteratorTrait;

    /* Awareness of an iteration.
     *
     * @since [*next-version*]
     */
    use IterationAwareTrait;

    /* Awareness of an iterator.
     *
     * @since [*next-version*]
     */
    use IteratorAwareTrait;

    /* Ability to resolve an iterator.
     *
     * @since [*next-version*]
     */
    use ResolveIteratorCapableTrait;

    /* Factory of iterations.
     *
     * @since [*next-version*]
     */
    use CreateIterationCapableTrait;

    /* Factory of Iterator exceptions.
     *
     * @since [*next-version*]
     */
    use CreateIteratorExceptionCapableTrait;

    /* Factory of Out of Range exceptions.
     *
     * @since [*next-version*]
     */
    use CreateOutOfRangeExceptionCapableTrait;

    /* Ability to normalize integers.
     *
     * @since [*next-version*]
     */
    use NormalizeIntCapableTrait;

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function key()
    {
        return $this->_key();
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function current()
    {
        return $this->_value();
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function next()
    {
        $this->_next();
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function valid()
    {
        return $this->_valid();
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function rewind()
    {
        $iterator = $this->_getIterator();
        $iterator->rewind();
        $this->_setIteration($this->_createIteration($iterator->key(), $iterator->current()));
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function getIteration()
    {
        return $this->_getIteration();
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    protected function _loop()
    {
        $iterator = $this->_getIterator();

        if (!$iterator->valid()) {
            return $this->_createIteration(null, null);
        }

        $iterator->next();
        $iteration = $this->_createIteration($iterator->key(), $iterator->current());

        return $iteration;
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    protected function _reset()
    {
        return $this->_createIteration(null, null);
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    protected function _throwIteratorException(
        $message = null,
        $code = null,
        RootException $previous = null
    ) {
        throw $this->_createIteratorException($message, $code, $previous, $this);
    }
}