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

final class RepresentativeOfPageModel
{
    public const DESCRIPTION = 'Indicates whether this image is representative of the content of the page.';
    public const LABEL = 'representativeOfPage';
    public const NAME = 'schema:representativeOfPage';
    public const VALUES = ['BooleanModel' => 'Jolicode\SchemaOrg\Type\BooleanModel'];
    public const TYPES = ['ImageObject' => 'Jolicode\SchemaOrg\Type\ImageObjectModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
