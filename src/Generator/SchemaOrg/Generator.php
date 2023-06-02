<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Generator\SchemaOrg;

use Jolicode\JsonLd\Generator\SchemaOrg\Types\AsbtractSchemaOrgElement;
use Jolicode\JsonLd\Generator\SchemaOrg\Types\ElementsContainer;
use Jolicode\JsonLd\Generator\SchemaOrg\Types\EnumerationMember;
use Jolicode\JsonLd\Generator\SchemaOrg\Types\Property;
use Jolicode\JsonLd\Generator\SchemaOrg\Types\Type;
use PhpParser\BuilderFactory;
use PhpParser\Node\Expr;
use PhpParser\Node\Scalar;
use PhpParser\Node\Stmt;
use PhpParser\PrettyPrinter\Standard;
use Symfony\Component\Filesystem\Filesystem;

class Generator
{
    public function writeFile(ElementsContainer $container, Filesystem $filesystem, Standard $printer): void
    {
        foreach ($container->getAllElements() as $element) {
            $classDirectory = match ($element::class) {
                Type::class => 'Type',
                Property::class => 'Property',
                EnumerationMember::class => 'EnumerationMember',
                default => throw new \RuntimeException(sprintf('Unknown class %s', $element::class)),
            };

            $fileName = sprintf(
                '%s/%s/%s.php',
                Extractor::GENERATED_DIR,
                $classDirectory,
                $element->className
            );

            $filesystem->dumpFile(
                $fileName,
                $printer->prettyPrintFile([$this->generate($element)])
            );
        }
    }

    private function generate(Type|Property|EnumerationMember $element): Stmt\Namespace_
    {
        return match ($element::class) {
            Type::class => $this->generateType($element),
            Property::class => $this->generateProperty($element),
            EnumerationMember::class => $this->generateEnumerationMember($element),
            default => throw new \RuntimeException(sprintf('Unknown class %s', $element::class)),
        };
    }

    private function generateType(Type $type): Stmt\Namespace_
    {
        $factory = new BuilderFactory();

        $node = $factory
            ->namespace('SchemaOrg\\Type')
            ->addStmt($factory->use('SchemaOrg\\Property'));

        $constructor = $factory->method('__construct')
            ->makePublic();

        $class = $factory
            ->class($type->className)
            ->makeFinal()
            ->addStmt(
                $factory->classConst('DESCRIPTION', $type->description)
                    ->makePublic()
            )
            ->addStmt(
                $factory->classConst('LABEL', $type->label)
                    ->makePublic()
            )
            ->addStmt(
                $factory->classConst('NAME', $type->name)
                    ->makePublic()
            );

        usort($type->properties, fn (Property $a, Property $b) => $a->label <=> $b->label);

        foreach ($type->properties as $property) {
            $constructor->addParam(
                $factory->param($property->label)
                    ->makePublic()
                    ->setType(sprintf('?Property\\%s', $property->className))
                    ->setDefault(null)
            );
        }

        $enumerationMembers = [];

        foreach ($type->enumerationMembers as $enumerationMember) {
            $enumerationMembers[] = new Expr\ArrayItem(
                new Scalar\String_(sprintf('EnumerationMember\\%s', $enumerationMember->className)),
                new Scalar\String_($enumerationMember->className),
            );
        }

        /* @phpstan-ignore-next-line */
        usort($enumerationMembers, fn ($a, $b) => $a->value->value <=> $b->value->value);

        $class->addStmt(
            $factory->classConst('ENUMERATION_MEMBERS', new Expr\Array_($enumerationMembers))
                ->makePublic()
        );

        $class->addStmt($constructor);
        $node->addStmt($class);

        return $node->getNode();
    }

    private function generateProperty(Property $property): Stmt\Namespace_
    {
        $namespace = 'SchemaOrg\\Property';
        $factory = new BuilderFactory();

        $node = $factory
            ->namespace($namespace);

        $class = $factory
            ->class($property->className)
            ->makeFinal()
            ->addStmt(
                $factory->classConst('DESCRIPTION', $property->description)
                    ->makePublic()
            )
            ->addStmt(
                $factory->classConst('LABEL', $property->label)
                    ->makePublic()
            )
            ->addStmt(
                $factory->classConst('NAME', $property->name)
                    ->makePublic()
            );

        $parents = [];

        foreach ($property->parents as $parent) {
            $className = AsbtractSchemaOrgElement::getClassName($parent);
            $fqcn = sprintf('%s\\%s', $namespace, $className);
            $parents[] = new Expr\ArrayItem(
                new Scalar\String_($fqcn),
                new Scalar\String_($className),
            );
        }

        /* @phpstan-ignore-next-line */
        usort($parents, fn ($a, $b) => $a->value->value <=> $b->value->value);

        $class->addStmt(
            $factory->classConst('POSSIBLE_PARENTS', $parents)
                ->makePublic()
        );

        $node->addStmt($class);

        return $node->getNode();
    }

    private function generateEnumerationMember(EnumerationMember $enumerationMember): Stmt\Namespace_
    {
        $namespace = 'SchemaOrg\\EnumerationMember';
        $factory = new BuilderFactory();

        $node = $factory
            ->namespace($namespace);

        $class = $factory
            ->class($enumerationMember->className)
            ->makeFinal()
            ->addStmt(
                $factory->classConst('DESCRIPTION', $enumerationMember->description)
                    ->makePublic()
            )
            ->addStmt(
                $factory->classConst('LABEL', $enumerationMember->label)
                    ->makePublic()
            )
            ->addStmt(
                $factory->classConst('NAME', $enumerationMember->name)
                    ->makePublic()
            );

        $node->addStmt($class);

        return $node->getNode();
    }
}
