<?php

declare(strict_types=1);

namespace MakeSpace\Shared\Module\Cache\Domain;

interface CacheKey
{
    public function value();
    public function __toString();
}
