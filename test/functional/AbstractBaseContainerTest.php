<?php

namespace Dhii\Collection\FuncTest;

use ArrayObject;
use Xpmock\TestCase;
use Dhii\Collection\AbstractBaseContainer as TestSubject;
use PHPUnit_Framework_MockObject_MockObject as MockObject;
use Exception as RootException;

/**
 * Tests {@see TestSubject}.
 *
 * @since [*next-version*]
 */
class AbstractBaseContainerTest extends TestCase
{
    /**
     * The name of the test subject.
     *
     * @since [*next-version*]
     */
    const TEST_SUBJECT_CLASSNAME = 'Dhii\Collection\AbstractBaseContainer';

    /**
     * Creates a new instance of the test subject.
     *
     * @since [*next-version*]
     *
     * @param array|null $methods The methods to mock.
     *
     * @return TestSubject|MockObject The new instance.
     */
    public function createInstance($methods = [], $constructorArgs = [], $disableOriginalConstructor = false)
    {
        is_array($methods) && $methods = $this->mergeValues($methods, [
            '__',
        ]);

        $builder = $this->getMockBuilder(static::TEST_SUBJECT_CLASSNAME)
            ->setMethods($methods)
            ->setConstructorArgs($constructorArgs);
        $disableOriginalConstructor && $builder->disableOriginalConstructor();
        $mock = $builder->getMock();

        $mock->method('__')
            ->will($this->returnArgument(0));

        return $mock;
    }

    /**
     * Merges the values of two arrays.
     *
     * The resulting product will be a numeric array where the values of both inputs are present, without duplicates.
     *
     * @since [*next-version*]
     *
     * @param array $destination The base array.
     * @param array $source      The array with more keys.
     *
     * @return array The array which contains unique values
     */
    public function mergeValues($destination, $source)
    {
        return array_keys(array_merge(array_flip($destination), array_flip($source)));
    }

    /**
     * Creates a mock that both extends a class and implements interfaces.
     *
     * This is particularly useful for cases where the mock is based on an
     * internal class, such as in the case with exceptions. Helps to avoid
     * writing hard-coded stubs.
     *
     * @since [*next-version*]
     *
     * @param string $className      Name of the class for the mock to extend.
     * @param string $interfaceNames Names of the interfaces for the mock to implement.
     *
     * @return object The object that extends and implements the specified class and interfaces.
     */
    public function mockClassAndInterfaces($className, $interfaceNames = [])
    {
        $paddingClassName = uniqid($className);
        $definition = vsprintf('abstract class %1$s extends %2$s implements %3$s {}', [
            $paddingClassName,
            $className,
            implode(', ', $interfaceNames),
        ]);
        eval($definition);

        return $this->getMockForAbstractClass($paddingClassName);
    }

    /**
     * Creates a new exception.
     *
     * @since [*next-version*]
     *
     * @param string $message The exception message.
     *
     * @return RootException The new exception.
     */
    public function createException($message = '')
    {
        $mock = $this->getMockBuilder('Exception')
            ->setConstructorArgs([$message])
            ->getMock();

        return $mock;
    }

    /**
     * Creates a new store mock.
     *
     * @since [*next-version*]
     *
     * @param array      $data    The data for the store.
     * @param array|null $methods Names of methods to mock.
     *
     * @return ArrayObject|MockObject The new store mock.
     */
    public function createStore($data = [], $methods = [])
    {
        is_array($methods) && $methods = $this->mergeValues($methods, [
        ]);

        $builder = $this->getMockBuilder('ArrayObject')
                ->setConstructorArgs([$data]);
        $builder->setMethods($methods);
        $mock = $builder->getMock();

        return $mock;
    }

    /**
     * Tests whether a valid instance of the test subject can be created.
     *
     * @see https://bugs.php.net/bug.php?id=61943
     * @since [*next-version*]
     */
    public function testCanBeCreated()
    {
        $subject = $this->createInstance([
            '_getDataStore',
            '_normalizeKey',
            '_throwNotFoundException',
        ], [], true);

        $this->assertInstanceOf(
            static::TEST_SUBJECT_CLASSNAME,
            $subject,
            'A valid instance of the test subject could not be created.'
        );
        $this->assertInstanceOf(
            'Psr\Container\ContainerInterface',
            $subject,
            'Subject does not implement required interface'
        );
    }

    /**
     * Tests whether container functionality works as expected.
     *
     * @since [*next-version*]
     */
    public function testContainer()
    {
        $keys = [uniqid('key'), uniqid('key')];
        $randomKey = uniqid();
        $values = [uniqid('val'), uniqid('val')];
        $data = array_combine($keys, $values);
        $store = $this->createStore($data, null);
        $subject = $this->createInstance(['_getDataStore', '_normalizeKey'], [], true);
        $_subject = $this->reflect($subject);

        $subject->method('_getDataStore')
                ->will($this->returnValue($store));
        $subject->expects($this->exactly(5))
                ->method('_normalizeKey')
                ->withConsecutive(
                    [$keys[0]],
                    [$keys[1]],
                    [$keys[0]],
                    [$keys[1]],
                    [$randomKey]
                )
                ->will($this->returnArgument(0));

        $has1 = $subject->has($keys[0]);
        $this->assertTrue($has1, 'Subject did not recognize that it has the first key');
        $has2 = $subject->has($keys[1]);
        $this->assertTrue($has2, 'Subject did not recognize that it has the second key');

        $result1 = $subject->get($keys[0]);
        $this->assertEquals($values[0], $result1, 'Subject did not correctly determine the value of the first key');

        $result2 = $subject->get($keys[1]);
        $this->assertEquals($values[1], $result2, 'Subject did not correctly determine the value of the second key');

        $this->assertFalse($subject->has($randomKey), 'Subject incorrectly determined having a random non-existing key');
    }
}
