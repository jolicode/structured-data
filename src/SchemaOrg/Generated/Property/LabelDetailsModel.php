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

final class LabelDetailsModel
{
    public const DESCRIPTION = 'Link to the drug\'s label details.';
    public const LABEL = 'labelDetails';
    public const NAME = 'schema:labelDetails';
    public const VALUES = ['URLModel' => 'Jolicode\SchemaOrg\Type\URLModel'];
    public const TYPES = ['Drug' => 'Jolicode\SchemaOrg\Type\DrugModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
