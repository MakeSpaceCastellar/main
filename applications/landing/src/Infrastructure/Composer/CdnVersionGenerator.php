<?php

declare(strict_types=1);

namespace MakeSpace\Landing\Infrastructure\Composer;

use Composer\Script\Event;

final class CdnVersionGenerator
{
    public static function generate(Event $event)
    {
        $cdnVersionGenerator =
            new \MakeSpace\Infrastructure\Asset\CdnVersionGenerator(__DIR__ . '/../../../config/cdn_version.yaml');

        $version = $cdnVersionGenerator();

        $event->getIO()->write(sprintf('Version [%s] saved in file applications/landing/config/cdn_version.yaml', $version));
    }
}
