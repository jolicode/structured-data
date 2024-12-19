<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Tests\Algorithms\Benchmark;

abstract class AbstractJsonLdBench
{
    public const DATA_PATH = __DIR__ . '/../../../var/cache/w3c-json-ld-api/tests';

    abstract protected function getAlgorithmName(): string;

    protected function loadJson(string $filename): string
    {
        $filePath = \sprintf(
            '%s/%s/input/%s',
            static::DATA_PATH,
            $this->getAlgorithmName(),
            $filename,
        );
        $content = file_get_contents($filePath);

        if (false === $content) {
            throw new \RuntimeException(\sprintf('Could not load file %s', $filePath));
        }

        return $content;
    }

    protected function getBaseUrlForW3CTests(string $filename): string
    {
        return \sprintf(
            'https://w3c.github.io/json-ld-api/tests/%s/%s',
            $this->getAlgorithmName(),
            $filename,
        );
    }
}
