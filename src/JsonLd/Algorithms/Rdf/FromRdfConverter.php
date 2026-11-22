<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\JsonLd\Algorithms\Rdf;

use JoliCode\StructuredData\JsonLd\Algorithms\ContextProcessing\Context;
use JoliCode\StructuredData\JsonLd\Algorithms\Exception\JsonLdException;
use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\FramingKeyword;
use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\Keyword;
use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\ProcessorOptions;

/**
 * Serializes an RDF dataset as an expanded JSON-LD document.
 *
 * This is a PHP implementation of the Serialize RDF as JSON-LD algorithm based
 * on the JSON-LD 1.1 Processing Algorithms and API W3C Recommendation published
 * on July 16th, 2020.
 *
 * see https://www.w3.org/TR/json-ld11-api/#serialize-rdf-as-json-ld-algorithm
 *
 * @phpstan-type Usage array{node: \stdClass, property: string, value: \stdClass}
 */
class FromRdfConverter
{
    private readonly NQuadsParser $parser;

    public function __construct(?NQuadsParser $parser = null)
    {
        $this->parser = $parser ?? new NQuadsParser();
    }

    /**
     * @param RdfDataset|string $dataset      The dataset to serialize. A string is read as N-Quads.
     * @param bool              $encodeResult Whether to encode the result as a JSON string or not
     *
     * @return ($encodeResult is true ? string : list<\stdClass>)
     */
    public function fromRdf(
        RdfDataset|string $dataset,
        ProcessorOptions $options = new ProcessorOptions(),
        bool $encodeResult = true,
    ): array|string {
        ToRdfConverter::assertRdfDirection($options->rdfDirection);

        if (\is_string($dataset)) {
            $dataset = $this->parser->parse($dataset);
        }

        // 1 and 2
        /** @var array<string, array<string, \stdClass>> $graphMap */
        $graphMap = [FramingKeyword::DEFAULT->value => []];
        // 3
        /** @var array<string, Usage|false> $referencedOnce */
        $referencedOnce = [];
        // 4
        /** @var array<string, array<string, true>> $compoundLiteralSubjects */
        $compoundLiteralSubjects = [];
        // The usages of rdf:nil, per graph: the tail of every list.
        /** @var array<string, list<Usage>> $nilUsages */
        $nilUsages = [];

        // 5
        foreach ($dataset->quads() as $quad) {
            // 5.1
            $name = null === $quad->graph ? FramingKeyword::DEFAULT->value : self::identifier($quad->graph);
            // 5.2
            $graphMap[$name] ??= [];

            // 5.4
            if (FramingKeyword::DEFAULT->value !== $name) {
                $graphMap[FramingKeyword::DEFAULT->value][$name] ??= self::createNode($name);
            }

            $subject = self::identifier($quad->subject);
            $predicate = self::identifier($quad->predicate);
            $object = $quad->object;

            // 5.7.1 and 5.7.2
            $node = $graphMap[$name][$subject] ??= self::createNode($subject);

            // 5.7.3
            if (RdfVocabulary::RDF_DIRECTION_COMPOUND_LITERAL === $options->rdfDirection && RdfVocabulary::RDF_DIRECTION === $predicate) {
                $compoundLiteralSubjects[$name][$subject] = true;
            }

            $objectIdentifier = null;

            if (!$object instanceof Literal) {
                $objectIdentifier = self::identifier($object);
                // 5.7.4
                $graphMap[$name][$objectIdentifier] ??= self::createNode($objectIdentifier);

                // 5.7.5
                if (RdfVocabulary::RDF_TYPE === $predicate && !$options->useRdfType) {
                    $types = $node->{Keyword::TYPE->value} ?? [];

                    if (!\in_array($objectIdentifier, $types, true)) {
                        $types[] = $objectIdentifier;
                    }

                    $node->{Keyword::TYPE->value} = $types;

                    continue;
                }
            }

            // 5.7.6
            $value = $this->rdfToObject($object, $options);

            // 5.7.7 and 5.7.8
            $values = $node->{$predicate} ?? [];
            $known = false;

            foreach ($values as $existingValue) {
                if (serialize($existingValue) === serialize($value)) {
                    $value = $existingValue;
                    $known = true;

                    break;
                }
            }

            if (!$known) {
                $values[] = $value;
                $node->{$predicate} = $values;
            }

            if (null === $objectIdentifier) {
                continue;
            }

            $usage = ['node' => $node, 'property' => $predicate, 'value' => $value];

            if (RdfVocabulary::RDF_NIL === $objectIdentifier) {
                // 5.7.9
                $nilUsages[$name][] = $usage;
            } elseif (\array_key_exists($objectIdentifier, $referencedOnce)) {
                // 5.7.10
                $referencedOnce[$objectIdentifier] = false;
            } elseif ($object instanceof BlankNode) {
                // 5.7.11
                $referencedOnce[$objectIdentifier] = $usage;
            }
        }

        // 6
        foreach (array_keys($graphMap) as $name) {
            $name = (string) $name;

            // 6.1
            foreach (array_keys($compoundLiteralSubjects[$name] ?? []) as $compoundLiteral) {
                $compoundLiteral = (string) $compoundLiteral;
                // 6.1.1
                $usage = $referencedOnce[$compoundLiteral] ?? false;

                if (false === $usage) {
                    continue;
                }

                // 6.1.5
                $compoundLiteralNode = $graphMap[$name][$compoundLiteral] ?? null;
                unset($graphMap[$name][$compoundLiteral]);

                if (null === $compoundLiteralNode) {
                    continue;
                }

                // 6.1.6
                foreach ($usage['node']->{$usage['property']} ?? [] as $reference) {
                    if (!$reference instanceof \stdClass || ($reference->{Keyword::ID->value} ?? null) !== $compoundLiteral) {
                        continue;
                    }

                    // 6.1.6.1
                    unset($reference->{Keyword::ID->value});
                    // 6.1.6.2
                    $reference->{Keyword::VALUE->value} = self::firstValue($compoundLiteralNode, RdfVocabulary::RDF_VALUE);

                    // 6.1.6.3
                    if (property_exists($compoundLiteralNode, RdfVocabulary::RDF_LANGUAGE)) {
                        $language = self::firstValue($compoundLiteralNode, RdfVocabulary::RDF_LANGUAGE);

                        if (!WellFormedness::isLanguageTag($language)) {
                            throw new JsonLdException('invalid language-tagged string');
                        }

                        $reference->{Keyword::LANGUAGE->value} = $language;
                    }

                    // 6.1.6.4
                    if (property_exists($compoundLiteralNode, RdfVocabulary::RDF_DIRECTION)) {
                        $direction = self::firstValue($compoundLiteralNode, RdfVocabulary::RDF_DIRECTION);

                        if ('ltr' !== $direction && 'rtl' !== $direction) {
                            throw new JsonLdException('invalid base direction');
                        }

                        $reference->{Keyword::DIRECTION->value} = $direction;
                    }
                }
            }

            // 6.2 to 6.4
            foreach ($nilUsages[$name] ?? [] as $usage) {
                // 6.4.1
                $node = $usage['node'];
                $property = $usage['property'];
                $head = $usage['value'];
                // 6.4.2
                $list = [];
                $listNodes = [];

                // 6.4.3
                while (RdfVocabulary::RDF_REST === $property && self::isWellFormedListNode($node, $referencedOnce)) {
                    $nodeIdentifier = (string) $node->{Keyword::ID->value};
                    /** @var Usage $nodeUsage */
                    $nodeUsage = $referencedOnce[$nodeIdentifier];

                    // 6.4.3.1
                    $list[] = $node->{RdfVocabulary::RDF_FIRST}[0];
                    // 6.4.3.2
                    $listNodes[] = $nodeIdentifier;
                    // 6.4.3.3 to 6.4.3.5
                    $node = $nodeUsage['node'];
                    $property = $nodeUsage['property'];
                    $head = $nodeUsage['value'];

                    // 6.4.3.6
                    if (!WellFormedness::isBlankNode($node->{Keyword::ID->value})) {
                        break;
                    }
                }

                // 6.4.4
                unset($head->{Keyword::ID->value});
                // 6.4.5 and 6.4.6
                $head->{Keyword::LIST->value} = array_reverse($list);

                // 6.4.7
                foreach ($listNodes as $listNode) {
                    unset($graphMap[$name][$listNode]);
                }
            }
        }

        // 7
        $result = [];
        $defaultGraph = $graphMap[FramingKeyword::DEFAULT->value];

        if ($options->ordered) {
            ksort($defaultGraph, \SORT_STRING);
        }

        // 8
        foreach ($defaultGraph as $subject => $node) {
            $subject = (string) $subject;

            // 8.1
            if (FramingKeyword::DEFAULT->value !== $subject && \array_key_exists($subject, $graphMap)) {
                $namedGraph = $graphMap[$subject];

                if ($options->ordered) {
                    ksort($namedGraph, \SORT_STRING);
                }

                // 8.1.1 and 8.1.2
                $node->{Keyword::GRAPH->value} = array_values(array_filter($namedGraph, self::isNotOnlyAReference(...)));
            }

            // 8.2
            if (self::isNotOnlyAReference($node)) {
                $result[] = $node;
            }
        }

        if (!$encodeResult) {
            return $result;
        }

        $encoded = json_encode($result, \JSON_PRETTY_PRINT | \JSON_UNESCAPED_SLASHES | \JSON_UNESCAPED_UNICODE | \JSON_PRESERVE_ZERO_FRACTION);

        if (false === $encoded) {
            throw new JsonLdException('The JSON-LD document could not be encoded.');
        }

        return $encoded;
    }

