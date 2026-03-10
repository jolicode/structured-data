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

final class PublisherModel
{
    public const DESCRIPTION = 'The publisher of the article in question.';
    public const LABEL = 'publisher';
    public const NAME = 'schema:publisher';
    public const VALUES = ['OrganizationModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\OrganizationModel', 'PersonModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['CreativeWork' => 'Jolicode\Vocabularies\SchemaOrg\Type\CreativeWorkModel', 'FinancialIncentive' => 'Jolicode\Vocabularies\SchemaOrg\Type\FinancialIncentiveModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
