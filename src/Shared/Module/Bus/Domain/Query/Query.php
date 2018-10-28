<?php

declare(strict_types=1);

namespace MakeSpace\Shared\Module\Bus\Domain\Query;

use \MakeSpace\Shared\Module\Bus\Domain\Request;

interface Query extends Request
{
    public function tags(): array;
}
