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

use JoliCode\StructuredData\JsonLd\Algorithms\Exception\JsonLdException;
use JoliCode\StructuredData\JsonLd\Algorithms\Expand\Expander;
use JoliCode\StructuredData\JsonLd\Algorithms\Flatten\NodeMapGenerator;
use JoliCode\StructuredData\JsonLd\Algorithms\Http\DocumentLoaderInterface;
use JoliCode\StructuredData\JsonLd\Algorithms\Http\HttpDocumentLoader;
use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\FramingKeyword;
use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\Keyword;
use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\ProcessorOptions;
use JoliCode\StructuredData\JsonLd\Algorithms\Services\IdentifierGenerator;
use JoliCode\StructuredData\JsonLd\Algorithms\Services\InputDocumentResolver;

/**
 * Deserializes a JSON-LD document to an RDF dataset.
 *
 * This is a PHP implementation of the Deserialize JSON-LD to RDF algorithm
 * based on the JSON-LD 1.1 Processing Algorithms and API W3C Recommendation
 * published on July 16th, 2020.
 *
 * see https://www.w3.org/TR/json-ld11-api/#deserialize-json-ld-to-rdf-algorithm
 */
class ToRdfConverter
{
    private readonly Expander $expander;
    private readonly InputDocumentResolver $inputDocumentResolver;

    public function __construct(
        ?Expander $expander = null,
        ?DocumentLoaderInterface $documentLoader = null,
    ) {
        $documentLoader ??= new HttpDocumentLoader();
        $this->expander = $expander ?? new Expander(documentLoader: $documentLoader);
        $this->inputDocumentResolver = new InputDocumentResolver($documentLoader);
    }

    /**
     * @param string|\stdClass $json The JSON-LD document to deserialize. It can be a URI, a JSON string or a JSON object.
     */
    public function toRdf(string|\stdClass $json, ProcessorOptions $options = new ProcessorOptions()): RdfDataset
    {
        self::assertRdfDirection($options->rdfDirection);

        // The expansion writes to the options and to the document it is handed:
        // both are the caller's.
        $options = clone $options;
        $options->ordered = false;

        if ($json instanceof \stdClass) {
            $copy = unserialize(serialize($json));
            $json = $copy instanceof \stdClass ? $copy : $json;
        }

        // An HTML document is deserialized whole: every one of its JSON-LD script
        // elements, unless the "extractAllScripts" option says otherwise.
        $expanded = $this->expander->expandResolved($this->inputDocumentResolver->resolve($json, $options, true), $options);

        if ($expanded instanceof \stdClass) {
            $expanded = [$expanded];
        }

        $identifierGenerator = new IdentifierGenerator();
        /** @var array<string, array<string, array<string, mixed>>|null> $nodeMap */
        $nodeMap = [FramingKeyword::DEFAULT->value => []];

        if (\is_array($expanded)) {
            self::unnameNullIdentifiers($expanded);
            (new NodeMapGenerator($identifierGenerator))->buildNode($expanded, $nodeMap);
        }

        $dataset = new RdfDataset();

        // 1
        foreach ($nodeMap as $graphName => $graph) {
            $graphName = (string) $graphName;
            $graphTerm = null;

            // 1.1
            if (FramingKeyword::DEFAULT->value !== $graphName) {
                $graphTerm = self::node($graphName);

                if (null === $graphTerm) {
                    continue;
                }
            }

            // 1.3
            foreach ($graph ?? [] as $subject => $node) {
                // 1.3.1
                $subjectTerm = self::node((string) $subject);

                if (null === $subjectTerm) {
                    continue;
                }

                // 1.3.2
                foreach ($node as $property => $values) {
                    $property = (string) $property;

                    if (!\is_array($values)) {
                        continue;
                    }

                    // 1.3.2.1
                    if (Keyword::TYPE->value === $property) {
                        foreach ($values as $type) {
                            $typeTerm = \is_string($type) ? self::node($type) : null;

                            if (null !== $typeTerm) {
                                $dataset->add(new Quad($subjectTerm, new Iri(RdfVocabulary::RDF_TYPE), $typeTerm, $graphTerm));
                            }
                        }

                        continue;
                    }

                    // 1.3.2.2
                    if (str_starts_with($property, '@')) {
                        continue;
                    }

                    // 1.3.2.3 and 1.3.2.4
                    $predicate = self::node($property);

                    if (null === $predicate || ($predicate instanceof BlankNode && !$options->produceGeneralizedRdf)) {
                        continue;
                    }

                    // 1.3.2.5
                    foreach ($values as $item) {
                        $object = $this->objectToRdf($item, $dataset, $graphTerm, $options, $identifierGenerator);

                        if (null !== $object) {
                            $dataset->add(new Quad($subjectTerm, $predicate, $object, $graphTerm));
                        }
                    }
                }
            }
        }

        return $dataset;
    }

