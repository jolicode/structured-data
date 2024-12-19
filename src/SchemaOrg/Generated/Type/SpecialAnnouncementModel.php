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

final class SpecialAnnouncementModel
{
    public const DESCRIPTION = 'A SpecialAnnouncement combines a simple date-stamped textual information update
      with contextualized Web links and other structured data.  It represents an information update made by a
      locally-oriented organization, for example schools, pharmacies, healthcare providers,  community groups, police,
      local government.

For work in progress guidelines on Coronavirus-related markup see [this doc](https://docs.google.com/document/d/14ikaGCKxo50rRM7nvKSlbUpjyIk2WMQd3IkB1lItlrM/edit#).

The motivating scenario for SpecialAnnouncement is the [Coronavirus pandemic](https://en.wikipedia.org/wiki/2019%E2%80%9320_coronavirus_pandemic), and the initial vocabulary is oriented to this urgent situation. Schema.org
expect to improve the markup iteratively as it is deployed and as feedback emerges from use. In addition to our
usual [Github entry](https://github.com/schemaorg/schemaorg/issues/2490), feedback comments can also be provided in [this document](https://docs.google.com/document/d/1fpdFFxk8s87CWwACs53SGkYv3aafSxz_DTtOQxMrBJQ/edit#).


While this schema is designed to communicate urgent crisis-related information, it is not the same as an emergency warning technology like [CAP](https://en.wikipedia.org/wiki/Common_Alerting_Protocol), although there may be overlaps. The intent is to cover
the kinds of everyday practical information being posted to existing websites during an emergency situation.

Several kinds of information can be provided:

We encourage the provision of "name", "text", "datePosted", "expires" (if appropriate), "category" and
"url" as a simple baseline. It is important to provide a value for "category" where possible, most ideally as a well known
URL from Wikipedia or Wikidata. In the case of the 2019-2020 Coronavirus pandemic, this should be "https://en.wikipedia.org/w/index.php?title=2019-20\_coronavirus\_pandemic" or "https://www.wikidata.org/wiki/Q81068910".

For many of the possible properties, values can either be simple links or an inline description, depending on whether a summary is available. For a link, provide just the URL of the appropriate page as the property\'s value. For an inline description, use a [[WebContent]] type, and provide the url as a property of that, alongside at least a simple "[[text]]" summary of the page. It is
unlikely that a single SpecialAnnouncement will need all of the possible properties simultaneously.

We expect that in many cases the page referenced might contain more specialized structured data, e.g. contact info, [[openingHours]], [[Event]], [[FAQPage]] etc. By linking to those pages from a [[SpecialAnnouncement]] you can help make it clearer that the events are related to the situation (e.g. Coronavirus) indicated by the [[category]] property of the [[SpecialAnnouncement]].

Many [[SpecialAnnouncement]]s will relate to particular regions and to identifiable local organizations. Use [[spatialCoverage]] for the region, and [[announcementLocation]] to indicate specific [[LocalBusiness]]es and [[CivicStructure]]s. If the announcement affects both a particular region and a specific location (for example, a library closure that serves an entire region), use both [[spatialCoverage]] and [[announcementLocation]].

The [[about]] property can be used to indicate entities that are the focus of the announcement. We now recommend using [[about]] only
for representing non-location entities (e.g. a [[Course]] or a [[RadioStation]]). For places, use [[announcementLocation]] and [[spatialCoverage]]. Consumers of this markup should be aware that the initial design encouraged the use of [[about]] for locations too.

The basic content of [[SpecialAnnouncement]] is similar to that of an [RSS](https://en.wikipedia.org/wiki/RSS) or [Atom](https://en.wikipedia.org/wiki/Atom_(Web_standard)) feed. For publishers without such feeds, basic feed-like information can be shared by posting
[[SpecialAnnouncement]] updates in a page, e.g. using JSON-LD. For sites with Atom/RSS functionality, you can point to a feed
with the [[webFeed]] property. This can be a simple URL, or an inline [[DataFeed]] object, with [[encodingFormat]] providing
media type information, e.g. "application/rss+xml" or "application/atom+xml".';
    public const LABEL = 'SpecialAnnouncement';
    public const NAME = 'schema:SpecialAnnouncement';
    public const PARENTS = ['CreativeWorkModel' => 'Jolicode\SchemaOrg\Type\CreativeWorkModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2490'];

    public function __construct(
        public ?Property\AboutModel $about = null,
        public ?Property\AbstractModel $abstract = null,
        public ?Property\AccessModeModel $accessMode = null,
        public ?Property\AccessModeSufficientModel $accessModeSufficient = null,
        public ?Property\AccessibilityAPIModel $accessibilityAPI = null,
        public ?Property\AccessibilityControlModel $accessibilityControl = null,
        public ?Property\AccessibilityFeatureModel $accessibilityFeature = null,
        public ?Property\AccessibilityHazardModel $accessibilityHazard = null,
        public ?Property\AccessibilitySummaryModel $accessibilitySummary = null,
        public ?Property\AccountablePersonModel $accountablePerson = null,
        public ?Property\AcquireLicensePageModel $acquireLicensePage = null,
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AggregateRatingModel $aggregateRating = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\AlternativeHeadlineModel $alternativeHeadline = null,
        public ?Property\AnnouncementLocationModel $announcementLocation = null,
        public ?Property\ArchivedAtModel $archivedAt = null,
        public ?Property\AssessesModel $assesses = null,
        public ?Property\AssociatedMediaModel $associatedMedia = null,
        public ?Property\AudienceModel $audience = null,
        public ?Property\AudioModel $audio = null,
        public ?Property\AuthorModel $author = null,
        public ?Property\AwardModel $award = null,
        public ?Property\AwardsModel $awards = null,
        public ?Property\CategoryModel $category = null,
        public ?Property\CharacterModel $character = null,
        public ?Property\CitationModel $citation = null,
        public ?Property\CommentModel $comment = null,
        public ?Property\CommentCountModel $commentCount = null,
        public ?Property\ConditionsOfAccessModel $conditionsOfAccess = null,
        public ?Property\ContentLocationModel $contentLocation = null,
        public ?Property\ContentRatingModel $contentRating = null,
        public ?Property\ContentReferenceTimeModel $contentReferenceTime = null,
        public ?Property\ContributorModel $contributor = null,
        public ?Property\CopyrightHolderModel $copyrightHolder = null,
        public ?Property\CopyrightNoticeModel $copyrightNotice = null,
        public ?Property\CopyrightYearModel $copyrightYear = null,
        public ?Property\CorrectionModel $correction = null,
        public ?Property\CountryOfOriginModel $countryOfOrigin = null,
        public ?Property\CreativeWorkStatusModel $creativeWorkStatus = null,
        public ?Property\CreatorModel $creator = null,
        public ?Property\CreditTextModel $creditText = null,
        public ?Property\DateCreatedModel $dateCreated = null,
        public ?Property\DateModifiedModel $dateModified = null,
        public ?Property\DatePostedModel $datePosted = null,
        public ?Property\DatePublishedModel $datePublished = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DigitalSourceTypeModel $digitalSourceType = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\DiscussionUrlModel $discussionUrl = null,
        public ?Property\DiseasePreventionInfoModel $diseasePreventionInfo = null,
        public ?Property\DiseaseSpreadStatisticsModel $diseaseSpreadStatistics = null,
        public ?Property\EditEIDRModel $editEIDR = null,
        public ?Property\EditorModel $editor = null,
        public ?Property\EducationalAlignmentModel $educationalAlignment = null,
        public ?Property\EducationalLevelModel $educationalLevel = null,
        public ?Property\EducationalUseModel $educationalUse = null,
        public ?Property\EncodingModel $encoding = null,
        public ?Property\EncodingFormatModel $encodingFormat = null,
        public ?Property\EncodingsModel $encodings = null,
        public ?Property\ExampleOfWorkModel $exampleOfWork = null,
        public ?Property\ExpiresModel $expires = null,
        public ?Property\FileFormatModel $fileFormat = null,
        public ?Property\FunderModel $funder = null,
        public ?Property\FundingModel $funding = null,
        public ?Property\GenreModel $genre = null,
        public ?Property\GettingTestedInfoModel $gettingTestedInfo = null,
        public ?Property\GovernmentBenefitsInfoModel $governmentBenefitsInfo = null,
        public ?Property\HasPartModel $hasPart = null,
        public ?Property\HeadlineModel $headline = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\InLanguageModel $inLanguage = null,
        public ?Property\InteractionStatisticModel $interactionStatistic = null,
        public ?Property\InteractivityTypeModel $interactivityType = null,
        public ?Property\InterpretedAsClaimModel $interpretedAsClaim = null,
        public ?Property\IsAccessibleForFreeModel $isAccessibleForFree = null,
        public ?Property\IsBasedOnModel $isBasedOn = null,
        public ?Property\IsBasedOnUrlModel $isBasedOnUrl = null,
        public ?Property\IsFamilyFriendlyModel $isFamilyFriendly = null,
        public ?Property\IsPartOfModel $isPartOf = null,
        public ?Property\KeywordsModel $keywords = null,
        public ?Property\LearningResourceTypeModel $learningResourceType = null,
        public ?Property\LicenseModel $license = null,
        public ?Property\LocationCreatedModel $locationCreated = null,
        public ?Property\MainEntityModel $mainEntity = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\MaintainerModel $maintainer = null,
        public ?Property\MaterialModel $material = null,
        public ?Property\MaterialExtentModel $materialExtent = null,
        public ?Property\MentionsModel $mentions = null,
        public ?Property\NameModel $name = null,
        public ?Property\NewsUpdatesAndGuidelinesModel $newsUpdatesAndGuidelines = null,
        public ?Property\OffersModel $offers = null,
        public ?Property\PatternModel $pattern = null,
        public ?Property\PositionModel $position = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\ProducerModel $producer = null,
        public ?Property\ProviderModel $provider = null,
        public ?Property\PublicTransportClosuresInfoModel $publicTransportClosuresInfo = null,
        public ?Property\PublicationModel $publication = null,
        public ?Property\PublisherModel $publisher = null,
        public ?Property\PublisherImprintModel $publisherImprint = null,
        public ?Property\PublishingPrinciplesModel $publishingPrinciples = null,
        public ?Property\QuarantineGuidelinesModel $quarantineGuidelines = null,
        public ?Property\RecordedAtModel $recordedAt = null,
        public ?Property\ReleasedEventModel $releasedEvent = null,
        public ?Property\ReviewModel $review = null,
        public ?Property\ReviewsModel $reviews = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SchemaVersionModel $schemaVersion = null,
        public ?Property\SchoolClosuresInfoModel $schoolClosuresInfo = null,
        public ?Property\SdDatePublishedModel $sdDatePublished = null,
        public ?Property\SdLicenseModel $sdLicense = null,
        public ?Property\SdPublisherModel $sdPublisher = null,
        public ?Property\SizeModel $size = null,
        public ?Property\SourceOrganizationModel $sourceOrganization = null,
        public ?Property\SpatialModel $spatial = null,
        public ?Property\SpatialCoverageModel $spatialCoverage = null,
        public ?Property\SponsorModel $sponsor = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\TeachesModel $teaches = null,
        public ?Property\TemporalModel $temporal = null,
        public ?Property\TemporalCoverageModel $temporalCoverage = null,
        public ?Property\TextModel $text = null,
        public ?Property\ThumbnailModel $thumbnail = null,
        public ?Property\ThumbnailUrlModel $thumbnailUrl = null,
        public ?Property\TimeRequiredModel $timeRequired = null,
        public ?Property\TranslationOfWorkModel $translationOfWork = null,
        public ?Property\TranslatorModel $translator = null,
        public ?Property\TravelBansModel $travelBans = null,
        public ?Property\TypicalAgeRangeModel $typicalAgeRange = null,
        public ?Property\UrlModel $url = null,
        public ?Property\UsageInfoModel $usageInfo = null,
        public ?Property\VersionModel $version = null,
        public ?Property\VideoModel $video = null,
        public ?Property\WebFeedModel $webFeed = null,
        public ?Property\WorkExampleModel $workExample = null,
        public ?Property\WorkTranslationModel $workTranslation = null,
    ) {
    }
}
