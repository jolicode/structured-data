<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generators\Google;

use Jolicode\Vocabularies\Generators\GeneratorInterface;
use Jolicode\Vocabularies\Generators\Google\Filesystem as GoogleFilesystem;
use Jolicode\Vocabularies\Generators\StaticFileGenerator;
use PhpParser\BuilderFactory;
use PhpParser\BuilderHelpers;
use PhpParser\Node\Expr;
use PhpParser\Node\Expr\Array_;
use PhpParser\Node\Stmt;
use Symfony\Component\Console\Style\SymfonyStyle;

class Generator implements GeneratorInterface
{
    public const NAMESPACE_BASE = 'Jolicode\Vocabularies\Generated\Google';

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

    private function decodeJson(?SymfonyStyle $io = null): \Generator
    {
        $jsonFiles = $this->googleFilesystem->getJsonFiles();

        foreach ($jsonFiles as $file) {
            $content = json_decode($file->getContents(), true);

            if (null === $content) {
                if ($io) {
                    $io->error(\sprintf('Failed to decode the following Google json file: %s. Error is: %s', $file->getRealPath(), json_last_error_msg()));
                }

                continue;
            }

            yield $content;
        }
    }

    /**
     * @return \Generator<Stmt\Namespace_>
     */
    private function generateClasses(array $json): \Generator
    {
        if ($hasMultipleDefinitions = \array_key_exists('subtypes', $json)) {
            $json = $json['subtypes'];

            yield from $this->generateAbstractClass($json);

            foreach ($json as $type) {
                yield from $this->generateClass($type, $hasMultipleDefinitions);
            }
        } else {
            yield from $this->generateClass($json);
        }
    }

    private function generateClass(array $type, bool $hasMultipleDefinitions = false): \Generator
    {
        $properties = BuilderHelpers::normalizeValue($type['properties'] ?? []);
        $this->markArraysAsMultiline($properties);

        foreach ($type['supportedTypes'] as $currentType) {
            $node = $this->factory->namespace(self::NAMESPACE_BASE);

            $name = $hasMultipleDefinitions ? ucfirst($currentType) . ucfirst($type['subtype']) : ucfirst($currentType);

            $class = $this->factory
                ->class($name)
                ->makeFinal()
                ->addStmts([
                    $this->factory->classConst('NAME', $name)
                        ->makePublic(),
                    $this->factory->classConst('SUPPORTED_TYPES', $type['supportedTypes'])
                        ->makePublic(),
                    $this->factory->classConst('VALUE', $type['value'] ?? [])
                        ->makePublic(),
                    $this->factory->classConst('DOCUMENTATION', $type['documentation'] ?? null)
                        ->makePublic(),
                    $this->factory->classConst('SUBTYPE', $type['subtype'] ?? null)
                        ->makePublic(),
                    $this->factory->classConst('HAS_SPECIAL_RULES', !empty($type['specialRules']))
                        ->makePublic(),
                    $this->factory->classConst('SPECIAL_RULE_KEYS', $type['specialRules'] ?? [])
                        ->makePublic(),
                    $this->factory->classConst('IS_CAROUSEL_ELIGIBLE', $type['isCarouselEligible'] ?? false)
                        ->makePublic(),
                    $this->factory->classConst('CAROUSEL_PROPERTIES', $type['carouselProperties'] ?? [])
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
            if (null === $item) {
                continue;
            }

            if ($item->key instanceof Expr) {
                $this->markArraysAsMultiline($item->key);
            }

            if ($item->value instanceof Expr) {
                $this->markArraysAsMultiline($item->value);
            }
        }
    }

    /**
     * @return array<string>
     */
    private function getExpectedClassNames(array $json): array
    {
        $names = [];

        if (\array_key_exists('subtypes', $json)) {
            foreach ($json['subtypes'] as $type) {
                foreach (($type['supportedTypes'] ?? []) as $supportedType) {
                    $names[] = ucfirst($supportedType) . ucfirst($type['subtype'] ?? '');
                }
            }

            return array_values(array_unique($names));
        }

        foreach (($json['supportedTypes'] ?? []) as $supportedType) {
            $names[] = ucfirst($supportedType);
        }

        return array_values(array_unique($names));
    }

    /**
     * @return \Generator<Stmt\Namespace_>
     */
    private function generateAbstractClass(array $json): \Generator
    {
        $name = ucfirst($json[0]['name']);
        $children = [];

        array_walk(
            $json,
            static function (array $item) use (&$children) {
                $children[] = ucfirst($item['name']) . ucfirst($item['subtype']);
            },
        );

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
