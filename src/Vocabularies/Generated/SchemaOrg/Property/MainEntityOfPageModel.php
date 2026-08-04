<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class MainEntityOfPageModel
{
    public const DESCRIPTION = 'Indicates a page (or other CreativeWork) for which this thing is the main entity being described. See [background notes](/docs/datamodel.html#mainEntityBackground) for details.';
    public const LABEL = 'mainEntityOfPage';
    public const NAME = 'schema:mainEntityOfPage';
    public const VALUES = ['CreativeWorkModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\CreativeWorkModel', 'URLModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\URLModel'];
    public const TYPES = ['Thing' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ThingModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
