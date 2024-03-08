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

final class ClaimModel
{
    public const DESCRIPTION = 'A [[Claim]] in Schema.org represents a specific, factually-oriented claim that could be the [[itemReviewed]] in a [[ClaimReview]]. The content of a claim can be summarized with the [[text]] property. Variations on well known claims can have their common identity indicated via [[sameAs]] links, and summarized with a [[name]]. Ideally, a [[Claim]] description includes enough contextual information to minimize the risk of ambiguity or inclarity. In practice, many claims are better understood in the context in which they appear or the interpretations provided by claim reviews.

  Beyond [[ClaimReview]], the Claim type can be associated with related creative works - for example a [[ScholarlyArticle]] or [[Question]] might be [[about]] some [[Claim]].

  At this time, Schema.org does not define any types of relationship between claims. This is a natural area for future exploration.
  ';
    public const LABEL = 'Claim';
    public const NAME = 'schema:Claim';
    public const PARENTS = ['CreativeWorkModel' => 'SchemaOrg\Type\CreativeWorkModel'];
    public const ENUMERATION_MEMBERS = [];

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
        public ?Property\AppearanceModel $appearance = null,
        public ?Property\ArchivedAtModel $archivedAt = null,
        public ?Property\AssessesModel $assesses = null,
        public ?Property\AssociatedMediaModel $associatedMedia = null,
        public ?Property\AudienceModel $audience = null,
        public ?Property\AudioModel $audio = null,
        public ?Property\AuthorModel $author = null,
        public ?Property\AwardModel $award = null,
        public ?Property\AwardsModel $awards = null,
        public ?Property\CharacterModel $character = null,
        public ?Property\CitationModel $citation = null,
        public ?Property\ClaimInterpreterModel $claimInterpreter = null,
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
        public ?Property\DatePublishedModel $datePublished = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\DiscussionUrlModel $discussionUrl = null,
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
        public ?Property\FirstAppearanceModel $firstAppearance = null,
        public ?Property\FunderModel $funder = null,
        public ?Property\FundingModel $funding = null,
        public ?Property\GenreModel $genre = null,
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
        public ?Property\OffersModel $offers = null,
        public ?Property\PatternModel $pattern = null,
        public ?Property\PositionModel $position = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\ProducerModel $producer = null,
        public ?Property\ProviderModel $provider = null,
        public ?Property\PublicationModel $publication = null,
        public ?Property\PublisherModel $publisher = null,
        public ?Property\PublisherImprintModel $publisherImprint = null,
        public ?Property\PublishingPrinciplesModel $publishingPrinciples = null,
        public ?Property\RecordedAtModel $recordedAt = null,
        public ?Property\ReleasedEventModel $releasedEvent = null,
        public ?Property\ReviewModel $review = null,
        public ?Property\ReviewsModel $reviews = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SchemaVersionModel $schemaVersion = null,
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
        public ?Property\TypicalAgeRangeModel $typicalAgeRange = null,
        public ?Property\UrlModel $url = null,
        public ?Property\UsageInfoModel $usageInfo = null,
        public ?Property\VersionModel $version = null,
        public ?Property\VideoModel $video = null,
        public ?Property\WorkExampleModel $workExample = null,
        public ?Property\WorkTranslationModel $workTranslation = null,
    ) {
    }
}
