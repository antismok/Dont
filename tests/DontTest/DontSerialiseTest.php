<?php

declare(strict_types=1);

namespace DontTest;

use Dont\Exception\NonSerialisableObject;
use Dont\DontSerialise;
use DontTestAsset\DontDoIt;
use DontTestAsset\NotSerialisable;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Dont\DontSerialise
 */
final class DontSerialiseTest extends TestCase
{
    /**
     * @dataProvider nonSerialisableObject
     *
     * @param object $object
     */
    public function testWillThrowOnSerialisationAttempt($object) : void
    {
        $this->expectException(NonSerialisableObject::class);

        serialize($object);
    }

    /**
     * @return object[]
     */
    public function nonSerialisableObject() : array
    {
        return [
            [new NotSerialisable()],
            [new DontDoIt()],
        ];
    }

    public function testSerialisePreventionIsFinal() : void
    {
        self::assertTrue((new \ReflectionMethod(DontSerialise::class, '__sleep'))->isFinal());
    }
}
