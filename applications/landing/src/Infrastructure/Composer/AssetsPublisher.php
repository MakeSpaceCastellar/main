<?php

declare(strict_types=1);

namespace MakeSpace\Landing\Infrastructure\Composer;

use Composer\Script\Event;
use Symfony\Component\Process\Process;

final class AssetsPublisher
{
    public static function publishAssets(Event $event)
    {
        $process = new Process(
            'yarn run makespace:build',
            __DIR__ . '/../../..',
            null,
            null,
            (float) 300
        );
        $process->run();

        if ($process->getExitCode() > 0) {
            throw new \RuntimeException($process->getErrorOutput());
        }

        $event->getIO()->write('Assets published in applications/landing/public/dist');
    }
}
