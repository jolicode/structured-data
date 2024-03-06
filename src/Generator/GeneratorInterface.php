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

interface GeneratorInterface
{
    /**
     * Extracts all the needed data and generates the corresponding files.
     *
     * @param bool $refresh if true, the generator will refresh the data from the source. Otherwise, it will use a cached file.
     */
    public function generate(bool $refresh): void;
}
