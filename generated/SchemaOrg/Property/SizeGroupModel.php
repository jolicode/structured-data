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

final class SizeGroupModel
{
    public const DESCRIPTION = 'The size group (also known as "size type") for a product\'s size. Size groups are common in the fashion industry to define size segments and suggested audiences for wearable products. Multiple values can be combined, for example "men\'s big and tall", "petite maternity" or "regular"';
    public const LABEL = 'sizeGroup';
    public const NAME = 'schema:sizeGroup';
    public const VALUES = ['SizeGroupEnumerationModel' => 'SchemaOrg\\Type\\SizeGroupEnumerationModel', 'TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['SizeSpecification' => 'SchemaOrg\\Type\\SizeSpecificationModel'];
}
