<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generators;

use Symfony\Component\Console\Style\SymfonyStyle;

interface GeneratorInterface
{
    /**
     * Extracts all the needed data and generates the corresponding files.
     */
    public function generate(?SymfonyStyle $io = null): void;

    /**
     * Returns the name of the generator.
     */
    public static function getName(): string;
}
