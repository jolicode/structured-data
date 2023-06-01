<?php

namespace Jolicode\JsonLd\Tests\Algorithms\Benchmark;

use Jolicode\JsonLd\Tests\Algorithms\AbstractJsonLdTestCase;

abstract class AbstractJsonLdBench
{
    abstract protected function getAlgorithmName(): string;

    protected function loadJson(string $filename): string|false
    {
        return file_get_contents(sprintf(
            '%s/%s/input/%s',
            AbstractJsonLdTestCase::FIXTURES_PATH,
            $this->getAlgorithmName(),
            $filename
        ));
    }

    protected function getBaseUrlForW3CTests(string $filename): string
    {
        return sprintf(
            'https://w3c.github.io/json-ld-api/tests/%s/%s',
            $this->getAlgorithmName(),
            $filename
        );
    }
}
