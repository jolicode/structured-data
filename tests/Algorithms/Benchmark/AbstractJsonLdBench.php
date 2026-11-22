<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Tests\Algorithms\Benchmark;

abstract class AbstractJsonLdBench
{
    public const DATA_PATH = __DIR__ . '/../../../var/cache/w3c-json-ld-api/tests';

    abstract protected function getAlgorithmName(): string;

    protected function loadJson(string $filename): string
    {
        return $this->loadFixture(\sprintf('%s/input/%s', $this->getAlgorithmName(), $filename));
    }

    /**
     * Loads a fixture by its path in the test suite. The RDF suites keep the
     * upstream layout, where the files of a suite are not filed by kind.
     */
    protected function loadFixture(string $path): string
    {
        $filePath = \sprintf('%s/%s', static::DATA_PATH, $path);
        $content = file_get_contents($filePath);

        if (false === $content) {
            throw new \RuntimeException(\sprintf('Could not load file %s', $filePath));
        }

        return $content;
    }

    protected function getBaseUrlForW3CTests(string $filename): string
    {
        return \sprintf(
            'urn:w3c-json-ld-api-tests:%s:%s',
            $this->getAlgorithmName(),
            $filename,
        );
    }
}
