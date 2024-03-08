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

final class RelatedAnatomyModel
{
    public const DESCRIPTION = 'Anatomical systems or structures that relate to the superficial anatomy.';
    public const LABEL = 'relatedAnatomy';
    public const NAME = 'schema:relatedAnatomy';
    public const VALUES = ['AnatomicalStructureModel' => 'SchemaOrg\\Type\\AnatomicalStructureModel', 'AnatomicalSystemModel' => 'SchemaOrg\\Type\\AnatomicalSystemModel'];
    public const TYPES = ['SuperficialAnatomy' => 'SchemaOrg\\Type\\SuperficialAnatomyModel'];
}
