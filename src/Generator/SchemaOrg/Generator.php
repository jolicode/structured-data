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

use Jolicode\JsonLd\Generator\SchemaOrg\Types\EnumerationMember;
use Jolicode\JsonLd\Generator\SchemaOrg\Types\Property;
use Jolicode\JsonLd\Generator\SchemaOrg\Types\SchemaOrgTypeInterface;
use Jolicode\JsonLd\Generator\SchemaOrg\Types\Type;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpClient\HttpClient;

class Generator
{
    // We use class constants instead of enum here because there are not so many keywords
    // plus enums are sometimes a pain
    public const KEY_GRAPH = '@graph';
    public const KEY_TYPE = '@type';
    public const KEY_ID = '@id';
    public const RDFS_CLASS = 'rdfs:Class';
    public const RDFS_COMMENT = 'rdfs:comment';
    public const RDFS_SUB_CLASS_OF = 'rdfs:subClassOf';
    public const RDF_PROPERTY = 'rdf:Property';

    // Bump this version with care! Sometimes a version is released but not yet available on GitHub.
    // Moreover, bumping it will very likely modify the source file, sometimes with breaking changes.
    // Be sure to check https://schema.org/docs/releases.html first.
    private const CURRENT_VERSION = '15.0';

    private const SOURCE_URL = 'https://raw.githubusercontent.com/schemaorg/schemaorg/main/data/releases/' . self::CURRENT_VERSION . '/schemaorg-current-https.jsonld';
    private const CACHE_FILE = __DIR__ . '/../../../var/cache/schema-org/schemaorg-current-https.jsonld';

    /**
     * @var array<string,SchemaOrgTypeInterface>
     */
    private array $types = [];

    public function __construct(
        private Filesystem $filesystem = new Filesystem(),
    ) {
    }

    /**
     * @return array<string,SchemaOrgTypeInterface>
     */
    public function generate(bool $refresh): void
    {
        if ($refresh || !$this->filesystem->exists(self::CACHE_FILE)) {
            $client = HttpClient::create();
            $response = $client->request('GET', self::SOURCE_URL);

            $this->filesystem->dumpFile(self::CACHE_FILE, $response->getContent());
        }

        $schemaOrgData = json_decode(file_get_contents(self::CACHE_FILE), true);
        $graph = $schemaOrgData[self::KEY_GRAPH];

        $this->extractTypes($graph);
    }

    /**
     * @return array<string,SchemaOrgTypeInterface>
     */
    private function extractTypes(array $graph): array
    {
        foreach ($graph as $type) {
            $type = match (true) {
                $this->isClassType($type) => Type::fromRawType($type),
                $this->isPropertyType($type) => Property::fromRawType($type),
                $this->isEnumerationType($type) => EnumerationMember::fromRawType($type),
                default => null,
            };

            if ($type instanceof SchemaOrgTypeInterface) {
                $this->addType($type);
            }
        }

        ksort($this->types);

        return $this->types;
    }

    private function addType(SchemaOrgTypeInterface $type): void
    {
        if (property_exists($type, 'name') && !\array_key_exists($type->name, $this->types)) {
            $this->types[$type->name] = $type;
        }
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
