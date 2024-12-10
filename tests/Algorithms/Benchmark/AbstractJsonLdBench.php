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
    public const FIXTURES_PATH = __DIR__ . '/../fixtures';

    abstract protected function getAlgorithmName(): string;

    protected function loadJson(string $filename): string|false
    {
        return file_get_contents(\sprintf(
            '%s/%s/input/%s',
            static::FIXTURES_PATH,
            $this->getAlgorithmName(),
            $filename,
        ));
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
