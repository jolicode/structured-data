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

use Jolicode\JsonLd\Algorithms\JsonLd\Keyword;
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
            $className = $this->defineClassName($type);

            $this->currentNamespace = sprintf('%s\\%s', self::NAMESPACE_BASE, $className);
            $this->currentFilename = sprintf(
                '%s/%s/%s',
                Extractor::GENERATED_DIR,
                $className,
                $className,
            );

            $this->writeFullType($type, $className);
        }
    }

    private function writeFullType(MainType|PropertyType $type, string $className): void
    {
        $namespace = $this->currentNamespace;
        $filename = $this->currentFilename . '.php';

        $this->filesystem->dumpFile(
            $filename,
            $this->printer->prettyPrintFile([$this->generateType($type, $namespace, $className)])
        );
    }

    private function generateType(MainType|PropertyType $type, string $namespace, string $className): Stmt\Namespace_
    {
        $node = $this->factory
            ->namespace($namespace);

        $class = $this->factory
            ->class($className)
            ->makeFinal();

        $class->addStmt(
            $this->factory->classConst('NAME', $type->name)
                ->makePublic()
        );

        $requiredProperties = $this->generateTypeProperties($type->requiredProperties);
        $recommendedProperties = $this->generateTypeProperties($type->recommendedProperties);

        if ($type instanceof MainType) {
            if (\count($type->subTypes)) {
                $this->generateSubTypes($type, $class);
            }

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
                $additionalRequiredProperties = $this->generateTypeProperties($additionalRequiredProperties);

                $additionalRecommendedProperties = $this->types[$type->dependsOn]->recommendedProperties;
                $additionalRecommendedProperties = $this->generateTypeProperties($additionalRecommendedProperties);

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

    private function generateTypeProperties(array $properties): array
    {
        $formattedProperties = [];

        foreach ($properties as $property) {
            if (\count($property->atLeastOneOf)) {
                $atLeastOneOf = [];

                array_walk(
                    $property->atLeastOneOf,
                    function (PropertyType $type) use (&$atLeastOneOf, &$formattedProperties, $property) {
                        $atLeastOneOf[$type->name] = array_keys($property->types);

                        if (!\array_key_exists($type->name, $formattedProperties)) {
                            $formattedProperties[$type->name] = $atLeastOneOf[$type->name];
                        }
                    }
                );

                $formattedProperties['atLeastOneOf'] = $atLeastOneOf;
                unset($properties['atLeastOneOf']);

                continue;
            }

            foreach ($property->types as $type) {
                if (Keyword::tryFrom($property->name)) {
                    // We skip keywords... They are not Google properties.
                    continue;
                }

                $formattedProperties[$property->name][] = $type->name;

                if (\count($type->requiredProperties) || \count($type->recommendedProperties)) {
                    $previousNamespace = $this->currentNamespace;
                    $previousFilename = $this->currentFilename;

                    $newFilename = $this->removeFilenameParentName($this->currentFilename);

                    $type->name = $this->toPascalCase($type->name);
                    $propertyName = ucfirst($property->name);
                    $className = $this->defineClassName($type);

                    $this->currentNamespace = sprintf('%s\\%s', $previousNamespace, $propertyName);
                    $this->currentFilename = sprintf('%s/%s/%s', $newFilename, $propertyName, $className);

                    $this->writeFullType($type, $className);

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
            $className = $this->defineClassName($subType);

            $newNamespace = sprintf('%s\\Subtypes', $previousNamespace);
            $newFilename = $this->removeFilenameParentName($previousFilename);
            $newFilename = sprintf('%s/Subtypes/%s', $newFilename, $className);

            $this->currentNamespace = $newNamespace;
            $this->currentFilename = $newFilename;

            $subTypes[$className] = $newNamespace . '\\' . $className;

            $this->writeFullType($subType, $className);

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

        $this->writeFullType($carousel, 'Carousel');

        $this->currentNamespace = $previousNamespace;
        $this->currentFilename = $previousFilename;

        $class->addStmt(
            $this->factory->classConst('CAROUSEL', sprintf('%s\\Carousel', $newNamespace))
                ->makePublic()
        );
    }

    private function defineClassName(MainType|PropertyType $type): string
    {
        $className = $type->name;

        // For nor only main types may have multiple types, but we should keep an eye on it;
        if ($type instanceof MainType && \count($type->multipleTypes)) {
            // It is way easier concatenating the multiple types in the class name.
            // The class name will be weird but the original name will be kept in $type->name and sent to the front.
            $className = implode(' ', $type->multipleTypes);
        }

        return $this->toPascalCase($className);
    }

    private function toPascalCase(string $string): string
    {
        $string = explode(' ', $string);
        array_walk($string, fn (string & $word) => $word = ucfirst($word));
        $string = implode('', $string);

        return $string;
    }

    private function removeFilenameParentName(string $filename): string
    {
        $filename = explode('/', $filename);
        $filename = \array_slice($filename, 0, \count($filename) - 1);
        $filename = implode('/', $filename);

        return $filename;
    }
}
