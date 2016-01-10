<?php
namespace Tests\Exceptions\InvalidArgumentException;

use Xqddd\Exceptions\InvalidArgumentException;

class ConstructTest extends \PHPUnit_Framework_TestCase
{

    /**
     * When called with string values will store the values
     */
    public function testWhenCalledWithStringValuesWillStoreTheValues()
    {
        $argumentName = 'argument';
        $expected = 'expected';
        $actual = 'actual';

        $InvalidArgumentException = new InvalidArgumentException($argumentName, $expected, $actual);

        static::assertSame(
            $argumentName,
            \PHPUnit_Framework_Assert::readAttribute($InvalidArgumentException, 'argumentName')
        );
        static::assertSame(
            $expected,
            \PHPUnit_Framework_Assert::readAttribute($InvalidArgumentException, 'expected')
        );
        static::assertSame(
            $actual,
            \PHPUnit_Framework_Assert::readAttribute($InvalidArgumentException, 'actual')
        );
    }

    /**
     * When called with non-string values will store the values json encoded
     * @dataProvider nonStringValues
     * @param mixed $argumentName
     * @param mixed $expected
     * @param mixed $actual
     */
    public function testWhenCalledWithNonStringValuesWillStoreTheValuesJsonEncoded($argumentName, $expected, $actual)
    {
        $InvalidArgumentException = new InvalidArgumentException($argumentName, $expected, $actual);

        static::assertSame(
            json_encode($argumentName),
            \PHPUnit_Framework_Assert::readAttribute($InvalidArgumentException, 'argumentName')
        );
        static::assertSame(
            json_encode($expected),
            \PHPUnit_Framework_Assert::readAttribute($InvalidArgumentException, 'expected')
        );
        static::assertSame(
            json_encode($actual),
            \PHPUnit_Framework_Assert::readAttribute($InvalidArgumentException, 'actual')
        );
    }

    public function nonStringValues()
    {
        /**
         * An array of ints
         * @var array
         */
        $intReturn = [123, 456, 789];

        $object1 = new \stdClass();
        $object1->test = 123;
        $object2 = new \stdClass();
        $object2->wow = 456;
        $object3 = new \stdClass();
        $object3->bla = 789;
        /**
         * An array of objects
         * @var array
         */
        $objectReturn = [$object1, $object2, $object3];

        /**
         * An array of mixed values
         * @var array
         */
        $mixedReturn = [123, $object2, $objectReturn];

        return [
            $intReturn,
            $objectReturn,
            $mixedReturn
        ];
    }

}
