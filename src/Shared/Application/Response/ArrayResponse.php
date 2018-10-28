<?php

declare(strict_types=1);

namespace MakeSpace\Shared\Application\Response;

use MakeSpace\Shared\Module\Bus\Domain\Query\Response;
use MakeSpace\Types\ValueObject\ArrayValueObject;

final class ArrayResponse extends ArrayValueObject implements Response
{
}
