<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Type;

use Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class QualitativeValueModel
{
    public const DESCRIPTION = 'A predefined value for a product characteristic, e.g. the power cord plug type \'US\' or the garment sizes \'S\', \'M\', \'L\', and \'XL\'.';
    public const LABEL = 'QualitativeValue';
    public const NAME = 'schema:QualitativeValue';
    public const PARENTS = ['EnumerationModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\EnumerationModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;

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
        public ?Property\OwnerModel $owner = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\SupersededByModel $supersededBy = null,
        public ?Property\UrlModel $url = null,
        public ?Property\ValueReferenceModel $valueReference = null,
    ) {
    }
}
