<?php

declare(strict_types=1);

namespace MakeSpace\Shared\Module\Cache\Domain;

use MakeSpace\Shared\Module\Bus\Domain\Query\Query;
use MakeSpace\Types\ValueObject\StringValueObject;
use ReflectionClass;
use function Lambdish\Phunctional\each;

final class QueryCacheKey extends StringValueObject implements CacheKey
{
    private const KEY_PREFIX = 'query';

    public function __construct(string $queryHash, string $contentHash, ?string $tags = null)
    {
        self::guard($queryHash, $contentHash);

        parent::__construct(sprintf('%s-%s-%s-%s', self::KEY_PREFIX, $queryHash, $contentHash, $tags));
    }

    private static function guard(string $queryHash, string $contentHash)
    {
        each(
            function ($hash) {
                if (!ctype_xdigit($hash)) {
                    throw new \InvalidArgumentException(
                        sprintf('<%s> must be a string with hexadecimal characters.', $hash)
                    );
                }
            },
            [$queryHash, $contentHash]
        );
    }

    public static function fromQuery(Query $query): self
    {
        return new self(self::buildQueryHash($query), self::buildQueryContentHash($query), self::buildQueryTags($query));
    }

    private static function buildQueryHash(Query $query): string
    {
        return substr(md5(get_class($query)), 0, 8);
    }

    private static function buildQueryContentHash(Query $query): string
    {
        return md5(json_encode(['_attrs' => self::getProperties($query), '_class' => get_class($query)]));
    }

    private static function buildQueryTags(Query $query): string
    {
        return implode(',', $query->tags());
    }

    private static function getProperties(Query $query): array
    {
        $result = [];

        $reflectionClass = new ReflectionClass($query);
        foreach ($reflectionClass->getProperties() as $reflectionProperty) {
            $reflectionProperty->setAccessible(true);
            $result[$reflectionProperty->name] = $reflectionProperty->getValue($query);
        }

        return $result;
    }
}
