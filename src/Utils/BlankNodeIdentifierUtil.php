<?php

namespace Jolicode\JsonLd\Utils;

class BlankNodeIdentifierUtil
{
    private array $existing = [];
    private string $prefix = '_:';
    private int $counter = 1;

    /**
     * Replace the type of the input if it is a blank node identifier, do nothing otherwise
     */
    public function replaceBlankNodeIdentifiers(array|string $type, array $input): string|false|array
    {
        if (is_string($type)) {
            if (str_starts_with('_:', $type)) {
                if (array_key_exists($type, $this->blankNodeIdentifiers)) {
                    return $this->blankNodeIdentifiers[$type];
                }

                $newIdentifier = $this->prefix . (string) $this->counter;
                $this->counter++;
                $this->existing[$type] = $newIdentifier;

                return $newIdentifier;
            } else {
                // Do nothing : we only replace blank node identifiers
                return false;
            }
        } elseif (is_array($input)) {
            $types = [];

            foreach ($type as $typeEntry) {
                $types[] = $this->replaceBlankNodeIdentifiers($typeEntry, $input);
            }

            return $types;
        } else {
            // TODO : use real exceptions and catch them
            throw new \Exception('Wrong value for the @type key');
        }
    }
}