    /**
     * The RDF to Object Conversion algorithm.
     *
     * see https://www.w3.org/TR/json-ld11-api/#rdf-to-object-conversion
     */
    private function rdfToObject(Iri|BlankNode|Literal $value, ProcessorOptions $options): \stdClass
    {
        // 1
        if (!$value instanceof Literal) {
            return (object) [Keyword::ID->value => self::identifier($value)];
        }

        // 2
        $result = new \stdClass();
        $converted = $value->value;
        $type = null;

        if (null !== $value->language) {
            // 2.7
            $result->{Keyword::LANGUAGE->value} = $value->language;
        } elseif (Context::PROCESSING_MODE_10 !== $options->processingMode && RdfVocabulary::RDF_JSON === $value->datatype) {
            // 2.5
            try {
                $converted = json_decode($value->value, flags: \JSON_THROW_ON_ERROR);
            } catch (\JsonException) {
                throw new JsonLdException('invalid JSON literal');
            }

            $type = Keyword::JSON->value;
        } elseif (RdfVocabulary::RDF_DIRECTION_I18N_DATATYPE === $options->rdfDirection && str_starts_with($value->datatype, RdfVocabulary::I18N)) {
            // 2.6
            [$language, $direction] = explode('_', substr($value->datatype, \strlen(RdfVocabulary::I18N)), 2) + [1 => ''];

            if ('' !== $language) {
                $result->{Keyword::LANGUAGE->value} = $language;
            }

            if ('' !== $direction) {
                $result->{Keyword::DIRECTION->value} = $direction;
            }
        } elseif ($options->useNativeTypes) {
            // 2.4
            [$converted, $type] = self::nativeValue($value);
        } elseif (RdfVocabulary::XSD_STRING !== $value->datatype) {
            // 2.8
            $type = $value->datatype;
        }

        // 2.9
        $result->{Keyword::VALUE->value} = $converted;

        // 2.10
        if (null !== $type) {
            $result->{Keyword::TYPE->value} = $type;
        }

        return $result;
    }

