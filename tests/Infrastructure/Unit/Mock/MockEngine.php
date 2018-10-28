<?php

declare(strict_types=1);

namespace MakeSpace\Tests\Infrastructure\Types\Stub;

use Mockery;

final class MockEngine
{
    private $mockEngine;

    public function __construct()
    {
        $this->mockEngine = new Mockery();
    }

    public function mock(...$args)
    {
        return $this->mockEngine->mock(...$args);
    }

    public function close()
    {
        $this->mockEngine->close();
    }
}