    public static function assertRdfDirection(?string $rdfDirection): void
    {
        if (!\in_array($rdfDirection, [null, RdfVocabulary::RDF_DIRECTION_I18N_DATATYPE, RdfVocabulary::RDF_DIRECTION_COMPOUND_LITERAL], true)) {
            throw new JsonLdException(\sprintf('The "rdfDirection" option must be null, "%s" or "%s".', RdfVocabulary::RDF_DIRECTION_I18N_DATATYPE, RdfVocabulary::RDF_DIRECTION_COMPOUND_LITERAL));
        }
    }

    /**
     * The Object to RDF Conversion algorithm. The triples a list or a compound
     * literal needs are added to the dataset on the way.
     *
     * see https://www.w3.org/TR/json-ld11-api/#object-to-rdf-conversion
     */
    private function objectToRdf(
        mixed $item,
        RdfDataset $dataset,
        Iri|BlankNode|null $graph,
        ProcessorOptions $options,
        IdentifierGenerator $identifierGenerator,
    ): Iri|BlankNode|Literal|null {
        // The node map holds a list as an array, the expanded document as a map.
        if ($item instanceof \stdClass && property_exists($item, Keyword::LIST->value)) {
            $item = [Keyword::LIST->value => $item->{Keyword::LIST->value}];
        }

        if (\is_array($item)) {
            $list = $item[Keyword::LIST->value] ?? [];

            return $this->listToRdf(\is_array($list) ? array_values($list) : [], $dataset, $graph, $options, $identifierGenerator);
        }

        if (!$item instanceof \stdClass) {
            return null;
        }

        // 1 and 2
        if (!property_exists($item, Keyword::VALUE->value)) {
            return self::node($item->{Keyword::ID->value} ?? null);
        }

        // 4
        $value = $item->{Keyword::VALUE->value};
        // 5
        $datatype = $item->{Keyword::TYPE->value} ?? null;
        $language = $item->{Keyword::LANGUAGE->value} ?? null;

        // 6
        if (null !== $datatype && Keyword::JSON->value !== $datatype && !WellFormedness::isIri($datatype)) {
            return null;
        }

        // 7
        if (null !== $language && !WellFormedness::isLanguageTag($language)) {
            return null;
        }

        if (Keyword::JSON->value === $datatype) {
            // 8
            $value = JsonCanonicalizer::canonicalize($value);
            $datatype = RdfVocabulary::RDF_JSON;
        } elseif (\is_bool($value)) {
            // 9
            $value = CanonicalLexicalForm::boolean($value);
            $datatype ??= RdfVocabulary::XSD_BOOLEAN;
        } elseif (\is_int($value) || \is_float($value)) {
            if (RdfVocabulary::XSD_DOUBLE === $datatype || CanonicalLexicalForm::isDouble($value)) {
                // 10
                $value = CanonicalLexicalForm::double($value);
                $datatype ??= RdfVocabulary::XSD_DOUBLE;
            } else {
                // 11
                $value = CanonicalLexicalForm::integer($value);
                $datatype ??= RdfVocabulary::XSD_INTEGER;
            }
        } else {
            // 12
            $datatype ??= null === $language ? RdfVocabulary::XSD_STRING : RdfVocabulary::RDF_LANG_STRING;
        }

        if (!\is_string($value) || !\is_string($datatype)) {
            return null;
        }

        $direction = $item->{Keyword::DIRECTION->value} ?? null;

        // 13
        if (\is_string($direction) && null !== $options->rdfDirection) {
            // 13.1
            $normalizedLanguage = \is_string($language) ? strtolower($language) : '';

            // 13.2
            if (RdfVocabulary::RDF_DIRECTION_I18N_DATATYPE === $options->rdfDirection) {
                return new Literal($value, RdfVocabulary::I18N . $normalizedLanguage . '_' . $direction);
            }

            // 13.3
            $compoundLiteral = new BlankNode($identifierGenerator->getIdentifier(null));
            $dataset->add(new Quad($compoundLiteral, new Iri(RdfVocabulary::RDF_VALUE), new Literal($value), $graph));

            if (\is_string($language)) {
                $dataset->add(new Quad($compoundLiteral, new Iri(RdfVocabulary::RDF_LANGUAGE), new Literal($normalizedLanguage), $graph));
            }

            $dataset->add(new Quad($compoundLiteral, new Iri(RdfVocabulary::RDF_DIRECTION), new Literal($direction), $graph));

            return $compoundLiteral;
        }

        // 14
        return new Literal($value, $datatype, \is_string($language) ? $language : null);
    }

