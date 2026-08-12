<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\JsonLd\Algorithms\Http;

/**
 * Decides which remote documents an HttpDocumentLoader may fetch, and under which
 * limits.
 *
 * There is deliberately no "allow everything" factory: the URLs this policy guards
 * come from the document being processed, so opening it up entirely turns any
 * audited document into a request forgery primitive.
 */
final readonly class RemoteContextPolicy
{
    private const DEFAULT_TIMEOUT = 2.0;
    private const DEFAULT_MAX_DURATION = 5.0;
    private const DEFAULT_MAX_REDIRECTS = 3;
    private const DEFAULT_MAX_RESPONSE_BYTES = 1048576;
    private const DEFAULT_MAX_HOPS = 10;

    /**
     * @param list<string> $allowedHosts   lowercase, sorted
     * @param list<string> $allowedSchemes lowercase, sorted
     */
    private function __construct(
        public array $allowedHosts,
        public array $allowedSchemes,
        public float $timeout,
        public float $maxDuration,
        public int $maxRedirects,
        public int $maxResponseBytes,
        public int $maxHops,
    ) {
    }

    /**
     * The default policy: no host may be fetched at all.
     *
     * The schema.org context is served from the vocabulary files shipped with this
     * library and is resolved before any loader is involved, so this policy still
     * covers the overwhelmingly common case without a single outbound request.
     */
    public static function schemaOrgOnly(): self
    {
        return new self(
            allowedHosts: [],
            allowedSchemes: ['https'],
            timeout: self::DEFAULT_TIMEOUT,
            maxDuration: self::DEFAULT_MAX_DURATION,
            maxRedirects: self::DEFAULT_MAX_REDIRECTS,
            maxResponseBytes: self::DEFAULT_MAX_RESPONSE_BYTES,
            maxHops: self::DEFAULT_MAX_HOPS,
        );
    }

    /**
     * Allows the listed hosts, over https only. Host matching is exact: listing
     * "schema.org" does not allow "evil.schema.org.example".
     */
    public static function allowHosts(string ...$hosts): self
    {
        return self::schemaOrgOnly()->withHosts(...$hosts);
    }

    public function withHosts(string ...$hosts): self
    {
        $normalized = array_values(array_unique(array_map(mb_strtolower(...), $hosts)));
        sort($normalized);

        return new self(
            allowedHosts: $normalized,
            allowedSchemes: $this->allowedSchemes,
            timeout: $this->timeout,
            maxDuration: $this->maxDuration,
            maxRedirects: $this->maxRedirects,
            maxResponseBytes: $this->maxResponseBytes,
            maxHops: $this->maxHops,
        );
    }

    /**
     * Only "http" and "https" are accepted: anything else would hand the PHP stream
     * wrappers ("file://", "phar://", "ftp://"...) a document controlled URL.
     */
    public function withSchemes(string ...$schemes): self
    {
        $normalized = array_values(array_unique(array_map(mb_strtolower(...), $schemes)));
        sort($normalized);

        foreach ($normalized as $scheme) {
            if (!\in_array($scheme, ['http', 'https'], true)) {
                throw new \InvalidArgumentException(\sprintf('Only the "http" and "https" schemes may be allowed, "%s" given.', $scheme));
            }
        }

        return new self(
            allowedHosts: $this->allowedHosts,
            allowedSchemes: $normalized,
            timeout: $this->timeout,
            maxDuration: $this->maxDuration,
            maxRedirects: $this->maxRedirects,
            maxResponseBytes: $this->maxResponseBytes,
            maxHops: $this->maxHops,
        );
    }

    public function withTimeouts(float $timeout, float $maxDuration): self
    {
        if ($timeout <= 0 || $maxDuration <= 0) {
            throw new \InvalidArgumentException('Timeouts must be strictly positive.');
        }

        return new self(
            allowedHosts: $this->allowedHosts,
            allowedSchemes: $this->allowedSchemes,
            timeout: $timeout,
            maxDuration: $maxDuration,
            maxRedirects: $this->maxRedirects,
            maxResponseBytes: $this->maxResponseBytes,
            maxHops: $this->maxHops,
        );
    }

    public function withMaxRedirects(int $maxRedirects): self
    {
        if ($maxRedirects < 0) {
            throw new \InvalidArgumentException('The maximum number of redirects cannot be negative.');
        }

        return new self(
            allowedHosts: $this->allowedHosts,
            allowedSchemes: $this->allowedSchemes,
            timeout: $this->timeout,
            maxDuration: $this->maxDuration,
            maxRedirects: $maxRedirects,
            maxResponseBytes: $this->maxResponseBytes,
            maxHops: $this->maxHops,
        );
    }

    public function withMaxResponseBytes(int $maxResponseBytes): self
    {
        if ($maxResponseBytes <= 0) {
            throw new \InvalidArgumentException('The maximum response size must be strictly positive.');
        }

        return new self(
            allowedHosts: $this->allowedHosts,
            allowedSchemes: $this->allowedSchemes,
            timeout: $this->timeout,
            maxDuration: $this->maxDuration,
            maxRedirects: $this->maxRedirects,
            maxResponseBytes: $maxResponseBytes,
            maxHops: $this->maxHops,
        );
    }

    public function withMaxHops(int $maxHops): self
    {
        if ($maxHops < 1) {
            throw new \InvalidArgumentException('The maximum number of hops must be at least 1.');
        }

        return new self(
            allowedHosts: $this->allowedHosts,
            allowedSchemes: $this->allowedSchemes,
            timeout: $this->timeout,
            maxDuration: $this->maxDuration,
            maxRedirects: $this->maxRedirects,
            maxResponseBytes: $this->maxResponseBytes,
            maxHops: $maxHops,
        );
    }

    /**
     * Must be called on every URL that is about to be requested: the initial one, but
     * also every alternate location, every "Link" header hop, and the effective URL a
     * response was served from once redirects have been followed.
     */
    public function allows(string $url): bool
    {
        if ([] === $this->allowedHosts) {
            return false;
        }

        $parts = parse_url($url);

        if (false === $parts || !isset($parts['scheme'], $parts['host'])) {
            return false;
        }

        // Userinfo in the URL ("https://user:pass@schema.org/") would make an
        // allowed host carry credentials to the server; refuse it outright.
        if (isset($parts['user']) || isset($parts['pass'])) {
            return false;
        }

        $scheme = mb_strtolower($parts['scheme']);

        // A port other than the scheme default would let an allowed host be probed
        // on arbitrary ports; only the default port (or none) is accepted.
        if (isset($parts['port']) && $parts['port'] !== self::defaultPortForScheme($scheme)) {
            return false;
        }

        return \in_array($scheme, $this->allowedSchemes, true)
            && \in_array(mb_strtolower($parts['host']), $this->allowedHosts, true);
    }

    public function fingerprint(): string
    {
        return hash('xxh128', serialize([
            $this->allowedHosts,
            $this->allowedSchemes,
            $this->timeout,
            $this->maxDuration,
            $this->maxRedirects,
            $this->maxResponseBytes,
            $this->maxHops,
        ]));
    }

    private static function defaultPortForScheme(string $scheme): ?int
    {
        return match ($scheme) {
            'https' => 443,
            'http' => 80,
            default => null,
        };
    }
}
