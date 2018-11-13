<?php

declare(strict_types=1);

namespace MakeSpace\Landing\Infrastructure\Composer;

use Composer\Script\Event;
use Symfony\Component\Process\Process;

final class JsTranslationsDumper
{
    public static function dumpJsTranslations(Event $event)
    {
        $translationsPath = 'assets/molecules/translator';
        $process          = new Process(
            sprintf('php bin/console bazinga:js-translation:dump %s --merge-domains', $translationsPath),
            __DIR__ . '/../../..',
            null,
            null,
            (float) 300
        );
        $process->run();

        if ($process->getExitCode() > 0) {
            throw new \RuntimeException($process->getErrorOutput());
        }

        $event->getIO()->write(sprintf('Js translations dumped in applications/landing/%s', $translationsPath));
    }
}
