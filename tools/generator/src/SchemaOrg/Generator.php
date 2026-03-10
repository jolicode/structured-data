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

use Jolicode\JsonLd\Generator\Filesystem;
use Jolicode\JsonLd\Generator\GeneratorInterface;
use Jolicode\JsonLd\Generator\SchemaOrg\Objects\AbstractSchemaOrgElement;
use Jolicode\JsonLd\Generator\SchemaOrg\Objects\ClassesContainer;
use Jolicode\JsonLd\Generator\SchemaOrg\Objects\EnumerationMember;
use Jolicode\JsonLd\Generator\SchemaOrg\Objects\Property;
use Jolicode\JsonLd\Generator\SchemaOrg\Objects\Type;
use PhpParser\Builder\Class_;
use PhpParser\BuilderFactory;
use PhpParser\Node\ArrayItem;
use PhpParser\Node\Expr;
use PhpParser\Node\Scalar;
use PhpParser\Node\Stmt;
use PhpParser\PrettyPrinter\Standard;
use Symfony\Component\DomCrawler\Crawler;

readonly class Generator implements GeneratorInterface
{
    private const NAMESPACE_TYPE = 'Jolicode\\SchemaOrg\\Type';
    private const NAMESPACE_PROPERTY = 'Jolicode\\SchemaOrg\\Property';
    private const NAMESPACE_ENUMERATION_MEMBER = 'Jolicode\\SchemaOrg\\EnumerationMember';

    public function __construct(
        private BuilderFactory $factory = new BuilderFactory(),
        private Filesystem $filesystem = new Filesystem(),
        private Standard $printer = new Standard(),
    ) {
    }

    public function getName(): string
    {
        return 'schema.org';
    }

    public function generate(): void
    {
        $extractor = new Extractor();
        $this->generateClasses($extractor->extractClasses());
    }

    public function generateExamples(string $schemaOrgExamples): void
    {
        $crawler = new Crawler($schemaOrgExamples);
        $crawler
            ->filter('script[type^=application]')
            ->each(function (Crawler $example, $i) {
                $example = trim($example->outerHtml());
                $this->saveExample('https-schema-org', $example);
            });
    }

    private function generateClasses(ClassesContainer $container): void
    {
        foreach ($container->getAllElements() as $element) {
            $type = match ($element::class) {
                Type::class => 'Type',
                Property::class => 'Property',
                EnumerationMember::class => 'EnumerationMember',
                default => throw new \RuntimeException(\sprintf('Unknown class %s', $element::class)),
            };

            $this->filesystem->saveSchemaOrgClass(
                $type,
                $element->className,
                $this->printer->prettyPrintFile([$this->generateElement($element)]),
            );
        }
    }

    private function saveExample(string $prefix, string $example): void
    {
        if (preg_match('/\<script type\=\"application\/ld\+json\"\>(.*)\<\/script\>/s', $example, $matches)) {
            $content = $this->removeComments($matches[1]);
            $this->filesystem->saveSchemaOrgExample($prefix, $content);
        } elseif ($this->maybeJsonString($example)) {
            $this->filesystem->saveSchemaOrgExample($prefix, $example);
        }
    }

    private function removeComments(string $example): string
    {
        $example = explode("\n", $example);

        foreach ($example as $line => $content) {
            if (str_starts_with(trim($content), '//')) {
                unset($example[$line]);
            }
        }

        return trim(implode("\n", $example));
    }

    private function maybeJsonString(string $body): bool
    {
        return \in_array(substr(trim($body), 0, 1), ['[', '{'], true);
    }

    private function generateElement(Type|Property|EnumerationMember $element): Stmt\Namespace_
    {
        return match ($element::class) {
            Type::class => $this->generateType($element),
            Property::class => $this->generateProperty($element),
            EnumerationMember::class => $this->generateEnumerationMember($element),
            default => throw new \RuntimeException(\sprintf('Unknown class %s', $element::class)),
        };
    }

    private function generateType(Type $type): Stmt\Namespace_
    {
        $node = $this->factory
            ->namespace(self::NAMESPACE_TYPE)
            ->addStmt($this->factory->use(self::NAMESPACE_PROPERTY));

        $constructor = $this->factory->method('__construct')
            ->makePublic();

        $class = $this->factory
            ->class($type->className)
            ->makeFinal()
            ->addStmt(
                $this->factory->classConst('DESCRIPTION', $type->description)
                    ->makePublic(),
            )
            ->addStmt(
                $this->factory->classConst('LABEL', $type->label)
                    ->makePublic(),
            )
            ->addStmt(
                $this->factory->classConst('NAME', $type->name)
                    ->makePublic(),
            );

        /* ADD THE PROPERTIES */
        usort($type->properties, static fn (Property $a, Property $b) => $a->label <=> $b->label);

        foreach ($type->properties as $property) {
            $constructor->addParam(
                $this->factory->param($property->label)
                    ->makePublic()
                    ->setType(\sprintf('?Property\\%s', $property->className))
                    ->setDefault(null),
            );
        }

        /** ADD THE PARENTS */
        $parents = [];

        foreach ($type->parents as $parent) {
            $className = AbstractSchemaOrgElement::getClassName($parent);
            $fqcn = \sprintf('%s\\%s', self::NAMESPACE_TYPE, $className);
            $parents[] = new ArrayItem(
                new Scalar\String_($fqcn),
                new Scalar\String_($className),
            );
        }

        /* @phpstan-ignore-next-line */
        usort($parents, static fn ($a, $b) => $a->value->value <=> $b->value->value);

        $class->addStmt(
            $this->factory->classConst('PARENTS', new Expr\Array_($parents))
                ->makePublic(),
        );

        /** ADD THE ENUMERATION MEMBERS */
        $enumerationMembers = [];

        foreach ($type->enumerationMembers as $enumerationMember) {
            $enumerationMembers[] = new ArrayItem(
                new Scalar\String_(\sprintf('EnumerationMember\\%s', $enumerationMember->className)),
                new Scalar\String_($enumerationMember->className),
            );
        }

        /* @phpstan-ignore-next-line */
        usort($enumerationMembers, static fn ($a, $b) => $a->value->value <=> $b->value->value);

        $class->addStmt(
            $this->factory->classConst('ENUMERATION_MEMBERS', new Expr\Array_($enumerationMembers))
                ->makePublic(),
        );

        $class = $this->addSchemaInformation($class, $type);
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
                    ->makePublic(),
            )
            ->addStmt(
                $this->factory->classConst('LABEL', $property->label)
                    ->makePublic(),
            )
            ->addStmt(
                $this->factory->classConst('NAME', $property->name)
                    ->makePublic(),
            );

        $possibleValues = [];

        foreach ($property->possibleValues as $value) {
            $className = AbstractSchemaOrgElement::getClassName($value);
            $fqcn = \sprintf('%s\\%s', self::NAMESPACE_TYPE, $className);
            $possibleValues[] = new ArrayItem(
                new Scalar\String_($fqcn),
                new Scalar\String_($className),
            );
        }

        /* @phpstan-ignore-next-line */
        usort($possibleValues, static fn ($a, $b) => $a->value->value <=> $b->value->value);

        $class->addStmt(
            $this->factory->classConst('VALUES', new Expr\Array_($possibleValues))
                ->makePublic(),
        );

        $possibleTypes = [];

        foreach ($property->possibleTypes as $type) {
            $className = AbstractSchemaOrgElement::removeSchemaPrefix($type);
            $fqcn = \sprintf('%s\\%s%s', self::NAMESPACE_TYPE, $className, 'Model');
            $possibleTypes[] = new ArrayItem(
                new Scalar\String_($fqcn),
                new Scalar\String_($className),
            );
        }

        /* @phpstan-ignore-next-line */
        usort($possibleTypes, static fn ($a, $b) => $a->value->value <=> $b->value->value);

        $class->addStmt(
            $this->factory->classConst('TYPES', new Expr\Array_($possibleTypes))
                ->makePublic(),
        );

        $class = $this->addSchemaInformation($class, $property);
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
                    ->makePublic(),
            )
            ->addStmt(
                $this->factory->classConst('LABEL', $enumerationMember->label)
                    ->makePublic(),
            )
            ->addStmt(
                $this->factory->classConst('NAME', $enumerationMember->name)
                    ->makePublic(),
            );

        $class = $this->addSchemaInformation($class, $enumerationMember);
        $node->addStmt($class);

        return $node->getNode();
    }

    private function addSchemaInformation(Class_ $class, AbstractSchemaOrgElement $element): Class_
    {
        $metadata = [
            'IS_PART_OF' => $element->isPartOf,
            'SOURCE' => $element->source,
        ];

        foreach ($metadata as $key => $value) {
            usort($value, static fn ($a, $b) => $a <=> $b);
            $class->addStmt(
                $this->factory->classConst($key, $value)
                    ->makePublic(),
            );
        }

        return $class;
    }
}
