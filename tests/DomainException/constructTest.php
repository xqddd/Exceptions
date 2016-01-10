<?php
namespace Tests\Exceptions\DomainException;

use Xqddd\Exceptions\DomainException;

class ConstructTest extends \PHPUnit_Framework_TestCase
{

    /**
     * When called with string values will store the values
     */
    public function testWhenCalledWithStringValuesWillStoreTheValues()
    {
        $providedValue = 'value';
        $currentDomain = 'domain';

        $DomainException = new DomainException($providedValue, $currentDomain);

        static::assertSame(
            $providedValue,
            \PHPUnit_Framework_Assert::readAttribute($DomainException, 'providedValue')
        );
        static::assertSame(
            $currentDomain,
            \PHPUnit_Framework_Assert::readAttribute($DomainException, 'currentDomain')
        );
    }

    /**
     * When called with non-string values will store the values json encoded
     * @dataProvider nonStringValues
     * @param mixed $providedValue
     * @param mixed $currentDomain
     */
    public function testWhenCalledWithNonStringValuesWillStoreTheValuesJsonEncoded($providedValue, $currentDomain)
    {
        $DomainException = new DomainException($providedValue, $currentDomain);

        static::assertSame(
            json_encode($providedValue),
            \PHPUnit_Framework_Assert::readAttribute($DomainException, 'providedValue')
        );
        static::assertSame(
            json_encode($currentDomain),
            \PHPUnit_Framework_Assert::readAttribute($DomainException, 'currentDomain')
        );
    }

    public function nonStringValues()
    {
        /**
         * An array of ints
         * @var array
         */
        $intReturn = [123, 456];

        $object1 = new \stdClass();
        $object1->test = 123;
        $object2 = new \stdClass();
        $object2->wow = 456;
        /**
         * An array of objects
         * @var array
         */
        $objectReturn = [$object1, $object2];

        /**
         * An array of mixed values
         * @var array
         */
        $mixedReturn = [123, $object2];

        return [
            $intReturn,
            $objectReturn,
            $mixedReturn
        ];
    }

}
