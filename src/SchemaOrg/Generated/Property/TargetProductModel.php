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

final class TargetProductModel
{
    public const DESCRIPTION = 'Target Operating System / Product to which the code applies.  If applies to several versions, just the product name can be used.';
    public const LABEL = 'targetProduct';
    public const NAME = 'schema:targetProduct';
    public const VALUES = ['SoftwareApplicationModel' => 'Jolicode\SchemaOrg\Type\SoftwareApplicationModel'];
    public const TYPES = ['SoftwareSourceCode' => 'Jolicode\SchemaOrg\Type\SoftwareSourceCodeModel'];
}
