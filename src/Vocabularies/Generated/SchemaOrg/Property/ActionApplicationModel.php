<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Property;

final class ActionApplicationModel
{
    public const DESCRIPTION = 'An application that can complete the request.';
    public const LABEL = 'actionApplication';
    public const NAME = 'schema:actionApplication';
    public const VALUES = ['SoftwareApplicationModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\SoftwareApplicationModel'];
    public const TYPES = ['EntryPoint' => 'Jolicode\Vocabularies\SchemaOrg\Type\EntryPointModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
