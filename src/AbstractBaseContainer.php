<?php

namespace Dhii\Collection;

use Dhii\Data\Container\ContainerInterface;
use Dhii\Data\Container\CreateNotFoundExceptionCapableTrait;
use Dhii\Data\Object\GetDataCapableTrait;
use Dhii\Data\Object\HasDataCapableTrait;
use Dhii\Data\Object\NormalizeKeyCapableTrait;
use Dhii\Exception\CreateInvalidArgumentExceptionCapableTrait;
use Dhii\Util\Normalization\NormalizeStringCapableTrait;
use Exception as RootException;

/**
 * Abstract base functionality of a container.
 *
 * @since [*next-version*]
 */
abstract class AbstractBaseContainer implements ContainerInterface
{
    /* Ability to check for data member.
     *
     * @since [*next-version*]
     */
    use HasDataCapableTrait;

    /* Ability to retrieve a data member.
     *
     * @since [*next-version*]
     */
    use GetDataCapableTrait;

    /* Ability to normalize a data key.
     *
     * @since [*next-version*]
     */
    use NormalizeKeyCapableTrait;

    /* Ability to normalize a string.
     *
     * @since [*next-version*]
     */
    use NormalizeStringCapableTrait;

    /* Factory of Invalid Argument exceptions.
     *
     * @since [*next-version*]
     */
    use CreateInvalidArgumentExceptionCapableTrait;

    /* Factory of Not Found exceptions.
     *
     * @since [*next-version*]
     */
    use CreateNotFoundExceptionCapableTrait;

    /**
     * Parameter-less constructor.
     *
     * This is run after the instance has been initialized.
     */
    protected function _construct()
    {
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function get($id)
    {
        return $this->_getData($id);
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function has($key)
    {
        return $this->_hasData($key);
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    protected function _throwNotFoundException(
        $message = null,
        $code = null,
        RootException $previous = null,
        ContainerInterface $container = null,
        $dataKey = null
    ) {
        throw $this->_createNotFoundException($message, $code, $previous, $this, $dataKey);
    }
}
