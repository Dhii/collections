# Dhii - Collections

[![Build Status](https://travis-ci.org/dhii/collections.svg?branch=develop)](https://travis-ci.org/dhii/collections)
[![Code Climate](https://codeclimate.com/github/Dhii/collections/badges/gpa.svg)](https://codeclimate.com/github/Dhii/collections)
[![Test Coverage](https://codeclimate.com/github/Dhii/collections/badges/coverage.svg)](https://codeclimate.com/github/Dhii/collections/coverage)
[![Latest Stable Version](https://poser.pugx.org/dhii/collections/version)](https://packagist.org/packages/dhii/collections)
[![This package complies with Dhii standards](https://img.shields.io/badge/Dhii-Compliant-green.svg?style=flat-square)][Dhii]

Collection implementations.

## Classes

### Concrete
- [`CountableMap`][CountableMap] - A countable [PSR-11][PSR-11] container and [Dhii iterator][dhii/iterator-interface]
in one. Initialize with `array`, `object`, or any [`Traversable`][Traversable]. Pass an [`ArrayObject`][ArrayObject]
to use that as data store, and avoid initialization-time traversing. Uses include:

    * A key-value map. Being PSR-11-compliant ensures your value container is interoperable. Being also a
    [Dhii container][dhii/data-container-interface] means that it provides extra flexibility and interoperability.
    * A list. It is a valid [`Iterator`][Iterator], making it iterable. It's also a Dhii iterator, meaning it provides
    every [iteration][IterationInterface] as an immutable [key-value pair][KeyValueAwareInterface].
    * Countable. While [any iterable can be counted][CountIterableCapableTrait], [`count()`][Countable#count()]
    implementation allows for optimisation and caching.
    
    One of the biggest advantages of this class is that it follows [ISP][ISP] very closely, implementing a lot of the
    [collection interfaces][dhii/collections-interface], so it is at the same time a map, a set, and a list. This means
    that you can make consuming logic depend only on the interface that it requires, and pass this versatile map to it.
    This allows you to keep your data in one place, and avoid duplicating it just to comply with a narrow-type consumer.
    
### Abstract
- [`AbstractBaseContainer`][AbstractBaseContainer] - Simple retrieval of values from a container.
- [`AbstractBaseMap`][AbstractBaseMap] - Iteration over the container values.
- [`AbstractBaseCountableMap`][AbstractBaseCountableMap] - Counting of container values.

### Traits
- [`IteratorAwareTrait`][IteratorAwareTrait] - Awareness of an inner iterator, which by default comes from the data store.
    

[Dhii]:                                 https://github.com/Dhii/dhii
[PSR-11]:                               https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-11-container.md
[ISP]:                                  https://en.wikipedia.org/wiki/Interface_segregation_principle

[dhii/iterator-interface]:              https://packagist.org/packages/dhii/iterator-interface
[dhii/data-container-interface]:        https://packagist.org/packages/dhii/data-container-interface
[dhii/collections-interface]:           https://packagist.org/packages/dhii/collections-interface

[CountableMap]:                         src/CountableMap.php
[AbstractBaseContainer]:                src/AbstractBaseContainer.php
[AbstractBaseMap]:                      src/AbstractBaseMap.php
[AbstractBaseCountableMap]:             src/AbstractBaseCountableMap.php
[IteratorAwareTrait]:                   src/IteratorAwareTrait.php

[IterationInterface]:                   https://github.com/Dhii/iterator-interface/blob/develop/src/IterationInterface.php
[KeyValueAwareInterface]:               https://github.com/Dhii/data-key-value-aware-interface/blob/develop/src/KeyValueAwareInterface.php
[CountIterableCapableTrait]:            https://github.com/Dhii/iterator-helper-base/blob/develop/src/CountIterableCapableTrait.php

[Traversable]:                          http://php.net/manual/en/class.traversable.php
[ArrayObject]:                          http://php.net/manual/en/class.arrayobject.php
[Iterator]:                             http://php.net/manual/en/class.iterator.php
[Countable#count()]:                    http://php.net/manual/en/countable.count.php