    /**
     * A literal as a native JSON value, when its lexical form allows it. The
     * datatype is kept whenever the native value alone would not say it.
     *
     * @return array{bool|int|float|string, string|null}
     */
    private static function nativeValue(Literal $literal): array
    {
        $lexicalForm = $literal->value;

        switch ($literal->datatype) {
            case RdfVocabulary::XSD_STRING:
                return [$lexicalForm, null];
            case RdfVocabulary::XSD_BOOLEAN:
                if (\in_array($lexicalForm, ['true', 'false', '1', '0'], true)) {
                    return ['true' === $lexicalForm || '1' === $lexicalForm, null];
                }

                break;
            case RdfVocabulary::XSD_INTEGER:
                // An integer PHP cannot hold keeps its lexical form: a float
                // would silently lose its last digits.
                if (1 === preg_match('/^[+-]?\d+$/', $lexicalForm) && (string) (int) $lexicalForm === self::normalizeInteger($lexicalForm)) {
                    return [(int) $lexicalForm, null];
                }

                break;
            case RdfVocabulary::XSD_DOUBLE:
                // JSON has no infinity: a double it cannot write stays a string.
                if (1 === preg_match('/^[+-]?(\d+(\.\d*)?|\.\d+)([eE][+-]?\d+)?$/', $lexicalForm) && is_finite((float) $lexicalForm)) {
                    return [(float) $lexicalForm, null];
                }

                break;
        }

        return [$lexicalForm, $literal->datatype];
    }

