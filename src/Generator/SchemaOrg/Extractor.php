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

use Jolicode\JsonLd\Generator\SchemaOrg\Types\ClassesContainer;
use Jolicode\JsonLd\Generator\SchemaOrg\Types\EnumerationMember;
use Jolicode\JsonLd\Generator\SchemaOrg\Types\Property;
use Jolicode\JsonLd\Generator\SchemaOrg\Types\Type;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpClient\HttpClient;
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

    // Bump this version with care! Sometimes a version is released but not yet available on GitHub.
    // Moreover, bumping it will very likely modify the source file, sometimes with breaking changes.
    // Be sure to check https://schema.org/docs/releases.html first.
    private const CURRENT_VERSION = '15.0';

    private const CACHE_DIRECTORY = __DIR__ . '/../../../var/cache/schema-org/';

    private const TYPES_SOURCE_URL = 'https://raw.githubusercontent.com/schemaorg/schemaorg/main/data/releases/' . self::CURRENT_VERSION . '/schemaorg-current-https.jsonld';
    private const TYPES_CACHE_FILE = self::CACHE_DIRECTORY . 'schemaorg-' . self::CURRENT_VERSION . '-https.jsonld';

    private const EXAMPLES_SOURCE_URL = 'https://raw.githubusercontent.com/schemaorg/schemaorg/main/data/examples.txt';
    private const EXAMPLES_CACHE_FILE = self::CACHE_DIRECTORY . 'examples.txt';

    public function __construct(
        private Filesystem $filesystem,
        private AsciiSlugger $slugger = new AsciiSlugger(),
    ) {
    }

    public function extractClasses(bool $refresh): ClassesContainer
    {
        if ($refresh || !$this->filesystem->exists(self::TYPES_CACHE_FILE)) {
            $client = HttpClient::create();
            $response = $client->request('GET', self::TYPES_SOURCE_URL);

            $this->filesystem->dumpFile(self::TYPES_CACHE_FILE, $response->getContent());
        }

        $schemaOrgData = json_decode(file_get_contents(self::TYPES_CACHE_FILE), true);

        return $this->createContainer($schemaOrgData[self::KEY_GRAPH]);
    }

    public function extractExamples(bool $refresh): string
    {
        $key = (string) $this->slugger->slug(self::EXAMPLES_SOURCE_URL);
        $path = self::CACHE_DIRECTORY . $key . '.txt';

        $this->filesystem->copy(self::EXAMPLES_SOURCE_URL, $path, $refresh);

        return file_get_contents($path);
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
