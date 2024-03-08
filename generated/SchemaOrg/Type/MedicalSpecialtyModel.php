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

final class MedicalSpecialtyModel
{
    public const DESCRIPTION = 'Any specific branch of medical science or practice. Medical specialities include clinical specialties that pertain to particular organ systems and their respective disease states, as well as allied health specialties. Enumerated type.';
    public const LABEL = 'MedicalSpecialty';
    public const NAME = 'schema:MedicalSpecialty';
    public const PARENTS = ['MedicalEnumerationModel' => 'SchemaOrg\Type\MedicalEnumerationModel', 'SpecialtyModel' => 'SchemaOrg\Type\SpecialtyModel'];
    public const ENUMERATION_MEMBERS = ['AnesthesiaModel' => 'EnumerationMember\AnesthesiaModel', 'CardiovascularModel' => 'EnumerationMember\CardiovascularModel', 'CommunityHealthModel' => 'EnumerationMember\CommunityHealthModel', 'DentistryModel' => 'EnumerationMember\DentistryModel', 'DermatologicModel' => 'EnumerationMember\DermatologicModel', 'DermatologyModel' => 'EnumerationMember\DermatologyModel', 'DietNutritionModel' => 'EnumerationMember\DietNutritionModel', 'EmergencyModel' => 'EnumerationMember\EmergencyModel', 'EndocrineModel' => 'EnumerationMember\EndocrineModel', 'GastroenterologicModel' => 'EnumerationMember\GastroenterologicModel', 'GeneticModel' => 'EnumerationMember\GeneticModel', 'GeriatricModel' => 'EnumerationMember\GeriatricModel', 'GynecologicModel' => 'EnumerationMember\GynecologicModel', 'HematologicModel' => 'EnumerationMember\HematologicModel', 'InfectiousModel' => 'EnumerationMember\InfectiousModel', 'LaboratoryScienceModel' => 'EnumerationMember\LaboratoryScienceModel', 'MidwiferyModel' => 'EnumerationMember\MidwiferyModel', 'MusculoskeletalModel' => 'EnumerationMember\MusculoskeletalModel', 'NeurologicModel' => 'EnumerationMember\NeurologicModel', 'NursingModel' => 'EnumerationMember\NursingModel', 'ObstetricModel' => 'EnumerationMember\ObstetricModel', 'OncologicModel' => 'EnumerationMember\OncologicModel', 'OptometricModel' => 'EnumerationMember\OptometricModel', 'OtolaryngologicModel' => 'EnumerationMember\OtolaryngologicModel', 'PathologyModel' => 'EnumerationMember\PathologyModel', 'PediatricModel' => 'EnumerationMember\PediatricModel', 'PharmacySpecialtyModel' => 'EnumerationMember\PharmacySpecialtyModel', 'PhysiotherapyModel' => 'EnumerationMember\PhysiotherapyModel', 'PlasticSurgeryModel' => 'EnumerationMember\PlasticSurgeryModel', 'PodiatricModel' => 'EnumerationMember\PodiatricModel', 'PrimaryCareModel' => 'EnumerationMember\PrimaryCareModel', 'PsychiatricModel' => 'EnumerationMember\PsychiatricModel', 'PublicHealthModel' => 'EnumerationMember\PublicHealthModel', 'PulmonaryModel' => 'EnumerationMember\PulmonaryModel', 'RadiographyModel' => 'EnumerationMember\RadiographyModel', 'RenalModel' => 'EnumerationMember\RenalModel', 'RespiratoryTherapyModel' => 'EnumerationMember\RespiratoryTherapyModel', 'RheumatologicModel' => 'EnumerationMember\RheumatologicModel', 'SpeechPathologyModel' => 'EnumerationMember\SpeechPathologyModel', 'SurgicalModel' => 'EnumerationMember\SurgicalModel', 'ToxicologicModel' => 'EnumerationMember\ToxicologicModel', 'UrologicModel' => 'EnumerationMember\UrologicModel'];

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\NameModel $name = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\SupersededByModel $supersededBy = null,
        public ?Property\UrlModel $url = null,
    ) {
    }
}
