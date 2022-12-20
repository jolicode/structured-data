<?php

namespace Jolicode\JsonLd\Utils;

class IdentifierGenerator
{
    private array $existing = [];
    private string $prefix = '_:';
    private int $counter = 1;

    /**
     * A utility method to get the correct identifier for a given identifier key
     *
     * Will return :
     *      - a string with the generated identifier if one is generated
     *      - a string with an existing identifier if the one provided already exists
     *      - a string with the original value if input is not a blank node identifier
     *      - an array of string identifiers if multiple identifiers are provided
     */
    public function getIdentifier(array|string|null $identifier): string|array
    {
        if ($identifier && array_key_exists($identifier, $this->existing)) {
            return $this->existing[$identifier];
        }

        return match (gettype($identifier)) {
            'string' => $this->handleStringIdentifier($identifier),
            'array' => $this->handleArrayIdentifier($identifier),
            'NULL' => $this->createNewIdentifier(),
                // TODO : use real exceptions and catch them
            default => throw new \Exception(sprintf(
                'Wrong value found for the @type key : it should be a string or an array, %s provided',
                gettype($identifier)
            )),
        };
    }

    private function handleStringIdentifier(string $identifier): string
    {
        if (str_starts_with($this->prefix, $identifier)) {
            $newIdentifier = $this->createNewIdentifier();
            $this->existing[$identifier] = $newIdentifier;

            return $newIdentifier;
        } else {
            // Return original string : we only replace blank node identifiers
            return $identifier;
        }
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
        $this->counter++;

        return $newIdentifier;
    }
}
