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

use Jolicode\JsonLd\Generator\ExtractorInterface;
use Jolicode\JsonLd\Generator\SchemaOrg\Types\ElementsContainer;
use Jolicode\JsonLd\Generator\SchemaOrg\Types\EnumerationMember;
use Jolicode\JsonLd\Generator\SchemaOrg\Types\Property;
use Jolicode\JsonLd\Generator\SchemaOrg\Types\Type;
use PhpParser\PrettyPrinter\Standard;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpClient\HttpClient;

readonly class Extractor implements ExtractorInterface
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

    private const SOURCE_URL = 'https://raw.githubusercontent.com/schemaorg/schemaorg/main/data/releases/' . self::CURRENT_VERSION . '/schemaorg-current-https.jsonld';
    private const CACHE_FILE = __DIR__ . '/../../../var/cache/schema-org/schemaorg-' . self::CURRENT_VERSION . '-https.jsonld';

    public function __construct(
        private Filesystem $filesystem = new Filesystem(),
        private Generator $generator = new Generator(),
        private Standard $printer = new Standard(),
    ) {
    }

    public function extract(bool $refresh): void
    {
        if ($refresh || !$this->filesystem->exists(self::CACHE_FILE)) {
            $client = HttpClient::create();
            $response = $client->request('GET', self::SOURCE_URL);

            $this->filesystem->dumpFile(self::CACHE_FILE, $response->getContent());
        }

        $schemaOrgData = json_decode(file_get_contents(self::CACHE_FILE), true);
        $container = $this->createContainer($schemaOrgData[self::KEY_GRAPH]);

        $this->generator->writeFile(
            $container,
            $this->filesystem,
            $this->printer,
        );
    }

    private function createContainer(array $graph): ElementsContainer
    {
        $container = new ElementsContainer();

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
