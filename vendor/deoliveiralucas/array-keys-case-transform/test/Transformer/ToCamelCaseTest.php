<?php

namespace Tests\ArrayKeysCaseTransform\Transformer;

use ArrayKeysCaseTransform\Transformer\ToCamelCase;
use PHPUnit\Framework\TestCase;

class ToCamelCaseTest extends TestCase
{

    public function testTransformShouldWork() : void
    {
        $arrayToBeTested = [
            'first_item'  => 'First Item',
            'second item' => 'Second Item',
            'third-item'  => 'Third Item',
            'fourthItem'  => 'Fourth Item',
        ];

        $arrayExpected = [
            'firstItem'  => 'First Item',
            'secondItem' => 'Second Item',
            'thirdItem'  => 'Third Item',
            'fourthItem' => 'Fourth Item',
        ];

        $result = (new ToCamelCase())->transform($arrayToBeTested);

        $this->assertEquals($arrayExpected, $result);
    }
}
