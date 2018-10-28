<?php

declare(strict_types=1);

namespace MakeSpace\Tests\Infrastructure\Types\Stub;

use PHPUnit\Framework\TestCase;
use MakeSpace\Tests\Infrastructure\Unit\Mock\MockEngine;

abstract class UnitTestCase extends TestCase
{
    private $mockEngine;

    public function mockEngine()
    {
        return $this->mockEngine ?: new MockEngine();
    }

    protected function tearDown(): void
    {
        $this->mockEngine()->close();

        parent::tearDown();
    }
}
