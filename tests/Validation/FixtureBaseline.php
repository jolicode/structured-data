<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Tests\Validation;

/**
 * Reads the JSON baselines recording the expected diagnostics of the validation
 * fixtures, as written by the "qa:phpunit:update-baseline" castor task.
 *
 * @phpstan-type BaselineEntry array{errors: list<string>, warnings: list<string>, documentIssues: list<string>}
 */
final class FixtureBaseline
{
    /**
     * @return array<string, BaselineEntry> the expected diagnostics, indexed by fixture file name
     */
    public static function load(string $baselinePath): array
    {
        $baseline = is_file($baselinePath) ? file_get_contents($baselinePath) : false;
        $decoded = json_decode(false === $baseline ? '{}' : $baseline, true);

        if (!\is_array($decoded)) {
            throw new \RuntimeException(\sprintf('The baseline "%s" could not be decoded.', $baselinePath));
        }

        $entries = [];

        foreach ($decoded as $fixture => $entry) {
            if (!\is_string($fixture) || !\is_array($entry)) {
                throw new \RuntimeException(\sprintf('Invalid baseline entry "%s" in "%s".', $fixture, $baselinePath));
            }

            $entries[$fixture] = [
                'errors' => self::stringList($entry['errors'] ?? [], $fixture, $baselinePath),
                'warnings' => self::stringList($entry['warnings'] ?? [], $fixture, $baselinePath),
                'documentIssues' => self::stringList($entry['documentIssues'] ?? [], $fixture, $baselinePath),
            ];
        }

        return $entries;
    }

    /**
     * @return list<string>
     */
    private static function stringList(mixed $values, string $fixture, string $baselinePath): array
    {
        if (!\is_array($values)) {
            throw new \RuntimeException(\sprintf('The diagnostics of "%s" in "%s" must be a list of strings.', $fixture, $baselinePath));
        }

        $messages = [];

        foreach ($values as $value) {
            if (!\is_string($value)) {
                throw new \RuntimeException(\sprintf('The diagnostics of "%s" in "%s" must be a list of strings.', $fixture, $baselinePath));
            }

            $messages[] = $value;
        }

        return $messages;
    }
}
