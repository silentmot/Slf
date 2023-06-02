<?php

namespace Tests\ArrayKeysCaseTransform\Transformer;

use ArrayKeysCaseTransform\Transformer\ToSnakeCase;
use PHPUnit\Framework\TestCase;

class ToSnakeCaseTest extends TestCase
{

    public function testTransformShouldWork() : void
    {
        $arrayToBeTested = [
            'firstItem'   => 'First Item',
            'second item' => 'Second Item',
            'third-item'  => 'Third Item',
            'fourth_item' => 'Fourth Item',
        ];

        $arrayExpected = [
            'first_item'  => 'First Item',
            'second_item' => 'Second Item',
            'third_item'  => 'Third Item',
            'fourth_item' => 'Fourth Item',
        ];

        $result = (new ToSnakeCase())->transform($arrayToBeTested);

        $this->assertEquals($arrayExpected, $result);
    }
}
