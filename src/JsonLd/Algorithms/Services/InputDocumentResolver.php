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

use JoliCode\StructuredData\JsonLd\Algorithms\Exception\JsonLdException;
use JoliCode\StructuredData\JsonLd\Algorithms\Http\DocumentLoaderInterface;
use JoliCode\StructuredData\JsonLd\Algorithms\Http\IriResolver;
use JoliCode\StructuredData\JsonLd\Algorithms\Http\LoadDocumentOptions;
use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\ProcessorOptions;

/**
 * Turns what an algorithm is handed (a JSON string, a decoded document, or the
 * URL of a document) into the document it works on and the base IRI it works
 * with. Every algorithm starts here, so that they all read a URL the same way.
 */
final class InputDocumentResolver
{
    public function __construct(
        private readonly DocumentLoaderInterface $documentLoader,
    ) {
    }

    /**
     * @param string|\stdClass|array<mixed> $input                    A JSON string, a decoded document, or a URL. A URL is given
     *                                                                as it is, or as a JSON string ('"https://example.com/doc"').
     * @param bool                          $extractAllScriptsDefault what the "extractAllScripts" option means when it is not set
     */
    public function resolve(string|\stdClass|array $input, ProcessorOptions $options, bool $extractAllScriptsDefault = false): ResolvedInput
    {
        if (!\is_string($input)) {
            return new ResolvedInput($input, $options->base);
        }

        $document = json_decode($input);

        if (null === $document && 'null' !== trim($input)) {
            if (!IriResolver::isAbsoluteIri(trim($input))) {
                throw new JsonLdException('The JSON string could not be parsed.');
            }

            $document = trim($input);
        }

        if (!\is_string($document)) {
            return new ResolvedInput($document, $options->base);
        }

        $remoteDocument = $this->documentLoader->load($document, new LoadDocumentOptions(
            extractAllScripts: $options->extractAllScripts ?? $extractAllScriptsDefault,
        ));

        // The "base" option takes precedence over the location of the document,
        // and the base element of an HTML document over both.
        $base = $options->base ?? $remoteDocument->documentUrl;

        if (null !== $remoteDocument->htmlBase) {
            $base = IriResolver::resolveIri($base, $remoteDocument->htmlBase);
        }

        return new ResolvedInput($remoteDocument->document, $base, $remoteDocument->documentUrl, $remoteDocument->contextUrl);
    }
}
