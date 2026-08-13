<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace json_ld;

use Castor\Attribute\AsArgument;
use Castor\Attribute\AsTask;

use function Castor\io;

use JoliCode\StructuredData\JsonLd\Algorithms\Compact\Compactor;
use JoliCode\StructuredData\JsonLd\Algorithms\Expand\Expander;
use JoliCode\StructuredData\JsonLd\Algorithms\Flatten\Flattener;
use JoliCode\StructuredData\JsonLd\Algorithms\Frame\Framer;

#[AsTask(description: 'Applies the expansion algorithm to a JSON-LD document')]
function expand(
    #[AsArgument(name: 'file', description: 'The file to expand')]
    string $fileName,
): void {
    $file = file_get_contents($fileName);

    if (false === $file) {
        io()->error(\sprintf('The file "%s" could not be read.', $fileName));

        return;
    }

    $expander = new Expander();
    $result = $expander->expand($file);

    if (!\is_string($result)) {
        $result = json_encode($result, \JSON_PRETTY_PRINT) ?: '';
    }

    io()->writeln($result);
}

#[AsTask(description: 'Applies the flatenization algorithm to a JSON-LD document')]
function flatten(
    #[AsArgument(name: 'file', description: 'The file to flatten')]
    string $fileName,
): void {
    $file = file_get_contents($fileName);

    if (false === $file) {
        io()->error(\sprintf('The file "%s" could not be read.', $fileName));

        return;
    }

    $flattener = new Flattener();
    $result = $flattener->flatten($file);

    if (!\is_string($result)) {
        $result = json_encode($result, \JSON_PRETTY_PRINT) ?: '';
    }

    io()->writeln($result);
}

#[AsTask(name: 'compact', description: 'Applies the compaction algorithm to a JSON-LD document, using the provided context')]
function compactJsonLd(
    #[AsArgument(name: 'file', description: 'The file to compact')]
    string $fileName,
    #[AsArgument(name: 'context-file', description: 'The file holding the context to compact against')]
    string $contextFileName,
): void {
    $file = file_get_contents($fileName);
    $context = file_get_contents($contextFileName);

    if (false === $file || false === $context) {
        io()->error(\sprintf('The file "%s" or "%s" could not be read.', $fileName, $contextFileName));

        return;
    }

    $compactor = new Compactor();
    $result = $compactor->compact($file, $context);

    if (!\is_string($result)) {
        $result = json_encode($result, \JSON_PRETTY_PRINT) ?: '';
    }

    io()->writeln($result);
}

#[AsTask(name: 'frame', description: 'Applies the framing algorithm to a JSON-LD document, using the provided frame')]
function frameJsonLd(
    #[AsArgument(name: 'file', description: 'The file to frame')]
    string $fileName,
    #[AsArgument(name: 'frame-file', description: 'The file holding the frame')]
    string $frameFileName,
): void {
    $file = file_get_contents($fileName);
    $frame = file_get_contents($frameFileName);

    if (false === $file || false === $frame) {
        io()->error(\sprintf('The file "%s" or "%s" could not be read.', $fileName, $frameFileName));

        return;
    }

    $framer = new Framer();
    $result = $framer->frame($file, $frame);

    if (!\is_string($result)) {
        $result = json_encode($result, \JSON_PRETTY_PRINT) ?: '';
    }

    io()->writeln($result);
}
