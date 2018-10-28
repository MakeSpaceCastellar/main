<?php

declare(strict_types=1);

namespace MakeSpace\Tests\Infrastructure\Types\Stub;

final class UrlStub
{
    use RandomSeededStringTrait {
        randomSeededString as private;
    }

    const protocols               = ['http', 'https'];
    const VALID_HOSTNAME_CHARS    = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    const VALID_TLD_CHARS         = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    const pathChars               = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789.-_~';
    const VALID_QUERYSTRING_CHARS = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789.-_~';

    public static function random(): string
    {
        return sprintf(
            '%s://%s.%s/%s%s',
            self::randomProtocol(),
            self::randomHostname(),
            self::randomTld(),
            self::randomPath(),
            self::randomQueryString()
        );
    }

    private static function randomProtocol(): string
    {
        return self::protocols[mt_rand(0, 1)];
    }

    private static function randomHostname(): string
    {
        return self::randomSeededString(self::VALID_HOSTNAME_CHARS, 10, 50);
    }

    private static function randomTld(): string
    {
        return self::randomSeededString(self::VALID_TLD_CHARS, 2, 3);
    }

    private static function randomPath(): string
    {
        $folderNumber = mt_rand(0, 10);
        $paths        = [];
        for ($i = 0; $i < $folderNumber; $i++) {
            $paths[] = self::randomSeededString(self::pathChars, 1, 20);
        }

        return implode('/', $paths);
    }

    private static function randomQueryString(): string
    {
        $parameterNumber = mt_rand(0, 10);
        $parameters      = [];
        for ($i = 0; $i < $parameterNumber; $i++) {
            $parameters[] = sprintf(
                '%s=%s',
                self::randomSeededString(self::VALID_QUERYSTRING_CHARS, 1, 20),
                self::randomSeededString(self::VALID_QUERYSTRING_CHARS, 1, 20)
            );
        }

        return $parameters ? sprintf('?%s', implode('&', $parameters)) : '';
    }
}
