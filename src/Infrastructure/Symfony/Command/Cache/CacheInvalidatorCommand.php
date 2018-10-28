<?php

declare(strict_types=1);

namespace MakeSpace\Infrastructure\Symfony\Command\Cache;

use function Lambdish\Phunctional\each;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\InvalidOptionException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

final class CacheInvalidatorCommand extends Command
{
    private $redis;

    /**
     * @param \Redis|\RedisCluster $redisClient
     */
    public function __construct($redisClient)
    {
        $this->redis = $redisClient;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('application:cache:invalidate')
             ->setDescription('Invalidates cache entries selectively')
             ->addOption('all', 'a', InputOption::VALUE_NONE, 'Remove all cache entries')
             ->addOption('pattern', 'p', InputOption::VALUE_REQUIRED, 'Pattern matching cache entries. Must start with "cache:"');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $all = $input->getOption('all');
        $pattern = $input->getOption('pattern');
        if ($all) {
            $this->invalidateAll();
        } elseif ($pattern) {
            $this->guardPattern($pattern);
            $this->invalidate($pattern);
        } else {
            throw new InvalidOptionException('You should use one of all|pattern options');
        }
    }

    private function invalidateAll()
    {
        $this->invalidate('cache:*');
    }

    private function invalidate($pattern)
    {
        $keys = $this->redis->keys($pattern);
        each(
            function ($key) {
                $this->redis->del($key);
            },
            $keys
        );
    }

    private function guardPattern(string $pattern)
    {
        $prefix = 'cache:';

        if (substr($pattern, 0, strlen($prefix)) !== $prefix) {
            throw new \InvalidArgumentException(
                sprintf('Pattern %s does not start with "cache:"', $pattern)
            );
        }
    }
}
