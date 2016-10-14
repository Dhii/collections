<?php

namespace Dhii\Collection\FuncTest;

use Dhii\Collection;

/**
 * Tests {@see Collection\CallbackIterator}.
 *
 * @since [*next-version*]
 */
class CallbackIteratorTest extends \Xpmock\TestCase
{
    /**
     * Creates a new instance of the test subject.
     *
     * @since [*next-version*]
     *
     * @param mixed[]|\Traversable $items The items, over which to iterate.
     * @param callable $callback The callback to apply to each item on iteration.
     *
     * @return Collection\CallbackIterator The new test subject instance.
     */
    public function createInstance($items, $callback)
    {
        $mock = $this->mock('Dhii\Collection\CallbackIterator')
                ->new($items, $callback);

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

        $this->assertInstanceOf('Dhii\Collection\CallbackIteratorInterface', $subject, 'Subject is not a valid callback iterator');
    }

    /**
     * Tests whether iteration and callback application happen correctly.
     *
     * @since [*next-version*]
     */
    public function testIteration()
    {
        $me = $this;
        $iterations = 0;
        $data = array('apple', 'banana', 'strawberry');
        $callback = function($key, $item, &$isContinue) use (&$iterations, $data, $me) {
            $iterations++;
            if ($iterations === 2) {
                // This tests whether breaking out of the loop works from the callback
                $isContinue = false;
            }

            $me->assertContains($item, $data, 'The current item is not in the collection');
        };
        $subject = $this->createInstance($data, $callback);

        foreach ($subject as $_item) {
            // Callback only runs on each iteration.
        }

        $this->assertEquals(2, $iterations, 'The callback has not been invoked the required number of times');
    }
}
