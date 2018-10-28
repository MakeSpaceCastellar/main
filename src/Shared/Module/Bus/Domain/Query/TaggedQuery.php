<?php

declare(strict_types=1);

namespace MakeSpace\Shared\Module\Bus\Domain\Query;

abstract class TaggedQuery implements Query
{
    private $tags = [];

    protected function addTag(string $context, ?string $value = null)
    {
        if ($value) {
            $this->tags[] = sprintf('%s=%s', $context, $value);
        } else {
            $this->tags[] = $context;
        }
    }

    public function tags(): array
    {
        return array_filter($this->tags);
    }
}
