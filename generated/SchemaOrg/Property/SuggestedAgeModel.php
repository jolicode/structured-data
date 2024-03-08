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

final class SuggestedAgeModel
{
    public const DESCRIPTION = 'The age or age range for the intended audience or person, for example 3-12 months for infants, 1-5 years for toddlers.';
    public const LABEL = 'suggestedAge';
    public const NAME = 'schema:suggestedAge';
    public const VALUES = ['QuantitativeValueModel' => 'SchemaOrg\\Type\\QuantitativeValueModel'];
    public const TYPES = ['PeopleAudience' => 'SchemaOrg\\Type\\PeopleAudienceModel', 'SizeSpecification' => 'SchemaOrg\\Type\\SizeSpecificationModel'];
}
