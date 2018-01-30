<?php

namespace Dhii\Collection;

use ArrayObject;
use Dhii\I18n\StringTranslatingTrait;
use stdClass;
use Traversable;

/**
 * An iterable, countable, readable list that can also be checked.
 *
 * @since [*next-version*]
 */
class CountableMap extends AbstractBaseCountableMap
{
    /*
     * @since [*next-version*]
     */
    use StringTranslatingTrait;

    /**
     * @since [*next-version*]
     *
     * @param ArrayObject|array|stdClass|Traversable $elements The elements of the map.
     */
    public function __construct($elements)
    {
        if ($elements instanceof ArrayObject) {
            $this->_setDataStore($elements);
        } elseif ($elements instanceof Traversable) {
            $this->_setMany($elements);
        } elseif (is_array($elements) || $elements instanceof stdClass) {
            $this->_setDataStore($this->_createDataStore($elements));
        } else {
            throw $this->_createInvalidArgumentException(
                $this->__('Invalid element list'),
                null,
                null,
                $elements
            );
        }

        $this->_construct();
    }
}
