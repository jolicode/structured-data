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

use PhpParser\Node\Name;
use PhpParser\Node\Stmt;
use PhpParser\PrettyPrinter\Standard;
use Symfony\Component\Filesystem\Filesystem;
use Jolicode\JsonLd\Generator\SchemaOrg\Extractor;
use Jolicode\JsonLd\Generator\SchemaOrg\Types\Type;
use Jolicode\JsonLd\Generator\SchemaOrg\Types\Property;
use Jolicode\JsonLd\Generator\SchemaOrg\Types\ElementsContainer;
use Jolicode\JsonLd\Generator\SchemaOrg\Types\EnumerationMember;
use Jolicode\JsonLd\Generator\SchemaOrg\Types\AsbtractSchemaOrgElement;
use PhpParser\BuilderFactory;

class Generator
{
    public function writeFile(ElementsContainer $container, Filesystem $filesystem, Standard $printer): void
    {
        foreach ($container->getAllElements() as $element) {
            if (\count($element->enumerationMembers) > 0 && \count($element->properties) < 30) {
                dd($element);
            }

            $classDirectory = match (true) {
                $element instanceof Type => 'Type',
                $element instanceof Property => 'Property',
                $element instanceof EnumerationMember => 'EnumerationMember',
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

            die();
        }
    }

    private function generate(AsbtractSchemaOrgElement $element): Stmt\Namespace_
    {
        return match (true) {
            $element instanceof Type => $this->generateType($element),
            $element instanceof Property => $this->generateProperty($element),
            $element instanceof EnumerationMember => $this->generateEnumerationMember($element),
        };
    }

    private function generateType(Type $type): Stmt\Namespace_
    {
        $factory = new BuilderFactory();

        $node = $factory
            ->namespace('SchemaOrg\\Type')
            ->addStmt($factory->use('SchemaOrg\\Property'));

        $class = $factory
            ->class($type->className)
            ->makeFinal()
            ->makeReadonly()
            ->addStmt(
                $factory->classConst('NAME', $type->name)
                    ->makePublic()
            )
            ->addStmt(
                $factory->classConst('DESCRIPTION', $type->description)
                    ->makePublic()
            )
            ->addStmt(
                $factory->classConst('LABEL', $type->label)
                    ->makePublic()
            );

        usort($type->properties, fn (Property $a, Property $b) => $a->label <=> $b->label);

        $constructor = $factory->method('__construct')
            ->makePublic();

        foreach ($type->properties as $property) {
            $constructor->addParam(
                $factory->property($property->label)
                    ->makePublic()
                    ->setType(sprintf('Property\\%s', $property->className))
            );
        }

        $node->addStmt($class);

        return $node->getNode();
    }

    private function generateProperty(Property $property): Stmt\Namespace_
    {
        $statements = [];
        $extends = [];

        $subNodes = [
            'stmts' => $statements,
            'extends' => $extends,
        ];

        $class = new Stmt\Class_(new Name($property->label), $subNodes);

        return new Stmt\Namespace_(new Name('SchemaOrg\\Property'), [$class]);
    }

    private function generateEnumerationMember(EnumerationMember $enumerationMember): Stmt\Namespace_
    {
        $statements = [];
        $extends = [];

        $subNodes = [
            'stmts' => $statements,
            'extends' => $extends,
        ];

        $class = new Stmt\Class_(new Name($enumerationMember->label), $subNodes);

        return new Stmt\Namespace_(new Name('SchemaOrg\\EnumerationMember'), [$class]);
    }
}
