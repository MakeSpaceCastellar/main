<?php

declare(strict_types=1);

namespace MakeSpace\Landing\Infrastructure\Composer;

use Composer\Script\Event;
use Symfony\Component\Process\Process;

final class FrontendDependenciesInstaller
{
    public static function installFrontendDependencies(Event $event)
    {
        $process = new Process(
            'yarn install --prefer-offline',
            __DIR__ . '/../../..',
            null,
            null,
            (float) 300
        );
        $process->run();

        if ($process->getExitCode() > 0) {
            throw new \RuntimeException($process->getErrorOutput());
        }

        $event->getIO()->write('Frontend dependencies installed in node_modules');
    }
}
