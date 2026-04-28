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

final class NutritionInformationModel
{
    public const DESCRIPTION = 'Nutritional information about the recipe.';
    public const LABEL = 'NutritionInformation';
    public const NAME = 'schema:NutritionInformation';
    public const PARENTS = ['StructuredValueModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\StructuredValueModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = [];
    public const SOURCE = [];

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\CaloriesModel $calories = null,
        public ?Property\CarbohydrateContentModel $carbohydrateContent = null,
        public ?Property\CholesterolContentModel $cholesterolContent = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\FatContentModel $fatContent = null,
        public ?Property\FiberContentModel $fiberContent = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\NameModel $name = null,
        public ?Property\OwnerModel $owner = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\ProteinContentModel $proteinContent = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SaturatedFatContentModel $saturatedFatContent = null,
        public ?Property\ServingSizeModel $servingSize = null,
        public ?Property\SodiumContentModel $sodiumContent = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\SugarContentModel $sugarContent = null,
        public ?Property\TransFatContentModel $transFatContent = null,
        public ?Property\UnsaturatedFatContentModel $unsaturatedFatContent = null,
        public ?Property\UrlModel $url = null,
    ) {
    }
}
