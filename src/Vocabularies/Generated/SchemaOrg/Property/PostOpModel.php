<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class PostOpModel
{
    public const DESCRIPTION = 'A description of the postoperative procedures, care, and/or followups for this device.';
    public const LABEL = 'postOp';
    public const NAME = 'schema:postOp';
    public const VALUES = ['TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['MedicalDevice' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MedicalDeviceModel'];
    public const IS_PART_OF = ['https://health-lifesci.schema.org'];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
