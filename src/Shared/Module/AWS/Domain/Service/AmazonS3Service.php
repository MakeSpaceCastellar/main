<?php

declare(strict_types=1);

namespace MakeSpace\Shared\Module\AWS\Domain\Service;

use Aws\Result;
use Aws\S3\S3Client;

final class AmazonS3Service
{
    private $client;
    private $bucket;

    public function __construct(string $bucket, array $s3arguments)
    {
        $this->setBucket($bucket);
        $this->setClient(new S3Client($s3arguments));
    }

    public function upload(string $sourceFile, string $key, string $privacy = 'public-read'): Result
    {
        return $this->getClient()->putObject(
            [
                'ACL'        => $privacy,
                'Bucket'     => $this->getBucket(),
                'Key'        => $key,
                'SourceFile' => $sourceFile
            ]
        );
    }

    protected function getClient(): S3Client
    {
        return $this->client;
    }

    private function setClient(S3Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    protected function getBucket(): string
    {
        return $this->bucket;
    }

    private function setBucket(string $bucket): self
    {
        $this->bucket = $bucket;

        return $this;
    }
}
