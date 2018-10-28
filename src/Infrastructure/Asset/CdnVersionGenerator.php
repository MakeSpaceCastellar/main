<?php

declare(strict_types=1);

namespace MakeSpace\Infrastructure\Asset;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Process\Process;
use Symfony\Component\Yaml\Yaml;

final class CdnVersionGenerator
{
    private $versionFilePath;

    public function __construct(string $versionFilePath)
    {
        $this->versionFilePath = $versionFilePath;
    }

    public function __invoke(?string $forcedVersion = null): string
    {
        if (null === $forcedVersion) {
            $process  = new Process('hashdeep -r -l . | sort | md5sum', __DIR__ . '/../../../applications/landing/assets');
            $process->run();
            $output = $process->getOutput();
            $version = substr($output, 0, 8);
        } else {
            $version = $forcedVersion;
        }

        $fs = new Filesystem();
        if ($fs->exists($this->versionFilePath)) {
            $fs->remove($this->versionFilePath);
        }

        $yamlContents = Yaml::dump(['parameters' => ['cdn_version' => $version]]);
        $fs->touch($this->versionFilePath);
        $fs->dumpFile($this->versionFilePath, $yamlContents);

        return $version;
    }
}
