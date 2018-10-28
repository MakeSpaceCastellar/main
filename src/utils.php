<?php

declare(strict_types=1);

namespace MakeSpace\Utils;

use DateTimeImmutable;
use DateTimeInterface;
use DateTimeZone;

function date_to_string(DateTimeInterface $date): string
{
    $timestamp             = $date->getTimestamp();
    $microseconds          = $date->format('u');
    $millisecondsOnASecond = 1000;

    return (string) (((float) ((string) $timestamp . '.' . (string) $microseconds)) * $millisecondsOnASecond);
}

function string_to_date($milliseconds)
{
    $millisecondsOnASecond = 1000;
    $asSeconds             = (int) floor($milliseconds / $millisecondsOnASecond);
    $dateTime              = new DateTimeImmutable('@' . ((string) $asSeconds), new DateTimeZone('UTC'));

    return new DateTimeImmutable(
        $dateTime->format('Y-m-d\TH:i:s') . '.' . sprintf(
            '%03d',
            $milliseconds % $millisecondsOnASecond
        ) . '000' . $dateTime->format('O')
    );
}

function snake_to_camel($word)
{
    return lcfirst(str_replace('_', '', ucwords($word, '_')));
}
