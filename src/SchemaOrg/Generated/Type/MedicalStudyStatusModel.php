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

final class MedicalStudyStatusModel
{
    public const DESCRIPTION = 'The status of a medical study. Enumerated type.';
    public const LABEL = 'MedicalStudyStatus';
    public const NAME = 'schema:MedicalStudyStatus';
    public const PARENTS = ['MedicalEnumerationModel' => 'Jolicode\SchemaOrg\Type\MedicalEnumerationModel'];
    public const ENUMERATION_MEMBERS = ['ActiveNotRecruitingModel' => 'EnumerationMember\ActiveNotRecruitingModel', 'CompletedModel' => 'EnumerationMember\CompletedModel', 'EnrollingByInvitationModel' => 'EnumerationMember\EnrollingByInvitationModel', 'NotYetRecruitingModel' => 'EnumerationMember\NotYetRecruitingModel', 'RecruitingModel' => 'EnumerationMember\RecruitingModel', 'ResultsAvailableModel' => 'EnumerationMember\ResultsAvailableModel', 'ResultsNotAvailableModel' => 'EnumerationMember\ResultsNotAvailableModel', 'SuspendedModel' => 'EnumerationMember\SuspendedModel', 'TerminatedModel' => 'EnumerationMember\TerminatedModel', 'WithdrawnModel' => 'EnumerationMember\WithdrawnModel'];
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
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\SupersededByModel $supersededBy = null,
        public ?Property\UrlModel $url = null,
    ) {
    }
}
