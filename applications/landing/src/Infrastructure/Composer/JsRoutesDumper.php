<?php

declare(strict_types=1);

namespace MakeSpace\Landing\Infrastructure\Composer;

use Composer\Script\Event;
use Symfony\Component\Process\Process;

final class JsRoutesDumper
{
    public static function dumpJsRoutes(Event $event)
    {
        $routesFile = 'assets/molecules/router/fos_js_routes.json';
        $process    = new Process(
            sprintf('php bin/console fos:js-routing:dump --format=json --target=%s', $routesFile),
            __DIR__ . '/../../..',
            null,
            null,
            (float) 300
        );
        $process->run();

        if ($process->getExitCode() > 0) {
            throw new \RuntimeException($process->getErrorOutput());
        }

        $event->getIO()->write(sprintf('Js routes dumped in applications/landing/%s', $routesFile));
    }
}