    /**
     * The List to RDF Conversion algorithm.
     *
     * see https://www.w3.org/TR/json-ld11-api/#list-to-rdf-conversion
     *
     * @param list<mixed> $list
     */
    private function listToRdf(
        array $list,
        RdfDataset $dataset,
        Iri|BlankNode|null $graph,
        ProcessorOptions $options,
        IdentifierGenerator $identifierGenerator,
    ): Iri|BlankNode {
        // 1
        if ([] === $list) {
            return new Iri(RdfVocabulary::RDF_NIL);
        }

        // 2
        $blankNodes = [];

        foreach ($list as $ignored) {
            $blankNodes[] = new BlankNode($identifierGenerator->getIdentifier(null));
        }

        // 3
        foreach ($list as $index => $item) {
            $subject = $blankNodes[$index];
            // 3.2
            $object = $this->objectToRdf($item, $dataset, $graph, $options, $identifierGenerator);

            // 3.3
            if (null !== $object) {
                $dataset->add(new Quad($subject, new Iri(RdfVocabulary::RDF_FIRST), $object, $graph));
            }

            // 3.4
            $dataset->add(new Quad(
                $subject,
                new Iri(RdfVocabulary::RDF_REST),
                $blankNodes[$index + 1] ?? new Iri(RdfVocabulary::RDF_NIL),
                $graph,
            ));
        }

        // 4
        return $blankNodes[0];
    }

    /**
     * Expansion leaves a null "@id" where an IRI had the form of a keyword. Such
     * a node names nothing: it is neither a subject nor an object, while the
     * nodes it holds still are. The node map generation would give it a fresh
     * blank node identifier, so it is handed an identifier that is not
     * well-formed instead, which is what the deserialization leaves out.
     */
    private static function unnameNullIdentifiers(mixed $element): void
    {
        if (\is_array($element)) {
            foreach ($element as $item) {
                self::unnameNullIdentifiers($item);
            }

            return;
        }

        if (!$element instanceof \stdClass || property_exists($element, Keyword::VALUE->value)) {
            return;
        }

        if (property_exists($element, Keyword::ID->value) && null === $element->{Keyword::ID->value}) {
            $element->{Keyword::ID->value} = '';
        }

        foreach (get_object_vars($element) as $value) {
            self::unnameNullIdentifiers($value);
        }
    }

    private static function node(mixed $identifier): Iri|BlankNode|null
    {
        if (!\is_string($identifier)) {
            return null;
        }

        if (WellFormedness::isBlankNode($identifier)) {
            return new BlankNode($identifier);
        }

        return WellFormedness::isIri($identifier) ? new Iri($identifier) : null;
    }
}
