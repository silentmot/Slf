<?php

namespace Tests;

use ArrayKeysCaseTransform\ArrayKeys;
use ArrayKeysCaseTransform\Transformer\AbstractTransformer;
use PHPUnit\Framework\TestCase;

class ArrayKeysTest extends TestCase
{

    public function testToSnakeCaseCallShouldWork() : void
    {
        ArrayKeys::toSnakeCase([]);

        $this->assertTrue(true);
    }

    public function testToCamelCaseCallShouldWork() : void
    {
        ArrayKeys::toCamelCase([]);

        $this->assertTrue(true);
    }

    public function testTransformCallShouldWork() : void
    {
        $converter = new class extends AbstractTransformer {
            protected function format(string $key): string
            {
                return $key;
            }
        };

        ArrayKeys::transform($converter, []);

        $this->assertTrue(true);
    }
}
