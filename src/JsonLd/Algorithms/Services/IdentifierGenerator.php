<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\JsonLd\Algorithms\Services;

class IdentifierGenerator
{
    private array $existing = [];
    private string $generalPrefix = '_:';
    private string $prefix = '_:b';
    private int $counter = 0;

    /**
     * A utility method to get the correct identifier for a given identifier key.
     *
     * Will return :
     *      - a string with the generated identifier if one is generated
     *      - a string with an existing identifier if the one provided already exists
     *      - a string with the original value if input is not a blank node identifier
     *      - an array of string identifiers if multiple identifiers are provided
     */
    public function getIdentifier(array|string|null $identifier): string|array
    {
        if (\is_string($identifier) && \array_key_exists($identifier, $this->existing)) {
            return $this->existing[$identifier];
        }

        return match (\gettype($identifier)) {
            'string' => $this->handleStringIdentifier($identifier),
            'array' => $this->handleArrayIdentifier($identifier),
            'NULL' => $this->createNewIdentifier(),
        };
    }

    private function handleStringIdentifier(string $identifier): string
    {
        if (str_starts_with($identifier, $this->generalPrefix)) {
            $newIdentifier = $this->createNewIdentifier();
            $this->existing[$identifier] = $newIdentifier;

            return $newIdentifier;
        }

        // Return original string : we only replace blank node identifiers
        return $identifier;
    }

    private function handleArrayIdentifier(array $identifiers): array
    {
        $newIdentifiers = [];

        foreach ($identifiers as $identifierEntry) {
            $newIdentifiers[] = $this->getIdentifier($identifierEntry);
        }

        return $newIdentifiers;
    }

    private function createNewIdentifier(): string
    {
        $newIdentifier = $this->prefix . (string) $this->counter;
        ++$this->counter;

        return $newIdentifier;
    }
}
