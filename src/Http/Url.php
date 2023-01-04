<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Http;

/**
 * This hole class is basically taken from https://github.com/digitalbazaar/jsonld.js/blob/main/lib/url.js
 * Thanks a lot !
 */
class Url
{
    private const REGEX = '/^(([^:\/?#]+):)?(?:\/\/((?:(([^:@]*)(?::([^:@]*))?)?@)?([^:\/?#]*)(?::(\d*))?))?(?:(((?:[^?#\/]*\/)*)([^?#]*))(?:\?([^#]*))?(?:#(.*))?)/';
    private const KEYS = [
        'href', 'protocol', 'scheme', 'authority', 'auth', 'user', 'password',
        'hostname', 'port', 'path', 'directory', 'file', 'query', 'fragment',
    ];

    public ?string $href = null;
    public ?string $protocol = null;
    public ?string $scheme = null;
    public ?string $authority = null;
    public ?string $auth = null;
    public ?string $user = null;
    public ?string $password = null;
    public ?string $hostname = null;
    public ?string $port = null;
    public ?string $path = null;
    public ?string $directory = null;
    public ?string $file = null;
    public ?string $query = null;
    public ?string $fragment = null;

    private ?string $normalizedPath = null;

    public function __construct(
        private readonly string $baseUrl,
        private readonly bool $normalize = true,
    ) {
        $this->build();
    }

    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    public function getNormalizedPath(): string
    {
        return $this->normalizedPath;
    }

    public function removeDotSegments(): void
    {
        if (!$this->path) {
            $this->normalizedPath = '';

            return;
        }

        $input = explode('/', $this->path);
        $output = [];

        while (\count($input)) {
            $next = array_shift($input);
            $done = !\count($input);

            if ('.' === $next) {
                if ($done) {
                    $output[] = '';
                }

                continue;
            }

            if ('..' === $next) {
                array_pop($output);

                if ($done) {
                    $output[] = '';
                }

                continue;
            }

            $output[] = $next;
        }

        if ('/' === $this->path[0] && \count($output) && '' !== $output[0]) {
            array_unshift($output, '');
        }

        if (1 === \count($output) && '' === $output[0]) {
            $this->normalizedPath = '/';

            return;
        }

        $this->normalizedPath = implode('/', $output);
    }

    private function build(): void
    {
        preg_match_all(self::REGEX, $this->baseUrl, $matches);

        foreach (self::KEYS as $index => $key) {
            $this->$key = $matches[$index][0] ?: null;
        }

        if ($this->normalize) {
            if (
                'https' === $this->scheme && '443' === (string) $this->port ||
                'http' === $this->scheme && '80' === $this->port
            ) {
                $this->href = str_replace(':' . $this->port, '', $this->href);
                $this->authority = str_replace(':' . $this->port, '', $this->authority);
                $this->port = null;
            }

            $this->removeDotSegments();
        }
    }
}
