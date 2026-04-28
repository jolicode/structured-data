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

final class IPTCDigitalSourceEnumerationModel
{
    public const DESCRIPTION = '<a href="https://www.iptc.org/">IPTC</a> "Digital Source" codes for use with the [[digitalSourceType]] property, providing information about the source for a digital media object.
In general these codes are not declared here to be mutually exclusive, although some combinations would be contradictory if applied simultaneously, or might be considered mutually incompatible by upstream maintainers of the definitions. See the IPTC <a href="https://www.iptc.org/std/photometadata/documentation/userguide/">documentation</a>
 for <a href="https://cv.iptc.org/newscodes/digitalsourcetype/">detailed definitions</a> of all terms.';
    public const LABEL = 'IPTCDigitalSourceEnumeration';
    public const NAME = 'schema:IPTCDigitalSourceEnumeration';
    public const PARENTS = ['MediaEnumerationModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MediaEnumerationModel'];
    public const ENUMERATION_MEMBERS = ['AlgorithmicMediaDigitalSourceModel' => 'EnumerationMember\AlgorithmicMediaDigitalSourceModel', 'AlgorithmicallyEnhancedDigitalSourceModel' => 'EnumerationMember\AlgorithmicallyEnhancedDigitalSourceModel', 'CompositeCaptureDigitalSourceModel' => 'EnumerationMember\CompositeCaptureDigitalSourceModel', 'CompositeDigitalSourceModel' => 'EnumerationMember\CompositeDigitalSourceModel', 'CompositeSyntheticDigitalSourceModel' => 'EnumerationMember\CompositeSyntheticDigitalSourceModel', 'CompositeWithTrainedAlgorithmicMediaDigitalSourceModel' => 'EnumerationMember\CompositeWithTrainedAlgorithmicMediaDigitalSourceModel', 'DataDrivenMediaDigitalSourceModel' => 'EnumerationMember\DataDrivenMediaDigitalSourceModel', 'DigitalArtDigitalSourceModel' => 'EnumerationMember\DigitalArtDigitalSourceModel', 'DigitalCaptureDigitalSourceModel' => 'EnumerationMember\DigitalCaptureDigitalSourceModel', 'MinorHumanEditsDigitalSourceModel' => 'EnumerationMember\MinorHumanEditsDigitalSourceModel', 'MultiFrameComputationalCaptureDigitalSourceModel' => 'EnumerationMember\MultiFrameComputationalCaptureDigitalSourceModel', 'NegativeFilmDigitalSourceModel' => 'EnumerationMember\NegativeFilmDigitalSourceModel', 'PositiveFilmDigitalSourceModel' => 'EnumerationMember\PositiveFilmDigitalSourceModel', 'PrintDigitalSourceModel' => 'EnumerationMember\PrintDigitalSourceModel', 'ScreenCaptureDigitalSourceModel' => 'EnumerationMember\ScreenCaptureDigitalSourceModel', 'TrainedAlgorithmicMediaDigitalSourceModel' => 'EnumerationMember\TrainedAlgorithmicMediaDigitalSourceModel', 'VirtualRecordingDigitalSourceModel' => 'EnumerationMember\VirtualRecordingDigitalSourceModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/3392'];

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
