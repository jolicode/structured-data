<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Generator\SchemaOrg\Metadata;

use Jolicode\JsonLd\Generator\SchemaOrg\Extractor;
use Jolicode\JsonLd\Generator\SchemaOrg\Services\ClassTextBuilder;
use Jolicode\JsonLd\Generator\SchemaOrg\Types\ElementsContainer;
use Jolicode\JsonLd\Generator\SchemaOrg\Types\Property;
use PhpParser\Node;
use PhpParser\Node\Expr;
use PhpParser\Node\Name;
use PhpParser\Node\Scalar;
use PhpParser\Node\Stmt;
use PhpParser\PrettyPrinter\Standard;
use Symfony\Component\Filesystem\Filesystem;

class MetadataGenerator
{
    private const DESTINATION_FILE = Extractor::GENERATED_DIR . '/Metadata/SchemaOrgMetadata.php';

    public function writeFile(ElementsContainer $container, Filesystem $filesystem, Standard $printer): void
    {
        $filesystem->dumpFile(
            self::DESTINATION_FILE,
            $printer->prettyPrintFile([$this->generate($container)])
        );
    }

    public function generate(ElementsContainer $container): Stmt\Namespace_
    {
        $classes = [];
        $properties = [];
        $classNames = [];
        $propertiesList = [];
        $propertiesNames = [];

        foreach ($container->getTypes() as $type) {
            if (\count($type->enumerationMembers)) {
                dd($type);
            }
        }

        foreach ($container->getAllElements() as $element) {
            if (\is_array($element->description)) {
                $element->description = $element->description[Extractor::KEY_VALUE];
            }

            $className = ClassTextBuilder::sanitizeClassName($element->label);

            $classNames[] = new Scalar\String_($className);
            $classes[] = new Expr\ArrayItem(
                new Scalar\String_(
                    $element->description
                ),
                new Scalar\String_($className)
            );

            if ($element instanceof Property) {
                $propertiesList[] = $className;
                $properties[] = new Expr\ArrayItem(
                    new Scalar\String_(
                        $element->description
                    ),
                    new Scalar\String_($className)
                );
            }
        }

        ksort($propertiesList);

        foreach ($propertiesList as $attributeName) {
            $propertiesNames[] = new Scalar\String_($attributeName);
        }

        dd(
            \count($classNames),
            \count($classes),
            \count($properties),
            \count($propertiesNames),
        );

        $statements = [
            new Stmt\Const_([
                new Node\Const_(
                    'CLASSES',
                    new Expr\Array_($classNames)
                ),
            ]),
            new Stmt\Const_([
                new Node\Const_(
                    'ATTRIBUTES',
                    new Expr\Array_($propertiesNames)
                ),
            ]),
            new Stmt\Property(
                Stmt\Class_::MODIFIER_PUBLIC | Stmt\Class_::MODIFIER_STATIC,
                [
                    new Stmt\PropertyProperty(
                        'classes',
                        new Expr\Array_($classes)
                    ),
                ],
            ),
            new Stmt\Property(
                Stmt\Class_::MODIFIER_PUBLIC | Stmt\Class_::MODIFIER_STATIC,
                [
                    new Stmt\PropertyProperty(
                        'attributes',
                        new Expr\Array_($properties)
                    ),
                ],
            ),
        ];
        $model = new Stmt\Class_(
            new Name('SchemaOrgMetadata'),
            [
                'stmts' => $statements,
            ]
        );

        return new Stmt\Namespace_(new Name(Extractor::NAMESPACE), [$model]);
    }
}
