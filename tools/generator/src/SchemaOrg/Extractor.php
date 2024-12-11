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
use Jolicode\JsonLd\Generator\SchemaOrg\Objects\ClassesContainer;
use Jolicode\JsonLd\Generator\SchemaOrg\Objects\EnumerationMember;
use Jolicode\JsonLd\Generator\SchemaOrg\Objects\Property;
use Jolicode\JsonLd\Generator\SchemaOrg\Objects\Type;
use Symfony\Component\String\Slugger\AsciiSlugger;

readonly class Extractor
{
    // We use class constants instead of enum here because there are not so many keywords
    // plus enums are sometimes a pain
    public const KEY_GRAPH = '@graph';
    public const KEY_TYPE = '@type';
    public const KEY_ID = '@id';
    public const KEY_VALUE = '@value';

    public const RDFS_CLASS = 'rdfs:Class';
    public const RDFS_COMMENT = 'rdfs:comment';
    public const RDFS_LABEL = 'rdfs:label';
    public const RDFS_SUB_CLASS_OF = 'rdfs:subClassOf';
    public const RDF_PROPERTY = 'rdf:Property';
    public const OWL_EQUIVALENT_CLASS = 'owl:equivalentClass';

    public const GENERATED_DIR = __DIR__ . '/../../../generated/SchemaOrg';

    // @TODO MOVE TO MAIN LIB
    // Bump this version with care! Sometimes a version is released but not yet available on GitHub.
    // Moreover, bumping it will very likely modify the source file, sometimes with breaking changes.
    // Be sure to check https://schema.org/docs/releases.html first.
    public const CURRENT_VERSION = '22.0';

    public function __construct(
        private Filesystem $filesystem = new Filesystem(),
        private AsciiSlugger $slugger = new AsciiSlugger(),
    ) {
    }

    public function extractClasses(): ClassesContainer
    {
        $schemaOrgData = json_decode(
            $this->filesystem->getSchemaOrgTypesDefinition(),
            true,
        );

        return $this->createContainer($schemaOrgData[self::KEY_GRAPH]);
    }

    private function createContainer(array $graph): ClassesContainer
    {
        $container = new ClassesContainer();

        foreach ($graph as $type) {
            match (true) {
                $this->isClassType($type) => $container->addType(Type::fromRawData($type)),
                $this->isPropertyType($type) => $container->addProperty(Property::fromRawData($type)),
                $this->isEnumerationType($type) => $container->addEnumerationMember(EnumerationMember::fromRawData($type)),
                default => null,
            };
        }

        $container->finish();

        return $container;
    }

    private function isClassType(array $type): bool
    {
        return \is_array($type[self::KEY_TYPE]) ?
            \in_array(self::RDFS_CLASS, $type[self::KEY_TYPE], true) :
            self::RDFS_CLASS === $type[self::KEY_TYPE];
    }

    private function isPropertyType(array $type): bool
    {
        return self::RDF_PROPERTY === $type[self::KEY_TYPE];
    }

    private function isEnumerationType(array $rawType): bool
    {
        foreach ((array) $rawType[self::KEY_TYPE] as $type) {
            if (!str_starts_with($type, 'schema:')) {
                return false;
            }
        }

        return true;
    }
}
