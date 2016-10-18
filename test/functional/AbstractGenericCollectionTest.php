<?php

namespace Dhii\Collection\FuncTest;

use Dhii\Collection;

/**
 * Tests {@see Collection\AbstractGenericCollection}.
 *
 * @since [*next-version*]
 */
class AbstractGenericCollectionTest extends \Xpmock\TestCase
{
    /**
     * Creates a new instance of the test subject.
     *
     * @since [*next-version*]
     *
     * @return \Dhii\Collection\AbstractGenericCollection The new instance of the test subject.
     */
    public function createInstance($items = array())
    {
        $mock = $this->mock('Dhii\\Collection\\AbstractGenericCollection')
                ->new($items);

        return $mock;
    }

    /**
     * Tests that a correct instance of the test subject can be created.
     *
     * @since [*next-version*]
     */
    public function testCanBeCreated()
    {
        $subject = $this->createInstance();

        $this->assertInstanceOf('Dhii\\Collection\\CollectionInterface', $subject, 'Subject is not a valid collection');
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