    /**
     * An integer lexical form without its optional plus sign and leading zeros.
     */
    private static function normalizeInteger(string $lexicalForm): string
    {
        $negative = str_starts_with($lexicalForm, '-');
        $digits = ltrim(ltrim($lexicalForm, '+-'), '0');

        if ('' === $digits) {
            return '0';
        }

        return ($negative ? '-' : '') . $digits;
    }

    /**
     * Whether a node is one link of a well-formed RDF collection: a blank node
     * referenced once, holding one rdf:first, one rdf:rest and nothing else but
     * an optional rdf:List type.
     *
     * @param array<string, Usage|false> $referencedOnce
     */
    private static function isWellFormedListNode(\stdClass $node, array $referencedOnce): bool
    {
        $identifier = $node->{Keyword::ID->value} ?? null;

        if (!WellFormedness::isBlankNode($identifier) || false === ($referencedOnce[$identifier] ?? false)) {
            return false;
        }

        $first = $node->{RdfVocabulary::RDF_FIRST} ?? null;
        $rest = $node->{RdfVocabulary::RDF_REST} ?? null;

        if (!\is_array($first) || 1 !== \count($first) || !\is_array($rest) || 1 !== \count($rest)) {
            return false;
        }

        $entryCount = \count(get_object_vars($node));

        if (3 === $entryCount) {
            return true;
        }

        return 4 === $entryCount && [RdfVocabulary::RDF_LIST] === ($node->{Keyword::TYPE->value} ?? null);
    }

    private static function isNotOnlyAReference(\stdClass $node): bool
    {
        $entries = get_object_vars($node);

        return 1 !== \count($entries) || !\array_key_exists(Keyword::ID->value, $entries);
    }

    private static function firstValue(\stdClass $node, string $property): mixed
    {
        $first = ($node->{$property} ?? [])[0] ?? null;

        return $first instanceof \stdClass ? ($first->{Keyword::VALUE->value} ?? null) : null;
    }

    private static function createNode(string $identifier): \stdClass
    {
        return (object) [Keyword::ID->value => $identifier];
    }

    private static function identifier(Iri|BlankNode $term): string
    {
        return $term instanceof Iri ? $term->value : $term->label;
    }
}
