<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Type;

use SchemaOrg\Property;

final class EngineSpecificationModel
{
    public const DESCRIPTION = 'Information about the engine of the vehicle. A vehicle can have multiple engines represented by multiple engine specification entities.';
    public const LABEL = 'EngineSpecification';
    public const NAME = 'schema:EngineSpecification';
    public const PARENTS = ['StructuredValueModel' => 'SchemaOrg\Type\StructuredValueModel'];
    public const ENUMERATION_MEMBERS = [];

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\EngineDisplacementModel $engineDisplacement = null,
        public ?Property\EnginePowerModel $enginePower = null,
        public ?Property\EngineTypeModel $engineType = null,
        public ?Property\FuelTypeModel $fuelType = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\NameModel $name = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\TorqueModel $torque = null,
        public ?Property\UrlModel $url = null,
    ) {
    }
}
