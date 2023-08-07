<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Generator\Google;

use Jolicode\JsonLd\Generator\GeneratorInterface;
use Symfony\Component\Filesystem\Filesystem;

class Generator implements GeneratorInterface
{
    public function __construct(
        private Filesystem $filesystem = new Filesystem(),
    ) {
    }

    public function generate(bool $refresh): void
    {
        $extractor = new Extractor($this->filesystem);

        $extractor->extractClasses($refresh);
        // $this->generateExamples($extractor->extractExamples($refresh));
        // $this->generateClasses($extractor->extractClasses($refresh));
    }
}
