<?php

namespace Dhii\Collection\FuncTest;

use Dhii\Collection;

/**
 * Tests {@see Collection\SequentialIterator}
 *
 * @since [*next-version*]
 */
class SequentialIteratorTest extends \Xpmock\TestCase
{
    /**
     * Creates a new instance of the test subject.
     * 
     * @since [*next-version*]
     * 
     * @return Collection\SequentialIterator The new test subject instance.
     */
    public function createInstance($items)
    {
        $mock = $this->mock('Dhii\\Collection\\SequentialIterator')
                ->new($items);
        
        return $mock;
    }
    
    /**
     * Tests whether a valid instance of the test subject can be created.
     * 
     * @since [*next-version*]
     */
    public function testCanBeCreated()
    {
        $subject = $this->createInstance(array());
        
        $this->assertInstanceOf('Dhii\\Collection\\SequentialIteratorInterface', $subject, 'Subect is not a valid sequential iterator');
    }

    /**
     * Tests whether the iterator will iterate over items in inner iterators correctly.
     *
     * @since [*next-version*]
     */
    public function testSequentialIteration()
    {
        $items1 = array('apple', 'banana');
        $items2 = array('one', 'two');

        $subject = $this->createInstance(array(new \ArrayIterator($items1), new \ArrayIterator($items2)));
        
        $expected = array_merge($items1, $items2);
        $allItems = iterator_to_array($subject, false);
        $this->assertEquals($expected, $allItems, 'Iterating over all items did not produce correct result');
    }

    /**
     * Tests whether the iterator will iterate over inner iterators correctly.
     *
     * @since [*next-version*]
     */
    public function testInnerIteration()
    {
        $items1 = array('apple', 'banana');
        $items1 = new \ArrayIterator($items1);
        $items2 = array('one', 'two');
        $items2 = new \ArrayIterator($items2);
        
        $subject = $this->createInstance(array($items1, $items2));

        $expected = array($items1, $items2);
        $allItems = $subject->getIterators();
        $this->assertSame($expected, $allItems, 'Iterating over inner iterators did not produce correct result');
    }
}
