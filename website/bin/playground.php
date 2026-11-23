<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

// Run in the browser by PHP WebAssembly, see assets/php.js: the request is on
// stdin, and the answer on stdout, as JSON. It is the "output" of the
// algorithm, with its "language", or the "error" that says why there is none,
// or the "missing" documents: PHP has no network here, so the page fetches
// them, and asks again with them, see assets/jsonLd.js.

use JoliCode\StructuredData\JsonLd\Algorithms\Compact\Compactor;
use JoliCode\StructuredData\JsonLd\Algorithms\Exception\JsonLdException;
use JoliCode\StructuredData\JsonLd\Algorithms\Expand\Expander;
use JoliCode\StructuredData\JsonLd\Algorithms\Flatten\Flattener;
use JoliCode\StructuredData\JsonLd\Algorithms\Frame\Framer;
use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\ProcessorOptions;
use JoliCode\StructuredData\JsonLd\Algorithms\Rdf\FromRdfConverter;
use JoliCode\StructuredData\JsonLd\Algorithms\Rdf\NQuadsSerializer;
use JoliCode\StructuredData\JsonLd\Algorithms\Rdf\ToRdfConverter;
use JoliCode\StructuredData\Website\JsonLd\PreloadedDocumentLoader;

ini_set('display_errors', '0');
ini_set('log_errors', '1');

require __DIR__ . '/../vendor/autoload.php';

// As bin/audit.php: the memory of the WebAssembly module does not grow. It is
// the size of everything the algorithm reads, the fetched documents too.
const MAX_REQUEST_SIZE = 2 * 1024 * 1024;

const JSON_OUTPUT = \JSON_PRETTY_PRINT | \JSON_UNESCAPED_SLASHES | \JSON_UNESCAPED_UNICODE | \JSON_PRESERVE_ZERO_FRACTION | \JSON_THROW_ON_ERROR;

const ALGORITHMS = ['expand', 'compact', 'flatten', 'frame', 'toRdf', 'fromRdf'];

/**
 * @var array{
 *     algorithm: string,
 *     document: string,
 *     context?: string,
 *     frame?: string,
 *     options?: array<string, bool|string|null>,
 *     documents?: array<string, string>,
 * } $request
 */
$request = json_decode((string) file_get_contents('php://stdin'), true, flags: \JSON_THROW_ON_ERROR);

$algorithm = $request['algorithm'];
$document = $request['document'];
$context = $request['context'] ?? '';
$frame = $request['frame'] ?? '';
$given = $request['options'] ?? [];
$documents = $request['documents'] ?? [];

$answer = static function (array $answer): void {
    echo json_encode($answer, \JSON_THROW_ON_ERROR);
};

// A context, or a frame: what is not JSON is said so, rather than taken for a URL
$isJson = static function (string $json): bool {
    json_decode($json);

    return \JSON_ERROR_NONE === json_last_error();
};

$size = strlen($document) + strlen($context) + strlen($frame) + array_sum(array_map(strlen(...), $documents));

$error = match (true) {
    !in_array($algorithm, ALGORITHMS, true) => 'This algorithm is not known.',
    '' === trim($document) => 'fromRdf' === $algorithm ? 'Please enter some N-Quads.' : 'Please enter a JSON-LD document.',
    $size > MAX_REQUEST_SIZE => 'This document is too large to be processed.',
    'compact' === $algorithm && '' === trim($context) => 'Please enter the context to compact the document with.',
    in_array($algorithm, ['compact', 'flatten'], true) && '' !== trim($context) && !$isJson($context) => 'The context is not valid JSON.',
    'frame' === $algorithm && '' === trim($frame) => 'Please enter the frame to frame the document with.',
    'frame' === $algorithm && !$isJson($frame) => 'The frame is not valid JSON.',
    default => null,
};

if (null !== $error) {
    $answer(['error' => $error]);

    return;
}

$options = new ProcessorOptions(
    base: '' === ($given['base'] ?? '') ? null : (string) $given['base'],
    compactArrays: (bool) ($given['compactArrays'] ?? true),
    compactToRelative: (bool) ($given['compactToRelative'] ?? true),
    omitGraph: isset($given['omitGraph']) ? (bool) $given['omitGraph'] : null,
    ordered: (bool) ($given['ordered'] ?? false),
    produceGeneralizedRdf: (bool) ($given['produceGeneralizedRdf'] ?? false),
    rdfDirection: '' === ($given['rdfDirection'] ?? '') ? null : (string) $given['rdfDirection'],
    useNativeTypes: (bool) ($given['useNativeTypes'] ?? false),
    useRdfType: (bool) ($given['useRdfType'] ?? false),
);

$loader = new PreloadedDocumentLoader($documents);

try {
    $output = match ($algorithm) {
        'expand' => json_encode(new Expander(documentLoader: $loader)->expand($document, $options, encodeResult: false), JSON_OUTPUT),
        'compact' => json_encode(new Compactor(documentLoader: $loader)->compact($document, json_decode($context), $options, encodeResult: false), JSON_OUTPUT),
        // It answers a string, that is not always indented
        'flatten' => json_encode(json_decode((string) new Flattener(documentLoader: $loader)->flatten($document, '' === trim($context) ? null : json_decode($context), $options)), JSON_OUTPUT),
        'frame' => json_encode(new Framer(documentLoader: $loader)->frame($document, $frame, $options, encodeResult: false), JSON_OUTPUT),
        'toRdf' => NQuadsSerializer::serialize(new ToRdfConverter(documentLoader: $loader)->toRdf($document, $options)),
        'fromRdf' => json_encode(new FromRdfConverter()->fromRdf($document, $options, encodeResult: false), JSON_OUTPUT),
    };
} catch (JsonLdException $exception) {
    // The message of the library is the error code of the specification, and
    // never says which URL failed. Here the URL comes from the document of the
    // visitor, and is fetched by their browser: naming it tells nothing more.
    $answer(match (true) {
        [] !== $loader->getMissing() => ['missing' => $loader->getMissing()],
        [] !== $loader->getUnreadable() => ['error' => sprintf('%s: %s is not a JSON document.', $exception->getMessage(), implode(', ', $loader->getUnreadable()))],
        default => ['error' => $exception->getMessage()],
    });

    return;
}

$answer([
    'language' => 'toRdf' === $algorithm ? 'nquads' : 'json',
    // What the page has to give again, the next time it asks
    'loaded' => $loader->getLoaded(),
    'output' => $output,
]);
