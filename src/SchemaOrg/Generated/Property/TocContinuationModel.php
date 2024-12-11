<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Property;

final class TocContinuationModel
{
    public const DESCRIPTION = 'A [[HyperTocEntry]] can have a [[tocContinuation]] indicated, which is another [[HyperTocEntry]] that would be the default next item to play or render.';
    public const LABEL = 'tocContinuation';
    public const NAME = 'schema:tocContinuation';
    public const VALUES = ['HyperTocEntryModel' => 'Jolicode\SchemaOrg\Type\HyperTocEntryModel'];
    public const TYPES = ['HyperTocEntry' => 'Jolicode\SchemaOrg\Type\HyperTocEntryModel'];
}
