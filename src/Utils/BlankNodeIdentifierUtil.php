<?php

namespace Jolicode\JsonLd\Utils;

class BlankNodeIdentifierUtil
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
     *      - an array of string identifiers if multiple identifiers are provided
     *      - false if input is not a blank node identifier
     */
    public function replaceBlankNodeIdentifiers(array|string $identifier): string|false|array
    {
        return match (gettype($identifier)) {
            'string' => $this->handleStringIdentifier($identifier),
            'array' => $this->handleArrayIdentifier($identifier),
                // TODO : use real exceptions and catch them
            default => throw new \Exception(sprintf(
                'Wrong value found for the @type key : it should be a string or an array, %s provided',
                gettype($identifier)
            )),
        };
    }

    private function handleStringIdentifier(string $identifier): string|false
    {
        if (str_starts_with($this->prefix, $identifier)) {
            if (array_key_exists($identifier, $this->blankNodeIdentifiers)) {
                return $this->blankNodeIdentifiers[$identifier];
            }

            $newIdentifier = $this->prefix . (string) $this->counter;
            $this->counter++;
            $this->existing[$identifier] = $newIdentifier;

            return $newIdentifier;
        } else {
            // Do nothing : we only replace blank node identifiers
            return false;
        }
    }

    private function handleArrayIdentifier(array $identifiers): array
    {
        $newIdentifiers = [];

        foreach ($identifiers as $identifierEntry) {
            $newIdentifiers[] = $this->replaceBlankNodeIdentifiers($identifierEntry);
        }

        return $newIdentifiers;
    }
}
