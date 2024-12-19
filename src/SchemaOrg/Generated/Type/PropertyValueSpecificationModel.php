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

final class PropertyValueSpecificationModel
{
    public const DESCRIPTION = 'A Property value specification.';
    public const LABEL = 'PropertyValueSpecification';
    public const NAME = 'schema:PropertyValueSpecification';
    public const PARENTS = ['IntangibleModel' => 'Jolicode\SchemaOrg\Type\IntangibleModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = [];
    public const SOURCE = [];

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\DefaultValueModel $defaultValue = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\MaxValueModel $maxValue = null,
        public ?Property\MinValueModel $minValue = null,
        public ?Property\MultipleValuesModel $multipleValues = null,
        public ?Property\NameModel $name = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\ReadonlyValueModel $readonlyValue = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\StepValueModel $stepValue = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\UrlModel $url = null,
        public ?Property\ValueMaxLengthModel $valueMaxLength = null,
        public ?Property\ValueMinLengthModel $valueMinLength = null,
        public ?Property\ValueNameModel $valueName = null,
        public ?Property\ValuePatternModel $valuePattern = null,
        public ?Property\ValueRequiredModel $valueRequired = null,
    ) {
    }
}
