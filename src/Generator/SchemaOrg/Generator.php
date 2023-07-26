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

use Jolicode\JsonLd\Generator\GeneratorInterface;
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

readonly class Generator implements GeneratorInterface
{
    private const NAMESPACE_TYPE = 'SchemaOrg\\Type';
    private const NAMESPACE_PROPERTY = 'SchemaOrg\\Property';
    private const NAMESPACE_ENUMERATION_MEMBER = 'SchemaOrg\\EnumerationMember';

    public function __construct(
        private BuilderFactory $factory = new BuilderFactory(),
        private Filesystem $filesystem = new Filesystem(),
        private Standard $printer = new Standard(),
    ) {
    }

    public function generate(bool $refresh): void
    {
        $extractor = new Extractor(
            $this->filesystem,
            $this->printer,
        );

        $this->writeFile($extractor->extract($refresh));
    }

    private function writeFile(ElementsContainer $container): void
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

            $this->filesystem->dumpFile(
                $fileName,
                $this->printer->prettyPrintFile([$this->generateElement($element)])
            );
        }
    }

    private function generateElement(Type|Property|EnumerationMember $element): Stmt\Namespace_
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
        $node = $this->factory
            ->namespace(self::NAMESPACE_TYPE)
            ->addStmt($this->factory->use('SchemaOrg\\Property'));

        $constructor = $this->factory->method('__construct')
            ->makePublic();

        $class = $this->factory
            ->class($type->className)
            ->makeFinal()
            ->addStmt(
                $this->factory->classConst('DESCRIPTION', $type->description)
                    ->makePublic()
            )
            ->addStmt(
                $this->factory->classConst('LABEL', $type->label)
                    ->makePublic()
            )
            ->addStmt(
                $this->factory->classConst('NAME', $type->name)
                    ->makePublic()
            );

        /* ADD THE PROPERTIES */
        usort($type->properties, fn (Property $a, Property $b) => $a->label <=> $b->label);

        foreach ($type->properties as $property) {
            $constructor->addParam(
                $this->factory->param($property->label)
                    ->makePublic()
                    ->setType(sprintf('?Property\\%s', $property->className))
                    ->setDefault(null)
            );
        }

        /** ADD THE PARENTS */
        $parents = [];

        foreach ($type->parents as $parent) {
            $className = AsbtractSchemaOrgElement::getClassName($parent);
            $fqcn = sprintf('%s\\%s', self::NAMESPACE_TYPE, $className);
            $parents[] = new Expr\ArrayItem(
                new Scalar\String_($fqcn),
                new Scalar\String_($className),
            );
        }

        /* @phpstan-ignore-next-line */
        usort($parents, fn ($a, $b) => $a->value->value <=> $b->value->value);

        $class->addStmt(
            $this->factory->classConst('PARENTS', $parents)
                ->makePublic()
        );

        /** ADD THE ENUMERATION MEMBERS */
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
            $this->factory->classConst('ENUMERATION_MEMBERS', new Expr\Array_($enumerationMembers))
                ->makePublic()
        );

        $class->addStmt($constructor);
        $node->addStmt($class);

        return $node->getNode();
    }

    private function generateProperty(Property $property): Stmt\Namespace_
    {
        $node = $this->factory
            ->namespace(self::NAMESPACE_PROPERTY);

        $class = $this->factory
            ->class($property->className)
            ->makeFinal()
            ->addStmt(
                $this->factory->classConst('DESCRIPTION', $property->description)
                    ->makePublic()
            )
            ->addStmt(
                $this->factory->classConst('LABEL', $property->label)
                    ->makePublic()
            )
            ->addStmt(
                $this->factory->classConst('NAME', $property->name)
                    ->makePublic()
            );

        $possibleValues = [];

        foreach ($property->possibleValues as $value) {
            $className = AsbtractSchemaOrgElement::getClassName($value);
            $fqcn = sprintf('%s\\%s', self::NAMESPACE_TYPE, $className);
            $possibleValues[] = new Expr\ArrayItem(
                new Scalar\String_($fqcn),
                new Scalar\String_($className),
            );
        }

        /* @phpstan-ignore-next-line */
        usort($possibleValues, fn ($a, $b) => $a->value->value <=> $b->value->value);

        $class->addStmt(
            $this->factory->classConst('VALUES', $possibleValues)
                ->makePublic()
        );

        $node->addStmt($class);

        return $node->getNode();
    }

    private function generateEnumerationMember(EnumerationMember $enumerationMember): Stmt\Namespace_
    {
        $node = $this->factory
            ->namespace(self::NAMESPACE_ENUMERATION_MEMBER);

        $class = $this->factory
            ->class($enumerationMember->className)
            ->makeFinal()
            ->addStmt(
                $this->factory->classConst('DESCRIPTION', $enumerationMember->description)
                    ->makePublic()
            )
            ->addStmt(
                $this->factory->classConst('LABEL', $enumerationMember->label)
                    ->makePublic()
            )
            ->addStmt(
                $this->factory->classConst('NAME', $enumerationMember->name)
                    ->makePublic()
            );

        $node->addStmt($class);

        return $node->getNode();
    }
}
