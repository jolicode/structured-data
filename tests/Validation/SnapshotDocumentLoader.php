<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Tests\Validation;

use JoliCode\StructuredData\JsonLd\Algorithms\Http\DocumentLoaderInterface;

/**
 * Serves the remote contexts the validation fixtures reference from snapshots
 * committed next to them, so that the suite never depends on a third-party host
 * being reachable.
 *
 * This is not an optimisation: www.w3.org sits behind a Cloudflare challenge that
 * answers "429 Too Many Requests" to shared runners often enough to turn the suite
 * red — and, because Infection refuses to mutate a failing suite, to break the
 * mutation testing job too — for reasons that have nothing to do with the library.
 *
 * Refreshing a snapshot is a matter of downloading the URL again:
 *
 *     curl -H 'Accept: application/ld+json' -o tests/Validation/fixtures/remote-contexts/<file> <url>
 *
 * Only the two hosts below need one: schema.org itself never reaches a document
 * loader, as ContextCache serves it from resources/schema.org/context.
 */
final class SnapshotDocumentLoader implements DocumentLoaderInterface
{
    private const SNAPSHOTS_DIRECTORY = __DIR__ . '/fixtures/remote-contexts';

    /**
     * Maps every URL a fixture may ask for to its snapshot. The spelling variants
     * are listed explicitly rather than normalised away: a loader is handed the URL
     * the document wrote, and guessing which ones are equivalent is exactly the kind
     * of leniency the production loader deliberately avoids.
     *
     * "health-lifesci.schema.org" answers with an HTML page carrying an "alternate"
     * Link header, so its snapshot is the document that header points at.
     *
     * @var array<string, string>
     */
    private const SNAPSHOTS = [
        // https://www.w3.org/ns/credentials/v2
        'https://www.w3.org/ns/credentials/v2' => 'www.w3.org-ns-credentials-v2.jsonld',
        // https://health-lifesci.schema.org/docs/jsonldcontext.jsonld
        'http://health-lifesci.schema.org' => 'health-lifesci.schema.org.jsonld',
        'http://health-lifesci.schema.org/' => 'health-lifesci.schema.org.jsonld',
        'https://health-lifesci.schema.org' => 'health-lifesci.schema.org.jsonld',
        'https://health-lifesci.schema.org/' => 'health-lifesci.schema.org.jsonld',
    ];

    /**
     * Decoded snapshots, kept for the lifetime of the loader: the health-lifesci
     * context alone is 200 kB of JSON, and the data providers replay it once per
     * fixture that uses it.
     *
     * @var array<string, \stdClass>
     */
    private array $documents = [];

    public function load(string $url): \stdClass
    {
        if (!\array_key_exists($url, self::SNAPSHOTS)) {
            // Not a ContextProcessingException, and not a RuntimeException either:
            // both are caught upstream and would surface as a plain "loading remote
            // context failed" audit error, which tells whoever added the fixture
            // nothing about what to do next.
            throw new \LogicException(\sprintf('The validation suite runs offline, and no snapshot is registered for the remote context "%s". Download it into "%s" and register it in %s::SNAPSHOTS.', $url, self::SNAPSHOTS_DIRECTORY, self::class));
        }

        return $this->documents[$url] ??= $this->decode(self::SNAPSHOTS[$url]);
    }

    public function getCacheNamespace(): string
    {
        return 'test-snapshot:' . hash('xxh128', serialize(self::SNAPSHOTS));
    }

    private function decode(string $filename): \stdClass
    {
        $path = self::SNAPSHOTS_DIRECTORY . '/' . $filename;
        $contents = file_get_contents($path);

        if (false === $contents) {
            throw new \LogicException(\sprintf('The remote context snapshot "%s" could not be read.', $path));
        }

        $document = json_decode($contents, false, 512, \JSON_THROW_ON_ERROR);

        if (!$document instanceof \stdClass) {
            throw new \LogicException(\sprintf('The remote context snapshot "%s" does not hold a JSON object.', $path));
        }

        return $document;
    }
}
