<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generators\Google;

use PhpParser\PrettyPrinter\Standard;
use Symfony\Component\Filesystem\Filesystem as SymfonyFilesystem;
use Symfony\Component\Finder\Finder;

readonly class Filesystem
{
    public const GOOGLE_FIXTURES_DIR = __DIR__ . '/../../tests/Validation/fixtures/google';

    private const DATA_DIRECTORY = __DIR__ . '/../../resources/google/structured-data';
    private const GENERATED_CLASSES_DIR = __DIR__ . '/../../src/Vocabularies/Generated/Google';

    public function __construct(
        private readonly SymfonyFilesystem $filesystem = new SymfonyFilesystem(),
        private readonly Standard $prettyPrinter = new PrettyPrinter(),
    ) {
    }

    /**
     * @param \Generator<int, array{\PhpParser\Node\Stmt\Namespace_, string}> $types
     *
     * @return array<string>
     */
    public function writeClass(\Generator $types): array
    {
        $writtenClassNames = [];

        foreach ($types as [$type, $className]) {
            $this->filesystem->dumpFile(
                \sprintf('%s/%s.php', self::GENERATED_CLASSES_DIR, $className),
                $this->prettyPrinter->prettyPrintFile([$type]),
            );

            $writtenClassNames[] = $className;
        }

        return $writtenClassNames;
    }

    public function getJsonFiles(): Finder
    {
        return Finder::create()
            ->files()
            ->in(self::DATA_DIRECTORY)
            ->name('*.json')
            ->sortByName()
        ;
    }
}
