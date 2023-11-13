<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Generator\Google;

use Jolicode\JsonLd\Generator\GeneratorInterface;
use Jolicode\JsonLd\Generator\Google\Objects\MainType;
use Jolicode\JsonLd\Generator\Google\Objects\PropertyType;
use PhpParser\Builder;
use PhpParser\BuilderFactory;
use PhpParser\Node\Stmt;
use PhpParser\PrettyPrinter\Standard;
use Symfony\Component\Filesystem\Filesystem;

class Generator implements GeneratorInterface
{
    private const NAMESPACE_BASE = 'Google';

    public function __construct(
        private readonly BuilderFactory $factory = new BuilderFactory(),
        private readonly Filesystem $filesystem = new Filesystem(),
        private readonly Standard $printer = new Standard(),

        /**
         * @var array<string, MainType>
         */
        private array $types = [],

        private ?string $currentNamespace = null,
        private ?string $currentFilename = null,
    ) {
    }

    public function generate(bool $refresh): void
    {
        $extractor = new Extractor($this->filesystem);

        $this->types = $extractor->extractClasses($refresh);
        $this->filesystem->remove(Extractor::GENERATED_DIR);

        $this->generateClasses();
    }

    private function generateClasses(): void
    {
        foreach ($this->types as $type) {
            $this->currentNamespace = sprintf('%s\\%s', self::NAMESPACE_BASE, $type->name);
            $this->currentFilename = sprintf(
                '%s/%s/%s',
                Extractor::GENERATED_DIR,
                $type->name,
                $type->name,
            );

            $this->writeFullType($type);
        }
    }

    private function writeFullType(MainType|PropertyType $type): void
    {
        $namespace = $this->currentNamespace;
        $filename = $this->currentFilename . '.php';

        $this->filesystem->dumpFile(
            $filename,
            $this->printer->prettyPrintFile([$this->generateType($type, $namespace)])
        );
    }

    private function generateType(MainType|PropertyType $type, string $namespace): Stmt\Namespace_
    {
        $node = $this->factory
            ->namespace($namespace);

        $class = $this->factory
            ->class($type->name)
            ->makeFinal();

        $class->addStmt(
            $this->factory->classConst('NAME', $type->name)
                ->makePublic()
        );

        $requiredProperties = $this->formatTypeProperties($type->requiredProperties);
        $recommendedProperties = $this->formatTypeProperties($type->recommendedProperties);

        if ($type instanceof MainType) {
            if (\count($type->subTypes)) {
                $this->generateSubTypes($type, $class);
            }

            $class->addStmt(
                $this->factory->classConst('TYPES', $type->multipleTypes)
                    ->makePublic()
            );

            $class->addStmt(
                $this->factory->classConst('DOCUMENTATION_URL', $type->documentationUrl)
                    ->makePublic()
            );

            $class->addStmt(
                $this->factory->classConst('IS_A_SUBTYPE', $type->isASubtype)
                    ->makePublic()
            );

            if ($type->parentType) {
                $parentFQCN = str_replace('Subtypes', $type->parentType->name, $this->currentNamespace);

                $class->addStmt(
                    $this->factory->classConst('PARENT_TYPE', $parentFQCN)
                        ->makePublic()
                );
            }

            $class->addStmt(
                $this->factory->classConst('IS_CAROUSEL_ELIGIBLE', $type->isCarouselEligible)
                    ->makePublic()
            );

            if ($type->carousel) {
                $this->generateCarousel($type->carousel, $class);
            }

            if ($type->dependsOn) {
                $additionalRequiredProperties = $this->types[$type->dependsOn]->requiredProperties;
                $additionalRequiredProperties = $this->formatTypeProperties($additionalRequiredProperties);

                $additionalRecommendedProperties = $this->types[$type->dependsOn]->recommendedProperties;
                $additionalRecommendedProperties = $this->formatTypeProperties($additionalRecommendedProperties);

                $requiredProperties = array_merge($requiredProperties, $additionalRequiredProperties);
                $recommendedProperties = array_merge($recommendedProperties, $additionalRecommendedProperties);
            }
        }

        $class->addStmt(
            $this->factory->classConst('REQUIRED_PROPERTIES', $requiredProperties)
                ->makePublic()
        );

        $class->addStmt(
            $this->factory->classConst('RECOMMENDED_PROPERTIES', $recommendedProperties)
                ->makePublic()
        );

        $node->addStmt($class);

        return $node->getNode();
    }

    private function formatTypeProperties(array $properties): array
    {
        $formattedProperties = [];

        foreach ($properties as $property) {
            foreach ($property->types as $type) {
                $formattedProperties[$property->name][] = $type->name;

                if (\count($type->requiredProperties) || \count($type->recommendedProperties)) {
                    $previousNamespace = $this->currentNamespace;
                    $previousFilename = $this->currentFilename;

                    $newFilename = $this->removeFilenameParentName($this->currentFilename);

                    $propertyName = ucfirst($property->name);

                    $this->currentNamespace = sprintf('%s\\%s\\%s', $previousNamespace, $propertyName, $type->name);
                    $this->currentFilename = sprintf('%s/%s/%s', $newFilename, $propertyName, $type->name);

                    $this->writeFullType($type);

                    $this->currentNamespace = $previousNamespace;
                    $this->currentFilename = $previousFilename;
                }
            }
        }

        return $formattedProperties;
    }

    private function generateSubTypes(MainType $type, Builder\Class_ $class): void
    {
        $subTypes = [];

        $previousNamespace = $this->currentNamespace;
        $previousFilename = $this->currentFilename;

        foreach ($type->subTypes as $subType) {
            $newNamespace = sprintf('%s\\Subtypes', $previousNamespace);
            $newFilename = $this->removeFilenameParentName($previousFilename);
            $newFilename = sprintf('%s/Subtypes/%s', $newFilename, $subType->name);

            $this->currentNamespace = $newNamespace;
            $this->currentFilename = $newFilename;

            $subTypes[$subType->name] = $newNamespace . '\\' . $subType->name;

            $this->writeFullType($subType);

            $this->currentNamespace = $previousNamespace;
            $this->currentFilename = $previousFilename;
        }

        $class->addStmt(
            $this->factory->classConst('SUB_TYPES', $subTypes)
                ->makePublic()
        );
    }

    private function generateCarousel(PropertyType $carousel, Builder\Class_ $class): void
    {
        $previousNamespace = $this->currentNamespace;
        $previousFilename = $this->currentFilename;

        $newNamespace = sprintf('%s\\Carousel', $previousNamespace);
        $newFilename = $this->removeFilenameParentName($previousFilename);
        $newFilename = sprintf('%s/Carousel/Carousel', $newFilename);

        $this->currentNamespace = $newNamespace;
        $this->currentFilename = $newFilename;

        $this->writeFullType($carousel);

        $this->currentNamespace = $previousNamespace;
        $this->currentFilename = $previousFilename;

        $class->addStmt(
            $this->factory->classConst('CAROUSEL', sprintf('%s\\Carousel', $newNamespace))
                ->makePublic()
        );
    }

    private function removeFilenameParentName(string $filename): string
    {
        $filename = explode('/', $filename);
        $filename = \array_slice($filename, 0, \count($filename) - 1);
        $filename = implode('/', $filename);

        return $filename;
    }
}
