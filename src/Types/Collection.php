<?php

declare(strict_types=1);

namespace MakeSpace\Types;

use ArrayIterator;
use Countable;
use IteratorAggregate;
use function Lambdish\phunctional\each;

abstract class Collection implements Countable, IteratorAggregate
{
    /**
     * @var array
     */
    protected $items;

    public function __construct(array $items)
    {
        Assert::arrayOf($this->type(), $items);

        $this->items = $items;
    }

    abstract protected function type(): string;

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->items());
    }

    public function count(): int
    {
        return count($this->items());
    }

    protected function each(callable $fn): void
    {
        each($fn, $this->items());
    }

    public function items(): array
    {
        return $this->items;
    }
}
