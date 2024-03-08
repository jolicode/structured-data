<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class ServiceTypeModel
{
    public const DESCRIPTION = 'The type of service being offered, e.g. veterans\' benefits, emergency relief, etc.';
    public const LABEL = 'serviceType';
    public const NAME = 'schema:serviceType';
    public const VALUES = ['GovernmentBenefitsTypeModel' => 'SchemaOrg\Type\GovernmentBenefitsTypeModel', 'TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['Service' => 'SchemaOrg\Type\ServiceModel'];
}
