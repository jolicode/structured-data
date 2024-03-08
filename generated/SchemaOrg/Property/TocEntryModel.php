<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class TocEntryModel
{
    public const DESCRIPTION = 'Indicates a [[HyperTocEntry]] in a [[HyperToc]].';
    public const LABEL = 'tocEntry';
    public const NAME = 'schema:tocEntry';
    public const VALUES = ['HyperTocEntryModel' => 'SchemaOrg\\Type\\HyperTocEntryModel'];
    public const TYPES = ['HyperToc' => 'SchemaOrg\\Type\\HyperTocModel'];
}
