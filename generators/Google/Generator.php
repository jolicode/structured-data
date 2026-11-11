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

use JoliCode\StructuredData\Vocabularies\Generators\GeneratorInterface;
use JoliCode\StructuredData\Vocabularies\Generators\Google\Filesystem as GoogleFilesystem;
use JoliCode\StructuredData\Vocabularies\Generators\StaticFileGenerator;
use PhpParser\BuilderFactory;
use PhpParser\BuilderHelpers;
use PhpParser\Node\Expr;
use PhpParser\Node\Expr\Array_;
use PhpParser\Node\Stmt;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * The shapes below describe the hand-written JSON files of resources/google/structured-data,
 * as documented in their README: a single type definition, or a set of sub-type
 * definitions sharing a documentation page.
 *
 * @phpstan-type GoogleDefinition array{
 *     name: string,
 *     subtype?: string,
 *     documentation?: string,
 *     specialRules?: list<string>,
 *     supportedTypes: list<string>,
 *     properties?: array<mixed>,
 * }
 * @phpstan-type GoogleFile GoogleDefinition|array{subtypes: list<GoogleDefinition>}
 */
class Generator implements GeneratorInterface
{
    public const NAMESPACE_BASE = 'JoliCode\StructuredData\Vocabularies\Generated\Google';

    public function __construct(
        private readonly BuilderFactory $factory = new BuilderFactory(),
        private readonly GoogleFilesystem $googleFilesystem = new GoogleFilesystem(),
    ) {
    }

    public function generate(?SymfonyStyle $io = null): void
    {
        foreach ($this->decodeJson($io) as $json) {
            $expectedClassNames = $this->getExpectedClassNames($json);
            $writtenClassNames = $this->googleFilesystem->writeClass($this->generateClasses($json));

            $missingClassNames = array_diff($expectedClassNames, $writtenClassNames);

            if ([] !== $missingClassNames) {
                throw new \RuntimeException(\sprintf('Google generator did not write expected class(es): %s', implode(', ', $missingClassNames)));
            }
        }

        (new StaticFileGenerator())->generate();
    }

    public static function getName(): string
    {
        return 'google';
    }

    /**
     * @return \Generator<int, GoogleFile>
     */
    private function decodeJson(?SymfonyStyle $io = null): \Generator
    {
        $jsonFiles = $this->googleFilesystem->getJsonFiles();

        foreach ($jsonFiles as $file) {
            $content = json_decode($file->getContents(), true);

            if (!\is_array($content)) {
                if ($io) {
                    $io->error(\sprintf('Failed to decode the following Google json file: %s. Error is: %s', $file->getRealPath(), json_last_error_msg()));
                }

                continue;
            }

            // The hand-written files follow the shape documented in their README,
            // which the infrastructure tests enforce.
            /** @var GoogleFile $googleFile */
            $googleFile = $content;

            yield $googleFile;
        }
    }

    /**
     * @param GoogleFile $json
     *
     * @return \Generator<int, array{Stmt\Namespace_, string}>
     */
    private function generateClasses(array $json): \Generator
    {
        if (\array_key_exists('subtypes', $json)) {
            $json = $json['subtypes'];

            yield from $this->generateAbstractClass($json);

            foreach ($json as $type) {
                yield from $this->generateClass($type, true);
            }
        } else {
            yield from $this->generateClass($json);
        }
    }

    /**
     * @param GoogleDefinition $type
     *
     * @return \Generator<int, array{Stmt\Namespace_, string}>
     */
    private function generateClass(array $type, bool $hasMultipleDefinitions = false): \Generator
    {
        $properties = BuilderHelpers::normalizeValue($type['properties'] ?? []);
        $this->markArraysAsMultiline($properties);

        foreach ($type['supportedTypes'] as $currentType) {
            $node = $this->factory->namespace(self::NAMESPACE_BASE);

            $name = $hasMultipleDefinitions ? ucfirst($currentType) . ucfirst($type['subtype'] ?? '') : ucfirst($currentType);

            $class = $this->factory
                ->class($name)
                ->makeFinal()
                ->addStmts([
                    $this->factory->classConst('SUPPORTED_TYPES', $type['supportedTypes'])
                        ->makePublic(),
                    $this->factory->classConst('DOCUMENTATION', $type['documentation'] ?? null)
                        ->makePublic(),
                    $this->factory->classConst('SPECIAL_RULE_KEYS', $type['specialRules'] ?? [])
                        ->makePublic(),
                    $this->factory->classConst('PROPERTIES', $properties)
                        ->makePublic(),
                ]);

            if ($hasMultipleDefinitions) {
                $class->extend(ucfirst($type['name']));
            }

            $node->addStmt($class);

            yield [$node->getNode(), $name];
        }
    }

    private function markArraysAsMultiline(Expr $value): void
    {
        if (!$value instanceof Array_) {
            return;
        }

        $value->setAttribute('force_multiline', true);

        foreach ($value->items as $item) {
            if ($item->key instanceof Expr) {
                $this->markArraysAsMultiline($item->key);
            }

            $this->markArraysAsMultiline($item->value);
        }
    }

    /**
     * @param GoogleFile $json
     *
     * @return array<string>
     */
    private function getExpectedClassNames(array $json): array
    {
        $names = [];

        if (\array_key_exists('subtypes', $json)) {
            foreach ($json['subtypes'] as $type) {
                foreach ($type['supportedTypes'] as $supportedType) {
                    $names[] = ucfirst($supportedType) . ucfirst($type['subtype'] ?? '');
                }
            }

            return array_values(array_unique($names));
        }

        foreach ($json['supportedTypes'] as $supportedType) {
            $names[] = ucfirst($supportedType);
        }

        return array_values(array_unique($names));
    }

    /**
     * @param list<GoogleDefinition> $json
     *
     * @return \Generator<int, array{Stmt\Namespace_, string}>
     */
    private function generateAbstractClass(array $json): \Generator
    {
        $name = ucfirst($json[0]['name']);
        $children = [];

        foreach ($json as $item) {
            $children[] = ucfirst($item['name']) . ucfirst($item['subtype'] ?? '');
        }

        $node = $this->factory->namespace(self::NAMESPACE_BASE);

        $class = $this->factory
            ->class($name)
            ->makeAbstract()
            ->addStmts([
                $this->factory->classConst('NAME', $name)
                   ->makePublic(),
                $this->factory->classConst('CHILDREN', $children)
                   ->makePublic(),
            ]);

        $node->addStmt($class);

        yield [$node->getNode(), $name];
    }
}
