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

final class CarrierRequirementsModel
{
    public const DESCRIPTION = 'Specifies specific carrier(s) requirements for the application (e.g. an application may only work on a specific carrier network).';
    public const LABEL = 'carrierRequirements';
    public const NAME = 'schema:carrierRequirements';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['MobileApplication' => 'SchemaOrg\Type\MobileApplicationModel'];
}
