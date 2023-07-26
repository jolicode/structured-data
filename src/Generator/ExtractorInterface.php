<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Generator;

interface ExtractorInterface
{
    /**
     * Extracts the data from the related source and generates the needed files.
     */
    public function extract(bool $refresh): void;
}
