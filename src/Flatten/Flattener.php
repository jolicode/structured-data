<?php

namespace Jolicode\JsonLd\Flatten;

use Jolicode\JsonLd\Utils\BlankNodeIdentifierUtil;
use stdClass;

class Flattener
{
    private array $graph;
    private array $context;

    private BlankNodeIdentifierUtil $blankNodeIdentifierUtil;

    public function __construct()
    {
        $this->graph = [
            '@default' => [],
        ];

        $this->blankNodeIdentifierUtil = new BlankNodeIdentifierUtil();
    }

    /**
     * Takes a json_decoded JSON string as input and returns a flattened JSON string
     */
    public function flatten(stdClass $input): string
    {
        return json_encode($this->buildNode((array) $input));
    }

    private function buildNode(
        array|stdClass $input,
        $activeSubject = null,
        $activeProperty = null,
        $list = null
    ): array|stdClass {
        $result = [];

        if ($this->isCollection($input)) {
            foreach ($input as $node) {
                $result[] = $this->buildNode($node, $input, $activeSubject, $activeProperty, $list);
            }

            return $result;
        }

        if (!is_array($input)) {
            // TODO : implement real exceptions and catch them
            throw new \Exception('Incorrect input');
        }

        if (null !== $activeSubject) {
            $subjectNode = $this->graph[$activeSubject];
        }

        if (array_key_exists('@type', $input) && $input['@type']) {
            if ($newId = $this->blankNodeIdentifierUtil->replaceBlankNodeIdentifiers($input['@type'], $input)) {
                $input['@type'] = $newId;
            }
        }

        return $result;
    }

    private function isCollection($input)
    {
        return is_object($input) && stdClass::class === get_class($input);
    }
}
