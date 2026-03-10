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

final class InfectiousAgentClassModel
{
    public const DESCRIPTION = 'Classes of agents or pathogens that transmit infectious diseases. Enumerated type.';
    public const LABEL = 'InfectiousAgentClass';
    public const NAME = 'schema:InfectiousAgentClass';
    public const PARENTS = ['MedicalEnumerationModel' => 'Jolicode\SchemaOrg\Type\MedicalEnumerationModel'];
    public const ENUMERATION_MEMBERS = ['BacteriaModel' => 'EnumerationMember\BacteriaModel', 'FungusModel' => 'EnumerationMember\FungusModel', 'MulticellularParasiteModel' => 'EnumerationMember\MulticellularParasiteModel', 'PrionModel' => 'EnumerationMember\PrionModel', 'ProtozoaModel' => 'EnumerationMember\ProtozoaModel', 'VirusModel' => 'EnumerationMember\VirusModel'];
    public const IS_PART_OF = ['https://health-lifesci.schema.org'];
    public const SOURCE = [];

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\NameModel $name = null,
        public ?Property\OwnerModel $owner = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\SupersededByModel $supersededBy = null,
        public ?Property\UrlModel $url = null,
    ) {
    }
}
