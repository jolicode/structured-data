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

namespace SchemaOrg\Type;

use SchemaOrg\Property;

final class ObservationModel
{
    public const DESCRIPTION = 'Instances of the class [[Observation]] are used to specify observations about an entity at a particular time. The principal properties of an [[Observation]] are [[observationAbout]], [[measuredProperty]], [[statType]], [[value] and [[observationDate]]  and [[measuredProperty]]. Some but not all Observations represent a [[QuantitativeValue]]. Quantitative observations can be about a [[StatisticalVariable]], which is an abstract specification about which we can make observations that are grounded at a particular location and time.

Observations can also encode a subset of simple RDF-like statements (its observationAbout, a StatisticalVariable, defining the measuredPoperty; its observationAbout property indicating the entity the statement is about, and [[value]] )

In the context of a quantitative knowledge graph, typical properties could include [[measuredProperty]], [[observationAbout]], [[observationDate]], [[value]], [[unitCode]], [[unitText]], [[measurementMethod]].
    ';
    public const LABEL = 'Observation';
    public const NAME = 'schema:Observation';
    public const PARENTS = ['IntangibleModel' => 'SchemaOrg\\Type\\IntangibleModel', 'QuantitativeValueModel' => 'SchemaOrg\\Type\\QuantitativeValueModel'];
    public const ENUMERATION_MEMBERS = [];

    public function __construct(
        public ?Property\AdditionalPropertyModel $additionalProperty = null,
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\MarginOfErrorModel $marginOfError = null,
        public ?Property\MaxValueModel $maxValue = null,
        public ?Property\MeasuredPropertyModel $measuredProperty = null,
        public ?Property\MeasurementDenominatorModel $measurementDenominator = null,
        public ?Property\MeasurementMethodModel $measurementMethod = null,
        public ?Property\MeasurementQualifierModel $measurementQualifier = null,
        public ?Property\MeasurementTechniqueModel $measurementTechnique = null,
        public ?Property\MinValueModel $minValue = null,
        public ?Property\NameModel $name = null,
        public ?Property\ObservationAboutModel $observationAbout = null,
        public ?Property\ObservationDateModel $observationDate = null,
        public ?Property\ObservationPeriodModel $observationPeriod = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\UnitCodeModel $unitCode = null,
        public ?Property\UnitTextModel $unitText = null,
        public ?Property\UrlModel $url = null,
        public ?Property\ValueModel $value = null,
        public ?Property\ValueReferenceModel $valueReference = null,
        public ?Property\VariableMeasuredModel $variableMeasured = null,
    ) {
    }
}
