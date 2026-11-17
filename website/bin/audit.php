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
// stdin, and the answer on stdout, as JSON: the "html" of the result, or the
// "error" that says why the document is not audited.

use JoliCode\StructuredData\Audit\Item;
use JoliCode\StructuredData\Mapper\MappedType;
use JoliCode\StructuredData\Validator;
use JoliCode\StructuredData\Website\Twig\JsonLdExtension;
use JoliCode\StructuredData\Website\Twig\MarkdownExtension;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

ini_set('display_errors', '0');
ini_set('log_errors', '1');

require __DIR__ . '/../vendor/autoload.php';

// Auditing holds the document, its DOMDocument and the expanded JSON-LD at
// once, in the memory of the WebAssembly module, that does not grow.
const MAX_DOCUMENT_SIZE = 2 * 1024 * 1024;

/** @var array{allowPendingVocabulary: bool, body: string, mergeSharedIdentifiers: bool} $request */
$request = json_decode((string) file_get_contents('php://stdin'), true, flags: \JSON_THROW_ON_ERROR);

$body = $request['body'];

$error = match (true) {
    '' === trim($body) => 'Please enter some code to validate.',
    strlen($body) > MAX_DOCUMENT_SIZE => 'This document is too large to be validated.',
    default => null,
};

if (null !== $error) {
    echo json_encode(['error' => $error], \JSON_THROW_ON_ERROR);

    return;
}

$audit = new Validator()->audit(
    $body,
    reportPendingVocabularyUsage: !$request['allowPendingVocabulary'],
    mergeNodesSharingAnIdentifier: $request['mergeSharedIdentifiers'],
);

$loader = new FilesystemLoader(__DIR__ . '/../templates');
$loader->addPath(__DIR__ . '/../assets/images', 'images');

$twig = new Environment($loader, ['strict_variables' => true]);
$twig->addExtension(new JsonLdExtension());
$twig->addExtension(new MarkdownExtension());

echo json_encode([
    'html' => $twig->render('result.html.twig', [
        'body' => $body,
        // The items, not the blocks: with the merge on, the blocks sharing an
        // identifier make one item, whose node carries the verdict.
        'types' => array_map(static fn (Item $item): MappedType => $item->getType(), $audit->getItems()),
    ]),
], \JSON_THROW_ON_ERROR);
