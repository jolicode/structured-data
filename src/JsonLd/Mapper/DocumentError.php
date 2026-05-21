<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Mapper;

readonly class DocumentError implements DocumentIssueInterface
{
    public function __construct(
        public string $source,
        public string $message,
        public string $ranges = '',
    ) {
    }

    public function getSource(): string
    {
        return $this->source;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getRanges(): string
    {
        return $this->ranges;
    }
}
