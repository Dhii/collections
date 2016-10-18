<?php

namespace Dhii\Collection\FuncTest;

use Dhii\Collection;

/**
 * Tests {@see Collection\DumbCollection}.
 *
 * @since [*next-version*]
 */
class DumbCollectionTest extends \Xpmock\TestCase
{
    /**
     * Creates a new instance of the test subject.
     *
     * @since [*next-version*]
     *
     * @param mixed[]|\Traversable $items The items for the collection
     *
     * @return Collection\DumbCollection The new test subject instance.
     */
    public function createInstance($items)
    {
        $mock = $this->mock('Dhii\Collection\DumbCollection')
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
        $subject = $this->createInstance(array(), 'is_null');

        $this->assertInstanceOf('Dhii\Collection\CollectionInterface', $subject, 'Subject is not a valid collection');
    }

    /**
     * Tests that the collection can correctly determine whether it contains an element.
     *
     * @since [*next-version*]
     */
    public function testContains()
    {
        $existingItem1 = 'apple';
        $existingItem2 = 'apple';
        $nonExistingItem = 'orange';
        $items = array($existingItem1, $existingItem2);
        $subject = $this->createInstance($items);

        $this->assertTrue($subject->contains($existingItem1), 'Subject reported that it does not contain an existing item');
        $this->assertTrue($subject->contains($existingItem2), 'Subject reported that it does not contain an existing item');
        $this->assertFalse($subject->contains($nonExistingItem), 'Subject reported that it contains a non-existing item');
    }
}
