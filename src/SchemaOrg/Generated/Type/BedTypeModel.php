<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Type;

use Jolicode\SchemaOrg\Property;

final class BedTypeModel
{
    public const DESCRIPTION = 'A type of bed. This is used for indicating the bed or beds available in an accommodation.';
    public const LABEL = 'BedType';
    public const NAME = 'schema:BedType';
    public const PARENTS = ['QualitativeValueModel' => 'Jolicode\SchemaOrg\Type\QualitativeValueModel'];
    public const ENUMERATION_MEMBERS = [];

    public function __construct(
        public ?Property\AdditionalPropertyModel $additionalProperty = null,
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\EqualModel $equal = null,
        public ?Property\GreaterModel $greater = null,
        public ?Property\GreaterOrEqualModel $greaterOrEqual = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\LesserModel $lesser = null,
        public ?Property\LesserOrEqualModel $lesserOrEqual = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\NameModel $name = null,
        public ?Property\NonEqualModel $nonEqual = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\SupersededByModel $supersededBy = null,
        public ?Property\UrlModel $url = null,
        public ?Property\ValueReferenceModel $valueReference = null,
    ) {
    }
}
