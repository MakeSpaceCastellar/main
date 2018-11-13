<?php

declare(strict_types=1);

namespace MakeSpace\Landing\Infrastructure\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AssetExtension extends AbstractExtension
{
    private $cdnVersion;
    private $cdnUrl;

    public function __construct(string $cdnVersion, string $cdnUrl)
    {
        $this->cdnVersion = $cdnVersion;
        $this->cdnUrl     = $cdnUrl;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('asset', [$this, 'asset'])
        ];
    }

    public function asset(string $asset): string
    {
        return sprintf('%s%s?%s', $this->cdnUrl, $asset, $this->cdnVersion);
    }
}
