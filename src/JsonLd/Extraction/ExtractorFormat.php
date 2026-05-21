<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Extraction;

enum ExtractorFormat: string
{
    case JSONLD = 'jsonld';
    case MICRODATA = 'microdata';
    case RDFA = 'rdfa';

    public function displayName(): string
    {
        return match ($this) {
            self::JSONLD => 'JSON-LD',
            self::MICRODATA => 'Microdata',
            self::RDFA => 'RDFa',
        };
    }
}
